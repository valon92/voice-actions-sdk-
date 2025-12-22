<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Subscription;
use Stripe\Exception\ApiErrorException;

class SubscriptionController extends Controller
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
     * Get current subscription
     */
    public function getCurrent(Request $request)
    {
        try {
            $apiKey = $request->bearerToken() ?? $request->header('X-API-Key');
            $platform = $this->verifyApiKey($apiKey);
            
            if (!$platform) {
                return response()->json([
                    'success' => false,
                    'error' => 'Invalid API key'
                ], 401);
            }

            // Check if subscriptions table exists
            $subscription = null;
            try {
                $subscription = DB::table('subscriptions')
                    ->where('platform_id', $platform['id'])
                    ->where('status', '!=', 'canceled')
                    ->orderBy('created_at', 'desc')
                    ->first();
            } catch (\Exception $e) {
                // Table might not exist, return null subscription
                if (config('app.debug')) {
                    \Log::warning('subscriptions table might not exist: ' . $e->getMessage());
                }
            }

            if (!$subscription) {
                return response()->json([
                    'success' => true,
                    'subscription' => null,
                    'message' => 'No active subscription'
                ]);
            }

            return response()->json([
                'success' => true,
                'subscription' => [
                    'id' => $subscription->id,
                    'plan' => $subscription->plan ?? 'free',
                    'status' => $subscription->status ?? 'inactive',
                    'current_period_start' => $subscription->current_period_start,
                    'current_period_end' => $subscription->current_period_end,
                    'trial_ends_at' => $subscription->trial_ends_at,
                    'cancel_at_period_end' => (bool) ($subscription->cancel_at_period_end ?? false),
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('getCurrent subscription error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'api_key' => substr($request->bearerToken() ?? $request->header('X-API-Key') ?? '', 0, 10) . '...',
            ]);

            return response()->json([
                'success' => false,
                'error' => 'Failed to load subscription',
                'message' => config('app.debug') ? $e->getMessage() : 'An error occurred while loading subscription',
            ], 500);
        }
    }

    /**
     * Cancel subscription
     */
    public function cancel(Request $request)
    {
        $apiKey = $request->bearerToken() ?? $request->header('X-API-Key');
        $platform = $this->verifyApiKey($apiKey);
        
        if (!$platform) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid API key'
            ], 401);
        }

        $subscription = DB::table('subscriptions')
            ->where('platform_id', $platform['id'])
            ->where('status', 'active')
            ->first();

        if (!$subscription) {
            return response()->json([
                'success' => false,
                'error' => 'No active subscription found'
            ], 404);
        }

        try {
            $stripeSubscription = Subscription::retrieve($subscription->stripe_subscription_id);
            
            // Cancel at period end
            $stripeSubscription->cancel_at_period_end = true;
            $stripeSubscription->save();

            DB::table('subscriptions')
                ->where('id', $subscription->id)
                ->update([
                    'cancel_at_period_end' => true,
                    'updated_at' => now(),
                ]);

            return response()->json([
                'success' => true,
                'message' => 'Subscription will be canceled at the end of the billing period',
                'cancel_at_period_end' => true,
                'current_period_end' => $subscription->current_period_end,
            ]);
        } catch (ApiErrorException $e) {
            Log::error('Stripe cancel subscription error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Failed to cancel subscription'
            ], 500);
        }
    }

    /**
     * Resume canceled subscription
     */
    public function resume(Request $request)
    {
        $apiKey = $request->bearerToken() ?? $request->header('X-API-Key');
        $platform = $this->verifyApiKey($apiKey);
        
        if (!$platform) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid API key'
            ], 401);
        }

        $subscription = DB::table('subscriptions')
            ->where('platform_id', $platform['id'])
            ->where('cancel_at_period_end', true)
            ->first();

        if (!$subscription) {
            return response()->json([
                'success' => false,
                'error' => 'No subscription scheduled for cancellation'
            ], 404);
        }

        try {
            $stripeSubscription = Subscription::retrieve($subscription->stripe_subscription_id);
            $stripeSubscription->cancel_at_period_end = false;
            $stripeSubscription->save();

            DB::table('subscriptions')
                ->where('id', $subscription->id)
                ->update([
                    'cancel_at_period_end' => false,
                    'updated_at' => now(),
                ]);

            return response()->json([
                'success' => true,
                'message' => 'Subscription has been resumed',
            ]);
        } catch (ApiErrorException $e) {
            Log::error('Stripe resume subscription error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Failed to resume subscription'
            ], 500);
        }
    }

    /**
     * Get subscription history
     */
    public function getHistory(Request $request)
    {
        $apiKey = $request->bearerToken() ?? $request->header('X-API-Key');
        $platform = $this->verifyApiKey($apiKey);
        
        if (!$platform) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid API key'
            ], 401);
        }

        $subscriptions = DB::table('subscriptions')
            ->where('platform_id', $platform['id'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'subscriptions' => $subscriptions->map(function ($sub) {
                return [
                    'id' => $sub->id,
                    'plan' => $sub->plan,
                    'status' => $sub->status,
                    'current_period_start' => $sub->current_period_start,
                    'current_period_end' => $sub->current_period_end,
                    'canceled_at' => $sub->canceled_at,
                    'created_at' => $sub->created_at,
                ];
            })
        ]);
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
