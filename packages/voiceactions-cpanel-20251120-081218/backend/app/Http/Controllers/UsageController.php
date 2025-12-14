<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsageController extends Controller
{
    public function getStats(Request $request)
    {
        $platformId = $request->input('api_platform_id'); // Set by ApiKeyMiddleware

        if (!$platformId) {
            return response()->json([
                'success' => false,
                'error' => 'Platform ID not found in request context.'
            ], 400);
        }

        $totalCommands = DB::table('usage_counters')
            ->where('platform_id', $platformId)
            ->sum('count');

        $monthlyCommands = DB::table('usage_counters')
            ->where('platform_id', $platformId)
            ->where('month', now()->format('Y-m'))
            ->value('count') ?? 0;

        $last30Days = DB::table('usage_tracking')
            ->where('platform_id', $platformId)
            ->where('event', 'command_executed')
            ->where('timestamp', '>=', now()->subDays(30))
            ->count();

        return response()->json([
            'success' => true,
            'stats' => [
                'total_commands' => $totalCommands,
                'monthly_commands' => $monthlyCommands,
                'last_30_days_commands' => $last30Days,
            ],
        ]);
    }

    public function track(Request $request)
    {
        $platformId = $request->input('api_platform_id'); // Set by ApiKeyMiddleware
        $platformName = $request->input('platform_name', 'unknown');
        $sessionId = $request->input('session_id');
        $event = $request->input('event');
        $data = $request->input('data');

        if (!$platformId) {
            return response()->json(['success' => false, 'error' => 'Platform ID not found in request context.'], 400);
        }

        DB::table('usage_tracking')->insert([
            'platform_id' => $platformId,
            'platform_name' => $platformName,
            'session_id' => $sessionId,
            'event' => $event,
            'data' => json_encode($data),
            'timestamp' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Update usage counter for billing
        if ($event === 'command_executed') {
            $month = now()->format('Y-m');
            DB::table('usage_counters')->updateOrInsert(
                ['platform_id' => $platformId, 'platform_name' => $platformName, 'month' => $month],
                ['count' => DB::raw('count + 1'), 'updated_at' => now()]
            );
        }

        return response()->json(['success' => true, 'message' => 'Usage tracked successfully.']);
    }

}

