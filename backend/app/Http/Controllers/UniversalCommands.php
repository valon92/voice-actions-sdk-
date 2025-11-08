<?php

namespace App\Http\Controllers;

/**
 * Universal Commands Helper
 * Contains all universal voice commands for social media platforms
 */
class UniversalCommands
{
    /**
     * Get all universal commands organized by category
     */
    public static function getAllCommands($baseLocale)
    {
        $getPhrases = function($command) use ($baseLocale) {
            return self::getPhrases($command, $baseLocale);
        };

        return [
            // ============================================
            // 1. PROFILE MANAGEMENT
            // ============================================
            [
                'id' => 'edit-profile',
                'phrases' => $getPhrases('edit-profile'),
                'action' => 'edit-profile',
                'description' => 'Edit profile information',
                'category' => 'profile'
            ],
            [
                'id' => 'change-profile-picture',
                'phrases' => $getPhrases('change-profile-picture'),
                'action' => 'change-profile-picture',
                'description' => 'Change profile picture',
                'category' => 'profile'
            ],
            [
                'id' => 'change-cover-photo',
                'phrases' => $getPhrases('change-cover-photo'),
                'action' => 'change-cover-photo',
                'description' => 'Change cover photo',
                'category' => 'profile'
            ],
            [
                'id' => 'update-bio',
                'phrases' => $getPhrases('update-bio'),
                'action' => 'update-bio',
                'description' => 'Update bio/description',
                'category' => 'profile'
            ],
            [
                'id' => 'change-username',
                'phrases' => $getPhrases('change-username'),
                'action' => 'change-username',
                'description' => 'Change username',
                'category' => 'profile'
            ],
            [
                'id' => 'set-privacy',
                'phrases' => $getPhrases('set-privacy'),
                'action' => 'set-privacy',
                'description' => 'Set privacy settings',
                'category' => 'profile'
            ],
            [
                'id' => 'verify-profile',
                'phrases' => $getPhrases('verify-profile'),
                'action' => 'verify-profile',
                'description' => 'Verify profile',
                'category' => 'profile'
            ],
            [
                'id' => 'create-page',
                'phrases' => $getPhrases('create-page'),
                'action' => 'create-page',
                'description' => 'Create business page',
                'category' => 'profile'
            ],

            // ============================================
            // 2. CONTENT POSTING
            // ============================================
            [
                'id' => 'create-post',
                'phrases' => $getPhrases('create-post'),
                'action' => 'create-post',
                'description' => 'Create new post',
                'category' => 'content'
            ],
            [
                'id' => 'post-photo',
                'phrases' => $getPhrases('post-photo'),
                'action' => 'post-photo',
                'description' => 'Post photo',
                'category' => 'content'
            ],
            [
                'id' => 'post-video',
                'phrases' => $getPhrases('post-video'),
                'action' => 'post-video',
                'description' => 'Post video',
                'category' => 'content'
            ],
            [
                'id' => 'add-hashtag',
                'phrases' => $getPhrases('add-hashtag'),
                'action' => 'add-hashtag',
                'description' => 'Add hashtag',
                'category' => 'content'
            ],
            [
                'id' => 'tag-person',
                'phrases' => $getPhrases('tag-person'),
                'action' => 'tag-person',
                'description' => 'Tag person in post',
                'category' => 'content'
            ],
            [
                'id' => 'add-location',
                'phrases' => $getPhrases('add-location'),
                'action' => 'add-location',
                'description' => 'Add location tag',
                'category' => 'content'
            ],
            [
                'id' => 'add-emoji',
                'phrases' => $getPhrases('add-emoji'),
                'action' => 'add-emoji',
                'description' => 'Add emoji',
                'category' => 'content'
            ],
            [
                'id' => 'add-filter',
                'phrases' => $getPhrases('add-filter'),
                'action' => 'add-filter',
                'description' => 'Add filter/effect',
                'category' => 'content'
            ],
            [
                'id' => 'edit-post',
                'phrases' => $getPhrases('edit-post'),
                'action' => 'edit-post',
                'description' => 'Edit existing post',
                'category' => 'content'
            ],
            [
                'id' => 'delete-post',
                'phrases' => $getPhrases('delete-post'),
                'action' => 'delete-post',
                'description' => 'Delete post',
                'category' => 'content'
            ],
            [
                'id' => 'set-audience',
                'phrases' => $getPhrases('set-audience'),
                'action' => 'set-audience',
                'description' => 'Set post audience',
                'category' => 'content'
            ],
            [
                'id' => 'create-poll',
                'phrases' => $getPhrases('create-poll'),
                'action' => 'create-poll',
                'description' => 'Create poll/survey',
                'category' => 'content'
            ],

            // ============================================
            // 3. INTERACTIONS
            // ============================================
            [
                'id' => 'like',
                'phrases' => $getPhrases('like'),
                'action' => 'like',
                'description' => 'Like post/content',
                'category' => 'interaction'
            ],
            [
                'id' => 'unlike',
                'phrases' => $getPhrases('unlike'),
                'action' => 'unlike',
                'description' => 'Unlike post/content',
                'category' => 'interaction'
            ],
            [
                'id' => 'react',
                'phrases' => $getPhrases('react'),
                'action' => 'react',
                'description' => 'React to post (emoji)',
                'category' => 'interaction'
            ],
            [
                'id' => 'comment',
                'phrases' => $getPhrases('comment'),
                'action' => 'comment',
                'description' => 'Comment on post',
                'category' => 'interaction'
            ],
            [
                'id' => 'reply-comment',
                'phrases' => $getPhrases('reply-comment'),
                'action' => 'reply-comment',
                'description' => 'Reply to comment',
                'category' => 'interaction'
            ],
            [
                'id' => 'delete-comment',
                'phrases' => $getPhrases('delete-comment'),
                'action' => 'delete-comment',
                'description' => 'Delete comment',
                'category' => 'interaction'
            ],
            [
                'id' => 'like-comment',
                'phrases' => $getPhrases('like-comment'),
                'action' => 'like-comment',
                'description' => 'Like comment',
                'category' => 'interaction'
            ],
            [
                'id' => 'share',
                'phrases' => $getPhrases('share'),
                'action' => 'share',
                'description' => 'Share post',
                'category' => 'interaction'
            ],
            [
                'id' => 'repost',
                'phrases' => $getPhrases('repost'),
                'action' => 'repost',
                'description' => 'Repost/share to profile',
                'category' => 'interaction'
            ],
            [
                'id' => 'save',
                'phrases' => $getPhrases('save'),
                'action' => 'save',
                'description' => 'Save post/bookmark',
                'category' => 'interaction'
            ],
            [
                'id' => 'unsave',
                'phrases' => $getPhrases('unsave'),
                'action' => 'unsave',
                'description' => 'Unsave post',
                'category' => 'interaction'
            ],
            [
                'id' => 'follow',
                'phrases' => $getPhrases('follow'),
                'action' => 'follow',
                'description' => 'Follow user',
                'category' => 'interaction'
            ],
            [
                'id' => 'unfollow',
                'phrases' => $getPhrases('unfollow'),
                'action' => 'unfollow',
                'description' => 'Unfollow user',
                'category' => 'interaction'
            ],
            [
                'id' => 'block',
                'phrases' => $getPhrases('block'),
                'action' => 'block',
                'description' => 'Block user',
                'category' => 'interaction'
            ],
            [
                'id' => 'unblock',
                'phrases' => $getPhrases('unblock'),
                'action' => 'unblock',
                'description' => 'Unblock user',
                'category' => 'interaction'
            ],
            [
                'id' => 'report',
                'phrases' => $getPhrases('report'),
                'action' => 'report',
                'description' => 'Report content/user',
                'category' => 'interaction'
            ],
            [
                'id' => 'mention',
                'phrases' => $getPhrases('mention'),
                'action' => 'mention',
                'description' => 'Mention user (@username)',
                'category' => 'interaction'
            ],

            // ============================================
            // 4. MESSAGING & CALLS
            // ============================================
            [
                'id' => 'send-message',
                'phrases' => $getPhrases('send-message'),
                'action' => 'send-message',
                'description' => 'Send message',
                'category' => 'messaging'
            ],
            [
                'id' => 'send-photo',
                'phrases' => $getPhrases('send-photo'),
                'action' => 'send-photo',
                'description' => 'Send photo in message',
                'category' => 'messaging'
            ],
            [
                'id' => 'send-video',
                'phrases' => $getPhrases('send-video'),
                'action' => 'send-video',
                'description' => 'Send video in message',
                'category' => 'messaging'
            ],
            [
                'id' => 'voice-call',
                'phrases' => $getPhrases('voice-call'),
                'action' => 'voice-call',
                'description' => 'Start voice call',
                'category' => 'messaging'
            ],
            [
                'id' => 'video-call',
                'phrases' => $getPhrases('video-call'),
                'action' => 'video-call',
                'description' => 'Start video call',
                'category' => 'messaging'
            ],
            [
                'id' => 'end-call',
                'phrases' => $getPhrases('end-call'),
                'action' => 'end-call',
                'description' => 'End call',
                'category' => 'messaging'
            ],
            [
                'id' => 'create-group',
                'phrases' => $getPhrases('create-group'),
                'action' => 'create-group',
                'description' => 'Create group chat',
                'category' => 'messaging'
            ],
            [
                'id' => 'react-message',
                'phrases' => $getPhrases('react-message'),
                'action' => 'react-message',
                'description' => 'React to message',
                'category' => 'messaging'
            ],
            [
                'id' => 'delete-message',
                'phrases' => $getPhrases('delete-message'),
                'action' => 'delete-message',
                'description' => 'Delete message',
                'category' => 'messaging'
            ],

            // ============================================
            // 5. PRIVACY & SECURITY
            // ============================================
            [
                'id' => 'open-settings',
                'phrases' => $getPhrases('open-settings'),
                'action' => 'open-settings',
                'description' => 'Open settings',
                'category' => 'privacy'
            ],
            [
                'id' => 'privacy-settings',
                'phrases' => $getPhrases('privacy-settings'),
                'action' => 'privacy-settings',
                'description' => 'Open privacy settings',
                'category' => 'privacy'
            ],
            [
                'id' => 'security-settings',
                'phrases' => $getPhrases('security-settings'),
                'action' => 'security-settings',
                'description' => 'Open security settings',
                'category' => 'privacy'
            ],
            [
                'id' => 'enable-2fa',
                'phrases' => $getPhrases('enable-2fa'),
                'action' => 'enable-2fa',
                'description' => 'Enable two-factor authentication',
                'category' => 'privacy'
            ],
            [
                'id' => 'view-login-history',
                'phrases' => $getPhrases('view-login-history'),
                'action' => 'view-login-history',
                'description' => 'View login history',
                'category' => 'privacy'
            ],
            [
                'id' => 'manage-cookies',
                'phrases' => $getPhrases('manage-cookies'),
                'action' => 'manage-cookies',
                'description' => 'Manage cookies',
                'category' => 'privacy'
            ],

            // ============================================
            // 6. ANALYTICS & STATISTICS
            // ============================================
            [
                'id' => 'view-insights',
                'phrases' => $getPhrases('view-insights'),
                'action' => 'view-insights',
                'description' => 'View analytics/insights',
                'category' => 'analytics'
            ],
            [
                'id' => 'view-followers',
                'phrases' => $getPhrases('view-followers'),
                'action' => 'view-followers',
                'description' => 'View followers list',
                'category' => 'analytics'
            ],
            [
                'id' => 'view-following',
                'phrases' => $getPhrases('view-following'),
                'action' => 'view-following',
                'description' => 'View following list',
                'category' => 'analytics'
            ],
            [
                'id' => 'view-stats',
                'phrases' => $getPhrases('view-stats'),
                'action' => 'view-stats',
                'description' => 'View statistics',
                'category' => 'analytics'
            ],
            [
                'id' => 'export-data',
                'phrases' => $getPhrases('export-data'),
                'action' => 'export-data',
                'description' => 'Export data/report',
                'category' => 'analytics'
            ],

            // ============================================
            // 7. MONETIZATION
            // ============================================
            [
                'id' => 'enable-ads',
                'phrases' => $getPhrases('enable-ads'),
                'action' => 'enable-ads',
                'description' => 'Enable ads/monetization',
                'category' => 'monetization'
            ],
            [
                'id' => 'view-earnings',
                'phrases' => $getPhrases('view-earnings'),
                'action' => 'view-earnings',
                'description' => 'View earnings',
                'category' => 'monetization'
            ],
            [
                'id' => 'open-shop',
                'phrases' => $getPhrases('open-shop'),
                'action' => 'open-shop',
                'description' => 'Open shop/marketplace',
                'category' => 'monetization'
            ],

            // ============================================
            // 8. LIVE & STORY FEATURES
            // ============================================
            [
                'id' => 'go-live',
                'phrases' => $getPhrases('go-live'),
                'action' => 'go-live',
                'description' => 'Start live stream',
                'category' => 'live'
            ],
            [
                'id' => 'end-live',
                'phrases' => $getPhrases('end-live'),
                'action' => 'end-live',
                'description' => 'End live stream',
                'category' => 'live'
            ],
            [
                'id' => 'create-story',
                'phrases' => $getPhrases('create-story'),
                'action' => 'create-story',
                'description' => 'Create story',
                'category' => 'live'
            ],
            [
                'id' => 'view-story',
                'phrases' => $getPhrases('view-story'),
                'action' => 'view-story',
                'description' => 'View story',
                'category' => 'live'
            ],
            [
                'id' => 'next-story',
                'phrases' => $getPhrases('next-story'),
                'action' => 'next-story',
                'description' => 'Next story',
                'category' => 'live'
            ],
            [
                'id' => 'previous-story',
                'phrases' => $getPhrases('previous-story'),
                'action' => 'previous-story',
                'description' => 'Previous story',
                'category' => 'live'
            ],
            [
                'id' => 'save-story',
                'phrases' => $getPhrases('save-story'),
                'action' => 'save-story',
                'description' => 'Save story to highlights',
                'category' => 'live'
            ],
            [
                'id' => 'create-reel',
                'phrases' => $getPhrases('create-reel'),
                'action' => 'create-reel',
                'description' => 'Create reel',
                'category' => 'live'
            ],

            // ============================================
            // 9. USER EXPERIENCE
            // ============================================
            [
                'id' => 'toggle-theme',
                'phrases' => $getPhrases('toggle-theme'),
                'action' => 'toggle-theme',
                'description' => 'Toggle dark/light mode',
                'category' => 'ux'
            ],
            [
                'id' => 'clear-history',
                'phrases' => $getPhrases('clear-history'),
                'action' => 'clear-history',
                'description' => 'Clear search/activity history',
                'category' => 'ux'
            ],
            [
                'id' => 'refresh-feed',
                'phrases' => $getPhrases('refresh-feed'),
                'action' => 'refresh-feed',
                'description' => 'Refresh feed',
                'category' => 'ux'
            ],
            [
                'id' => 'view-trending',
                'phrases' => $getPhrases('view-trending'),
                'action' => 'view-trending',
                'description' => 'View trending content',
                'category' => 'ux'
            ],

            // ============================================
            // 10. BUSINESS FEATURES
            // ============================================
            [
                'id' => 'open-ads-manager',
                'phrases' => $getPhrases('open-ads-manager'),
                'action' => 'open-ads-manager',
                'description' => 'Open ads manager',
                'category' => 'business'
            ],
            [
                'id' => 'manage-roles',
                'phrases' => $getPhrases('manage-roles'),
                'action' => 'manage-roles',
                'description' => 'Manage page roles',
                'category' => 'business'
            ],
            [
                'id' => 'create-campaign',
                'phrases' => $getPhrases('create-campaign'),
                'action' => 'create-campaign',
                'description' => 'Create marketing campaign',
                'category' => 'business'
            ],

            // ============================================
            // NAVIGATION (Existing)
            // ============================================
            [
                'id' => 'scroll-down',
                'phrases' => $getPhrases('scroll-down'),
                'action' => 'scroll-down',
                'description' => 'Scroll page down',
                'category' => 'navigation'
            ],
            [
                'id' => 'scroll-up',
                'phrases' => $getPhrases('scroll-up'),
                'action' => 'scroll-up',
                'description' => 'Scroll page up',
                'category' => 'navigation'
            ],
            [
                'id' => 'go-home',
                'phrases' => $getPhrases('go-home'),
                'action' => 'go-home',
                'description' => 'Go to home feed',
                'category' => 'navigation'
            ],
            [
                'id' => 'go-profile',
                'phrases' => $getPhrases('go-profile'),
                'action' => 'go-profile',
                'description' => 'Go to profile',
                'category' => 'navigation'
            ],
            [
                'id' => 'go-messages',
                'phrases' => $getPhrases('go-messages'),
                'action' => 'go-messages',
                'description' => 'Go to messages',
                'category' => 'navigation'
            ],
            [
                'id' => 'go-notifications',
                'phrases' => $getPhrases('go-notifications'),
                'action' => 'go-notifications',
                'description' => 'Go to notifications',
                'category' => 'navigation'
            ],
            [
                'id' => 'search',
                'phrases' => $getPhrases('search'),
                'action' => 'search',
                'description' => 'Open search',
                'category' => 'navigation'
            ],
            [
                'id' => 'go-explore',
                'phrases' => $getPhrases('go-explore'),
                'action' => 'go-explore',
                'description' => 'Go to explore/discover',
                'category' => 'navigation'
            ],
            [
                'id' => 'go-reels',
                'phrases' => $getPhrases('go-reels'),
                'action' => 'go-reels',
                'description' => 'Go to reels',
                'category' => 'navigation'
            ],
            [
                'id' => 'go-stories',
                'phrases' => $getPhrases('go-stories'),
                'action' => 'go-stories',
                'description' => 'Go to stories',
                'category' => 'navigation'
            ],
            [
                'id' => 'view-profile',
                'phrases' => $getPhrases('view-profile'),
                'action' => 'view-profile',
                'description' => 'View user profile',
                'category' => 'navigation'
            ],

            // ============================================
            // CONTENT NAVIGATION
            // ============================================
            [
                'id' => 'next',
                'phrases' => $getPhrases('next'),
                'action' => 'next',
                'description' => 'Next item',
                'category' => 'navigation'
            ],
            [
                'id' => 'previous',
                'phrases' => $getPhrases('previous'),
                'action' => 'previous',
                'description' => 'Previous item',
                'category' => 'navigation'
            ],

            // ============================================
            // MEDIA CONTROL
            // ============================================
            [
                'id' => 'play',
                'phrases' => $getPhrases('play'),
                'action' => 'play',
                'description' => 'Play video/audio',
                'category' => 'media'
            ],
            [
                'id' => 'pause',
                'phrases' => $getPhrases('pause'),
                'action' => 'pause',
                'description' => 'Pause video/audio',
                'category' => 'media'
            ],
            [
                'id' => 'mute',
                'phrases' => $getPhrases('mute'),
                'action' => 'mute',
                'description' => 'Mute audio',
                'category' => 'media'
            ],
            [
                'id' => 'unmute',
                'phrases' => $getPhrases('unmute'),
                'action' => 'unmute',
                'description' => 'Unmute audio',
                'category' => 'media'
            ],
            [
                'id' => 'volume-up',
                'phrases' => $getPhrases('volume-up'),
                'action' => 'volume-up',
                'description' => 'Increase volume',
                'category' => 'media'
            ],
            [
                'id' => 'volume-down',
                'phrases' => $getPhrases('volume-down'),
                'action' => 'volume-down',
                'description' => 'Decrease volume',
                'category' => 'media'
            ],
            [
                'id' => 'fullscreen',
                'phrases' => $getPhrases('fullscreen'),
                'action' => 'fullscreen',
                'description' => 'Toggle fullscreen',
                'category' => 'media'
            ],
            [
                'id' => 'skip-forward',
                'phrases' => $getPhrases('skip-forward'),
                'action' => 'skip-forward',
                'description' => 'Skip forward',
                'category' => 'media'
            ],
            [
                'id' => 'skip-backward',
                'phrases' => $getPhrases('skip-backward'),
                'action' => 'skip-backward',
                'description' => 'Skip backward',
                'category' => 'media'
            ],

            // ============================================
            // CAMERA & CREATION
            // ============================================
            [
                'id' => 'open-camera',
                'phrases' => $getPhrases('open-camera'),
                'action' => 'open-camera',
                'description' => 'Open camera',
                'category' => 'creation'
            ],
            [
                'id' => 'take-photo',
                'phrases' => $getPhrases('take-photo'),
                'action' => 'take-photo',
                'description' => 'Take photo',
                'category' => 'creation'
            ],
            [
                'id' => 'record-video',
                'phrases' => $getPhrases('record-video'),
                'action' => 'record-video',
                'description' => 'Record video',
                'category' => 'creation'
            ],

            // ============================================
            // BASIC ACTIONS
            // ============================================
            [
                'id' => 'click',
                'phrases' => $getPhrases('click'),
                'action' => 'click',
                'description' => 'Click element',
                'category' => 'basic'
            ],
            [
                'id' => 'back',
                'phrases' => $getPhrases('back'),
                'action' => 'back',
                'description' => 'Go back',
                'category' => 'basic'
            ],
            [
                'id' => 'close',
                'phrases' => $getPhrases('close'),
                'action' => 'close',
                'description' => 'Close current view',
                'category' => 'basic'
            ],
        ];
    }

    /**
     * Get phrases for a command based on locale
     */
    public static function getPhrases($command, $locale)
    {
        $phrases = [
            'en' => [
                // Navigation
                'scroll-down' => ['scroll down', 'scroll down page', 'go down', 'move down'],
                'scroll-up' => ['scroll up', 'scroll up page', 'go up', 'move up'],
                'go-home' => ['go home', 'home', 'home feed', 'main feed', 'feed'],
                'go-profile' => ['go to profile', 'profile', 'my profile', 'view profile'],
                'go-messages' => ['messages', 'direct messages', 'dm', 'inbox', 'go to messages', 'open messages'],
                'go-notifications' => ['notifications', 'alerts', 'go to notifications', 'open notifications'],
                'go-explore' => ['explore', 'go to explore', 'discover', 'browse', 'explore page'],
                'go-reels' => ['go to reels', 'reels', 'open reels', 'show reels'],
                'go-stories' => ['stories', 'go to stories', 'view stories', 'open stories'],
                'search' => ['search', 'open search', 'search bar'],
                'view-profile' => ['view profile', 'see profile', 'show profile', 'user profile'],
                'back' => ['go back', 'back', 'return', 'previous page'],
                'close' => ['close', 'close window', 'exit'],

                // Profile Management
                'edit-profile' => ['edit profile', 'edit my profile', 'change profile', 'update profile'],
                'change-profile-picture' => ['change profile picture', 'change profile photo', 'update profile picture', 'new profile picture'],
                'change-cover-photo' => ['change cover photo', 'change cover', 'update cover photo', 'new cover photo'],
                'update-bio' => ['update bio', 'edit bio', 'change bio', 'update description', 'edit description'],
                'change-username' => ['change username', 'edit username', 'update username', 'new username'],
                'set-privacy' => ['set privacy', 'privacy settings', 'change privacy', 'update privacy'],
                'verify-profile' => ['verify profile', 'verify account', 'get verified', 'blue check'],
                'create-page' => ['create page', 'create business page', 'new page', 'business account'],

                // Content Posting
                'create-post' => ['create post', 'new post', 'make post', 'post', 'write post'],
                'post-photo' => ['post photo', 'upload photo', 'share photo', 'post picture'],
                'post-video' => ['post video', 'upload video', 'share video', 'post clip'],
                'add-hashtag' => ['add hashtag', 'hashtag', 'add tag', 'include hashtag'],
                'tag-person' => ['tag person', 'tag user', 'tag someone', 'mention in post'],
                'add-location' => ['add location', 'tag location', 'location', 'where am i'],
                'add-emoji' => ['add emoji', 'emoji', 'insert emoji'],
                'add-filter' => ['add filter', 'filter', 'apply filter', 'use filter'],
                'edit-post' => ['edit post', 'modify post', 'change post', 'update post'],
                'delete-post' => ['delete post', 'remove post', 'erase post', 'delete'],
                'set-audience' => ['set audience', 'choose audience', 'who can see', 'audience'],
                'create-poll' => ['create poll', 'make poll', 'new poll', 'survey', 'create survey'],

                // Interactions
                'like' => ['like', 'thumbs up', 'heart', 'love'],
                'unlike' => ['unlike', 'remove like', 'unheart', 'unlove'],
                'react' => ['react', 'add reaction', 'emoji reaction', 'react with emoji'],
                'comment' => ['comment', 'add comment', 'write comment', 'leave comment'],
                'reply-comment' => ['reply', 'reply to comment', 'answer comment', 'respond'],
                'delete-comment' => ['delete comment', 'remove comment', 'erase comment'],
                'like-comment' => ['like comment', 'thumbs up comment'],
                'share' => ['share', 'share post', 'send post', 'forward'],
                'repost' => ['repost', 're share', 'share again', 'repost to profile'],
                'save' => ['save', 'save post', 'bookmark', 'save for later'],
                'unsave' => ['unsave', 'remove save', 'unbookmark', 'remove bookmark'],
                'follow' => ['follow', 'follow user', 'follow account', 'add friend'],
                'unfollow' => ['unfollow', 'unfollow user', 'stop following', 'remove follow'],
                'block' => ['block', 'block user', 'block account', 'block person'],
                'unblock' => ['unblock', 'unblock user', 'unblock account'],
                'report' => ['report', 'report user', 'report post', 'report content', 'flag'],
                'mention' => ['mention', 'mention user', 'tag user', 'at user', 'call out'],

                // Messaging
                'send-message' => ['send message', 'message', 'text', 'dm', 'direct message'],
                'send-photo' => ['send photo', 'send picture', 'share photo in chat'],
                'send-video' => ['send video', 'share video in chat', 'send clip'],
                'voice-call' => ['voice call', 'call', 'phone call', 'audio call'],
                'video-call' => ['video call', 'video chat', 'facetime', 'video'],
                'end-call' => ['end call', 'hang up', 'disconnect', 'close call'],
                'create-group' => ['create group', 'new group', 'group chat', 'make group'],
                'react-message' => ['react to message', 'react message', 'emoji message'],
                'delete-message' => ['delete message', 'remove message', 'erase message'],

                // Privacy & Security
                'open-settings' => ['open settings', 'settings', 'preferences', 'options'],
                'privacy-settings' => ['privacy settings', 'privacy', 'privacy options'],
                'security-settings' => ['security settings', 'security', 'security options'],
                'enable-2fa' => ['enable two factor', 'enable 2fa', 'two factor authentication', '2fa'],
                'view-login-history' => ['view login history', 'login history', 'recent logins', 'access history'],
                'manage-cookies' => ['manage cookies', 'cookies', 'cookie settings'],

                // Analytics
                'view-insights' => ['view insights', 'insights', 'analytics', 'view analytics'],
                'view-followers' => ['view followers', 'followers', 'my followers', 'follower list'],
                'view-following' => ['view following', 'following', 'who i follow', 'following list'],
                'view-stats' => ['view stats', 'statistics', 'stats', 'view statistics'],
                'export-data' => ['export data', 'download data', 'export report', 'download report'],

                // Monetization
                'enable-ads' => ['enable ads', 'monetize', 'enable monetization', 'turn on ads'],
                'view-earnings' => ['view earnings', 'earnings', 'revenue', 'income', 'money'],
                'open-shop' => ['open shop', 'shop', 'marketplace', 'store'],

                // Live & Stories
                'go-live' => ['go live', 'start live', 'live stream', 'start streaming', 'broadcast'],
                'end-live' => ['end live', 'stop live', 'end stream', 'stop streaming'],
                'create-story' => ['create story', 'new story', 'make story', 'add story', 'post story'],
                'view-story' => ['view story', 'see story', 'open story', 'watch story'],
                'next-story' => ['next story', 'skip story', 'forward story', 'next'],
                'previous-story' => ['previous story', 'back story', 'go back story', 'previous'],
                'save-story' => ['save story', 'add to highlights', 'highlight story', 'save to highlights'],
                'create-reel' => ['create reel', 'new reel', 'make reel', 'add reel', 'post reel'],

                // User Experience
                'toggle-theme' => ['toggle theme', 'dark mode', 'light mode', 'change theme', 'switch theme'],
                'clear-history' => ['clear history', 'delete history', 'erase history', 'clear search'],
                'refresh-feed' => ['refresh feed', 'refresh', 'reload feed', 'update feed'],
                'view-trending' => ['view trending', 'trending', 'trends', 'popular', 'trending now'],

                // Business
                'open-ads-manager' => ['open ads manager', 'ads manager', 'advertising', 'ads'],
                'manage-roles' => ['manage roles', 'page roles', 'roles', 'permissions'],
                'create-campaign' => ['create campaign', 'new campaign', 'marketing campaign', 'ad campaign'],

                // Media Control
                'play' => ['play', 'start video', 'play video', 'resume'],
                'pause' => ['pause', 'stop video', 'pause video', 'stop'],
                'mute' => ['mute', 'silence', 'turn off sound', 'mute audio'],
                'unmute' => ['unmute', 'sound on', 'turn on sound', 'unmute audio'],
                'volume-up' => ['volume up', 'increase volume', 'louder', 'turn up'],
                'volume-down' => ['volume down', 'decrease volume', 'quieter', 'turn down'],
                'fullscreen' => ['fullscreen', 'full screen', 'maximize', 'enter fullscreen'],
                'skip-forward' => ['skip forward', 'forward', 'fast forward', 'next'],
                'skip-backward' => ['skip backward', 'backward', 'rewind', 'go back'],

                // Camera & Creation
                'open-camera' => ['camera', 'open camera', 'take photo', 'take picture'],
                'take-photo' => ['take photo', 'capture', 'snap', 'take picture', 'shoot'],
                'record-video' => ['record video', 'start recording', 'record', 'video record'],

                // Content Navigation
                'next' => ['next', 'next post', 'next video', 'skip', 'next item'],
                'previous' => ['previous', 'previous post', 'go back', 'back', 'previous item'],

                // Basic
                'click' => ['click', 'tap', 'press', 'select'],
            ],
            'sq' => [
                // Navigation
                'scroll-down' => ['shkruaj poshtë', 'shkruaj poshtë faqen', 'shko poshtë', 'lëviz poshtë'],
                'scroll-up' => ['shkruaj lart', 'shkruaj lart faqen', 'shko lart', 'lëviz lart'],
                'go-home' => ['shko ne shtepi', 'home', 'faqja kryesore', 'feed'],
                'go-profile' => ['shko ne profile', 'profile', 'profili im', 'shiko profile'],
                'go-messages' => ['mesazhe', 'direct', 'dm', 'inbox', 'shko ne mesazhe'],
                'go-notifications' => ['njoftime', 'alerts', 'shko ne njoftime', 'hape njoftime'],
                'go-explore' => ['explore', 'shko ne explore', 'zbulim', 'shfleto'],
                'go-reels' => ['reels', 'shko ne reels', 'hape reels'],
                'go-stories' => ['stories', 'shko ne stories', 'hape stories'],
                'search' => ['kerko', 'hape kerkimin', 'kutia e kerkimit'],
                'view-profile' => ['shiko profile', 'shfaq profile', 'profili i perdoruesit'],
                'back' => ['kthe mbrapa', 'mbrapa', 'kthehu'],
                'close' => ['mbyll', 'dil', 'mbyll dritaren'],

                // Profile Management
                'edit-profile' => ['ndrysho profile', 'edito profile', 'perditeso profile'],
                'change-profile-picture' => ['ndrysho foto profili', 'foto e re profili', 'perditeso foto profili'],
                'change-cover-photo' => ['ndrysho foto mbulese', 'foto e re mbulese', 'perditeso foto mbulese'],
                'update-bio' => ['perditeso bio', 'ndrysho bio', 'edito bio', 'perditeso pershkrimin'],
                'change-username' => ['ndrysho username', 'edito username', 'perditeso username'],
                'set-privacy' => ['vendos privatësi', 'settings privatësi', 'ndrysho privatësi'],
                'verify-profile' => ['verifiko profile', 'verifiko llogari', 'merr verifikim'],
                'create-page' => ['krijo faqe', 'faqe biznesi', 'llogari biznesi'],

                // Content Posting
                'create-post' => ['krijo postim', 'postim i ri', 'bej postim', 'shkruaj postim'],
                'post-photo' => ['posto foto', 'ngarko foto', 'ndaj foto', 'posto fotoje'],
                'post-video' => ['posto video', 'ngarko video', 'ndaj video'],
                'add-hashtag' => ['shto hashtag', 'hashtag', 'shto tag'],
                'tag-person' => ['tag person', 'tag perdorues', 'tag dikend'],
                'add-location' => ['shto lokacion', 'tag lokacion', 'lokacion'],
                'add-emoji' => ['shto emoji', 'emoji', 'fut emoji'],
                'add-filter' => ['shto filter', 'filter', 'perdor filter'],
                'edit-post' => ['edito postim', 'ndrysho postim', 'perditeso postim'],
                'delete-post' => ['fshij postim', 'hiq postim', 'zhduk postim'],
                'set-audience' => ['vendos audiencë', 'zgjedh audiencë', 'kush mund te shohë'],
                'create-poll' => ['krijo sondazh', 'sondazh i ri', 'anketë'],

                // Interactions
                'like' => ['pelqe', 'zemer', 'thumbs up', 'dashuri'],
                'unlike' => ['heq pelqimin', 'heq zemer', 'mos pelqe'],
                'react' => ['reago', 'shto reaksion', 'reaksion emoji'],
                'comment' => ['komento', 'shto koment', 'shkruaj koment'],
                'reply-comment' => ['pergjigju', 'pergjigju komentit', 'përgjigje'],
                'delete-comment' => ['fshij koment', 'hiq koment'],
                'like-comment' => ['pelqe koment', 'thumbs up koment'],
                'share' => ['ndaj', 'shpernda', 'dergo', 'forward'],
                'repost' => ['repost', 'ndaj përsëri', 'repost ne profile'],
                'save' => ['ruaj', 'ruaj postimin', 'bookmark', 'ruaj per me vone'],
                'unsave' => ['heq ruajtjen', 'heq bookmark'],
                'follow' => ['ndiq', 'ndiq perdoruesin', 'follow', 'shto mik'],
                'unfollow' => ['mos ndiq', 'heq ndjekjen', 'stop follow'],
                'block' => ['blloko', 'blloko perdorues', 'blloko llogari'],
                'unblock' => ['heq bllokimin', 'unblock perdorues'],
                'report' => ['raporto', 'raporto perdorues', 'raporto postim', 'flag'],
                'mention' => ['përmend', 'përmend perdorues', 'tag perdorues', 'thirr'],

                // Messaging
                'send-message' => ['dergo mesazh', 'mesazh', 'text', 'dm'],
                'send-photo' => ['dergo foto', 'dergo fotoje', 'ndaj foto ne chat'],
                'send-video' => ['dergo video', 'ndaj video ne chat'],
                'voice-call' => ['thirrje zanore', 'thirrje', 'telefon', 'audio call'],
                'video-call' => ['thirrje video', 'video chat', 'video'],
                'end-call' => ['mbyll thirrjen', 'ndal thirrjen', 'disconnect'],
                'create-group' => ['krijo grup', 'grup i ri', 'group chat'],
                'react-message' => ['reago mesazhit', 'reaksion mesazh'],
                'delete-message' => ['fshij mesazh', 'hiq mesazh'],

                // Privacy & Security
                'open-settings' => ['hape settings', 'settings', 'preferenca', 'opsione'],
                'privacy-settings' => ['settings privatësi', 'privatësi', 'opsione privatësi'],
                'security-settings' => ['settings sigurie', 'sigurie', 'opsione sigurie'],
                'enable-2fa' => ['aktivizo two factor', 'aktivizo 2fa', 'autentifikim dy faktorësh'],
                'view-login-history' => ['shiko historine e hyrjeve', 'historia e hyrjeve', 'hyrjet e fundit'],
                'manage-cookies' => ['menaxho cookies', 'cookies', 'settings cookies'],

                // Analytics
                'view-insights' => ['shiko insights', 'insights', 'analitika', 'shiko analitika'],
                'view-followers' => ['shiko ndjekësit', 'ndjekësit', 'lista e ndjekësve'],
                'view-following' => ['shiko ndjekjet', 'ndjekjet', 'kë po ndjek'],
                'view-stats' => ['shiko stats', 'statistika', 'shiko statistika'],
                'export-data' => ['eksporto te dhena', 'shkarko te dhena', 'eksporto raport'],

                // Monetization
                'enable-ads' => ['aktivizo reklama', 'monetizo', 'aktivizo monetizim'],
                'view-earnings' => ['shiko fitimet', 'fitimet', 'të ardhurat', 'para'],
                'open-shop' => ['hape shop', 'shop', 'marketplace', 'dyqan'],

                // Live & Stories
                'go-live' => ['shko live', 'fillo live', 'live stream', 'fillo streaming'],
                'end-live' => ['ndal live', 'mbyll live', 'ndal stream'],
                'create-story' => ['krijo story', 'story i ri', 'shto story', 'posto story'],
                'view-story' => ['shiko story', 'hape story', 'shiko story'],
                'next-story' => ['story tjeter', 'kaloj story', 'para story'],
                'previous-story' => ['story i meparshem', 'mbrapa story'],
                'save-story' => ['ruaj story', 'shto ne highlights', 'highlight story'],
                'create-reel' => ['krijo reel', 'reel i ri', 'shto reel'],

                // User Experience
                'toggle-theme' => ['ndrysho temë', 'dark mode', 'light mode', 'kalo temë'],
                'clear-history' => ['pastro historine', 'fshij historine', 'pastro kerkimin'],
                'refresh-feed' => ['rifresko feed', 'rifresko', 'perditeso feed'],
                'view-trending' => ['shiko trending', 'trending', 'trends', 'popullore'],

                // Business
                'open-ads-manager' => ['hape ads manager', 'ads manager', 'reklama', 'ads'],
                'manage-roles' => ['menaxho role', 'role faqe', 'role', 'leje'],
                'create-campaign' => ['krijo kampanje', 'kampanje e re', 'kampanje marketingu'],

                // Media Control
                'play' => ['luaj', 'fillo video', 'luaj video', 'vazhdo'],
                'pause' => ['pauzë', 'ndalo video', 'pauzë video', 'ndalo'],
                'mute' => ['mute', 'pa ze', 'fike ze', 'mute audio'],
                'unmute' => ['unmute', 'me ze', 'hape ze', 'unmute audio'],
                'volume-up' => ['rrit volumin', 'me ze', 'ze me i larte', 'rrit'],
                'volume-down' => ['ul volumin', 'me pak ze', 'ze me i ulet', 'ul'],
                'fullscreen' => ['ekran i plote', 'fullscreen', 'maksimizo'],
                'skip-forward' => ['kaloj para', 'para', 'shpejto para'],
                'skip-backward' => ['kaloj mbrapa', 'mbrapa', 'shpejto mbrapa'],

                // Camera & Creation
                'open-camera' => ['kamera', 'hape kamere', 'foto', 'fotoje'],
                'take-photo' => ['foto', 'kap', 'fotoje', 'shoot'],
                'record-video' => ['regjistro video', 'fillo regjistrim', 'regjistro', 'video record'],

                // Content Navigation
                'next' => ['tjeter', 'postimi tjeter', 'video tjeter', 'kaloj'],
                'previous' => ['i meparshem', 'postimi i meparshem', 'kthe mbrapa'],

                // Basic
                'click' => ['kliko', 'prek', 'shtyp', 'zgjedh'],
            ],
            'es' => [
                // Navigation
                'scroll-down' => ['desplazar abajo', 'bajar', 'ir abajo', 'mover abajo'],
                'scroll-up' => ['desplazar arriba', 'subir', 'ir arriba', 'mover arriba'],
                'go-home' => ['inicio', 'ir a inicio', 'feed principal', 'feed'],
                'go-profile' => ['perfil', 'ir a perfil', 'mi perfil', 'ver perfil'],
                'go-messages' => ['mensajes', 'mensajes directos', 'dm', 'buzón', 'ir a mensajes'],
                'go-notifications' => ['notificaciones', 'alertas', 'ir a notificaciones', 'abrir notificaciones'],
                'go-explore' => ['explorar', 'ir a explorar', 'descubrir', 'navegar'],
                'go-reels' => ['reels', 'ir a reels', 'abrir reels'],
                'go-stories' => ['historias', 'ir a historias', 'ver historias'],
                'search' => ['buscar', 'abrir búsqueda', 'barra de búsqueda'],
                'view-profile' => ['ver perfil', 'mostrar perfil', 'perfil de usuario'],
                'back' => ['volver', 'atrás', 'regresar'],
                'close' => ['cerrar', 'cerrar ventana', 'salir'],

                // Profile Management
                'edit-profile' => ['editar perfil', 'cambiar perfil', 'actualizar perfil'],
                'change-profile-picture' => ['cambiar foto de perfil', 'nueva foto de perfil', 'actualizar foto de perfil'],
                'change-cover-photo' => ['cambiar foto de portada', 'nueva foto de portada', 'actualizar foto de portada'],
                'update-bio' => ['actualizar biografía', 'editar biografía', 'cambiar biografía', 'actualizar descripción'],
                'change-username' => ['cambiar nombre de usuario', 'editar nombre de usuario', 'actualizar nombre de usuario'],
                'set-privacy' => ['configurar privacidad', 'ajustes de privacidad', 'cambiar privacidad'],
                'verify-profile' => ['verificar perfil', 'verificar cuenta', 'obtener verificación'],
                'create-page' => ['crear página', 'página de negocio', 'cuenta de negocio'],

                // Content Posting
                'create-post' => ['crear publicación', 'nueva publicación', 'publicar', 'escribir publicación'],
                'post-photo' => ['publicar foto', 'subir foto', 'compartir foto', 'publicar imagen'],
                'post-video' => ['publicar video', 'subir video', 'compartir video'],
                'add-hashtag' => ['agregar hashtag', 'hashtag', 'agregar etiqueta'],
                'tag-person' => ['etiquetar persona', 'etiquetar usuario', 'etiquetar a alguien'],
                'add-location' => ['agregar ubicación', 'etiquetar ubicación', 'ubicación'],
                'add-emoji' => ['agregar emoji', 'emoji', 'insertar emoji'],
                'add-filter' => ['agregar filtro', 'filtro', 'aplicar filtro'],
                'edit-post' => ['editar publicación', 'modificar publicación', 'cambiar publicación'],
                'delete-post' => ['eliminar publicación', 'borrar publicación', 'quitar publicación'],
                'set-audience' => ['configurar audiencia', 'elegir audiencia', 'quién puede ver'],
                'create-poll' => ['crear encuesta', 'nueva encuesta', 'sondear', 'crear sondeo'],

                // Interactions
                'like' => ['me gusta', 'corazón', 'pulgar arriba', 'amar'],
                'unlike' => ['quitar me gusta', 'quitar corazón', 'desamar'],
                'react' => ['reaccionar', 'agregar reacción', 'reacción emoji'],
                'comment' => ['comentar', 'agregar comentario', 'escribir comentario'],
                'reply-comment' => ['responder', 'responder comentario', 'contestar'],
                'delete-comment' => ['eliminar comentario', 'borrar comentario'],
                'like-comment' => ['me gusta comentario', 'pulgar arriba comentario'],
                'share' => ['compartir', 'compartir publicación', 'enviar', 'reenviar'],
                'repost' => ['republicar', 'compartir de nuevo', 'republicar en perfil'],
                'save' => ['guardar', 'guardar publicación', 'marcar', 'guardar para después'],
                'unsave' => ['quitar guardado', 'desmarcar', 'quitar marcador'],
                'follow' => ['seguir', 'seguir usuario', 'seguir cuenta', 'agregar amigo'],
                'unfollow' => ['dejar de seguir', 'dejar seguir', 'quitar seguimiento'],
                'block' => ['bloquear', 'bloquear usuario', 'bloquear cuenta'],
                'unblock' => ['desbloquear', 'desbloquear usuario', 'desbloquear cuenta'],
                'report' => ['reportar', 'reportar usuario', 'reportar publicación', 'marcar'],
                'mention' => ['mencionar', 'mencionar usuario', 'etiquetar usuario', 'llamar'],

                // Messaging
                'send-message' => ['enviar mensaje', 'mensaje', 'texto', 'dm', 'mensaje directo'],
                'send-photo' => ['enviar foto', 'enviar imagen', 'compartir foto en chat'],
                'send-video' => ['enviar video', 'compartir video en chat'],
                'voice-call' => ['llamada de voz', 'llamar', 'llamada telefónica', 'llamada de audio'],
                'video-call' => ['llamada de video', 'video chat', 'video'],
                'end-call' => ['terminar llamada', 'colgar', 'desconectar', 'cerrar llamada'],
                'create-group' => ['crear grupo', 'nuevo grupo', 'chat grupal'],
                'react-message' => ['reaccionar mensaje', 'reacción mensaje'],
                'delete-message' => ['eliminar mensaje', 'borrar mensaje'],

                // Privacy & Security
                'open-settings' => ['abrir configuración', 'configuración', 'preferencias', 'opciones'],
                'privacy-settings' => ['configuración de privacidad', 'privacidad', 'opciones de privacidad'],
                'security-settings' => ['configuración de seguridad', 'seguridad', 'opciones de seguridad'],
                'enable-2fa' => ['activar dos factores', 'activar 2fa', 'autenticación de dos factores'],
                'view-login-history' => ['ver historial de inicio', 'historial de inicio', 'inicios recientes'],
                'manage-cookies' => ['gestionar cookies', 'cookies', 'configuración de cookies'],

                // Analytics
                'view-insights' => ['ver estadísticas', 'estadísticas', 'analíticas', 'ver analíticas'],
                'view-followers' => ['ver seguidores', 'seguidores', 'mi lista de seguidores'],
                'view-following' => ['ver siguiendo', 'siguiendo', 'a quién sigo'],
                'view-stats' => ['ver estadísticas', 'estadísticas', 'ver estadísticas'],
                'export-data' => ['exportar datos', 'descargar datos', 'exportar informe'],

                // Monetization
                'enable-ads' => ['activar anuncios', 'monetizar', 'activar monetización'],
                'view-earnings' => ['ver ganancias', 'ganancias', 'ingresos', 'dinero'],
                'open-shop' => ['abrir tienda', 'tienda', 'marketplace', 'comercio'],

                // Live & Stories
                'go-live' => ['ir en vivo', 'iniciar en vivo', 'transmisión en vivo', 'iniciar transmisión'],
                'end-live' => ['terminar en vivo', 'detener en vivo', 'detener transmisión'],
                'create-story' => ['crear historia', 'nueva historia', 'agregar historia', 'publicar historia'],
                'view-story' => ['ver historia', 'abrir historia', 'mirar historia'],
                'next-story' => ['siguiente historia', 'saltar historia', 'adelante'],
                'previous-story' => ['historia anterior', 'atrás historia'],
                'save-story' => ['guardar historia', 'agregar a destacados', 'destacar historia'],
                'create-reel' => ['crear reel', 'nuevo reel', 'agregar reel'],

                // User Experience
                'toggle-theme' => ['cambiar tema', 'modo oscuro', 'modo claro', 'alternar tema'],
                'clear-history' => ['limpiar historial', 'borrar historial', 'limpiar búsqueda'],
                'refresh-feed' => ['actualizar feed', 'actualizar', 'recargar feed'],
                'view-trending' => ['ver tendencias', 'tendencias', 'popular', 'tendencia ahora'],

                // Business
                'open-ads-manager' => ['abrir administrador de anuncios', 'administrador de anuncios', 'publicidad'],
                'manage-roles' => ['gestionar roles', 'roles de página', 'roles', 'permisos'],
                'create-campaign' => ['crear campaña', 'nueva campaña', 'campaña de marketing'],

                // Media Control
                'play' => ['reproducir', 'iniciar video', 'reproducir video', 'continuar'],
                'pause' => ['pausar', 'detener video', 'pausar video', 'detener'],
                'mute' => ['silenciar', 'sin sonido', 'apagar sonido', 'silenciar audio'],
                'unmute' => ['activar sonido', 'con sonido', 'encender sonido', 'activar audio'],
                'volume-up' => ['subir volumen', 'aumentar volumen', 'más fuerte', 'subir'],
                'volume-down' => ['bajar volumen', 'disminuir volumen', 'más bajo', 'bajar'],
                'fullscreen' => ['pantalla completa', 'pantalla completa', 'maximizar'],
                'skip-forward' => ['adelantar', 'avanzar', 'avance rápido'],
                'skip-backward' => ['retroceder', 'atrás', 'retroceso rápido'],

                // Camera & Creation
                'open-camera' => ['cámara', 'abrir cámara', 'tomar foto', 'tomar imagen'],
                'take-photo' => ['tomar foto', 'capturar', 'fotografiar', 'disparar'],
                'record-video' => ['grabar video', 'iniciar grabación', 'grabar', 'grabación de video'],

                // Content Navigation
                'next' => ['siguiente', 'siguiente publicación', 'saltar', 'siguiente elemento'],
                'previous' => ['anterior', 'publicación anterior', 'atrás', 'elemento anterior'],

                // Basic
                'click' => ['clic', 'tocar', 'presionar', 'seleccionar'],
            ],
            'fr' => [
                // Navigation
                'scroll-down' => ['défiler vers le bas', 'descendre', 'aller en bas', 'déplacer vers le bas'],
                'scroll-up' => ['défiler vers le haut', 'monter', 'aller en haut', 'déplacer vers le haut'],
                'go-home' => ['accueil', 'aller à l\'accueil', 'fil principal', 'feed'],
                'go-profile' => ['profil', 'aller au profil', 'mon profil', 'voir profil'],
                'go-messages' => ['messages', 'messages directs', 'dm', 'boîte de réception', 'aller aux messages'],
                'go-notifications' => ['notifications', 'alertes', 'aller aux notifications', 'ouvrir notifications'],
                'go-explore' => ['explorer', 'aller à explorer', 'découvrir', 'naviguer'],
                'go-reels' => ['reels', 'aller aux reels', 'ouvrir reels'],
                'go-stories' => ['stories', 'aller aux stories', 'voir stories'],
                'search' => ['rechercher', 'ouvrir la recherche', 'barre de recherche'],
                'view-profile' => ['voir le profil', 'afficher le profil', 'profil utilisateur'],
                'back' => ['retour', 'arrière', 'revenir'],
                'close' => ['fermer', 'fermer la fenêtre', 'quitter'],

                // Profile Management
                'edit-profile' => ['modifier le profil', 'changer le profil', 'mettre à jour le profil'],
                'change-profile-picture' => ['changer la photo de profil', 'nouvelle photo de profil', 'mettre à jour photo de profil'],
                'change-cover-photo' => ['changer la photo de couverture', 'nouvelle photo de couverture', 'mettre à jour photo de couverture'],
                'update-bio' => ['mettre à jour la bio', 'modifier la bio', 'changer la bio', 'mettre à jour la description'],
                'change-username' => ['changer le nom d\'utilisateur', 'modifier le nom d\'utilisateur', 'mettre à jour le nom d\'utilisateur'],
                'set-privacy' => ['configurer la confidentialité', 'paramètres de confidentialité', 'changer la confidentialité'],
                'verify-profile' => ['vérifier le profil', 'vérifier le compte', 'obtenir la vérification'],
                'create-page' => ['créer une page', 'page professionnelle', 'compte professionnel'],

                // Content Posting
                'create-post' => ['créer une publication', 'nouvelle publication', 'publier', 'écrire une publication'],
                'post-photo' => ['publier une photo', 'télécharger une photo', 'partager une photo', 'publier une image'],
                'post-video' => ['publier une vidéo', 'télécharger une vidéo', 'partager une vidéo'],
                'add-hashtag' => ['ajouter un hashtag', 'hashtag', 'ajouter une étiquette'],
                'tag-person' => ['étiqueter une personne', 'étiqueter un utilisateur', 'étiqueter quelqu\'un'],
                'add-location' => ['ajouter un lieu', 'étiqueter un lieu', 'lieu'],
                'add-emoji' => ['ajouter un emoji', 'emoji', 'insérer un emoji'],
                'add-filter' => ['ajouter un filtre', 'filtre', 'appliquer un filtre'],
                'edit-post' => ['modifier la publication', 'changer la publication', 'mettre à jour la publication'],
                'delete-post' => ['supprimer la publication', 'effacer la publication', 'retirer la publication'],
                'set-audience' => ['configurer l\'audience', 'choisir l\'audience', 'qui peut voir'],
                'create-poll' => ['créer un sondage', 'nouveau sondage', 'sonder', 'créer une enquête'],

                // Interactions
                'like' => ['aimer', 'cœur', 'pouce en haut', 'adorer'],
                'unlike' => ['ne plus aimer', 'retirer le cœur', 'désaimer'],
                'react' => ['réagir', 'ajouter une réaction', 'réaction emoji'],
                'comment' => ['commenter', 'ajouter un commentaire', 'écrire un commentaire'],
                'reply-comment' => ['répondre', 'répondre au commentaire', 'contester'],
                'delete-comment' => ['supprimer le commentaire', 'effacer le commentaire'],
                'like-comment' => ['aimer le commentaire', 'pouce en haut commentaire'],
                'share' => ['partager', 'partager la publication', 'envoyer', 'transférer'],
                'repost' => ['repartager', 'partager à nouveau', 'repartager sur le profil'],
                'save' => ['enregistrer', 'sauvegarder', 'marquer', 'enregistrer pour plus tard'],
                'unsave' => ['retirer l\'enregistrement', 'démarquer', 'retirer le marque-page'],
                'follow' => ['suivre', 'suivre l\'utilisateur', 'suivre le compte', 'ajouter un ami'],
                'unfollow' => ['ne plus suivre', 'arrêter de suivre', 'retirer le suivi'],
                'block' => ['bloquer', 'bloquer l\'utilisateur', 'bloquer le compte'],
                'unblock' => ['débloquer', 'débloquer l\'utilisateur', 'débloquer le compte'],
                'report' => ['signaler', 'signaler l\'utilisateur', 'signaler la publication', 'marquer'],
                'mention' => ['mentionner', 'mentionner l\'utilisateur', 'étiqueter l\'utilisateur', 'appeler'],

                // Messaging
                'send-message' => ['envoyer un message', 'message', 'texte', 'dm', 'message direct'],
                'send-photo' => ['envoyer une photo', 'envoyer une image', 'partager une photo dans le chat'],
                'send-video' => ['envoyer une vidéo', 'partager une vidéo dans le chat'],
                'voice-call' => ['appel vocal', 'appeler', 'appel téléphonique', 'appel audio'],
                'video-call' => ['appel vidéo', 'vidéo chat', 'vidéo'],
                'end-call' => ['terminer l\'appel', 'raccrocher', 'déconnecter', 'fermer l\'appel'],
                'create-group' => ['créer un groupe', 'nouveau groupe', 'chat de groupe'],
                'react-message' => ['réagir au message', 'réaction message'],
                'delete-message' => ['supprimer le message', 'effacer le message'],

                // Privacy & Security
                'open-settings' => ['ouvrir les paramètres', 'paramètres', 'préférences', 'options'],
                'privacy-settings' => ['paramètres de confidentialité', 'confidentialité', 'options de confidentialité'],
                'security-settings' => ['paramètres de sécurité', 'sécurité', 'options de sécurité'],
                'enable-2fa' => ['activer l\'authentification à deux facteurs', 'activer 2fa', 'authentification à deux facteurs'],
                'view-login-history' => ['voir l\'historique de connexion', 'historique de connexion', 'connexions récentes'],
                'manage-cookies' => ['gérer les cookies', 'cookies', 'paramètres des cookies'],

                // Analytics
                'view-insights' => ['voir les statistiques', 'statistiques', 'analytiques', 'voir les analytiques'],
                'view-followers' => ['voir les abonnés', 'abonnés', 'ma liste d\'abonnés'],
                'view-following' => ['voir les abonnements', 'abonnements', 'qui je suis'],
                'view-stats' => ['voir les statistiques', 'statistiques', 'voir les statistiques'],
                'export-data' => ['exporter les données', 'télécharger les données', 'exporter le rapport'],

                // Monetization
                'enable-ads' => ['activer les publicités', 'monétiser', 'activer la monétisation'],
                'view-earnings' => ['voir les gains', 'gains', 'revenus', 'argent'],
                'open-shop' => ['ouvrir la boutique', 'boutique', 'marketplace', 'magasin'],

                // Live & Stories
                'go-live' => ['aller en direct', 'commencer en direct', 'diffusion en direct', 'commencer la diffusion'],
                'end-live' => ['terminer en direct', 'arrêter en direct', 'arrêter la diffusion'],
                'create-story' => ['créer une story', 'nouvelle story', 'ajouter story', 'publier story'],
                'view-story' => ['voir la story', 'ouvrir la story', 'regarder la story'],
                'next-story' => ['story suivante', 'passer story', 'suivant'],
                'previous-story' => ['story précédente', 'retour story'],
                'save-story' => ['enregistrer la story', 'ajouter aux highlights', 'mettre en évidence story'],
                'create-reel' => ['créer un reel', 'nouveau reel', 'ajouter reel'],

                // User Experience
                'toggle-theme' => ['changer le thème', 'mode sombre', 'mode clair', 'basculer le thème'],
                'clear-history' => ['effacer l\'historique', 'supprimer l\'historique', 'effacer la recherche'],
                'refresh-feed' => ['actualiser le fil', 'actualiser', 'recharger le fil'],
                'view-trending' => ['voir les tendances', 'tendances', 'populaire', 'tendance maintenant'],

                // Business
                'open-ads-manager' => ['ouvrir le gestionnaire de publicités', 'gestionnaire de publicités', 'publicité'],
                'manage-roles' => ['gérer les rôles', 'rôles de page', 'rôles', 'permissions'],
                'create-campaign' => ['créer une campagne', 'nouvelle campagne', 'campagne marketing'],

                // Media Control
                'play' => ['lire', 'démarrer vidéo', 'lire vidéo', 'reprendre'],
                'pause' => ['pause', 'arrêter vidéo', 'mettre en pause', 'arrêter'],
                'mute' => ['couper le son', 'sourdine', 'sans son', 'couper l\'audio'],
                'unmute' => ['activer le son', 'avec son', 'allumer le son', 'activer l\'audio'],
                'volume-up' => ['augmenter le volume', 'plus fort', 'monter le volume', 'augmenter'],
                'volume-down' => ['diminuer le volume', 'plus bas', 'baisser le volume', 'diminuer'],
                'fullscreen' => ['plein écran', 'plein écran', 'maximiser'],
                'skip-forward' => ['avancer', 'sauter en avant', 'avance rapide'],
                'skip-backward' => ['reculer', 'sauter en arrière', 'retour rapide'],

                // Camera & Creation
                'open-camera' => ['caméra', 'ouvrir la caméra', 'prendre une photo', 'prendre une image'],
                'take-photo' => ['prendre une photo', 'capturer', 'photographier', 'tirer'],
                'record-video' => ['enregistrer une vidéo', 'commencer l\'enregistrement', 'enregistrer', 'enregistrement vidéo'],

                // Content Navigation
                'next' => ['suivant', 'publication suivante', 'sauter', 'élément suivant'],
                'previous' => ['précédent', 'publication précédente', 'arrière', 'élément précédent'],

                // Basic
                'click' => ['cliquer', 'toucher', 'appuyer', 'sélectionner'],
            ],
        ];

        return $phrases[$locale][$command] ?? $phrases['en'][$command] ?? [];
    }
}

