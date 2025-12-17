<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Invoice;
use Stripe\Exception\ApiErrorException;

class UsageBillingController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    /**
     * Get current usage and billing info
     */
    public function getCurrentUsage(Request $request)
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
        $month = now()->format('Y-m');
        
        // Get current month usage
        $currentUsage = DB::table('usage_counters')
            ->where('platform_id', $platform['id'])
            ->where('month', $month)
            ->value('count') ?? 0;

        $limit = $this->getPlanLimit($platformData->plan);
        $overage = max(0, $currentUsage - $limit);
        $overageAmount = $overage * ($platformData->overage_rate ?? 0.01) * 100; // Convert to cents

        // Get subscription info
        $subscription = DB::table('subscriptions')
            ->where('platform_id', $platform['id'])
            ->where('status', 'active')
            ->first();

        $baseSubscriptionAmount = 0;
        if ($subscription) {
            $baseSubscriptionAmount = $subscription->plan === 'pro' ? 9900 : 0; // $99 në cents
        }

        return response()->json([
            'success' => true,
            'usage' => [
                'current' => $currentUsage,
                'limit' => $limit,
                'overage' => $overage,
                'percentage' => $limit > 0 ? round(($currentUsage / $limit) * 100, 2) : 0,
                'days_remaining' => now()->daysInMonth - now()->day,
            ],
            'billing' => [
                'base_subscription' => $baseSubscriptionAmount / 100,
                'overage_rate' => $platformData->overage_rate ?? 0.01,
                'overage_amount' => $overageAmount / 100,
                'total_estimate' => ($baseSubscriptionAmount + $overageAmount) / 100,
            ],
            'plan' => $platformData->plan,
            'has_subscription' => $subscription !== null,
        ]);
    }

    /**
     * Calculate monthly billing (called at end of month)
     */
    public function calculateMonthlyBilling(Request $request, $platformId = null)
    {
        // This can be called manually or via cron job
        $month = $request->input('month', now()->subMonth()->format('Y-m'));
        
        if ($platformId) {
            $platforms = DB::table('platforms')->where('id', $platformId)->get();
        } else {
            // Calculate për të gjitha platformat
            $platforms = DB::table('platforms')->get();
        }

        foreach ($platforms as $platform) {
            $this->calculateBillingForPlatform($platform, $month);
        }

        return response()->json([
            'success' => true,
            'message' => 'Billing calculated for ' . count($platforms) . ' platforms',
        ]);
    }

    /**
     * Calculate billing për një platform
     */
    private function calculateBillingForPlatform($platform, $month)
    {
        // Get usage për muajin
        $usage = DB::table('usage_counters')
            ->where('platform_id', $platform->id)
            ->where('month', $month)
            ->value('count') ?? 0;

        $limit = $this->getPlanLimit($platform->plan);
        $includedUsage = $limit;
        $overage = max(0, $usage - $limit);
        $overageRate = $platform->overage_rate ?? 0.01;
        $overageAmount = $overage * $overageRate * 100; // Convert to cents

        // Get subscription amount
        $subscription = DB::table('subscriptions')
            ->where('platform_id', $platform->id)
            ->where('status', 'active')
            ->first();

        $baseAmount = 0;
        if ($subscription) {
            $baseAmount = $subscription->plan === 'pro' ? 9900 : 0; // $99 në cents
        }

        $totalAmount = $baseAmount + $overageAmount;

        // Create or update usage billing record
        DB::table('usage_billing')->updateOrInsert(
            [
                'platform_id' => $platform->id,
                'month' => $month,
            ],
            [
                'base_subscription_amount' => $baseAmount,
                'usage_count' => $usage,
                'included_usage' => $includedUsage,
                'overage_count' => $overage,
                'overage_rate' => $overageRate,
                'overage_amount' => $overageAmount,
                'total_amount' => $totalAmount,
                'status' => $overage > 0 ? 'calculated' : 'pending',
                'calculated_at' => now(),
                'updated_at' => now(),
            ]
        );

        // If there's overage, create invoice
        if ($overage > 0 && $subscription && $platform->stripe_customer_id) {
            $this->createOverageInvoice($platform, $month, $overageAmount);
        }
    }

    /**
     * Create invoice për overage
     */
    private function createOverageInvoice($platform, $month, $amount)
    {
        try {
            $invoice = Invoice::create([
                'customer' => $platform->stripe_customer_id,
                'auto_advance' => true,
                'collection_method' => 'charge_automatically',
                'description' => "Voice Actions SDK - Overage charges for {$month}",
            ]);

            // Add invoice item
            \Stripe\InvoiceItem::create([
                'customer' => $platform->stripe_customer_id,
                'invoice' => $invoice->id,
                'amount' => $amount,
                'currency' => 'usd',
                'description' => "Overage charges for {$month}",
            ]);

            // Finalize invoice
            $invoice->finalizeInvoice();

            // Update usage billing record
            DB::table('usage_billing')
                ->where('platform_id', $platform->id)
                ->where('month', $month)
                ->update([
                    'stripe_invoice_id' => $invoice->id,
                    'status' => 'invoiced',
                    'invoiced_at' => now(),
                ]);

        } catch (ApiErrorException $e) {
            \Log::error('Failed to create overage invoice: ' . $e->getMessage());
        }
    }

    /**
     * Get billing history
     */
    public function getBillingHistory(Request $request)
    {
        $apiKey = $request->bearerToken() ?? $request->header('X-API-Key');
        $platform = $this->verifyApiKey($apiKey);
        
        if (!$platform) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid API key'
            ], 401);
        }

        $billingHistory = DB::table('usage_billing')
            ->where('platform_id', $platform['id'])
            ->orderBy('month', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'billing_history' => $billingHistory->map(function ($bill) {
                return [
                    'month' => $bill->month,
                    'usage_count' => $bill->usage_count,
                    'overage_count' => $bill->overage_count,
                    'base_subscription' => $bill->base_subscription_amount / 100,
                    'overage_amount' => $bill->overage_amount / 100,
                    'total_amount' => $bill->total_amount / 100,
                    'status' => $bill->status,
                    'stripe_invoice_id' => $bill->stripe_invoice_id,
                    'calculated_at' => $bill->calculated_at,
                    'paid_at' => $bill->paid_at,
                ];
            })
        ]);
    }

    /**
     * Get plan limit
     */
    private function getPlanLimit($plan)
    {
        return match($plan) {
            'enterprise' => 10000000,
            'pro' => 999999,
            default => 9999,
        };
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
