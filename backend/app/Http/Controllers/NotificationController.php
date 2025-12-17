<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    /**
     * Get active notifications for a platform
     * This endpoint is used by the SDK to fetch notifications for end users
     */
    public function getActiveNotifications(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'platform_name' => 'required|string',
            'user_identifier' => 'nullable|string',
            'session_id' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid request parameters',
                'errors' => $validator->errors()
            ], 400);
        }

        $platformName = $request->input('platform_name');
        $userIdentifier = $request->input('user_identifier');
        $sessionId = $request->input('session_id') ?? session()->getId();

        // Get platform
        $platform = DB::table('platforms')
            ->where('name', $platformName)
            ->first();

        if (!$platform) {
            return response()->json([
                'success' => false,
                'error' => 'Platform not found'
            ], 404);
        }

        $now = now();

        // Get active notifications
        $notifications = DB::table('notifications')
            ->where('platform_id', $platform->id)
            ->where('is_active', true)
            ->where(function ($query) use ($now) {
                $query->whereNull('starts_at')
                    ->orWhere('starts_at', '<=', $now);
            })
            ->where(function ($query) use ($now) {
                $query->whereNull('ends_at')
                    ->orWhere('ends_at', '>=', $now);
            })
            ->orderBy('priority', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        // Filter notifications based on target audience and user views
        $filteredNotifications = [];
        
        foreach ($notifications as $notification) {
            // Check if notification targets this user
            $targetAudience = json_decode($notification->target_audience ?? '["all"]', true);
            
            if (!in_array('all', $targetAudience) && $userIdentifier) {
                if (!in_array($userIdentifier, $targetAudience)) {
                    continue; // Skip if user not in target audience
                }
            }

            // Check if user has dismissed this notification
            $viewRecord = DB::table('notification_views')
                ->where('notification_id', $notification->id)
                ->where(function ($query) use ($userIdentifier, $sessionId) {
                    if ($userIdentifier) {
                        $query->where('user_identifier', $userIdentifier);
                    } else {
                        $query->where('session_id', $sessionId);
                    }
                })
                ->first();

            if ($viewRecord && $viewRecord->is_dismissed && $notification->is_dismissible) {
                continue; // Skip dismissed notifications
            }

            // Track view if not already viewed
            if (!$viewRecord) {
                DB::table('notification_views')->insert([
                    'notification_id' => $notification->id,
                    'user_identifier' => $userIdentifier,
                    'session_id' => $sessionId,
                    'viewed_at' => $now,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                // Increment view count
                DB::table('notifications')
                    ->where('id', $notification->id)
                    ->increment('view_count');
            } elseif (!$viewRecord->viewed_at) {
                // Update viewed_at if not set
                DB::table('notification_views')
                    ->where('id', $viewRecord->id)
                    ->update(['viewed_at' => $now]);
            }

            $filteredNotifications[] = [
                'id' => $notification->id,
                'type' => $notification->type,
                'title' => $notification->title,
                'message' => $notification->message,
                'action_url' => $notification->action_url,
                'action_text' => $notification->action_text,
                'is_dismissible' => $notification->is_dismissible,
                'priority' => $notification->priority,
            ];
        }

        return response()->json([
            'success' => true,
            'notifications' => $filteredNotifications,
            'count' => count($filteredNotifications)
        ]);
    }

    /**
     * Mark notification as dismissed
     */
    public function dismissNotification(Request $request, $notificationId)
    {
        $validator = Validator::make($request->all(), [
            'platform_name' => 'required|string',
            'user_identifier' => 'nullable|string',
            'session_id' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid request parameters'
            ], 400);
        }

        $platformName = $request->input('platform_name');
        $userIdentifier = $request->input('user_identifier');
        $sessionId = $request->input('session_id') ?? session()->getId();

        // Get platform
        $platform = DB::table('platforms')
            ->where('name', $platformName)
            ->first();

        if (!$platform) {
            return response()->json([
                'success' => false,
                'error' => 'Platform not found'
            ], 404);
        }

        // Verify notification belongs to platform
        $notification = DB::table('notifications')
            ->where('id', $notificationId)
            ->where('platform_id', $platform->id)
            ->first();

        if (!$notification) {
            return response()->json([
                'success' => false,
                'error' => 'Notification not found'
            ], 404);
        }

        // Update or create view record
        $viewRecord = DB::table('notification_views')
            ->where('notification_id', $notificationId)
            ->where(function ($query) use ($userIdentifier, $sessionId) {
                if ($userIdentifier) {
                    $query->where('user_identifier', $userIdentifier);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })
            ->first();

        $now = now();

        if ($viewRecord) {
            DB::table('notification_views')
                ->where('id', $viewRecord->id)
                ->update([
                    'is_dismissed' => true,
                    'dismissed_at' => $now,
                    'updated_at' => $now,
                ]);
        } else {
            DB::table('notification_views')->insert([
                'notification_id' => $notificationId,
                'user_identifier' => $userIdentifier,
                'session_id' => $sessionId,
                'is_dismissed' => true,
                'dismissed_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Notification dismissed'
        ]);
    }

    /**
     * Create a new notification (for platform owners)
     * Requires API key authentication
     */
    public function createNotification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:info,update,feature,warning,success',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'action_url' => 'nullable|url',
            'action_text' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'is_dismissible' => 'boolean',
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date|after:starts_at',
            'priority' => 'integer|min:0|max:100',
            'target_audience' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => 'Validation failed',
                'errors' => $validator->errors()
            ], 400);
        }

        $platformId = $request->user()->id ?? $request->header('X-Platform-Id');

        if (!$platformId) {
            return response()->json([
                'success' => false,
                'error' => 'Platform ID required'
            ], 400);
        }

        $notificationId = DB::table('notifications')->insertGetId([
            'platform_id' => $platformId,
            'type' => $request->input('type'),
            'title' => $request->input('title'),
            'message' => $request->input('message'),
            'action_url' => $request->input('action_url'),
            'action_text' => $request->input('action_text'),
            'is_active' => $request->input('is_active', true),
            'is_dismissible' => $request->input('is_dismissible', true),
            'starts_at' => $request->input('starts_at'),
            'ends_at' => $request->input('ends_at'),
            'priority' => $request->input('priority', 0),
            'target_audience' => json_encode($request->input('target_audience', ['all'])),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'notification' => [
                'id' => $notificationId,
                'message' => 'Notification created successfully'
            ]
        ], 201);
    }

    /**
     * Get notification statistics for platform owners
     */
    public function getStats(Request $request)
    {
        $platformId = $request->user()->id ?? $request->header('X-Platform-Id');

        if (!$platformId) {
            return response()->json([
                'success' => false,
                'error' => 'Platform ID required'
            ], 400);
        }

        $stats = DB::table('notifications')
            ->where('platform_id', $platformId)
            ->selectRaw('
                COUNT(*) as total_notifications,
                SUM(CASE WHEN is_active = 1 THEN 1 ELSE 0 END) as active_notifications,
                SUM(view_count) as total_views,
                AVG(view_count) as avg_views_per_notification
            ')
            ->first();

        return response()->json([
            'success' => true,
            'stats' => $stats
        ]);
    }
}

