<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CheckUsageLimits
{
    /**
     * Handle an incoming request.
     * Kontrollon nëse platforma ka arritur usage limit
     */
    public function handle(Request $request, Closure $next): Response
    {
        $platformId = $request->input('api_platform_id');
        
        if (!$platformId) {
            return $next($request); // Let ApiKeyMiddleware handle this
        }

        $platform = DB::table('platforms')->where('id', $platformId)->first();
        
        if (!$platform) {
            return $next($request);
        }

        // Get current month usage
        $month = now()->format('Y-m');
        $currentUsage = DB::table('usage_counters')
            ->where('platform_id', $platformId)
            ->where('month', $month)
            ->value('count') ?? 0;

        // Get plan limits
        $limit = $this->getPlanLimit($platform->plan);
        
        // Update current usage në platform
        DB::table('platforms')
            ->where('id', $platformId)
            ->update(['usage_current' => $currentUsage]);

        // Check if limit exceeded
        if ($currentUsage >= $limit) {
            // Check if has active subscription (allows overage)
            $hasActiveSubscription = DB::table('subscriptions')
                ->where('platform_id', $platformId)
                ->where('status', 'active')
                ->exists();

            if (!$hasActiveSubscription && $platform->plan === 'free') {
                // Block free plan users që kanë arritur limit
                return response()->json([
                    'success' => false,
                    'error' => 'Usage limit exceeded',
                    'message' => 'You have reached your monthly usage limit. Please upgrade to continue using the service.',
                    'current_usage' => $currentUsage,
                    'limit' => $limit,
                    'upgrade_url' => '/checkout?plan=pro',
                ], 429);
            }
            
            // For paid plans, allow but track for billing
            // Overage will be calculated at end of month
        }

        return $next($request);
    }

    /**
     * Get usage limit për plan
     */
    private function getPlanLimit($plan)
    {
        return match($plan) {
            'enterprise' => 10000000, // 10M komanda/muaj
            'pro' => 999999, // 999K komanda/muaj
            default => 9999, // Free plan: 9,999 komanda/muaj
        };
    }
}
