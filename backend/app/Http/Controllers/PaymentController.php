<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\PaymentMethod;
use Stripe\Exception\ApiErrorException;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Only set Stripe API key if it's configured
        $stripeSecret = env('STRIPE_SECRET');
        if ($stripeSecret) {
            try {
                Stripe::setApiKey($stripeSecret);
            } catch (\Exception $e) {
                // Silently fail if Stripe is not configured
                if (config('app.debug')) {
                    \Log::warning('Stripe API key not configured: ' . $e->getMessage());
                }
            }
        }
    }

    /**
     * Create Stripe checkout session for subscription
     */
    public function createCheckoutSession(Request $request)
    {
        $request->validate([
            'plan' => 'required|in:pro,enterprise',
            'platform_id' => 'required|exists:platforms,id',
        ]);

        $platform = DB::table('platforms')->where('id', $request->platform_id)->first();
        
        if (!$platform) {
            return response()->json([
                'success' => false,
                'error' => 'Platform not found'
            ], 404);
        }

        try {
            // Get or create Stripe customer
            $customerId = $platform->stripe_customer_id;
            if (!$customerId) {
                $customer = \Stripe\Customer::create([
                    'email' => $platform->email,
                    'metadata' => [
                        'platform_id' => $platform->id,
                        'platform_name' => $platform->name,
                    ],
                ]);
                $customerId = $customer->id;
                
                DB::table('platforms')
                    ->where('id', $platform->id)
                    ->update(['stripe_customer_id' => $customerId]);
            }

            // Get price ID based on plan
            $priceId = $this->getPriceIdForPlan($request->plan);
            
            if (!$priceId) {
                return response()->json([
                    'success' => false,
                    'error' => 'Price not configured for this plan'
                ], 400);
            }

            // Create checkout session
            $session = Session::create([
                'customer' => $customerId,
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price' => $priceId,
                    'quantity' => 1,
                ]],
                'mode' => 'subscription',
                'success_url' => $request->input('success_url', env('APP_URL') . '/platform/dashboard?session_id={CHECKOUT_SESSION_ID}'),
                'cancel_url' => $request->input('cancel_url', env('APP_URL') . '/pricing?canceled=true'),
                'metadata' => [
                    'platform_id' => $platform->id,
                    'plan' => $request->plan,
                ],
            ]);

            return response()->json([
                'success' => true,
                'session_id' => $session->id,
                'url' => $session->url,
            ]);
        } catch (ApiErrorException $e) {
            Log::error('Stripe checkout error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Failed to create checkout session: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Handle Stripe webhook
     */
    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = \Stripe\Webhook::constructEvent($payload, $sigHeader, $endpointSecret);
        } catch (\Exception $e) {
            Log::error('Webhook signature verification failed: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $this->handleCheckoutSessionCompleted($event->data->object);
                break;
            case 'customer.subscription.created':
            case 'customer.subscription.updated':
                $this->handleSubscriptionUpdated($event->data->object);
                break;
            case 'customer.subscription.deleted':
                $this->handleSubscriptionDeleted($event->data->object);
                break;
            case 'invoice.payment_succeeded':
                $this->handleInvoicePaymentSucceeded($event->data->object);
                break;
            case 'invoice.payment_failed':
                $this->handleInvoicePaymentFailed($event->data->object);
                break;
        }

        return response()->json(['received' => true]);
    }

    /**
     * Get payment methods for platform
     */
    public function getPaymentMethods(Request $request)
    {
        $apiKey = $request->bearerToken() ?? $request->header('X-API-Key');
        $platform = $this->verifyApiKey($apiKey);
        
        if (!$platform) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid API key'
            ], 401);
        }

        $platformData = DB::table('platforms')->where('id', $platform['id'])->first();
        
        if (!$platformData->stripe_customer_id) {
            return response()->json([
                'success' => true,
                'payment_methods' => []
            ]);
        }

        try {
            $paymentMethods = PaymentMethod::all([
                'customer' => $platformData->stripe_customer_id,
                'type' => 'card',
            ]);

            $methods = [];
            foreach ($paymentMethods->data as $pm) {
                $methods[] = [
                    'id' => $pm->id,
                    'type' => $pm->type,
                    'card' => [
                        'brand' => $pm->card->brand,
                        'last4' => $pm->card->last4,
                        'exp_month' => $pm->card->exp_month,
                        'exp_year' => $pm->card->exp_year,
                    ],
                ];
            }

            return response()->json([
                'success' => true,
                'payment_methods' => $methods
            ]);
        } catch (ApiErrorException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to retrieve payment methods'
            ], 500);
        }
    }

    /**
     * Handle checkout session completed
     */
    private function handleCheckoutSessionCompleted($session)
    {
        $platformId = $session->metadata->platform_id ?? null;
        if (!$platformId) {
            return;
        }

        // Subscription will be created via subscription.created webhook
        Log::info('Checkout session completed for platform: ' . $platformId);
    }

    /**
     * Handle subscription updated
     */
    private function handleSubscriptionUpdated($subscription)
    {
        $customerId = $subscription->customer;
        $platform = DB::table('platforms')->where('stripe_customer_id', $customerId)->first();
        
        if (!$platform) {
            return;
        }

        // Determine plan from subscription
        $plan = 'free';
        if ($subscription->items->data) {
            $priceId = $subscription->items->data[0]->price->id;
            $plan = $this->getPlanFromPriceId($priceId);
        }

        // Create or update subscription record
        DB::table('subscriptions')->updateOrInsert(
            ['stripe_subscription_id' => $subscription->id],
            [
                'platform_id' => $platform->id,
                'plan' => $plan,
                'status' => $subscription->status,
                'stripe_customer_id' => $customerId,
                'trial_ends_at' => $subscription->trial_end ? date('Y-m-d H:i:s', $subscription->trial_end) : null,
                'current_period_start' => date('Y-m-d H:i:s', $subscription->current_period_start),
                'current_period_end' => date('Y-m-d H:i:s', $subscription->current_period_end),
                'cancel_at_period_end' => $subscription->cancel_at_period_end,
                'canceled_at' => $subscription->canceled_at ? date('Y-m-d H:i:s', $subscription->canceled_at) : null,
                'updated_at' => now(),
            ]
        );

        // Update platform
        DB::table('platforms')
            ->where('id', $platform->id)
            ->update([
                'plan' => $plan,
                'subscription_status' => $subscription->status,
                'updated_at' => now(),
            ]);
    }

    /**
     * Handle subscription deleted
     */
    private function handleSubscriptionDeleted($subscription)
    {
        $customerId = $subscription->customer;
        $platform = DB::table('platforms')->where('stripe_customer_id', $customerId)->first();
        
        if (!$platform) {
            return;
        }

        DB::table('subscriptions')
            ->where('stripe_subscription_id', $subscription->id)
            ->update([
                'status' => 'canceled',
                'canceled_at' => now(),
                'updated_at' => now(),
            ]);

        DB::table('platforms')
            ->where('id', $platform->id)
            ->update([
                'plan' => 'free',
                'subscription_status' => 'canceled',
                'updated_at' => now(),
            ]);
    }

    /**
     * Handle invoice payment succeeded
     */
    private function handleInvoicePaymentSucceeded($invoice)
    {
        $customerId = $invoice->customer;
        $platform = DB::table('platforms')->where('stripe_customer_id', $customerId)->first();
        
        if (!$platform) {
            return;
        }

        $subscription = DB::table('subscriptions')
            ->where('stripe_subscription_id', $invoice->subscription)
            ->first();

        // Create invoice record
        DB::table('invoices')->insert([
            'platform_id' => $platform->id,
            'subscription_id' => $subscription->id ?? null,
            'stripe_invoice_id' => $invoice->id,
            'amount' => $invoice->amount_paid,
            'currency' => $invoice->currency,
            'status' => 'paid',
            'invoice_pdf_url' => $invoice->invoice_pdf,
            'invoice_hosted_url' => $invoice->hosted_invoice_url,
            'period_start' => date('Y-m-d H:i:s', $invoice->period_start),
            'period_end' => date('Y-m-d H:i:s', $invoice->period_end),
            'paid_at' => date('Y-m-d H:i:s', $invoice->status_transitions->paid_at ?? time()),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create payment record
        DB::table('payments')->insert([
            'platform_id' => $platform->id,
            'subscription_id' => $subscription->id ?? null,
            'stripe_payment_intent_id' => $invoice->payment_intent,
            'amount' => $invoice->amount_paid,
            'currency' => $invoice->currency,
            'status' => 'succeeded',
            'billing_period_start' => date('Y-m-d H:i:s', $invoice->period_start),
            'billing_period_end' => date('Y-m-d H:i:s', $invoice->period_end),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Handle invoice payment failed
     */
    private function handleInvoicePaymentFailed($invoice)
    {
        $customerId = $invoice->customer;
        $platform = DB::table('platforms')->where('stripe_customer_id', $customerId)->first();
        
        if (!$platform) {
            return;
        }

        DB::table('invoices')->insert([
            'platform_id' => $platform->id,
            'stripe_invoice_id' => $invoice->id,
            'amount' => $invoice->amount_due,
            'currency' => $invoice->currency,
            'status' => 'open',
            'invoice_pdf_url' => $invoice->invoice_pdf,
            'period_start' => date('Y-m-d H:i:s', $invoice->period_start),
            'period_end' => date('Y-m-d H:i:s', $invoice->period_end),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Get price ID for plan
     */
    private function getPriceIdForPlan($plan)
    {
        $prices = [
            'pro' => env('STRIPE_PRICE_PRO'),
            'enterprise' => env('STRIPE_PRICE_ENTERPRISE'),
        ];

        return $prices[$plan] ?? null;
    }

    /**
     * Get plan from price ID
     */
    private function getPlanFromPriceId($priceId)
    {
        if ($priceId === env('STRIPE_PRICE_PRO')) {
            return 'pro';
        } elseif ($priceId === env('STRIPE_PRICE_ENTERPRISE')) {
            return 'enterprise';
        }
        return 'free';
    }

    /**
     * Verify API key
     */
    private function verifyApiKey($apiKey)
    {
        $platforms = DB::table('platforms')
            ->where('status', 'active')
            ->select('id', 'api_key', 'api_key_hash', 'plan')
            ->get();

        foreach ($platforms as $platform) {
            if (\Illuminate\Support\Facades\Hash::check($apiKey, $platform->api_key_hash)) {
                return [
                    'id' => $platform->id,
                    'plan' => $platform->plan ?? 'free'
                ];
            }
        }

        $platform = DB::table('platforms')
            ->where('api_key', $apiKey)
            ->where('status', 'active')
            ->first();

        if ($platform) {
            return [
                'id' => $platform->id,
                'plan' => $platform->plan ?? 'free'
            ];
        }

        return null;
    }
}
