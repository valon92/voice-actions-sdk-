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
            // E-COMMERCE: ACCOUNT MANAGEMENT
            // ============================================
            [
                'id' => 'create-account',
                'phrases' => $getPhrases('create-account'),
                'action' => 'create-account',
                'description' => 'Create account',
                'category' => 'ecommerce-account'
            ],
            [
                'id' => 'update-personal-info',
                'phrases' => $getPhrases('update-personal-info'),
                'action' => 'update-personal-info',
                'description' => 'Update personal information',
                'category' => 'ecommerce-account'
            ],
            [
                'id' => 'save-shipping-address',
                'phrases' => $getPhrases('save-shipping-address'),
                'action' => 'save-shipping-address',
                'description' => 'Save shipping address',
                'category' => 'ecommerce-account'
            ],
            [
                'id' => 'save-payment-method',
                'phrases' => $getPhrases('save-payment-method'),
                'action' => 'save-payment-method',
                'description' => 'Save payment method',
                'category' => 'ecommerce-account'
            ],
            [
                'id' => 'view-order-history',
                'phrases' => $getPhrases('view-order-history'),
                'action' => 'view-order-history',
                'description' => 'View order history',
                'category' => 'ecommerce-account'
            ],
            [
                'id' => 'change-password',
                'phrases' => $getPhrases('change-password'),
                'action' => 'change-password',
                'description' => 'Change password',
                'category' => 'ecommerce-account'
            ],
            [
                'id' => 'manage-subscriptions',
                'phrases' => $getPhrases('manage-subscriptions'),
                'action' => 'manage-subscriptions',
                'description' => 'Manage subscriptions',
                'category' => 'ecommerce-account'
            ],
            [
                'id' => 'manage-notifications',
                'phrases' => $getPhrases('manage-notifications'),
                'action' => 'manage-notifications',
                'description' => 'Manage notifications',
                'category' => 'ecommerce-account'
            ],

            // ============================================
            // E-COMMERCE: PRODUCT SEARCH & DISCOVERY
            // ============================================
            [
                'id' => 'search-products',
                'phrases' => $getPhrases('search-products'),
                'action' => 'search-products',
                'description' => 'Search for products',
                'category' => 'ecommerce-search'
            ],
            [
                'id' => 'filter-products',
                'phrases' => $getPhrases('filter-products'),
                'action' => 'filter-products',
                'description' => 'Filter products',
                'category' => 'ecommerce-search'
            ],
            [
                'id' => 'browse-categories',
                'phrases' => $getPhrases('browse-categories'),
                'action' => 'browse-categories',
                'description' => 'Browse categories',
                'category' => 'ecommerce-search'
            ],
            [
                'id' => 'voice-search',
                'phrases' => $getPhrases('voice-search'),
                'action' => 'voice-search',
                'description' => 'Voice search',
                'category' => 'ecommerce-search'
            ],
            [
                'id' => 'image-search',
                'phrases' => $getPhrases('image-search'),
                'action' => 'image-search',
                'description' => 'Image search',
                'category' => 'ecommerce-search'
            ],
            [
                'id' => 'compare-products',
                'phrases' => $getPhrases('compare-products'),
                'action' => 'compare-products',
                'description' => 'Compare products',
                'category' => 'ecommerce-search'
            ],
            [
                'id' => 'view-recommendations',
                'phrases' => $getPhrases('view-recommendations'),
                'action' => 'view-recommendations',
                'description' => 'View recommendations',
                'category' => 'ecommerce-search'
            ],
            [
                'id' => 'view-related-products',
                'phrases' => $getPhrases('view-related-products'),
                'action' => 'view-related-products',
                'description' => 'View related products',
                'category' => 'ecommerce-search'
            ],
            [
                'id' => 'add-to-wishlist',
                'phrases' => $getPhrases('add-to-wishlist'),
                'action' => 'add-to-wishlist',
                'description' => 'Add to wishlist',
                'category' => 'ecommerce-search'
            ],

            // ============================================
            // E-COMMERCE: ORDER MANAGEMENT
            // ============================================
            [
                'id' => 'add-to-cart',
                'phrases' => $getPhrases('add-to-cart'),
                'action' => 'add-to-cart',
                'description' => 'Add product to cart',
                'category' => 'ecommerce-order'
            ],
            [
                'id' => 'view-cart',
                'phrases' => $getPhrases('view-cart'),
                'action' => 'view-cart',
                'description' => 'View shopping cart',
                'category' => 'ecommerce-order'
            ],
            [
                'id' => 'update-quantity',
                'phrases' => $getPhrases('update-quantity'),
                'action' => 'update-quantity',
                'description' => 'Update product quantity',
                'category' => 'ecommerce-order'
            ],
            [
                'id' => 'remove-from-cart',
                'phrases' => $getPhrases('remove-from-cart'),
                'action' => 'remove-from-cart',
                'description' => 'Remove from cart',
                'category' => 'ecommerce-order'
            ],
            [
                'id' => 'apply-coupon',
                'phrases' => $getPhrases('apply-coupon'),
                'action' => 'apply-coupon',
                'description' => 'Apply coupon code',
                'category' => 'ecommerce-order'
            ],
            [
                'id' => 'select-shipping',
                'phrases' => $getPhrases('select-shipping'),
                'action' => 'select-shipping',
                'description' => 'Select shipping method',
                'category' => 'ecommerce-order'
            ],
            [
                'id' => 'checkout',
                'phrases' => $getPhrases('checkout'),
                'action' => 'checkout',
                'description' => 'Proceed to checkout',
                'category' => 'ecommerce-order'
            ],
            [
                'id' => 'save-billing-info',
                'phrases' => $getPhrases('save-billing-info'),
                'action' => 'save-billing-info',
                'description' => 'Save billing information',
                'category' => 'ecommerce-order'
            ],
            [
                'id' => 'track-order',
                'phrases' => $getPhrases('track-order'),
                'action' => 'track-order',
                'description' => 'Track order status',
                'category' => 'ecommerce-order'
            ],
            [
                'id' => 'cancel-order',
                'phrases' => $getPhrases('cancel-order'),
                'action' => 'cancel-order',
                'description' => 'Cancel order',
                'category' => 'ecommerce-order'
            ],
            [
                'id' => 'print-invoice',
                'phrases' => $getPhrases('print-invoice'),
                'action' => 'print-invoice',
                'description' => 'Print invoice',
                'category' => 'ecommerce-order'
            ],

            // ============================================
            // E-COMMERCE: PAYMENTS & TRANSACTIONS
            // ============================================
            [
                'id' => 'select-payment-method',
                'phrases' => $getPhrases('select-payment-method'),
                'action' => 'select-payment-method',
                'description' => 'Select payment method',
                'category' => 'ecommerce-payment'
            ],
            [
                'id' => 'use-loyalty-points',
                'phrases' => $getPhrases('use-loyalty-points'),
                'action' => 'use-loyalty-points',
                'description' => 'Use loyalty points',
                'category' => 'ecommerce-payment'
            ],
            [
                'id' => 'view-transaction-history',
                'phrases' => $getPhrases('view-transaction-history'),
                'action' => 'view-transaction-history',
                'description' => 'View transaction history',
                'category' => 'ecommerce-payment'
            ],
            [
                'id' => 'request-refund',
                'phrases' => $getPhrases('request-refund'),
                'action' => 'request-refund',
                'description' => 'Request refund',
                'category' => 'ecommerce-payment'
            ],
            [
                'id' => 'apply-promo-code',
                'phrases' => $getPhrases('apply-promo-code'),
                'action' => 'apply-promo-code',
                'description' => 'Apply promo code',
                'category' => 'ecommerce-payment'
            ],
            [
                'id' => 'view-payment-methods',
                'phrases' => $getPhrases('view-payment-methods'),
                'action' => 'view-payment-methods',
                'description' => 'View saved payment methods',
                'category' => 'ecommerce-payment'
            ],

            // ============================================
            // E-COMMERCE: SHIPPING & DELIVERY
            // ============================================
            [
                'id' => 'select-shipping-company',
                'phrases' => $getPhrases('select-shipping-company'),
                'action' => 'select-shipping-company',
                'description' => 'Select shipping company',
                'category' => 'ecommerce-shipping'
            ],
            [
                'id' => 'set-delivery-address',
                'phrases' => $getPhrases('set-delivery-address'),
                'action' => 'set-delivery-address',
                'description' => 'Set delivery address',
                'category' => 'ecommerce-shipping'
            ],
            [
                'id' => 'select-pickup-point',
                'phrases' => $getPhrases('select-pickup-point'),
                'action' => 'select-pickup-point',
                'description' => 'Select pickup point',
                'category' => 'ecommerce-shipping'
            ],
            [
                'id' => 'track-shipment',
                'phrases' => $getPhrases('track-shipment'),
                'action' => 'track-shipment',
                'description' => 'Track shipment',
                'category' => 'ecommerce-shipping'
            ],
            [
                'id' => 'change-delivery-address',
                'phrases' => $getPhrases('change-delivery-address'),
                'action' => 'change-delivery-address',
                'description' => 'Change delivery address',
                'category' => 'ecommerce-shipping'
            ],
            [
                'id' => 'confirm-delivery',
                'phrases' => $getPhrases('confirm-delivery'),
                'action' => 'confirm-delivery',
                'description' => 'Confirm delivery',
                'category' => 'ecommerce-shipping'
            ],
            [
                'id' => 'view-shipping-notifications',
                'phrases' => $getPhrases('view-shipping-notifications'),
                'action' => 'view-shipping-notifications',
                'description' => 'View shipping notifications',
                'category' => 'ecommerce-shipping'
            ],

            // ============================================
            // E-COMMERCE: COMMUNICATION & SUPPORT
            // ============================================
            [
                'id' => 'contact-seller',
                'phrases' => $getPhrases('contact-seller'),
                'action' => 'contact-seller',
                'description' => 'Contact seller',
                'category' => 'ecommerce-support'
            ],
            [
                'id' => 'open-chat',
                'phrases' => $getPhrases('open-chat'),
                'action' => 'open-chat',
                'description' => 'Open chat',
                'category' => 'ecommerce-support'
            ],
            [
                'id' => 'contact-support',
                'phrases' => $getPhrases('contact-support'),
                'action' => 'contact-support',
                'description' => 'Contact customer support',
                'category' => 'ecommerce-support'
            ],
            [
                'id' => 'report-product',
                'phrases' => $getPhrases('report-product'),
                'action' => 'report-product',
                'description' => 'Report product',
                'category' => 'ecommerce-support'
            ],
            [
                'id' => 'open-dispute',
                'phrases' => $getPhrases('open-dispute'),
                'action' => 'open-dispute',
                'description' => 'Open dispute',
                'category' => 'ecommerce-support'
            ],
            [
                'id' => 'rate-seller',
                'phrases' => $getPhrases('rate-seller'),
                'action' => 'rate-seller',
                'description' => 'Rate seller',
                'category' => 'ecommerce-support'
            ],

            // ============================================
            // E-COMMERCE: REVIEWS & RATINGS
            // ============================================
            [
                'id' => 'rate-product',
                'phrases' => $getPhrases('rate-product'),
                'action' => 'rate-product',
                'description' => 'Rate product',
                'category' => 'ecommerce-review'
            ],
            [
                'id' => 'write-review',
                'phrases' => $getPhrases('write-review'),
                'action' => 'write-review',
                'description' => 'Write product review',
                'category' => 'ecommerce-review'
            ],
            [
                'id' => 'upload-product-photo',
                'phrases' => $getPhrases('upload-product-photo'),
                'action' => 'upload-product-photo',
                'description' => 'Upload product photo',
                'category' => 'ecommerce-review'
            ],
            [
                'id' => 'view-reviews',
                'phrases' => $getPhrases('view-reviews'),
                'action' => 'view-reviews',
                'description' => 'View product reviews',
                'category' => 'ecommerce-review'
            ],
            [
                'id' => 'filter-reviews',
                'phrases' => $getPhrases('filter-reviews'),
                'action' => 'filter-reviews',
                'description' => 'Filter reviews',
                'category' => 'ecommerce-review'
            ],
            [
                'id' => 'report-review',
                'phrases' => $getPhrases('report-review'),
                'action' => 'report-review',
                'description' => 'Report review',
                'category' => 'ecommerce-review'
            ],
            [
                'id' => 'upload-review-video',
                'phrases' => $getPhrases('upload-review-video'),
                'action' => 'upload-review-video',
                'description' => 'Upload review video',
                'category' => 'ecommerce-review'
            ],

            // ============================================
            // E-COMMERCE: LOYALTY & REWARDS
            // ============================================
            [
                'id' => 'view-loyalty-points',
                'phrases' => $getPhrases('view-loyalty-points'),
                'action' => 'view-loyalty-points',
                'description' => 'View loyalty points',
                'category' => 'ecommerce-loyalty'
            ],
            [
                'id' => 'redeem-points',
                'phrases' => $getPhrases('redeem-points'),
                'action' => 'redeem-points',
                'description' => 'Redeem loyalty points',
                'category' => 'ecommerce-loyalty'
            ],
            [
                'id' => 'activate-membership',
                'phrases' => $getPhrases('activate-membership'),
                'action' => 'activate-membership',
                'description' => 'Activate membership',
                'category' => 'ecommerce-loyalty'
            ],
            [
                'id' => 'view-exclusive-offers',
                'phrases' => $getPhrases('view-exclusive-offers'),
                'action' => 'view-exclusive-offers',
                'description' => 'View exclusive offers',
                'category' => 'ecommerce-loyalty'
            ],
            [
                'id' => 'refer-friend',
                'phrases' => $getPhrases('refer-friend'),
                'action' => 'refer-friend',
                'description' => 'Refer a friend',
                'category' => 'ecommerce-loyalty'
            ],

            // ============================================
            // E-COMMERCE: RETURNS & REFUNDS
            // ============================================
            [
                'id' => 'request-return',
                'phrases' => $getPhrases('request-return'),
                'action' => 'request-return',
                'description' => 'Request return',
                'category' => 'ecommerce-return'
            ],
            [
                'id' => 'track-refund',
                'phrases' => $getPhrases('track-refund'),
                'action' => 'track-refund',
                'description' => 'Track refund status',
                'category' => 'ecommerce-return'
            ],
            [
                'id' => 'upload-return-evidence',
                'phrases' => $getPhrases('upload-return-evidence'),
                'action' => 'upload-return-evidence',
                'description' => 'Upload return evidence',
                'category' => 'ecommerce-return'
            ],
            [
                'id' => 'choose-replacement',
                'phrases' => $getPhrases('choose-replacement'),
                'action' => 'choose-replacement',
                'description' => 'Choose replacement or refund',
                'category' => 'ecommerce-return'
            ],
            [
                'id' => 'view-return-history',
                'phrases' => $getPhrases('view-return-history'),
                'action' => 'view-return-history',
                'description' => 'View return history',
                'category' => 'ecommerce-return'
            ],

            // ============================================
            // E-COMMERCE: SELLER FEATURES
            // ============================================
            [
                'id' => 'create-store',
                'phrases' => $getPhrases('create-store'),
                'action' => 'create-store',
                'description' => 'Create store',
                'category' => 'ecommerce-seller'
            ],
            [
                'id' => 'add-product',
                'phrases' => $getPhrases('add-product'),
                'action' => 'add-product',
                'description' => 'Add product',
                'category' => 'ecommerce-seller'
            ],
            [
                'id' => 'manage-orders',
                'phrases' => $getPhrases('manage-orders'),
                'action' => 'manage-orders',
                'description' => 'Manage orders',
                'category' => 'ecommerce-seller'
            ],
            [
                'id' => 'view-sales-stats',
                'phrases' => $getPhrases('view-sales-stats'),
                'action' => 'view-sales-stats',
                'description' => 'View sales statistics',
                'category' => 'ecommerce-seller'
            ],
            [
                'id' => 'create-promotion',
                'phrases' => $getPhrases('create-promotion'),
                'action' => 'create-promotion',
                'description' => 'Create promotion',
                'category' => 'ecommerce-seller'
            ],
            [
                'id' => 'create-ad',
                'phrases' => $getPhrases('create-ad'),
                'action' => 'create-ad',
                'description' => 'Create sponsored ad',
                'category' => 'ecommerce-seller'
            ],
            [
                'id' => 'manage-reviews',
                'phrases' => $getPhrases('manage-reviews'),
                'action' => 'manage-reviews',
                'description' => 'Manage customer reviews',
                'category' => 'ecommerce-seller'
            ],
            [
                'id' => 'view-earnings',
                'phrases' => $getPhrases('view-earnings'),
                'action' => 'view-earnings',
                'description' => 'View earnings',
                'category' => 'ecommerce-seller'
            ],

            // ============================================
            // GAMING: ACCOUNT MANAGEMENT
            // ============================================
            [
                'id' => 'create-gaming-account',
                'phrases' => $getPhrases('create-gaming-account'),
                'action' => 'create-gaming-account',
                'description' => 'Create gaming account',
                'category' => 'gaming-account'
            ],
            [
                'id' => 'set-avatar',
                'phrases' => $getPhrases('set-avatar'),
                'action' => 'set-avatar',
                'description' => 'Set avatar',
                'category' => 'gaming-account'
            ],
            [
                'id' => 'change-gamertag',
                'phrases' => $getPhrases('change-gamertag'),
                'action' => 'change-gamertag',
                'description' => 'Change gamertag/username',
                'category' => 'gaming-account'
            ],
            [
                'id' => 'link-platform',
                'phrases' => $getPhrases('link-platform'),
                'action' => 'link-platform',
                'description' => 'Link gaming platform',
                'category' => 'gaming-account'
            ],
            [
                'id' => 'view-purchase-history',
                'phrases' => $getPhrases('view-purchase-history'),
                'action' => 'view-purchase-history',
                'description' => 'View purchase history',
                'category' => 'gaming-account'
            ],
            [
                'id' => 'manage-subscription',
                'phrases' => $getPhrases('manage-subscription'),
                'action' => 'manage-subscription',
                'description' => 'Manage gaming subscription',
                'category' => 'gaming-account'
            ],
            [
                'id' => 'view-installed-games',
                'phrases' => $getPhrases('view-installed-games'),
                'action' => 'view-installed-games',
                'description' => 'View installed games',
                'category' => 'gaming-account'
            ],
            [
                'id' => 'set-payment-method',
                'phrases' => $getPhrases('set-payment-method'),
                'action' => 'set-payment-method',
                'description' => 'Set payment method',
                'category' => 'gaming-account'
            ],

            // ============================================
            // GAMING: GAME DISCOVERY & PURCHASE
            // ============================================
            [
                'id' => 'search-games',
                'phrases' => $getPhrases('search-games'),
                'action' => 'search-games',
                'description' => 'Search for games',
                'category' => 'gaming-discovery'
            ],
            [
                'id' => 'filter-games',
                'phrases' => $getPhrases('filter-games'),
                'action' => 'filter-games',
                'description' => 'Filter games',
                'category' => 'gaming-discovery'
            ],
            [
                'id' => 'view-game-details',
                'phrases' => $getPhrases('view-game-details'),
                'action' => 'view-game-details',
                'description' => 'View game details',
                'category' => 'gaming-discovery'
            ],
            [
                'id' => 'watch-trailer',
                'phrases' => $getPhrases('watch-trailer'),
                'action' => 'watch-trailer',
                'description' => 'Watch game trailer',
                'category' => 'gaming-discovery'
            ],
            [
                'id' => 'add-to-wishlist',
                'phrases' => $getPhrases('add-to-wishlist'),
                'action' => 'add-to-wishlist',
                'description' => 'Add game to wishlist',
                'category' => 'gaming-discovery'
            ],
            [
                'id' => 'buy-game',
                'phrases' => $getPhrases('buy-game'),
                'action' => 'buy-game',
                'description' => 'Buy game',
                'category' => 'gaming-discovery'
            ],
            [
                'id' => 'pre-order-game',
                'phrases' => $getPhrases('pre-order-game'),
                'action' => 'pre-order-game',
                'description' => 'Pre-order game',
                'category' => 'gaming-discovery'
            ],
            [
                'id' => 'apply-game-coupon',
                'phrases' => $getPhrases('apply-game-coupon'),
                'action' => 'apply-game-coupon',
                'description' => 'Apply game coupon',
                'category' => 'gaming-discovery'
            ],
            [
                'id' => 'view-game-reviews',
                'phrases' => $getPhrases('view-game-reviews'),
                'action' => 'view-game-reviews',
                'description' => 'View game reviews',
                'category' => 'gaming-discovery'
            ],

            // ============================================
            // GAMING: DOWNLOAD & INSTALLATION
            // ============================================
            [
                'id' => 'download-game',
                'phrases' => $getPhrases('download-game'),
                'action' => 'download-game',
                'description' => 'Download game',
                'category' => 'gaming-download'
            ],
            [
                'id' => 'install-game',
                'phrases' => $getPhrases('install-game'),
                'action' => 'install-game',
                'description' => 'Install game',
                'category' => 'gaming-download'
            ],
            [
                'id' => 'manage-storage',
                'phrases' => $getPhrases('manage-storage'),
                'action' => 'manage-storage',
                'description' => 'Manage storage',
                'category' => 'gaming-download'
            ],
            [
                'id' => 'update-game',
                'phrases' => $getPhrases('update-game'),
                'action' => 'update-game',
                'description' => 'Update game',
                'category' => 'gaming-download'
            ],
            [
                'id' => 'install-dlc',
                'phrases' => $getPhrases('install-dlc'),
                'action' => 'install-dlc',
                'description' => 'Install DLC',
                'category' => 'gaming-download'
            ],
            [
                'id' => 'download-beta',
                'phrases' => $getPhrases('download-beta'),
                'action' => 'download-beta',
                'description' => 'Download beta version',
                'category' => 'gaming-download'
            ],
            [
                'id' => 'pause-download',
                'phrases' => $getPhrases('pause-download'),
                'action' => 'pause-download',
                'description' => 'Pause download',
                'category' => 'gaming-download'
            ],
            [
                'id' => 'resume-download',
                'phrases' => $getPhrases('resume-download'),
                'action' => 'resume-download',
                'description' => 'Resume download',
                'category' => 'gaming-download'
            ],

            // ============================================
            // GAMING: GAMEPLAY & INTERACTION
            // ============================================
            [
                'id' => 'launch-game',
                'phrases' => $getPhrases('launch-game'),
                'action' => 'launch-game',
                'description' => 'Launch game',
                'category' => 'gaming-play'
            ],
            [
                'id' => 'invite-friend',
                'phrases' => $getPhrases('invite-friend'),
                'action' => 'invite-friend',
                'description' => 'Invite friend to game',
                'category' => 'gaming-play'
            ],
            [
                'id' => 'create-party',
                'phrases' => $getPhrases('create-party'),
                'action' => 'create-party',
                'description' => 'Create party',
                'category' => 'gaming-play'
            ],
            [
                'id' => 'join-party',
                'phrases' => $getPhrases('join-party'),
                'action' => 'join-party',
                'description' => 'Join party',
                'category' => 'gaming-play'
            ],
            [
                'id' => 'open-voice-chat',
                'phrases' => $getPhrases('open-voice-chat'),
                'action' => 'open-voice-chat',
                'description' => 'Open voice chat',
                'category' => 'gaming-play'
            ],
            [
                'id' => 'toggle-fullscreen',
                'phrases' => $getPhrases('toggle-fullscreen'),
                'action' => 'toggle-fullscreen',
                'description' => 'Toggle fullscreen mode',
                'category' => 'gaming-play'
            ],
            [
                'id' => 'open-settings',
                'phrases' => $getPhrases('open-settings'),
                'action' => 'open-settings',
                'description' => 'Open game settings',
                'category' => 'gaming-play'
            ],
            [
                'id' => 'save-game',
                'phrases' => $getPhrases('save-game'),
                'action' => 'save-game',
                'description' => 'Save game progress',
                'category' => 'gaming-play'
            ],
            [
                'id' => 'sync-cloud-save',
                'phrases' => $getPhrases('sync-cloud-save'),
                'action' => 'sync-cloud-save',
                'description' => 'Sync cloud save',
                'category' => 'gaming-play'
            ],

            // ============================================
            // GAMING: GAME LIBRARY
            // ============================================
            [
                'id' => 'view-library',
                'phrases' => $getPhrases('view-library'),
                'action' => 'view-library',
                'description' => 'View game library',
                'category' => 'gaming-library'
            ],
            [
                'id' => 'filter-library',
                'phrases' => $getPhrases('filter-library'),
                'action' => 'filter-library',
                'description' => 'Filter game library',
                'category' => 'gaming-library'
            ],
            [
                'id' => 'create-collection',
                'phrases' => $getPhrases('create-collection'),
                'action' => 'create-collection',
                'description' => 'Create game collection',
                'category' => 'gaming-library'
            ],
            [
                'id' => 'view-game-stats',
                'phrases' => $getPhrases('view-game-stats'),
                'action' => 'view-game-stats',
                'description' => 'View game statistics',
                'category' => 'gaming-library'
            ],
            [
                'id' => 'toggle-auto-update',
                'phrases' => $getPhrases('toggle-auto-update'),
                'action' => 'toggle-auto-update',
                'description' => 'Toggle auto-update',
                'category' => 'gaming-library'
            ],
            [
                'id' => 'backup-game',
                'phrases' => $getPhrases('backup-game'),
                'action' => 'backup-game',
                'description' => 'Backup game',
                'category' => 'gaming-library'
            ],
            [
                'id' => 'uninstall-game',
                'phrases' => $getPhrases('uninstall-game'),
                'action' => 'uninstall-game',
                'description' => 'Uninstall game',
                'category' => 'gaming-library'
            ],

            // ============================================
            // GAMING: COMMUNITY & SOCIAL
            // ============================================
            [
                'id' => 'add-friend',
                'phrases' => $getPhrases('add-friend'),
                'action' => 'add-friend',
                'description' => 'Add friend',
                'category' => 'gaming-social'
            ],
            [
                'id' => 'view-friends-activity',
                'phrases' => $getPhrases('view-friends-activity'),
                'action' => 'view-friends-activity',
                'description' => 'View friends activity',
                'category' => 'gaming-social'
            ],
            [
                'id' => 'create-group',
                'phrases' => $getPhrases('create-group'),
                'action' => 'create-group',
                'description' => 'Create gaming group',
                'category' => 'gaming-social'
            ],
            [
                'id' => 'write-game-review',
                'phrases' => $getPhrases('write-game-review'),
                'action' => 'write-game-review',
                'description' => 'Write game review',
                'category' => 'gaming-social'
            ],
            [
                'id' => 'share-screenshot',
                'phrases' => $getPhrases('share-screenshot'),
                'action' => 'share-screenshot',
                'description' => 'Share screenshot',
                'category' => 'gaming-social'
            ],
            [
                'id' => 'share-gameplay-clip',
                'phrases' => $getPhrases('share-gameplay-clip'),
                'action' => 'share-gameplay-clip',
                'description' => 'Share gameplay clip',
                'category' => 'gaming-social'
            ],
            [
                'id' => 'view-leaderboard',
                'phrases' => $getPhrases('view-leaderboard'),
                'action' => 'view-leaderboard',
                'description' => 'View leaderboard',
                'category' => 'gaming-social'
            ],
            [
                'id' => 'view-achievements',
                'phrases' => $getPhrases('view-achievements'),
                'action' => 'view-achievements',
                'description' => 'View achievements',
                'category' => 'gaming-social'
            ],
            [
                'id' => 'share-achievement',
                'phrases' => $getPhrases('share-achievement'),
                'action' => 'share-achievement',
                'description' => 'Share achievement',
                'category' => 'gaming-social'
            ],

            // ============================================
            // GAMING: ACHIEVEMENTS & REWARDS
            // ============================================
            [
                'id' => 'unlock-achievement',
                'phrases' => $getPhrases('unlock-achievement'),
                'action' => 'unlock-achievement',
                'description' => 'Unlock achievement',
                'category' => 'gaming-achievement'
            ],
            [
                'id' => 'view-achievement-progress',
                'phrases' => $getPhrases('view-achievement-progress'),
                'action' => 'view-achievement-progress',
                'description' => 'View achievement progress',
                'category' => 'gaming-achievement'
            ],
            [
                'id' => 'compare-achievements',
                'phrases' => $getPhrases('compare-achievements'),
                'action' => 'compare-achievements',
                'description' => 'Compare achievements with friends',
                'category' => 'gaming-achievement'
            ],
            [
                'id' => 'view-rewards',
                'phrases' => $getPhrases('view-rewards'),
                'action' => 'view-rewards',
                'description' => 'View rewards',
                'category' => 'gaming-achievement'
            ],
            [
                'id' => 'claim-reward',
                'phrases' => $getPhrases('claim-reward'),
                'action' => 'claim-reward',
                'description' => 'Claim reward',
                'category' => 'gaming-achievement'
            ],
            [
                'id' => 'view-xp',
                'phrases' => $getPhrases('view-xp'),
                'action' => 'view-xp',
                'description' => 'View XP points',
                'category' => 'gaming-achievement'
            ],

            // ============================================
            // GAMING: COMMUNICATION & SUPPORT
            // ============================================
            [
                'id' => 'open-game-chat',
                'phrases' => $getPhrases('open-game-chat'),
                'action' => 'open-game-chat',
                'description' => 'Open game chat',
                'category' => 'gaming-support'
            ],
            [
                'id' => 'report-player',
                'phrases' => $getPhrases('report-player'),
                'action' => 'report-player',
                'description' => 'Report player',
                'category' => 'gaming-support'
            ],
            [
                'id' => 'report-cheater',
                'phrases' => $getPhrases('report-cheater'),
                'action' => 'report-cheater',
                'description' => 'Report cheater',
                'category' => 'gaming-support'
            ],
            [
                'id' => 'contact-support',
                'phrases' => $getPhrases('contact-support'),
                'action' => 'contact-support',
                'description' => 'Contact gaming support',
                'category' => 'gaming-support'
            ],
            [
                'id' => 'report-bug',
                'phrases' => $getPhrases('report-bug'),
                'action' => 'report-bug',
                'description' => 'Report bug',
                'category' => 'gaming-support'
            ],
            [
                'id' => 'block-player',
                'phrases' => $getPhrases('block-player'),
                'action' => 'block-player',
                'description' => 'Block player',
                'category' => 'gaming-support'
            ],
            [
                'id' => 'mute-player',
                'phrases' => $getPhrases('mute-player'),
                'action' => 'mute-player',
                'description' => 'Mute player',
                'category' => 'gaming-support'
            ],

            // ============================================
            // GAMING: MICROTRANSACTIONS & IN-GAME PURCHASES
            // ============================================
            [
                'id' => 'open-shop',
                'phrases' => $getPhrases('open-shop'),
                'action' => 'open-shop',
                'description' => 'Open in-game shop',
                'category' => 'gaming-purchase'
            ],
            [
                'id' => 'buy-item',
                'phrases' => $getPhrases('buy-item'),
                'action' => 'buy-item',
                'description' => 'Buy in-game item',
                'category' => 'gaming-purchase'
            ],
            [
                'id' => 'buy-skin',
                'phrases' => $getPhrases('buy-skin'),
                'action' => 'buy-skin',
                'description' => 'Buy skin',
                'category' => 'gaming-purchase'
            ],
            [
                'id' => 'view-purchase-history',
                'phrases' => $getPhrases('view-purchase-history'),
                'action' => 'view-purchase-history',
                'description' => 'View in-game purchase history',
                'category' => 'gaming-purchase'
            ],
            [
                'id' => 'activate-battle-pass',
                'phrases' => $getPhrases('activate-battle-pass'),
                'action' => 'activate-battle-pass',
                'description' => 'Activate battle pass',
                'category' => 'gaming-purchase'
            ],
            [
                'id' => 'gift-game',
                'phrases' => $getPhrases('gift-game'),
                'action' => 'gift-game',
                'description' => 'Gift game to friend',
                'category' => 'gaming-purchase'
            ],
            [
                'id' => 'view-marketplace',
                'phrases' => $getPhrases('view-marketplace'),
                'action' => 'view-marketplace',
                'description' => 'View marketplace',
                'category' => 'gaming-purchase'
            ],

            // ============================================
            // GAMING: SECURITY & PRIVACY
            // ============================================
            [
                'id' => 'set-privacy-level',
                'phrases' => $getPhrases('set-privacy-level'),
                'action' => 'set-privacy-level',
                'description' => 'Set privacy level',
                'category' => 'gaming-security'
            ],
            [
                'id' => 'block-unknown',
                'phrases' => $getPhrases('block-unknown'),
                'action' => 'block-unknown',
                'description' => 'Block unknown players',
                'category' => 'gaming-security'
            ],
            [
                'id' => 'enable-2fa',
                'phrases' => $getPhrases('enable-2fa'),
                'action' => 'enable-2fa',
                'description' => 'Enable 2FA',
                'category' => 'gaming-security'
            ],
            [
                'id' => 'view-login-history',
                'phrases' => $getPhrases('view-login-history'),
                'action' => 'view-login-history',
                'description' => 'View login history',
                'category' => 'gaming-security'
            ],
            [
                'id' => 'report-fraud',
                'phrases' => $getPhrases('report-fraud'),
                'action' => 'report-fraud',
                'description' => 'Report fraud',
                'category' => 'gaming-security'
            ],
            [
                'id' => 'enable-steam-guard',
                'phrases' => $getPhrases('enable-steam-guard'),
                'action' => 'enable-steam-guard',
                'description' => 'Enable Steam Guard',
                'category' => 'gaming-security'
            ],

            // ============================================
            // GAMING: REFUNDS & OWNERSHIP
            // ============================================
            [
                'id' => 'request-game-refund',
                'phrases' => $getPhrases('request-game-refund'),
                'action' => 'request-game-refund',
                'description' => 'Request game refund',
                'category' => 'gaming-refund'
            ],
            [
                'id' => 'view-refund-policy',
                'phrases' => $getPhrases('view-refund-policy'),
                'action' => 'view-refund-policy',
                'description' => 'View refund policy',
                'category' => 'gaming-refund'
            ],
            [
                'id' => 'view-licenses',
                'phrases' => $getPhrases('view-licenses'),
                'action' => 'view-licenses',
                'description' => 'View game licenses',
                'category' => 'gaming-refund'
            ],
            [
                'id' => 'download-invoice',
                'phrases' => $getPhrases('download-invoice'),
                'action' => 'download-invoice',
                'description' => 'Download invoice',
                'category' => 'gaming-refund'
            ],
            [
                'id' => 'check-ownership',
                'phrases' => $getPhrases('check-ownership'),
                'action' => 'check-ownership',
                'description' => 'Check game ownership',
                'category' => 'gaming-refund'
            ],

            // ============================================
            // GAMING: GAME EXPERIENCE PERSONALIZATION
            // ============================================
            [
                'id' => 'change-language',
                'phrases' => $getPhrases('change-language'),
                'action' => 'change-language',
                'description' => 'Change game language',
                'category' => 'gaming-ux'
            ],
            [
                'id' => 'toggle-dark-mode',
                'phrases' => $getPhrases('toggle-dark-mode'),
                'action' => 'toggle-dark-mode',
                'description' => 'Toggle dark mode',
                'category' => 'gaming-ux'
            ],
            [
                'id' => 'configure-controller',
                'phrases' => $getPhrases('configure-controller'),
                'action' => 'configure-controller',
                'description' => 'Configure controller',
                'category' => 'gaming-ux'
            ],
            [
                'id' => 'set-key-bindings',
                'phrases' => $getPhrases('set-key-bindings'),
                'action' => 'set-key-bindings',
                'description' => 'Set key bindings',
                'category' => 'gaming-ux'
            ],
            [
                'id' => 'toggle-overlay',
                'phrases' => $getPhrases('toggle-overlay'),
                'action' => 'toggle-overlay',
                'description' => 'Toggle in-game overlay',
                'category' => 'gaming-ux'
            ],
            [
                'id' => 'connect-streaming',
                'phrases' => $getPhrases('connect-streaming'),
                'action' => 'connect-streaming',
                'description' => 'Connect streaming platform',
                'category' => 'gaming-ux'
            ],
            [
                'id' => 'view-events',
                'phrases' => $getPhrases('view-events'),
                'action' => 'view-events',
                'description' => 'View gaming events',
                'category' => 'gaming-ux'
            ],

            // ============================================
            // GAMING: DEVICE & PLATFORM INTEGRATION
            // ============================================
            [
                'id' => 'sync-devices',
                'phrases' => $getPhrases('sync-devices'),
                'action' => 'sync-devices',
                'description' => 'Sync across devices',
                'category' => 'gaming-device'
            ],
            [
                'id' => 'connect-vr',
                'phrases' => $getPhrases('connect-vr'),
                'action' => 'connect-vr',
                'description' => 'Connect VR headset',
                'category' => 'gaming-device'
            ],
            [
                'id' => 'enable-cross-platform',
                'phrases' => $getPhrases('enable-cross-platform'),
                'action' => 'enable-cross-platform',
                'description' => 'Enable cross-platform play',
                'category' => 'gaming-device'
            ],
            [
                'id' => 'connect-controller',
                'phrases' => $getPhrases('connect-controller'),
                'action' => 'connect-controller',
                'description' => 'Connect controller',
                'category' => 'gaming-device'
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

            // ============================================
            // OPERATING SYSTEMS (Windows, macOS, Linux)
            // ============================================
            [
                'id' => 'open-app',
                'phrases' => $getPhrases('open-app'),
                'action' => 'open-app',
                'description' => 'Open application',
                'category' => 'os'
            ],
            [
                'id' => 'close-app',
                'phrases' => $getPhrases('close-app'),
                'action' => 'close-app',
                'description' => 'Close application',
                'category' => 'os'
            ],
            [
                'id' => 'minimize-window',
                'phrases' => $getPhrases('minimize-window'),
                'action' => 'minimize-window',
                'description' => 'Minimize window',
                'category' => 'os'
            ],
            [
                'id' => 'maximize-window',
                'phrases' => $getPhrases('maximize-window'),
                'action' => 'maximize-window',
                'description' => 'Maximize window',
                'category' => 'os'
            ],
            [
                'id' => 'save-file',
                'phrases' => $getPhrases('save-file'),
                'action' => 'save-file',
                'description' => 'Save file',
                'category' => 'os'
            ],
            [
                'id' => 'open-file',
                'phrases' => $getPhrases('open-file'),
                'action' => 'open-file',
                'description' => 'Open file',
                'category' => 'os'
            ],
            [
                'id' => 'create-folder',
                'phrases' => $getPhrases('create-folder'),
                'action' => 'create-folder',
                'description' => 'Create folder',
                'category' => 'os'
            ],
            [
                'id' => 'delete-file',
                'phrases' => $getPhrases('delete-file'),
                'action' => 'delete-file',
                'description' => 'Delete file',
                'category' => 'os'
            ],
            [
                'id' => 'open-settings',
                'phrases' => $getPhrases('open-settings'),
                'action' => 'open-settings',
                'description' => 'Open system settings',
                'category' => 'os'
            ],
            [
                'id' => 'install-software',
                'phrases' => $getPhrases('install-software'),
                'action' => 'install-software',
                'description' => 'Install software',
                'category' => 'os'
            ],
            [
                'id' => 'uninstall-software',
                'phrases' => $getPhrases('uninstall-software'),
                'action' => 'uninstall-software',
                'description' => 'Uninstall software',
                'category' => 'os'
            ],
            [
                'id' => 'update-system',
                'phrases' => $getPhrases('update-system'),
                'action' => 'update-system',
                'description' => 'Update system',
                'category' => 'os'
            ],
            [
                'id' => 'connect-wifi',
                'phrases' => $getPhrases('connect-wifi'),
                'action' => 'connect-wifi',
                'description' => 'Connect to Wi-Fi',
                'category' => 'os'
            ],
            [
                'id' => 'open-terminal',
                'phrases' => $getPhrases('open-terminal'),
                'action' => 'open-terminal',
                'description' => 'Open terminal/command prompt',
                'category' => 'os'
            ],
            [
                'id' => 'change-wallpaper',
                'phrases' => $getPhrases('change-wallpaper'),
                'action' => 'change-wallpaper',
                'description' => 'Change wallpaper',
                'category' => 'os'
            ],
            [
                'id' => 'create-user',
                'phrases' => $getPhrases('create-user'),
                'action' => 'create-user',
                'description' => 'Create new user account',
                'category' => 'os'
            ],
            [
                'id' => 'backup-data',
                'phrases' => $getPhrases('backup-data'),
                'action' => 'backup-data',
                'description' => 'Backup data',
                'category' => 'os'
            ],
            [
                'id' => 'restore-data',
                'phrases' => $getPhrases('restore-data'),
                'action' => 'restore-data',
                'description' => 'Restore data',
                'category' => 'os'
            ],
            [
                'id' => 'view-system-info',
                'phrases' => $getPhrases('view-system-info'),
                'action' => 'view-system-info',
                'description' => 'View system information',
                'category' => 'os'
            ],
            [
                'id' => 'monitor-performance',
                'phrases' => $getPhrases('monitor-performance'),
                'action' => 'monitor-performance',
                'description' => 'Monitor system performance',
                'category' => 'os'
            ],

            // ============================================
            // MOBILE PLATFORMS (Android, iOS)
            // ============================================
            [
                'id' => 'install-app',
                'phrases' => $getPhrases('install-app'),
                'action' => 'install-app',
                'description' => 'Install mobile app',
                'category' => 'mobile'
            ],
            [
                'id' => 'uninstall-app',
                'phrases' => $getPhrases('uninstall-app'),
                'action' => 'uninstall-app',
                'description' => 'Uninstall mobile app',
                'category' => 'mobile'
            ],
            [
                'id' => 'open-camera',
                'phrases' => $getPhrases('open-camera'),
                'action' => 'open-camera',
                'description' => 'Open camera',
                'category' => 'mobile'
            ],
            [
                'id' => 'take-photo',
                'phrases' => $getPhrases('take-photo'),
                'action' => 'take-photo',
                'description' => 'Take photo',
                'category' => 'mobile'
            ],
            [
                'id' => 'record-video',
                'phrases' => $getPhrases('record-video'),
                'action' => 'record-video',
                'description' => 'Record video',
                'category' => 'mobile'
            ],
            [
                'id' => 'open-contacts',
                'phrases' => $getPhrases('open-contacts'),
                'action' => 'open-contacts',
                'description' => 'Open contacts',
                'category' => 'mobile'
            ],
            [
                'id' => 'make-call',
                'phrases' => $getPhrases('make-call'),
                'action' => 'make-call',
                'description' => 'Make phone call',
                'category' => 'mobile'
            ],
            [
                'id' => 'send-sms',
                'phrases' => $getPhrases('send-sms'),
                'action' => 'send-sms',
                'description' => 'Send SMS message',
                'category' => 'mobile'
            ],
            [
                'id' => 'sync-cloud',
                'phrases' => $getPhrases('sync-cloud'),
                'action' => 'sync-cloud',
                'description' => 'Sync with cloud',
                'category' => 'mobile'
            ],
            [
                'id' => 'enable-backup',
                'phrases' => $getPhrases('enable-backup'),
                'action' => 'enable-backup',
                'description' => 'Enable automatic backup',
                'category' => 'mobile'
            ],
            [
                'id' => 'connect-device',
                'phrases' => $getPhrases('connect-device'),
                'action' => 'connect-device',
                'description' => 'Connect to external device',
                'category' => 'mobile'
            ],
            [
                'id' => 'enable-face-id',
                'phrases' => $getPhrases('enable-face-id'),
                'action' => 'enable-face-id',
                'description' => 'Enable Face ID',
                'category' => 'mobile'
            ],
            [
                'id' => 'enable-touch-id',
                'phrases' => $getPhrases('enable-touch-id'),
                'action' => 'enable-touch-id',
                'description' => 'Enable Touch ID',
                'category' => 'mobile'
            ],
            [
                'id' => 'manage-permissions',
                'phrases' => $getPhrases('manage-permissions'),
                'action' => 'manage-permissions',
                'description' => 'Manage app permissions',
                'category' => 'mobile'
            ],
            [
                'id' => 'find-device',
                'phrases' => $getPhrases('find-device'),
                'action' => 'find-device',
                'description' => 'Find my device',
                'category' => 'mobile'
            ],
            [
                'id' => 'change-ringtone',
                'phrases' => $getPhrases('change-ringtone'),
                'action' => 'change-ringtone',
                'description' => 'Change ringtone',
                'category' => 'mobile'
            ],
            [
                'id' => 'enable-location',
                'phrases' => $getPhrases('enable-location'),
                'action' => 'enable-location',
                'description' => 'Enable location services',
                'category' => 'mobile'
            ],

            // ============================================
            // CLOUD PLATFORMS (AWS, Azure, Google Cloud)
            // ============================================
            [
                'id' => 'create-server',
                'phrases' => $getPhrases('create-server'),
                'action' => 'create-server',
                'description' => 'Create virtual server',
                'category' => 'cloud'
            ],
            [
                'id' => 'create-database',
                'phrases' => $getPhrases('create-database'),
                'action' => 'create-database',
                'description' => 'Create database',
                'category' => 'cloud'
            ],
            [
                'id' => 'upload-file',
                'phrases' => $getPhrases('upload-file'),
                'action' => 'upload-file',
                'description' => 'Upload file to cloud',
                'category' => 'cloud'
            ],
            [
                'id' => 'download-file',
                'phrases' => $getPhrases('download-file'),
                'action' => 'download-file',
                'description' => 'Download file from cloud',
                'category' => 'cloud'
            ],
            [
                'id' => 'deploy-app',
                'phrases' => $getPhrases('deploy-app'),
                'action' => 'deploy-app',
                'description' => 'Deploy application',
                'category' => 'cloud'
            ],
            [
                'id' => 'monitor-traffic',
                'phrases' => $getPhrases('monitor-traffic'),
                'action' => 'monitor-traffic',
                'description' => 'Monitor traffic',
                'category' => 'cloud'
            ],
            [
                'id' => 'set-permissions',
                'phrases' => $getPhrases('set-permissions'),
                'action' => 'set-permissions',
                'description' => 'Set user permissions',
                'category' => 'cloud'
            ],
            [
                'id' => 'enable-encryption',
                'phrases' => $getPhrases('enable-encryption'),
                'action' => 'enable-encryption',
                'description' => 'Enable encryption',
                'category' => 'cloud'
            ],
            [
                'id' => 'create-backup',
                'phrases' => $getPhrases('create-backup'),
                'action' => 'create-backup',
                'description' => 'Create backup',
                'category' => 'cloud'
            ],
            [
                'id' => 'restore-backup',
                'phrases' => $getPhrases('restore-backup'),
                'action' => 'restore-backup',
                'description' => 'Restore from backup',
                'category' => 'cloud'
            ],
            [
                'id' => 'scale-resources',
                'phrases' => $getPhrases('scale-resources'),
                'action' => 'scale-resources',
                'description' => 'Scale resources',
                'category' => 'cloud'
            ],
            [
                'id' => 'view-logs',
                'phrases' => $getPhrases('view-logs'),
                'action' => 'view-logs',
                'description' => 'View logs',
                'category' => 'cloud'
            ],

            // ============================================
            // DEVELOPER PLATFORMS (GitHub, GitLab, etc.)
            // ============================================
            [
                'id' => 'create-repository',
                'phrases' => $getPhrases('create-repository'),
                'action' => 'create-repository',
                'description' => 'Create repository',
                'category' => 'developer'
            ],
            [
                'id' => 'clone-repository',
                'phrases' => $getPhrases('clone-repository'),
                'action' => 'clone-repository',
                'description' => 'Clone repository',
                'category' => 'developer'
            ],
            [
                'id' => 'commit-changes',
                'phrases' => $getPhrases('commit-changes'),
                'action' => 'commit-changes',
                'description' => 'Commit changes',
                'category' => 'developer'
            ],
            [
                'id' => 'push-changes',
                'phrases' => $getPhrases('push-changes'),
                'action' => 'push-changes',
                'description' => 'Push changes',
                'category' => 'developer'
            ],
            [
                'id' => 'pull-changes',
                'phrases' => $getPhrases('pull-changes'),
                'action' => 'pull-changes',
                'description' => 'Pull changes',
                'category' => 'developer'
            ],
            [
                'id' => 'create-branch',
                'phrases' => $getPhrases('create-branch'),
                'action' => 'create-branch',
                'description' => 'Create branch',
                'category' => 'developer'
            ],
            [
                'id' => 'merge-branch',
                'phrases' => $getPhrases('merge-branch'),
                'action' => 'merge-branch',
                'description' => 'Merge branch',
                'category' => 'developer'
            ],
            [
                'id' => 'create-pull-request',
                'phrases' => $getPhrases('create-pull-request'),
                'action' => 'create-pull-request',
                'description' => 'Create pull request',
                'category' => 'developer'
            ],
            [
                'id' => 'deploy-site',
                'phrases' => $getPhrases('deploy-site'),
                'action' => 'deploy-site',
                'description' => 'Deploy website',
                'category' => 'developer'
            ],
            [
                'id' => 'view-commits',
                'phrases' => $getPhrases('view-commits'),
                'action' => 'view-commits',
                'description' => 'View commit history',
                'category' => 'developer'
            ],
            [
                'id' => 'view-issues',
                'phrases' => $getPhrases('view-issues'),
                'action' => 'view-issues',
                'description' => 'View issues',
                'category' => 'developer'
            ],
            [
                'id' => 'create-issue',
                'phrases' => $getPhrases('create-issue'),
                'action' => 'create-issue',
                'description' => 'Create issue',
                'category' => 'developer'
            ],
            [
                'id' => 'invite-collaborator',
                'phrases' => $getPhrases('invite-collaborator'),
                'action' => 'invite-collaborator',
                'description' => 'Invite collaborator',
                'category' => 'developer'
            ],

            // ============================================
            // COMMON TECHNICAL FEATURES
            // ============================================
            [
                'id' => 'connect-internet',
                'phrases' => $getPhrases('connect-internet'),
                'action' => 'connect-internet',
                'description' => 'Connect to internet',
                'category' => 'tech-common'
            ],
            [
                'id' => 'create-account',
                'phrases' => $getPhrases('create-account'),
                'action' => 'create-account',
                'description' => 'Create user account',
                'category' => 'tech-common'
            ],
            [
                'id' => 'change-language',
                'phrases' => $getPhrases('change-language'),
                'action' => 'change-language',
                'description' => 'Change language',
                'category' => 'tech-common'
            ],
            [
                'id' => 'open-browser',
                'phrases' => $getPhrases('open-browser'),
                'action' => 'open-browser',
                'description' => 'Open web browser',
                'category' => 'tech-common'
            ],
            [
                'id' => 'enable-security',
                'phrases' => $getPhrases('enable-security'),
                'action' => 'enable-security',
                'description' => 'Enable security features',
                'category' => 'tech-common'
            ],
            [
                'id' => 'enable-auto-update',
                'phrases' => $getPhrases('enable-auto-update'),
                'action' => 'enable-auto-update',
                'description' => 'Enable automatic updates',
                'category' => 'tech-common'
            ],
            [
                'id' => 'connect-external-device',
                'phrases' => $getPhrases('connect-external-device'),
                'action' => 'connect-external-device',
                'description' => 'Connect external device',
                'category' => 'tech-common'
            ],
            [
                'id' => 'optimize-system',
                'phrases' => $getPhrases('optimize-system'),
                'action' => 'optimize-system',
                'description' => 'Optimize system',
                'category' => 'tech-common'
            ],

            // ============================================
            // EDUCATION: STUDENT ACTIONS
            // ============================================
            [
                'id' => 'watch-lecture',
                'phrases' => $getPhrases('watch-lecture'),
                'action' => 'watch-lecture',
                'description' => 'Watch lecture video',
                'category' => 'education-student'
            ],
            [
                'id' => 'download-materials',
                'phrases' => $getPhrases('download-materials'),
                'action' => 'download-materials',
                'description' => 'Download course materials',
                'category' => 'education-student'
            ],
            [
                'id' => 'read-chapter',
                'phrases' => $getPhrases('read-chapter'),
                'action' => 'read-chapter',
                'description' => 'Read chapter or module',
                'category' => 'education-student'
            ],
            [
                'id' => 'enroll-course',
                'phrases' => $getPhrases('enroll-course'),
                'action' => 'enroll-course',
                'description' => 'Enroll in course',
                'category' => 'education-student'
            ],
            [
                'id' => 'resume-course',
                'phrases' => $getPhrases('resume-course'),
                'action' => 'resume-course',
                'description' => 'Resume course',
                'category' => 'education-student'
            ],
            [
                'id' => 'view-course-info',
                'phrases' => $getPhrases('view-course-info'),
                'action' => 'view-course-info',
                'description' => 'View course information',
                'category' => 'education-student'
            ],
            [
                'id' => 'take-quiz',
                'phrases' => $getPhrases('take-quiz'),
                'action' => 'take-quiz',
                'description' => 'Take quiz or test',
                'category' => 'education-student'
            ],
            [
                'id' => 'submit-assignment',
                'phrases' => $getPhrases('submit-assignment'),
                'action' => 'submit-assignment',
                'description' => 'Submit assignment',
                'category' => 'education-student'
            ],
            [
                'id' => 'view-grades',
                'phrases' => $getPhrases('view-grades'),
                'action' => 'view-grades',
                'description' => 'View grades and progress',
                'category' => 'education-student'
            ],
            [
                'id' => 'contact-instructor',
                'phrases' => $getPhrases('contact-instructor'),
                'action' => 'contact-instructor',
                'description' => 'Contact instructor',
                'category' => 'education-student'
            ],
            [
                'id' => 'ask-question',
                'phrases' => $getPhrases('ask-question'),
                'action' => 'ask-question',
                'description' => 'Ask question in forum',
                'category' => 'education-student'
            ],
            [
                'id' => 'join-discussion',
                'phrases' => $getPhrases('join-discussion'),
                'action' => 'join-discussion',
                'description' => 'Join discussion board',
                'category' => 'education-student'
            ],
            [
                'id' => 'download-certificate',
                'phrases' => $getPhrases('download-certificate'),
                'action' => 'download-certificate',
                'description' => 'Download certificate',
                'category' => 'education-student'
            ],
            [
                'id' => 'view-portfolio',
                'phrases' => $getPhrases('view-portfolio'),
                'action' => 'view-portfolio',
                'description' => 'View learning portfolio',
                'category' => 'education-student'
            ],
            [
                'id' => 'view-progress',
                'phrases' => $getPhrases('view-progress'),
                'action' => 'view-progress',
                'description' => 'View learning progress',
                'category' => 'education-student'
            ],

            // ============================================
            // EDUCATION: INSTRUCTOR ACTIONS
            // ============================================
            [
                'id' => 'create-course',
                'phrases' => $getPhrases('create-course'),
                'action' => 'create-course',
                'description' => 'Create new course',
                'category' => 'education-instructor'
            ],
            [
                'id' => 'upload-content',
                'phrases' => $getPhrases('upload-content'),
                'action' => 'upload-content',
                'description' => 'Upload course content',
                'category' => 'education-instructor'
            ],
            [
                'id' => 'set-course-price',
                'phrases' => $getPhrases('set-course-price'),
                'action' => 'set-course-price',
                'description' => 'Set course price',
                'category' => 'education-instructor'
            ],
            [
                'id' => 'invite-students',
                'phrases' => $getPhrases('invite-students'),
                'action' => 'invite-students',
                'description' => 'Invite students to course',
                'category' => 'education-instructor'
            ],
            [
                'id' => 'view-student-progress',
                'phrases' => $getPhrases('view-student-progress'),
                'action' => 'view-student-progress',
                'description' => 'View student progress',
                'category' => 'education-instructor'
            ],
            [
                'id' => 'grade-assignment',
                'phrases' => $getPhrases('grade-assignment'),
                'action' => 'grade-assignment',
                'description' => 'Grade assignment',
                'category' => 'education-instructor'
            ],
            [
                'id' => 'post-announcement',
                'phrases' => $getPhrases('post-announcement'),
                'action' => 'post-announcement',
                'description' => 'Post announcement',
                'category' => 'education-instructor'
            ],
            [
                'id' => 'view-analytics',
                'phrases' => $getPhrases('view-analytics'),
                'action' => 'view-analytics',
                'description' => 'View course analytics',
                'category' => 'education-instructor'
            ],
            [
                'id' => 'start-live-class',
                'phrases' => $getPhrases('start-live-class'),
                'action' => 'start-live-class',
                'description' => 'Start live class',
                'category' => 'education-instructor'
            ],
            [
                'id' => 'answer-question',
                'phrases' => $getPhrases('answer-question'),
                'action' => 'answer-question',
                'description' => 'Answer student question',
                'category' => 'education-instructor'
            ],

            // ============================================
            // EDUCATION: COMMON FEATURES
            // ============================================
            [
                'id' => 'search-courses',
                'phrases' => $getPhrases('search-courses'),
                'action' => 'search-courses',
                'description' => 'Search for courses',
                'category' => 'education-common'
            ],
            [
                'id' => 'view-recommendations',
                'phrases' => $getPhrases('view-recommendations'),
                'action' => 'view-recommendations',
                'description' => 'View course recommendations',
                'category' => 'education-common'
            ],
            [
                'id' => 'view-course-history',
                'phrases' => $getPhrases('view-course-history'),
                'action' => 'view-course-history',
                'description' => 'View course history',
                'category' => 'education-common'
            ],
            [
                'id' => 'enable-notifications',
                'phrases' => $getPhrases('enable-notifications'),
                'action' => 'enable-notifications',
                'description' => 'Enable course notifications',
                'category' => 'education-common'
            ],
            [
                'id' => 'contact-support',
                'phrases' => $getPhrases('contact-support'),
                'action' => 'contact-support',
                'description' => 'Contact support',
                'category' => 'education-common'
            ],

            // ============================================
            // COMMUNICATION: CHAT & MESSAGING
            // ============================================
            [
                'id' => 'send-message',
                'phrases' => $getPhrases('send-message'),
                'action' => 'send-message',
                'description' => 'Send text message',
                'category' => 'communication-chat'
            ],
            [
                'id' => 'send-file',
                'phrases' => $getPhrases('send-file'),
                'action' => 'send-file',
                'description' => 'Send file or document',
                'category' => 'communication-chat'
            ],
            [
                'id' => 'edit-message',
                'phrases' => $getPhrases('edit-message'),
                'action' => 'edit-message',
                'description' => 'Edit message',
                'category' => 'communication-chat'
            ],
            [
                'id' => 'delete-message',
                'phrases' => $getPhrases('delete-message'),
                'action' => 'delete-message',
                'description' => 'Delete message',
                'category' => 'communication-chat'
            ],
            [
                'id' => 'search-messages',
                'phrases' => $getPhrases('search-messages'),
                'action' => 'search-messages',
                'description' => 'Search message history',
                'category' => 'communication-chat'
            ],
            [
                'id' => 'mention-user',
                'phrases' => $getPhrases('mention-user'),
                'action' => 'mention-user',
                'description' => 'Mention user with @',
                'category' => 'communication-chat'
            ],
            [
                'id' => 'react-message',
                'phrases' => $getPhrases('react-message'),
                'action' => 'react-message',
                'description' => 'React to message',
                'category' => 'communication-chat'
            ],
            [
                'id' => 'pin-message',
                'phrases' => $getPhrases('pin-message'),
                'action' => 'pin-message',
                'description' => 'Pin message',
                'category' => 'communication-chat'
            ],
            [
                'id' => 'create-thread',
                'phrases' => $getPhrases('create-thread'),
                'action' => 'create-thread',
                'description' => 'Create thread',
                'category' => 'communication-chat'
            ],

            // ============================================
            // COMMUNICATION: CALLS & VIDEO
            // ============================================
            [
                'id' => 'start-call',
                'phrases' => $getPhrases('start-call'),
                'action' => 'start-call',
                'description' => 'Start voice or video call',
                'category' => 'communication-call'
            ],
            [
                'id' => 'join-meeting',
                'phrases' => $getPhrases('join-meeting'),
                'action' => 'join-meeting',
                'description' => 'Join meeting',
                'category' => 'communication-call'
            ],
            [
                'id' => 'toggle-camera',
                'phrases' => $getPhrases('toggle-camera'),
                'action' => 'toggle-camera',
                'description' => 'Toggle camera on/off',
                'category' => 'communication-call'
            ],
            [
                'id' => 'toggle-mic',
                'phrases' => $getPhrases('toggle-mic'),
                'action' => 'toggle-mic',
                'description' => 'Toggle microphone on/off',
                'category' => 'communication-call'
            ],
            [
                'id' => 'change-background',
                'phrases' => $getPhrases('change-background'),
                'action' => 'change-background',
                'description' => 'Change virtual background',
                'category' => 'communication-call'
            ],
            [
                'id' => 'record-meeting',
                'phrases' => $getPhrases('record-meeting'),
                'action' => 'record-meeting',
                'description' => 'Record meeting',
                'category' => 'communication-call'
            ],
            [
                'id' => 'share-screen',
                'phrases' => $getPhrases('share-screen'),
                'action' => 'share-screen',
                'description' => 'Share screen',
                'category' => 'communication-call'
            ],
            [
                'id' => 'raise-hand',
                'phrases' => $getPhrases('raise-hand'),
                'action' => 'raise-hand',
                'description' => 'Raise hand',
                'category' => 'communication-call'
            ],
            [
                'id' => 'mute-participant',
                'phrases' => $getPhrases('mute-participant'),
                'action' => 'mute-participant',
                'description' => 'Mute participant',
                'category' => 'communication-call'
            ],

            // ============================================
            // COMMUNICATION: GROUPS & CHANNELS
            // ============================================
            [
                'id' => 'create-channel',
                'phrases' => $getPhrases('create-channel'),
                'action' => 'create-channel',
                'description' => 'Create channel or group',
                'category' => 'communication-group'
            ],
            [
                'id' => 'invite-member',
                'phrases' => $getPhrases('invite-member'),
                'action' => 'invite-member',
                'description' => 'Invite member to channel',
                'category' => 'communication-group'
            ],
            [
                'id' => 'set-channel-info',
                'phrases' => $getPhrases('set-channel-info'),
                'action' => 'set-channel-info',
                'description' => 'Set channel info',
                'category' => 'communication-group'
            ],
            [
                'id' => 'set-permissions',
                'phrases' => $getPhrases('set-permissions'),
                'action' => 'set-permissions',
                'description' => 'Set channel permissions',
                'category' => 'communication-group'
            ],
            [
                'id' => 'assign-role',
                'phrases' => $getPhrases('assign-role'),
                'action' => 'assign-role',
                'description' => 'Assign role to user',
                'category' => 'communication-group'
            ],
            [
                'id' => 'leave-channel',
                'phrases' => $getPhrases('leave-channel'),
                'action' => 'leave-channel',
                'description' => 'Leave channel',
                'category' => 'communication-group'
            ],

            // ============================================
            // COMMUNICATION: FILES & DOCUMENTS
            // ============================================
            [
                'id' => 'upload-file',
                'phrases' => $getPhrases('upload-file'),
                'action' => 'upload-file',
                'description' => 'Upload file',
                'category' => 'communication-file'
            ],
            [
                'id' => 'view-file-versions',
                'phrases' => $getPhrases('view-file-versions'),
                'action' => 'view-file-versions',
                'description' => 'View file versions',
                'category' => 'communication-file'
            ],
            [
                'id' => 'comment-document',
                'phrases' => $getPhrases('comment-document'),
                'action' => 'comment-document',
                'description' => 'Comment on document',
                'category' => 'communication-file'
            ],
            [
                'id' => 'search-files',
                'phrases' => $getPhrases('search-files'),
                'action' => 'search-files',
                'description' => 'Search files',
                'category' => 'communication-file'
            ],

            // ============================================
            // COMMUNICATION: NOTIFICATIONS & SETTINGS
            // ============================================
            [
                'id' => 'mute-channel',
                'phrases' => $getPhrases('mute-channel'),
                'action' => 'mute-channel',
                'description' => 'Mute channel notifications',
                'category' => 'communication-notification'
            ],
            [
                'id' => 'enable-do-not-disturb',
                'phrases' => $getPhrases('enable-do-not-disturb'),
                'action' => 'enable-do-not-disturb',
                'description' => 'Enable Do Not Disturb',
                'category' => 'communication-notification'
            ],
            [
                'id' => 'change-theme',
                'phrases' => $getPhrases('change-theme'),
                'action' => 'change-theme',
                'description' => 'Change theme',
                'category' => 'communication-notification'
            ],
            [
                'id' => 'set-status',
                'phrases' => $getPhrases('set-status'),
                'action' => 'set-status',
                'description' => 'Set status',
                'category' => 'communication-notification'
            ],

            // ============================================
            // COMMUNICATION: COLLABORATION & TASKS
            // ============================================
            [
                'id' => 'create-task',
                'phrases' => $getPhrases('create-task'),
                'action' => 'create-task',
                'description' => 'Create task',
                'category' => 'communication-collaboration'
            ],
            [
                'id' => 'sync-calendar',
                'phrases' => $getPhrases('sync-calendar'),
                'action' => 'sync-calendar',
                'description' => 'Sync calendar',
                'category' => 'communication-collaboration'
            ],
            [
                'id' => 'set-deadline',
                'phrases' => $getPhrases('set-deadline'),
                'action' => 'set-deadline',
                'description' => 'Set deadline',
                'category' => 'communication-collaboration'
            ],
            [
                'id' => 'open-whiteboard',
                'phrases' => $getPhrases('open-whiteboard'),
                'action' => 'open-whiteboard',
                'description' => 'Open whiteboard',
                'category' => 'communication-collaboration'
            ],
            [
                'id' => 'view-project-progress',
                'phrases' => $getPhrases('view-project-progress'),
                'action' => 'view-project-progress',
                'description' => 'View project progress',
                'category' => 'communication-collaboration'
            ],

            // ============================================
            // COMMUNICATION: INTEGRATIONS
            // ============================================
            [
                'id' => 'connect-app',
                'phrases' => $getPhrases('connect-app'),
                'action' => 'connect-app',
                'description' => 'Connect external app',
                'category' => 'communication-integration'
            ],
            [
                'id' => 'view-integrations',
                'phrases' => $getPhrases('view-integrations'),
                'action' => 'view-integrations',
                'description' => 'View integrations',
                'category' => 'communication-integration'
            ],
            [
                'id' => 'create-automation',
                'phrases' => $getPhrases('create-automation'),
                'action' => 'create-automation',
                'description' => 'Create automation',
                'category' => 'communication-integration'
            ],

            // ============================================
            // COMMUNICATION: SECURITY & PROFILE
            // ============================================
            [
                'id' => 'update-profile',
                'phrases' => $getPhrases('update-profile'),
                'action' => 'update-profile',
                'description' => 'Update profile',
                'category' => 'communication-security'
            ],
            [
                'id' => 'enable-2fa',
                'phrases' => $getPhrases('enable-2fa'),
                'action' => 'enable-2fa',
                'description' => 'Enable two-factor authentication',
                'category' => 'communication-security'
            ],
            [
                'id' => 'block-user',
                'phrases' => $getPhrases('block-user'),
                'action' => 'block-user',
                'description' => 'Block user',
                'category' => 'communication-security'
            ],
            [
                'id' => 'view-privacy-settings',
                'phrases' => $getPhrases('view-privacy-settings'),
                'action' => 'view-privacy-settings',
                'description' => 'View privacy settings',
                'category' => 'communication-security'
            ],

            // ============================================
            // COMMUNICATION: ADMIN ACTIONS
            // ============================================
            [
                'id' => 'delete-channel',
                'phrases' => $getPhrases('delete-channel'),
                'action' => 'delete-channel',
                'description' => 'Delete channel',
                'category' => 'communication-admin'
            ],
            [
                'id' => 'set-rules',
                'phrases' => $getPhrases('set-rules'),
                'action' => 'set-rules',
                'description' => 'Set channel rules',
                'category' => 'communication-admin'
            ],
            [
                'id' => 'view-activity-log',
                'phrases' => $getPhrases('view-activity-log'),
                'action' => 'view-activity-log',
                'description' => 'View activity log',
                'category' => 'communication-admin'
            ],
            [
                'id' => 'view-analytics',
                'phrases' => $getPhrases('view-analytics'),
                'action' => 'view-analytics',
                'description' => 'View communication analytics',
                'category' => 'communication-admin'
            ],

            // ============================================
            // COMMUNICATION: COMMON FEATURES
            // ============================================
            [
                'id' => 'sync-devices',
                'phrases' => $getPhrases('sync-devices'),
                'action' => 'sync-devices',
                'description' => 'Sync across devices',
                'category' => 'communication-common'
            ],
            [
                'id' => 'view-chat-history',
                'phrases' => $getPhrases('view-chat-history'),
                'action' => 'view-chat-history',
                'description' => 'View chat history',
                'category' => 'communication-common'
            ],

            // ============================================
            // DEVELOPMENT: PROJECT & CODE MANAGEMENT
            // ============================================
            [
                'id' => 'create-project',
                'phrases' => $getPhrases('create-project'),
                'action' => 'create-project',
                'description' => 'Create new project',
                'category' => 'development-project'
            ],
            [
                'id' => 'upload-code',
                'phrases' => $getPhrases('upload-code'),
                'action' => 'upload-code',
                'description' => 'Upload source code',
                'category' => 'development-project'
            ],
            [
                'id' => 'edit-file',
                'phrases' => $getPhrases('edit-file'),
                'action' => 'edit-file',
                'description' => 'Edit file',
                'category' => 'development-project'
            ],
            [
                'id' => 'view-version-history',
                'phrases' => $getPhrases('view-version-history'),
                'action' => 'view-version-history',
                'description' => 'View version history',
                'category' => 'development-project'
            ],
            [
                'id' => 'compare-versions',
                'phrases' => $getPhrases('compare-versions'),
                'action' => 'compare-versions',
                'description' => 'Compare versions',
                'category' => 'development-project'
            ],
            [
                'id' => 'create-branch',
                'phrases' => $getPhrases('create-branch'),
                'action' => 'create-branch',
                'description' => 'Create branch',
                'category' => 'development-project'
            ],
            [
                'id' => 'view-commit-history',
                'phrases' => $getPhrases('view-commit-history'),
                'action' => 'view-commit-history',
                'description' => 'View commit history',
                'category' => 'development-project'
            ],

            // ============================================
            // DEVELOPMENT: TEAM COLLABORATION
            // ============================================
            [
                'id' => 'create-pull-request',
                'phrases' => $getPhrases('create-pull-request'),
                'action' => 'create-pull-request',
                'description' => 'Create pull request',
                'category' => 'development-collaboration'
            ],
            [
                'id' => 'review-code',
                'phrases' => $getPhrases('review-code'),
                'action' => 'review-code',
                'description' => 'Review code',
                'category' => 'development-collaboration'
            ],
            [
                'id' => 'comment-code',
                'phrases' => $getPhrases('comment-code'),
                'action' => 'comment-code',
                'description' => 'Comment on code',
                'category' => 'development-collaboration'
            ],
            [
                'id' => 'resolve-conflict',
                'phrases' => $getPhrases('resolve-conflict'),
                'action' => 'resolve-conflict',
                'description' => 'Resolve merge conflict',
                'category' => 'development-collaboration'
            ],
            [
                'id' => 'view-issues',
                'phrases' => $getPhrases('view-issues'),
                'action' => 'view-issues',
                'description' => 'View issues',
                'category' => 'development-collaboration'
            ],
            [
                'id' => 'create-issue',
                'phrases' => $getPhrases('create-issue'),
                'action' => 'create-issue',
                'description' => 'Create issue',
                'category' => 'development-collaboration'
            ],
            [
                'id' => 'manage-team',
                'phrases' => $getPhrases('manage-team'),
                'action' => 'manage-team',
                'description' => 'Manage team members',
                'category' => 'development-collaboration'
            ],

            // ============================================
            // DEVELOPMENT: PUBLISHING & DEPLOY
            // ============================================
            [
                'id' => 'deploy-app',
                'phrases' => $getPhrases('deploy-app'),
                'action' => 'deploy-app',
                'description' => 'Deploy application',
                'category' => 'development-deploy'
            ],
            [
                'id' => 'select-environment',
                'phrases' => $getPhrases('select-environment'),
                'action' => 'select-environment',
                'description' => 'Select deployment environment',
                'category' => 'development-deploy'
            ],
            [
                'id' => 'set-custom-domain',
                'phrases' => $getPhrases('set-custom-domain'),
                'action' => 'set-custom-domain',
                'description' => 'Set custom domain',
                'category' => 'development-deploy'
            ],
            [
                'id' => 'view-build-logs',
                'phrases' => $getPhrases('view-build-logs'),
                'action' => 'view-build-logs',
                'description' => 'View build logs',
                'category' => 'development-deploy'
            ],
            [
                'id' => 'restart-build',
                'phrases' => $getPhrases('restart-build'),
                'action' => 'restart-build',
                'description' => 'Restart build',
                'category' => 'development-deploy'
            ],
            [
                'id' => 'rollback-deployment',
                'phrases' => $getPhrases('rollback-deployment'),
                'action' => 'rollback-deployment',
                'description' => 'Rollback deployment',
                'category' => 'development-deploy'
            ],
            [
                'id' => 'enable-ssl',
                'phrases' => $getPhrases('enable-ssl'),
                'action' => 'enable-ssl',
                'description' => 'Enable SSL/HTTPS',
                'category' => 'development-deploy'
            ],

            // ============================================
            // DEVELOPMENT: TECHNICAL INTEGRATIONS
            // ============================================
            [
                'id' => 'connect-database',
                'phrases' => $getPhrases('connect-database'),
                'action' => 'connect-database',
                'description' => 'Connect database',
                'category' => 'development-integration'
            ],
            [
                'id' => 'connect-api',
                'phrases' => $getPhrases('connect-api'),
                'action' => 'connect-api',
                'description' => 'Connect external API',
                'category' => 'development-integration'
            ],
            [
                'id' => 'set-environment-variables',
                'phrases' => $getPhrases('set-environment-variables'),
                'action' => 'set-environment-variables',
                'description' => 'Set environment variables',
                'category' => 'development-integration'
            ],
            [
                'id' => 'test-api',
                'phrases' => $getPhrases('test-api'),
                'action' => 'test-api',
                'description' => 'Test API endpoint',
                'category' => 'development-integration'
            ],
            [
                'id' => 'create-automation-script',
                'phrases' => $getPhrases('create-automation-script'),
                'action' => 'create-automation-script',
                'description' => 'Create automation script',
                'category' => 'development-integration'
            ],

            // ============================================
            // DEVELOPMENT: VERSION CONTROL
            // ============================================
            [
                'id' => 'revert-changes',
                'phrases' => $getPhrases('revert-changes'),
                'action' => 'revert-changes',
                'description' => 'Revert to previous version',
                'category' => 'development-version'
            ],
            [
                'id' => 'view-contributions',
                'phrases' => $getPhrases('view-contributions'),
                'action' => 'view-contributions',
                'description' => 'View user contributions',
                'category' => 'development-version'
            ],
            [
                'id' => 'merge-branch',
                'phrases' => $getPhrases('merge-branch'),
                'action' => 'merge-branch',
                'description' => 'Merge branch',
                'category' => 'development-version'
            ],

            // ============================================
            // DEVELOPMENT: TESTING & MONITORING
            // ============================================
            [
                'id' => 'run-tests',
                'phrases' => $getPhrases('run-tests'),
                'action' => 'run-tests',
                'description' => 'Run automated tests',
                'category' => 'development-testing'
            ],
            [
                'id' => 'view-test-results',
                'phrases' => $getPhrases('view-test-results'),
                'action' => 'view-test-results',
                'description' => 'View test results',
                'category' => 'development-testing'
            ],
            [
                'id' => 'setup-cicd',
                'phrases' => $getPhrases('setup-cicd'),
                'action' => 'setup-cicd',
                'description' => 'Setup CI/CD pipeline',
                'category' => 'development-testing'
            ],
            [
                'id' => 'monitor-performance',
                'phrases' => $getPhrases('monitor-performance'),
                'action' => 'monitor-performance',
                'description' => 'Monitor application performance',
                'category' => 'development-testing'
            ],
            [
                'id' => 'view-logs',
                'phrases' => $getPhrases('view-logs'),
                'action' => 'view-logs',
                'description' => 'View system logs',
                'category' => 'development-testing'
            ],

            // ============================================
            // DEVELOPMENT: SECURITY & ACCESS
            // ============================================
            [
                'id' => 'set-ssh-key',
                'phrases' => $getPhrases('set-ssh-key'),
                'action' => 'set-ssh-key',
                'description' => 'Set SSH key',
                'category' => 'development-security'
            ],
            [
                'id' => 'manage-permissions',
                'phrases' => $getPhrases('manage-permissions'),
                'action' => 'manage-permissions',
                'description' => 'Manage user permissions',
                'category' => 'development-security'
            ],
            [
                'id' => 'set-project-visibility',
                'phrases' => $getPhrases('set-project-visibility'),
                'action' => 'set-project-visibility',
                'description' => 'Set project visibility',
                'category' => 'development-security'
            ],
            [
                'id' => 'enable-2fa',
                'phrases' => $getPhrases('enable-2fa'),
                'action' => 'enable-2fa',
                'description' => 'Enable two-factor authentication',
                'category' => 'development-security'
            ],
            [
                'id' => 'view-audit-log',
                'phrases' => $getPhrases('view-audit-log'),
                'action' => 'view-audit-log',
                'description' => 'View audit log',
                'category' => 'development-security'
            ],

            // ============================================
            // DEVELOPMENT: PACKAGE MANAGEMENT
            // ============================================
            [
                'id' => 'install-package',
                'phrases' => $getPhrases('install-package'),
                'action' => 'install-package',
                'description' => 'Install package',
                'category' => 'development-package'
            ],
            [
                'id' => 'update-packages',
                'phrases' => $getPhrases('update-packages'),
                'action' => 'update-packages',
                'description' => 'Update packages',
                'category' => 'development-package'
            ],
            [
                'id' => 'resolve-dependencies',
                'phrases' => $getPhrases('resolve-dependencies'),
                'action' => 'resolve-dependencies',
                'description' => 'Resolve dependency conflicts',
                'category' => 'development-package'
            ],
            [
                'id' => 'run-build-script',
                'phrases' => $getPhrases('run-build-script'),
                'action' => 'run-build-script',
                'description' => 'Run build script',
                'category' => 'development-package'
            ],

            // ============================================
            // DEVELOPMENT: ENVIRONMENT CUSTOMIZATION
            // ============================================
            [
                'id' => 'configure-project',
                'phrases' => $getPhrases('configure-project'),
                'action' => 'configure-project',
                'description' => 'Configure project settings',
                'category' => 'development-environment'
            ],
            [
                'id' => 'setup-local-environment',
                'phrases' => $getPhrases('setup-local-environment'),
                'action' => 'setup-local-environment',
                'description' => 'Setup local development environment',
                'category' => 'development-environment'
            ],
            [
                'id' => 'sync-repository',
                'phrases' => $getPhrases('sync-repository'),
                'action' => 'sync-repository',
                'description' => 'Sync with cloud repository',
                'category' => 'development-environment'
            ],
            [
                'id' => 'create-documentation',
                'phrases' => $getPhrases('create-documentation'),
                'action' => 'create-documentation',
                'description' => 'Create project documentation',
                'category' => 'development-environment'
            ],

            // ============================================
            // DEVELOPMENT: ADMIN ACTIONS
            // ============================================
            [
                'id' => 'delete-project',
                'phrases' => $getPhrases('delete-project'),
                'action' => 'delete-project',
                'description' => 'Delete project',
                'category' => 'development-admin'
            ],
            [
                'id' => 'set-branch-protection',
                'phrases' => $getPhrases('set-branch-protection'),
                'action' => 'set-branch-protection',
                'description' => 'Set branch protection rules',
                'category' => 'development-admin'
            ],
            [
                'id' => 'view-team-activity',
                'phrases' => $getPhrases('view-team-activity'),
                'action' => 'view-team-activity',
                'description' => 'View team activity',
                'category' => 'development-admin'
            ],
            [
                'id' => 'configure-integrations',
                'phrases' => $getPhrases('configure-integrations'),
                'action' => 'configure-integrations',
                'description' => 'Configure external integrations',
                'category' => 'development-admin'
            ],
            [
                'id' => 'view-statistics',
                'phrases' => $getPhrases('view-statistics'),
                'action' => 'view-statistics',
                'description' => 'View project statistics',
                'category' => 'development-admin'
            ],

            // ============================================
            // DEVELOPMENT: COMMON FEATURES
            // ============================================
            [
                'id' => 'view-project-history',
                'phrases' => $getPhrases('view-project-history'),
                'action' => 'view-project-history',
                'description' => 'View project development history',
                'category' => 'development-common'
            ],

            // ============================================
            // AI PLATFORMS: INTERACTION & CONTENT CREATION
            // ============================================
            [
                'id' => 'chat-with-ai',
                'phrases' => $getPhrases('chat-with-ai'),
                'action' => 'chat-with-ai',
                'description' => 'Start chat conversation with AI',
                'category' => 'ai-interaction'
            ],
            [
                'id' => 'ask-question',
                'phrases' => $getPhrases('ask-question'),
                'action' => 'ask-question',
                'description' => 'Ask question to AI',
                'category' => 'ai-interaction'
            ],
            [
                'id' => 'create-content',
                'phrases' => $getPhrases('create-content'),
                'action' => 'create-content',
                'description' => 'Create content (article, essay, email, etc.)',
                'category' => 'ai-interaction'
            ],
            [
                'id' => 'translate-text',
                'phrases' => $getPhrases('translate-text'),
                'action' => 'translate-text',
                'description' => 'Translate text to different language',
                'category' => 'ai-interaction'
            ],
            [
                'id' => 'summarize-document',
                'phrases' => $getPhrases('summarize-document'),
                'action' => 'summarize-document',
                'description' => 'Summarize long document',
                'category' => 'ai-interaction'
            ],
            [
                'id' => 'correct-grammar',
                'phrases' => $getPhrases('correct-grammar'),
                'action' => 'correct-grammar',
                'description' => 'Correct grammar and spelling errors',
                'category' => 'ai-interaction'
            ],
            [
                'id' => 'generate-ideas',
                'phrases' => $getPhrases('generate-ideas'),
                'action' => 'generate-ideas',
                'description' => 'Generate ideas and suggestions',
                'category' => 'ai-interaction'
            ],
            [
                'id' => 'generate-code',
                'phrases' => $getPhrases('generate-code'),
                'action' => 'generate-code',
                'description' => 'Generate code in programming language',
                'category' => 'ai-interaction'
            ],
            [
                'id' => 'optimize-code',
                'phrases' => $getPhrases('optimize-code'),
                'action' => 'optimize-code',
                'description' => 'Optimize existing code',
                'category' => 'ai-interaction'
            ],
            [
                'id' => 'convert-code',
                'phrases' => $getPhrases('convert-code'),
                'action' => 'convert-code',
                'description' => 'Convert code between programming languages',
                'category' => 'ai-interaction'
            ],

            // ============================================
            // AI PLATFORMS: MULTIMODAL GENERATION
            // ============================================
            [
                'id' => 'generate-image',
                'phrases' => $getPhrases('generate-image'),
                'action' => 'generate-image',
                'description' => 'Generate image from text description',
                'category' => 'ai-multimodal'
            ],
            [
                'id' => 'edit-image',
                'phrases' => $getPhrases('edit-image'),
                'action' => 'edit-image',
                'description' => 'Edit existing image',
                'category' => 'ai-multimodal'
            ],
            [
                'id' => 'remove-background',
                'phrases' => $getPhrases('remove-background'),
                'action' => 'remove-background',
                'description' => 'Remove background from image',
                'category' => 'ai-multimodal'
            ],
            [
                'id' => 'generate-video',
                'phrases' => $getPhrases('generate-video'),
                'action' => 'generate-video',
                'description' => 'Generate video from text',
                'category' => 'ai-multimodal'
            ],
            [
                'id' => 'text-to-speech',
                'phrases' => $getPhrases('text-to-speech'),
                'action' => 'text-to-speech',
                'description' => 'Convert text to speech',
                'category' => 'ai-multimodal'
            ],
            [
                'id' => 'speech-to-text',
                'phrases' => $getPhrases('speech-to-text'),
                'action' => 'speech-to-text',
                'description' => 'Convert speech to text',
                'category' => 'ai-multimodal'
            ],
            [
                'id' => 'generate-music',
                'phrases' => $getPhrases('generate-music'),
                'action' => 'generate-music',
                'description' => 'Generate music with AI',
                'category' => 'ai-multimodal'
            ],
            [
                'id' => 'create-design',
                'phrases' => $getPhrases('create-design'),
                'action' => 'create-design',
                'description' => 'Create graphic design, logo, or presentation',
                'category' => 'ai-multimodal'
            ],

            // ============================================
            // AI PLATFORMS: PERSONALIZATION & TRAINING
            // ============================================
            [
                'id' => 'create-assistant',
                'phrases' => $getPhrases('create-assistant'),
                'action' => 'create-assistant',
                'description' => 'Create custom AI assistant',
                'category' => 'ai-personalization'
            ],
            [
                'id' => 'save-conversation',
                'phrases' => $getPhrases('save-conversation'),
                'action' => 'save-conversation',
                'description' => 'Save conversation history',
                'category' => 'ai-personalization'
            ],
            [
                'id' => 'set-tone',
                'phrases' => $getPhrases('set-tone'),
                'action' => 'set-tone',
                'description' => 'Set communication tone and style',
                'category' => 'ai-personalization'
            ],
            [
                'id' => 'train-model',
                'phrases' => $getPhrases('train-model'),
                'action' => 'train-model',
                'description' => 'Train custom AI model with dataset',
                'category' => 'ai-personalization'
            ],
            [
                'id' => 'use-advanced-prompt',
                'phrases' => $getPhrases('use-advanced-prompt'),
                'action' => 'use-advanced-prompt',
                'description' => 'Use advanced prompt for better results',
                'category' => 'ai-personalization'
            ],
            [
                'id' => 'access-api',
                'phrases' => $getPhrases('access-api'),
                'action' => 'access-api',
                'description' => 'Access AI API for application development',
                'category' => 'ai-personalization'
            ],

            // ============================================
            // AI PLATFORMS: INTEGRATION & COLLABORATION
            // ============================================
            [
                'id' => 'connect-app',
                'phrases' => $getPhrases('connect-app'),
                'action' => 'connect-app',
                'description' => 'Connect AI with other applications',
                'category' => 'ai-integration'
            ],
            [
                'id' => 'install-plugin',
                'phrases' => $getPhrases('install-plugin'),
                'action' => 'install-plugin',
                'description' => 'Install plugin for additional features',
                'category' => 'ai-integration'
            ],
            [
                'id' => 'import-document',
                'phrases' => $getPhrases('import-document'),
                'action' => 'import-document',
                'description' => 'Import and analyze document (PDF, Excel, CSV, etc.)',
                'category' => 'ai-integration'
            ],
            [
                'id' => 'create-automation',
                'phrases' => $getPhrases('create-automation'),
                'action' => 'create-automation',
                'description' => 'Create automation workflow',
                'category' => 'ai-integration'
            ],
            [
                'id' => 'connect-database',
                'phrases' => $getPhrases('connect-database'),
                'action' => 'connect-database',
                'description' => 'Connect AI with database for queries',
                'category' => 'ai-integration'
            ],

            // ============================================
            // AI PLATFORMS: DATA ANALYSIS & UNDERSTANDING
            // ============================================
            [
                'id' => 'analyze-data',
                'phrases' => $getPhrases('analyze-data'),
                'action' => 'analyze-data',
                'description' => 'Analyze data (Excel, CSV, JSON, etc.)',
                'category' => 'ai-analysis'
            ],
            [
                'id' => 'create-chart',
                'phrases' => $getPhrases('create-chart'),
                'action' => 'create-chart',
                'description' => 'Create charts and visualizations',
                'category' => 'ai-analysis'
            ],
            [
                'id' => 'find-trends',
                'phrases' => $getPhrases('find-trends'),
                'action' => 'find-trends',
                'description' => 'Find trends and insights from data',
                'category' => 'ai-analysis'
            ],
            [
                'id' => 'analyze-sentiment',
                'phrases' => $getPhrases('analyze-sentiment'),
                'action' => 'analyze-sentiment',
                'description' => 'Analyze sentiment of text',
                'category' => 'ai-analysis'
            ],
            [
                'id' => 'categorize-text',
                'phrases' => $getPhrases('categorize-text'),
                'action' => 'categorize-text',
                'description' => 'Categorize and classify text',
                'category' => 'ai-analysis'
            ],
            [
                'id' => 'classify-image',
                'phrases' => $getPhrases('classify-image'),
                'action' => 'classify-image',
                'description' => 'Classify and categorize images',
                'category' => 'ai-analysis'
            ],
            [
                'id' => 'generate-report',
                'phrases' => $getPhrases('generate-report'),
                'action' => 'generate-report',
                'description' => 'Generate automated report from data',
                'category' => 'ai-analysis'
            ],

            // ============================================
            // AI PLATFORMS: SECURITY & ACCOUNT MANAGEMENT
            // ============================================
            [
                'id' => 'manage-account',
                'phrases' => $getPhrases('manage-account'),
                'action' => 'manage-account',
                'description' => 'Manage account and access settings',
                'category' => 'ai-security'
            ],
            [
                'id' => 'view-history',
                'phrases' => $getPhrases('view-history'),
                'action' => 'view-history',
                'description' => 'View conversation history',
                'category' => 'ai-security'
            ],
            [
                'id' => 'delete-history',
                'phrases' => $getPhrases('delete-history'),
                'action' => 'delete-history',
                'description' => 'Delete conversation history',
                'category' => 'ai-security'
            ],
            [
                'id' => 'set-privacy',
                'phrases' => $getPhrases('set-privacy'),
                'action' => 'set-privacy',
                'description' => 'Set data privacy settings',
                'category' => 'ai-security'
            ],
            [
                'id' => 'manage-api-keys',
                'phrases' => $getPhrases('manage-api-keys'),
                'action' => 'manage-api-keys',
                'description' => 'Manage API keys and usage limits',
                'category' => 'ai-security'
            ],
            [
                'id' => 'enable-2fa',
                'phrases' => $getPhrases('enable-2fa'),
                'action' => 'enable-2fa',
                'description' => 'Enable two-factor authentication',
                'category' => 'ai-security'
            ],

            // ============================================
            // AI PLATFORMS: PAYMENT & SUBSCRIPTION
            // ============================================
            [
                'id' => 'upgrade-plan',
                'phrases' => $getPhrases('upgrade-plan'),
                'action' => 'upgrade-plan',
                'description' => 'Upgrade to premium plan',
                'category' => 'ai-payment'
            ],
            [
                'id' => 'view-usage',
                'phrases' => $getPhrases('view-usage'),
                'action' => 'view-usage',
                'description' => 'View API usage and consumption',
                'category' => 'ai-payment'
            ],
            [
                'id' => 'monitor-costs',
                'phrases' => $getPhrases('monitor-costs'),
                'action' => 'monitor-costs',
                'description' => 'Monitor monthly costs and spending',
                'category' => 'ai-payment'
            ],
            [
                'id' => 'view-billing',
                'phrases' => $getPhrases('view-billing'),
                'action' => 'view-billing',
                'description' => 'View billing and invoices',
                'category' => 'ai-payment'
            ],

            // ============================================
            // AI PLATFORMS: DEVELOPMENT & TESTING
            // ============================================
            [
                'id' => 'test-model',
                'phrases' => $getPhrases('test-model'),
                'action' => 'test-model',
                'description' => 'Test different AI models in sandbox',
                'category' => 'ai-development'
            ],
            [
                'id' => 'build-app',
                'phrases' => $getPhrases('build-app'),
                'action' => 'build-app',
                'description' => 'Build application with AI API',
                'category' => 'ai-development'
            ],
            [
                'id' => 'publish-model',
                'phrases' => $getPhrases('publish-model'),
                'action' => 'publish-model',
                'description' => 'Publish or share model on platform',
                'category' => 'ai-development'
            ],
            [
                'id' => 'integrate-models',
                'phrases' => $getPhrases('integrate-models'),
                'action' => 'integrate-models',
                'description' => 'Integrate multiple AI models',
                'category' => 'ai-development'
            ],
            [
                'id' => 'debug-response',
                'phrases' => $getPhrases('debug-response'),
                'action' => 'debug-response',
                'description' => 'Debug AI responses and outputs',
                'category' => 'ai-development'
            ],
            [
                'id' => 'implement-ai',
                'phrases' => $getPhrases('implement-ai'),
                'action' => 'implement-ai',
                'description' => 'Implement AI in web, mobile, or desktop app',
                'category' => 'ai-development'
            ],

            // ============================================
            // AI PLATFORMS: ANALYTICS & MONITORING
            // ============================================
            [
                'id' => 'view-usage-report',
                'phrases' => $getPhrases('view-usage-report'),
                'action' => 'view-usage-report',
                'description' => 'View model usage reports',
                'category' => 'ai-analytics'
            ],
            [
                'id' => 'analyze-quality',
                'phrases' => $getPhrases('analyze-quality'),
                'action' => 'analyze-quality',
                'description' => 'Analyze quality of AI responses',
                'category' => 'ai-analytics'
            ],
            [
                'id' => 'view-api-consumption',
                'phrases' => $getPhrases('view-api-consumption'),
                'action' => 'view-api-consumption',
                'description' => 'View API consumption statistics',
                'category' => 'ai-analytics'
            ],
            [
                'id' => 'view-logs',
                'phrases' => $getPhrases('view-logs'),
                'action' => 'view-logs',
                'description' => 'View logs for debugging and monitoring',
                'category' => 'ai-analytics'
            ],

            // ============================================
            // AI PLATFORMS: LEARNING & EXPLORATION
            // ============================================
            [
                'id' => 'view-documentation',
                'phrases' => $getPhrases('view-documentation'),
                'action' => 'view-documentation',
                'description' => 'View AI and API documentation',
                'category' => 'ai-learning'
            ],
            [
                'id' => 'test-feature',
                'phrases' => $getPhrases('test-feature'),
                'action' => 'test-feature',
                'description' => 'Test new experimental features',
                'category' => 'ai-learning'
            ],
            [
                'id' => 'open-playground',
                'phrases' => $getPhrases('open-playground'),
                'action' => 'open-playground',
                'description' => 'Open AI playground for experimentation',
                'category' => 'ai-learning'
            ],
            [
                'id' => 'explore-models',
                'phrases' => $getPhrases('explore-models'),
                'action' => 'explore-models',
                'description' => 'Explore new models in public hub',
                'category' => 'ai-learning'
            ],

            // ============================================
            // STARGATE.CI - PLATFORM SPECIFIC COMMANDS
            // ============================================
            
            // Navigation Commands
            [
                'id' => 'navigate-home',
                'phrases' => $getPhrases('navigate-home'),
                'action' => 'navigate-home',
                'description' => 'Navigate to home page',
                'category' => 'stargate-navigation'
            ],
            [
                'id' => 'navigate-about',
                'phrases' => $getPhrases('navigate-about'),
                'action' => 'navigate-about',
                'description' => 'Navigate to about page',
                'category' => 'stargate-navigation'
            ],
            [
                'id' => 'navigate-events',
                'phrases' => $getPhrases('navigate-events'),
                'action' => 'navigate-events',
                'description' => 'Navigate to events page',
                'category' => 'stargate-navigation'
            ],
            [
                'id' => 'navigate-news',
                'phrases' => $getPhrases('navigate-news'),
                'action' => 'navigate-news',
                'description' => 'Navigate to news page',
                'category' => 'stargate-navigation'
            ],
            [
                'id' => 'navigate-faq',
                'phrases' => $getPhrases('navigate-faq'),
                'action' => 'navigate-faq',
                'description' => 'Navigate to FAQ page',
                'category' => 'stargate-navigation'
            ],
            [
                'id' => 'navigate-contact',
                'phrases' => $getPhrases('navigate-contact'),
                'action' => 'navigate-contact',
                'description' => 'Navigate to contact page',
                'category' => 'stargate-navigation'
            ],
            [
                'id' => 'navigate-subscribe',
                'phrases' => $getPhrases('navigate-subscribe'),
                'action' => 'navigate-subscribe',
                'description' => 'Navigate to subscribe page',
                'category' => 'stargate-navigation'
            ],
            [
                'id' => 'navigate-search',
                'phrases' => $getPhrases('navigate-search'),
                'action' => 'navigate-search',
                'description' => 'Navigate to search page',
                'category' => 'stargate-navigation'
            ],
            [
                'id' => 'navigate-disclaimer',
                'phrases' => $getPhrases('navigate-disclaimer'),
                'action' => 'navigate-disclaimer',
                'description' => 'Navigate to disclaimer page',
                'category' => 'stargate-navigation'
            ],
            [
                'id' => 'navigate-signin',
                'phrases' => $getPhrases('navigate-signin'),
                'action' => 'navigate-signin',
                'description' => 'Navigate to sign in page',
                'category' => 'stargate-navigation'
            ],
            [
                'id' => 'navigate-signup',
                'phrases' => $getPhrases('navigate-signup'),
                'action' => 'navigate-signup',
                'description' => 'Navigate to sign up page',
                'category' => 'stargate-navigation'
            ],

            // Scroll Commands (Enhanced)
            [
                'id' => 'scroll-to-top',
                'phrases' => $getPhrases('scroll-to-top'),
                'action' => 'scroll-to-top',
                'description' => 'Scroll to top of page',
                'category' => 'stargate-navigation'
            ],
            [
                'id' => 'scroll-to-bottom',
                'phrases' => $getPhrases('scroll-to-bottom'),
                'action' => 'scroll-to-bottom',
                'description' => 'Scroll to bottom of page',
                'category' => 'stargate-navigation'
            ],

            // Video Interactions
            [
                'id' => 'like-video',
                'phrases' => $getPhrases('like-video'),
                'action' => 'like-video',
                'description' => 'Like current video',
                'category' => 'stargate-video'
            ],
            [
                'id' => 'comment-video',
                'phrases' => $getPhrases('comment-video'),
                'action' => 'comment-video',
                'description' => 'Add comment to video',
                'category' => 'stargate-video'
            ],
            [
                'id' => 'share-video',
                'phrases' => $getPhrases('share-video'),
                'action' => 'share-video',
                'description' => 'Share current video',
                'category' => 'stargate-video'
            ],
            [
                'id' => 'play-video',
                'phrases' => $getPhrases('play-video'),
                'action' => 'play-video',
                'description' => 'Play video',
                'category' => 'stargate-video'
            ],
            [
                'id' => 'pause-video',
                'phrases' => $getPhrases('pause-video'),
                'action' => 'pause-video',
                'description' => 'Pause video',
                'category' => 'stargate-video'
            ],

            // News Interactions
            [
                'id' => 'like-article',
                'phrases' => $getPhrases('like-article'),
                'action' => 'like-article',
                'description' => 'Like current article',
                'category' => 'stargate-news'
            ],
            [
                'id' => 'read-article',
                'phrases' => $getPhrases('read-article'),
                'action' => 'read-article',
                'description' => 'Read full article',
                'category' => 'stargate-news'
            ],
            [
                'id' => 'share-article',
                'phrases' => $getPhrases('share-article'),
                'action' => 'share-article',
                'description' => 'Share current article',
                'category' => 'stargate-news'
            ],

            // Event Interactions
            [
                'id' => 'register-event',
                'phrases' => $getPhrases('register-event'),
                'action' => 'register-event',
                'description' => 'Register for event',
                'category' => 'stargate-events'
            ],
            [
                'id' => 'view-event-details',
                'phrases' => $getPhrases('view-event-details'),
                'action' => 'view-event-details',
                'description' => 'View event details',
                'category' => 'stargate-events'
            ],

            // Search Commands
            [
                'id' => 'open-search',
                'phrases' => $getPhrases('open-search'),
                'action' => 'open-search',
                'description' => 'Open search box',
                'category' => 'stargate-search'
            ],
            [
                'id' => 'clear-search',
                'phrases' => $getPhrases('clear-search'),
                'action' => 'clear-search',
                'description' => 'Clear search box',
                'category' => 'stargate-search'
            ],

            // UI Controls
            [
                'id' => 'close-modal',
                'phrases' => $getPhrases('close-modal'),
                'action' => 'close-modal',
                'description' => 'Close modal or dialog',
                'category' => 'stargate-ui'
            ],
            [
                'id' => 'open-menu',
                'phrases' => $getPhrases('open-menu'),
                'action' => 'open-menu',
                'description' => 'Open mobile menu',
                'category' => 'stargate-ui'
            ],
            [
                'id' => 'close-menu',
                'phrases' => $getPhrases('close-menu'),
                'action' => 'close-menu',
                'description' => 'Close mobile menu',
                'category' => 'stargate-ui'
            ],
            [
                'id' => 'toggle-theme',
                'phrases' => $getPhrases('toggle-theme'),
                'action' => 'toggle-theme',
                'description' => 'Toggle dark/light theme',
                'category' => 'stargate-ui'
            ],

            // Subscription
            [
                'id' => 'subscribe',
                'phrases' => $getPhrases('subscribe'),
                'action' => 'subscribe',
                'description' => 'Subscribe to updates',
                'category' => 'stargate-subscription'
            ],
            [
                'id' => 'unsubscribe',
                'phrases' => $getPhrases('unsubscribe'),
                'action' => 'unsubscribe',
                'description' => 'Unsubscribe from updates',
                'category' => 'stargate-subscription'
            ],

            // Account Management
            [
                'id' => 'logout',
                'phrases' => $getPhrases('logout'),
                'action' => 'logout',
                'description' => 'Logout from account',
                'category' => 'stargate-account'
            ],
            [
                'id' => 'view-profile',
                'phrases' => $getPhrases('view-profile'),
                'action' => 'view-profile',
                'description' => 'View user profile',
                'category' => 'stargate-account'
            ],

            // Browser Navigation
            [
                'id' => 'go-back',
                'phrases' => $getPhrases('go-back'),
                'action' => 'go-back',
                'description' => 'Go back in browser history',
                'category' => 'stargate-navigation'
            ],
            [
                'id' => 'go-forward',
                'phrases' => $getPhrases('go-forward'),
                'action' => 'go-forward',
                'description' => 'Go forward in browser history',
                'category' => 'stargate-navigation'
            ],
            [
                'id' => 'refresh-page',
                'phrases' => $getPhrases('refresh-page'),
                'action' => 'refresh-page',
                'description' => 'Refresh current page',
                'category' => 'stargate-navigation'
            ],

            // Content Actions
            [
                'id' => 'expand-content',
                'phrases' => $getPhrases('expand-content'),
                'action' => 'expand-content',
                'description' => 'Expand collapsed content',
                'category' => 'stargate-content'
            ],
            [
                'id' => 'collapse-content',
                'phrases' => $getPhrases('collapse-content'),
                'action' => 'collapse-content',
                'description' => 'Collapse expanded content',
                'category' => 'stargate-content'
            ],

            // Filter & Sort
            [
                'id' => 'filter-events',
                'phrases' => $getPhrases('filter-events'),
                'action' => 'filter-events',
                'description' => 'Filter events by category',
                'category' => 'stargate-filter'
            ],
            [
                'id' => 'sort-content',
                'phrases' => $getPhrases('sort-content'),
                'action' => 'sort-content',
                'description' => 'Sort content',
                'category' => 'stargate-filter'
            ],

            // Form Actions
            [
                'id' => 'submit-form',
                'phrases' => $getPhrases('submit-form'),
                'action' => 'submit-form',
                'description' => 'Submit current form',
                'category' => 'stargate-form'
            ],
            [
                'id' => 'clear-form',
                'phrases' => $getPhrases('clear-form'),
                'action' => 'clear-form',
                'description' => 'Clear form fields',
                'category' => 'stargate-form'
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

                // E-Commerce: Account Management
                'create-account' => ['create account', 'sign up', 'register', 'new account'],
                'update-personal-info' => ['update personal info', 'edit personal information', 'change personal info', 'update profile'],
                'save-shipping-address' => ['save shipping address', 'save address', 'add shipping address', 'save delivery address'],
                'save-payment-method' => ['save payment method', 'save card', 'add payment method', 'save credit card'],
                'view-order-history' => ['view order history', 'order history', 'my orders', 'past orders'],
                'change-password' => ['change password', 'update password', 'reset password', 'new password'],
                'manage-subscriptions' => ['manage subscriptions', 'subscriptions', 'my subscriptions'],
                'manage-notifications' => ['manage notifications', 'notification settings', 'email notifications', 'sms notifications'],

                // E-Commerce: Product Search & Discovery
                'search-products' => ['search products', 'find products', 'search', 'look for products'],
                'filter-products' => ['filter products', 'filter', 'apply filter', 'filter by price'],
                'browse-categories' => ['browse categories', 'categories', 'view categories', 'shop by category'],
                'voice-search' => ['voice search', 'search by voice', 'speak to search'],
                'image-search' => ['image search', 'search by image', 'photo search', 'visual search'],
                'compare-products' => ['compare products', 'compare', 'product comparison'],
                'view-recommendations' => ['view recommendations', 'recommendations', 'suggested products', 'products you may like'],
                'view-related-products' => ['view related products', 'related products', 'similar products', 'you may also like'],
                'add-to-wishlist' => ['add to wishlist', 'save for later', 'wishlist', 'add to favorites'],

                // E-Commerce: Order Management
                'add-to-cart' => ['add to cart', 'add to bag', 'buy now', 'add product'],
                'view-cart' => ['view cart', 'shopping cart', 'my cart', 'cart'],
                'update-quantity' => ['update quantity', 'change quantity', 'quantity', 'update amount'],
                'remove-from-cart' => ['remove from cart', 'delete from cart', 'remove item', 'remove product'],
                'apply-coupon' => ['apply coupon', 'use coupon', 'enter coupon code', 'discount code'],
                'select-shipping' => ['select shipping', 'choose shipping', 'shipping method', 'delivery method'],
                'checkout' => ['checkout', 'proceed to checkout', 'place order', 'buy'],
                'save-billing-info' => ['save billing info', 'save billing information', 'billing address'],
                'track-order' => ['track order', 'order tracking', 'track my order', 'where is my order'],
                'cancel-order' => ['cancel order', 'cancel', 'cancel purchase'],
                'print-invoice' => ['print invoice', 'download invoice', 'invoice', 'receipt'],

                // E-Commerce: Payments & Transactions
                'select-payment-method' => ['select payment method', 'choose payment', 'payment method', 'how to pay'],
                'use-loyalty-points' => ['use loyalty points', 'redeem points', 'apply points', 'use points'],
                'view-transaction-history' => ['view transaction history', 'transaction history', 'payment history', 'purchase history'],
                'request-refund' => ['request refund', 'refund', 'get refund', 'return money'],
                'apply-promo-code' => ['apply promo code', 'promo code', 'promotion code', 'discount'],
                'view-payment-methods' => ['view payment methods', 'payment methods', 'saved cards', 'my payment methods'],

                // E-Commerce: Shipping & Delivery
                'select-shipping-company' => ['select shipping company', 'choose shipping company', 'carrier', 'delivery company'],
                'set-delivery-address' => ['set delivery address', 'delivery address', 'shipping address', 'where to deliver'],
                'select-pickup-point' => ['select pickup point', 'pickup point', 'pickup location', 'collect from'],
                'track-shipment' => ['track shipment', 'track package', 'track delivery', 'where is my package'],
                'change-delivery-address' => ['change delivery address', 'update address', 'change address', 'new address'],
                'confirm-delivery' => ['confirm delivery', 'received', 'delivery confirmed', 'package received'],
                'view-shipping-notifications' => ['view shipping notifications', 'delivery updates', 'shipping updates'],

                // E-Commerce: Communication & Support
                'contact-seller' => ['contact seller', 'message seller', 'talk to seller', 'seller'],
                'open-chat' => ['open chat', 'chat', 'start chat', 'customer chat'],
                'contact-support' => ['contact support', 'customer support', 'help', 'support'],
                'report-product' => ['report product', 'report', 'flag product', 'report fake product'],
                'open-dispute' => ['open dispute', 'dispute', 'file dispute', 'complaint'],
                'rate-seller' => ['rate seller', 'review seller', 'seller rating', 'rate store'],

                // E-Commerce: Reviews & Ratings
                'rate-product' => ['rate product', 'rate', 'give rating', 'star rating'],
                'write-review' => ['write review', 'review', 'write a review', 'product review'],
                'upload-product-photo' => ['upload product photo', 'add photo', 'product photo', 'upload image'],
                'view-reviews' => ['view reviews', 'reviews', 'customer reviews', 'read reviews'],
                'filter-reviews' => ['filter reviews', 'filter by rating', 'positive reviews', 'negative reviews'],
                'report-review' => ['report review', 'flag review', 'report fake review'],
                'upload-review-video' => ['upload review video', 'video review', 'add video'],

                // E-Commerce: Loyalty & Rewards
                'view-loyalty-points' => ['view loyalty points', 'loyalty points', 'my points', 'points balance'],
                'redeem-points' => ['redeem points', 'use points', 'exchange points', 'points discount'],
                'activate-membership' => ['activate membership', 'membership', 'prime membership', 'subscribe'],
                'view-exclusive-offers' => ['view exclusive offers', 'exclusive offers', 'special offers', 'member deals'],
                'refer-friend' => ['refer friend', 'referral', 'invite friend', 'referral program'],

                // E-Commerce: Returns & Refunds
                'request-return' => ['request return', 'return product', 'return item', 'send back'],
                'track-refund' => ['track refund', 'refund status', 'where is my refund'],
                'upload-return-evidence' => ['upload return evidence', 'upload photo', 'damage photo', 'evidence'],
                'choose-replacement' => ['choose replacement', 'replacement or refund', 'exchange', 'replace product'],
                'view-return-history' => ['view return history', 'return history', 'my returns'],

                // E-Commerce: Seller Features
                'create-store' => ['create store', 'open store', 'new store', 'seller account'],
                'add-product' => ['add product', 'new product', 'list product', 'upload product'],
                'manage-orders' => ['manage orders', 'orders', 'seller orders', 'my orders'],
                'view-sales-stats' => ['view sales stats', 'sales statistics', 'sales report', 'revenue'],
                'create-promotion' => ['create promotion', 'new promotion', 'sale', 'discount'],
                'create-ad' => ['create ad', 'sponsored ad', 'advertisement', 'promote product'],
                'manage-reviews' => ['manage reviews', 'customer reviews', 'product reviews'],

                // Gaming: Account Management
                'create-gaming-account' => ['create gaming account', 'sign up for gaming', 'register gaming account', 'new gaming account'],
                'set-avatar' => ['set avatar', 'change avatar', 'update avatar', 'new avatar'],
                'change-gamertag' => ['change gamertag', 'change username', 'change gamer tag', 'update gamertag'],
                'link-platform' => ['link platform', 'connect platform', 'link steam', 'link epic', 'link xbox'],
                'view-purchase-history' => ['view purchase history', 'purchase history', 'game purchases', 'my purchases'],
                'manage-subscription' => ['manage subscription', 'gaming subscription', 'playstation plus', 'xbox game pass'],
                'view-installed-games' => ['view installed games', 'installed games', 'my games', 'games library'],
                'set-payment-method' => ['set payment method', 'payment method', 'gaming payment', 'save card'],

                // Gaming: Game Discovery & Purchase
                'search-games' => ['search games', 'find games', 'look for games', 'game search'],
                'filter-games' => ['filter games', 'filter by genre', 'filter by price', 'filter by platform'],
                'view-game-details' => ['view game details', 'game details', 'game info', 'show game'],
                'watch-trailer' => ['watch trailer', 'game trailer', 'view trailer', 'play trailer'],
                'buy-game' => ['buy game', 'purchase game', 'get game', 'buy now'],
                'pre-order-game' => ['pre-order game', 'preorder', 'pre order', 'reserve game'],
                'apply-game-coupon' => ['apply game coupon', 'use coupon', 'game coupon', 'discount code'],
                'view-game-reviews' => ['view game reviews', 'game reviews', 'read reviews', 'reviews'],

                // Gaming: Download & Installation
                'download-game' => ['download game', 'download', 'get game', 'install game'],
                'install-game' => ['install game', 'install', 'setup game', 'install now'],
                'manage-storage' => ['manage storage', 'storage management', 'free up space', 'check storage'],
                'update-game' => ['update game', 'game update', 'update', 'patch game'],
                'install-dlc' => ['install dlc', 'download dlc', 'get dlc', 'add dlc'],
                'download-beta' => ['download beta', 'beta version', 'early access', 'beta'],
                'pause-download' => ['pause download', 'pause', 'stop download', 'pause installation'],
                'resume-download' => ['resume download', 'resume', 'continue download', 'resume installation'],

                // Gaming: Gameplay & Interaction
                'launch-game' => ['launch game', 'start game', 'play game', 'open game'],
                'invite-friend' => ['invite friend', 'invite to game', 'add friend to game', 'invite player'],
                'create-party' => ['create party', 'new party', 'make party', 'start party'],
                'join-party' => ['join party', 'join', 'enter party', 'join game'],
                'open-voice-chat' => ['open voice chat', 'voice chat', 'start voice chat', 'enable voice'],
                'toggle-fullscreen' => ['toggle fullscreen', 'fullscreen', 'full screen', 'maximize'],
                'save-game' => ['save game', 'save progress', 'save', 'save state'],
                'sync-cloud-save' => ['sync cloud save', 'cloud save', 'sync save', 'upload save'],

                // Gaming: Game Library
                'view-library' => ['view library', 'game library', 'my library', 'library'],
                'filter-library' => ['filter library', 'filter games', 'sort library', 'organize library'],
                'create-collection' => ['create collection', 'new collection', 'game collection', 'make collection'],
                'view-game-stats' => ['view game stats', 'game statistics', 'playtime', 'game stats'],
                'toggle-auto-update' => ['toggle auto-update', 'auto-update', 'automatic updates', 'auto update'],
                'backup-game' => ['backup game', 'backup', 'save backup', 'create backup'],
                'uninstall-game' => ['uninstall game', 'remove game', 'delete game', 'uninstall'],

                // Gaming: Community & Social
                'add-friend' => ['add friend', 'friend request', 'add player', 'add gamer'],
                'view-friends-activity' => ['view friends activity', 'friends activity', 'what friends playing', 'friends'],
                'create-group' => ['create group', 'gaming group', 'clan', 'guild'],
                'write-game-review' => ['write game review', 'review game', 'game review', 'write review'],
                'share-screenshot' => ['share screenshot', 'screenshot', 'share image', 'post screenshot'],
                'share-gameplay-clip' => ['share gameplay clip', 'gameplay clip', 'share video', 'clip'],
                'view-leaderboard' => ['view leaderboard', 'leaderboard', 'rankings', 'top players'],
                'share-achievement' => ['share achievement', 'share trophy', 'post achievement', 'show achievement'],

                // Gaming: Achievements & Rewards
                'unlock-achievement' => ['unlock achievement', 'achievement unlocked', 'get achievement', 'earn trophy'],
                'view-achievement-progress' => ['view achievement progress', 'achievement progress', 'progress', 'achievements'],
                'compare-achievements' => ['compare achievements', 'compare with friends', 'achievement comparison'],
                'view-rewards' => ['view rewards', 'rewards', 'my rewards', 'prizes'],
                'claim-reward' => ['claim reward', 'get reward', 'collect reward', 'claim'],
                'view-xp' => ['view xp', 'experience points', 'xp', 'level'],

                // Gaming: Communication & Support
                'open-game-chat' => ['open game chat', 'game chat', 'chat', 'text chat'],
                'report-player' => ['report player', 'report', 'report user', 'flag player'],
                'report-cheater' => ['report cheater', 'report hacker', 'cheater', 'hacker'],
                'report-bug' => ['report bug', 'bug report', 'report issue', 'bug'],
                'block-player' => ['block player', 'block', 'block user', 'block gamer'],
                'mute-player' => ['mute player', 'mute', 'silence player', 'mute user'],

                // Gaming: Microtransactions & In-Game Purchases
                'buy-item' => ['buy item', 'purchase item', 'get item', 'buy'],
                'buy-skin' => ['buy skin', 'purchase skin', 'get skin', 'skin'],
                'activate-battle-pass' => ['activate battle pass', 'battle pass', 'season pass', 'activate pass'],
                'gift-game' => ['gift game', 'send game', 'gift', 'give game'],
                'view-marketplace' => ['view marketplace', 'marketplace', 'trading', 'market'],

                // Gaming: Security & Privacy
                'set-privacy-level' => ['set privacy level', 'privacy level', 'privacy settings', 'who can see'],
                'block-unknown' => ['block unknown', 'block strangers', 'private mode', 'friends only'],
                'report-fraud' => ['report fraud', 'fraud', 'scam', 'report scam'],
                'enable-steam-guard' => ['enable steam guard', 'steam guard', 'enable guard', 'two factor'],

                // Gaming: Refunds & Ownership
                'request-game-refund' => ['request game refund', 'refund game', 'get refund', 'return game'],
                'view-refund-policy' => ['view refund policy', 'refund policy', 'return policy', 'refund terms'],
                'view-licenses' => ['view licenses', 'game licenses', 'licenses', 'ownership'],
                'check-ownership' => ['check ownership', 'verify ownership', 'check license', 'ownership'],

                // Gaming: Game Experience Personalization
                'change-language' => ['change language', 'game language', 'language settings', 'set language'],
                'configure-controller' => ['configure controller', 'controller settings', 'setup controller', 'controller'],
                'set-key-bindings' => ['set key bindings', 'key bindings', 'controls', 'keyboard settings'],
                'toggle-overlay' => ['toggle overlay', 'overlay', 'in-game overlay', 'show overlay'],
                'connect-streaming' => ['connect streaming', 'streaming', 'twitch', 'youtube gaming'],
                'view-events' => ['view events', 'gaming events', 'tournaments', 'events'],

                // Gaming: Device & Platform Integration
                'sync-devices' => ['sync devices', 'sync', 'cloud sync', 'sync account'],
                'connect-vr' => ['connect vr', 'vr headset', 'virtual reality', 'oculus'],
                'enable-cross-platform' => ['enable cross-platform', 'cross-platform', 'cross play', 'multi-platform'],
                'connect-controller' => ['connect controller', 'controller', 'gamepad', 'wireless controller'],

                // Stargate.ci - Navigation
                'navigate-home' => ['go home', 'home', 'home page', 'main page', 'go to home', 'take me home'],
                'navigate-about' => ['go to about', 'about', 'about page', 'about us', 'show about', 'tell me about'],
                'navigate-events' => ['go to events', 'events', 'events page', 'show events', 'view events', 'upcoming events'],
                'navigate-news' => ['go to news', 'news', 'news page', 'show news', 'latest news', 'read news'],
                'navigate-faq' => ['go to faq', 'faq', 'faq page', 'frequently asked questions', 'show faq', 'help'],
                'navigate-contact' => ['go to contact', 'contact', 'contact page', 'contact us', 'get in touch'],
                'navigate-subscribe' => ['go to subscribe', 'subscribe', 'subscribe page', 'sign up for updates'],
                'navigate-search' => ['go to search', 'search', 'search page', 'open search', 'show search'],
                'navigate-disclaimer' => ['go to disclaimer', 'disclaimer', 'legal disclaimer', 'show disclaimer'],
                'navigate-signin' => ['go to sign in', 'sign in', 'sign in page', 'login', 'log in', 'sign in to account'],
                'navigate-signup' => ['go to sign up', 'sign up', 'sign up page', 'register', 'create account', 'new account'],
                'scroll-to-top' => ['scroll to top', 'go to top', 'top of page', 'beginning', 'top'],
                'scroll-to-bottom' => ['scroll to bottom', 'go to bottom', 'end of page', 'bottom'],

                // Stargate.ci - Video Interactions
                'like-video' => ['like this video', 'like video', 'thumbs up', 'i like this'],
                'comment-video' => ['add comment', 'comment', 'write comment', 'post comment'],
                'share-video' => ['share video', 'share this', 'share', 'share content'],
                'play-video' => ['play video', 'play', 'start video'],
                'pause-video' => ['pause video', 'pause', 'stop video', 'resume video'],

                // Stargate.ci - News Interactions
                'like-article' => ['like article', 'like this article', 'thumbs up article'],
                'read-article' => ['read article', 'open article', 'view article', 'show article'],
                'share-article' => ['share article', 'share this article'],

                // Stargate.ci - Event Interactions
                'register-event' => ['register for event', 'sign up for event', 'join event', 'register'],
                'view-event-details' => ['show event details', 'event details', 'more info', 'event info'],

                // Stargate.ci - Search
                'open-search' => ['search', 'open search', 'focus search', 'show search box'],
                'clear-search' => ['clear search', 'reset search', 'clear'],

                // Stargate.ci - UI Controls
                'close-modal' => ['close', 'close modal', 'dismiss', 'cancel'],
                'open-menu' => ['open menu', 'show menu', 'menu'],
                'close-menu' => ['close menu', 'hide menu'],
                'toggle-theme' => ['toggle theme', 'dark mode', 'light mode', 'switch theme'],

                // Stargate.ci - Subscription
                'subscribe' => ['subscribe', 'sign up', 'subscribe to updates', 'get notifications'],
                'unsubscribe' => ['unsubscribe', 'stop notifications', 'cancel subscription'],

                // Stargate.ci - Account
                'logout' => ['logout', 'log out', 'sign out', 'exit account'],
                'view-profile' => ['view profile', 'my profile', 'profile', 'account'],

                // Stargate.ci - Browser Navigation
                'go-back' => ['go back', 'back', 'previous page', 'return'],
                'go-forward' => ['go forward', 'forward', 'next page'],
                'refresh-page' => ['refresh', 'reload', 'refresh page', 'reload page'],

                // Stargate.ci - Content Actions
                'expand-content' => ['expand', 'show more', 'read more', 'see more'],
                'collapse-content' => ['collapse', 'show less', 'hide', 'minimize'],

                // Stargate.ci - Filter & Sort
                'filter-events' => ['filter events', 'show filters', 'filter by category'],
                'sort-content' => ['sort by date', 'sort by popularity', 'sort by name'],

                // Stargate.ci - Form Actions
                'submit-form' => ['submit', 'send', 'submit form', 'send form'],
                'clear-form' => ['clear form', 'reset form', 'clear all'],

                // Basic
                'click' => ['click', 'tap', 'press', 'select'],

                // Operating Systems
                'open-app' => ['open app', 'open application', 'launch app', 'start app'],
                'close-app' => ['close app', 'close application', 'exit app', 'quit app'],
                'minimize-window' => ['minimize window', 'minimize', 'minimize app'],
                'maximize-window' => ['maximize window', 'maximize', 'fullscreen window'],
                'save-file' => ['save file', 'save', 'save document'],
                'open-file' => ['open file', 'open', 'open document'],
                'create-folder' => ['create folder', 'new folder', 'make folder'],
                'delete-file' => ['delete file', 'delete', 'remove file'],
                'open-settings' => ['open settings', 'settings', 'system settings'],
                'install-software' => ['install software', 'install app', 'install program'],
                'uninstall-software' => ['uninstall software', 'uninstall app', 'remove software'],
                'update-system' => ['update system', 'system update', 'check for updates'],
                'connect-wifi' => ['connect wifi', 'connect to wifi', 'wifi', 'connect network'],
                'open-terminal' => ['open terminal', 'terminal', 'command prompt', 'cmd'],
                'change-wallpaper' => ['change wallpaper', 'wallpaper', 'background', 'desktop background'],
                'create-user' => ['create user', 'new user', 'add user account'],
                'backup-data' => ['backup data', 'backup', 'create backup'],
                'restore-data' => ['restore data', 'restore', 'restore backup'],
                'view-system-info' => ['view system info', 'system info', 'system information'],
                'monitor-performance' => ['monitor performance', 'system performance', 'cpu usage', 'ram usage'],

                // Mobile Platforms
                'install-app' => ['install app', 'download app', 'get app'],
                'uninstall-app' => ['uninstall app', 'remove app', 'delete app'],
                'open-camera' => ['open camera', 'camera', 'take photo'],
                'take-photo' => ['take photo', 'photo', 'capture photo', 'snap photo'],
                'record-video' => ['record video', 'video', 'record', 'start recording'],
                'open-contacts' => ['open contacts', 'contacts', 'phonebook'],
                'make-call' => ['make call', 'call', 'phone call', 'dial'],
                'send-sms' => ['send sms', 'text message', 'send message', 'sms'],
                'sync-cloud' => ['sync cloud', 'cloud sync', 'sync', 'synchronize'],
                'enable-backup' => ['enable backup', 'automatic backup', 'backup on'],
                'connect-device' => ['connect device', 'pair device', 'bluetooth'],
                'enable-face-id' => ['enable face id', 'face id', 'face unlock'],
                'enable-touch-id' => ['enable touch id', 'touch id', 'fingerprint'],
                'manage-permissions' => ['manage permissions', 'app permissions', 'permissions'],
                'find-device' => ['find device', 'find my device', 'locate device'],
                'change-ringtone' => ['change ringtone', 'ringtone', 'phone ringtone'],
                'enable-location' => ['enable location', 'location services', 'gps'],

                // Cloud Platforms
                'create-server' => ['create server', 'new server', 'virtual server', 'ec2'],
                'create-database' => ['create database', 'new database', 'database'],
                'upload-file' => ['upload file', 'upload', 'upload to cloud'],
                'download-file' => ['download file', 'download', 'download from cloud'],
                'deploy-app' => ['deploy app', 'deploy', 'deploy application'],
                'monitor-traffic' => ['monitor traffic', 'traffic', 'network traffic'],
                'set-permissions' => ['set permissions', 'permissions', 'user permissions'],
                'enable-encryption' => ['enable encryption', 'encryption', 'encrypt data'],
                'create-backup' => ['create backup', 'backup', 'cloud backup'],
                'restore-backup' => ['restore backup', 'restore', 'restore from backup'],
                'scale-resources' => ['scale resources', 'scale up', 'scale down', 'auto scale'],
                'view-logs' => ['view logs', 'logs', 'application logs'],

                // Developer Platforms
                'create-repository' => ['create repository', 'new repo', 'create repo'],
                'clone-repository' => ['clone repository', 'clone repo', 'git clone'],
                'commit-changes' => ['commit changes', 'commit', 'git commit'],
                'push-changes' => ['push changes', 'push', 'git push'],
                'pull-changes' => ['pull changes', 'pull', 'git pull'],
                'create-branch' => ['create branch', 'new branch', 'git branch'],
                'merge-branch' => ['merge branch', 'merge', 'git merge'],
                'create-pull-request' => ['create pull request', 'pull request', 'pr', 'create pr'],
                'deploy-site' => ['deploy site', 'deploy', 'publish site'],
                'view-commits' => ['view commits', 'commits', 'commit history'],
                'view-issues' => ['view issues', 'issues', 'bug tracker'],
                'create-issue' => ['create issue', 'new issue', 'report bug'],
                'invite-collaborator' => ['invite collaborator', 'add collaborator', 'invite team'],

                // Common Technical Features
                'connect-internet' => ['connect internet', 'internet', 'connect network'],
                'create-account' => ['create account', 'sign up', 'register', 'new account'],
                'change-language' => ['change language', 'language', 'set language'],
                'open-browser' => ['open browser', 'browser', 'web browser'],
                'enable-security' => ['enable security', 'security', 'security features'],
                'enable-auto-update' => ['enable auto update', 'auto update', 'automatic updates'],
                'connect-external-device' => ['connect external device', 'external device', 'usb', 'printer'],
                'optimize-system' => ['optimize system', 'optimize', 'system optimization'],

                // Education: Student Actions
                'watch-lecture' => ['watch lecture', 'play lecture', 'view lecture', 'lecture video'],
                'download-materials' => ['download materials', 'download course materials', 'get materials', 'download pdf'],
                'read-chapter' => ['read chapter', 'open chapter', 'view module', 'read module'],
                'enroll-course' => ['enroll course', 'join course', 'register course', 'enroll'],
                'resume-course' => ['resume course', 'continue course', 'resume learning', 'continue learning'],
                'view-course-info' => ['view course info', 'course information', 'course details', 'course description'],
                'take-quiz' => ['take quiz', 'start quiz', 'begin test', 'take test'],
                'submit-assignment' => ['submit assignment', 'upload assignment', 'hand in assignment', 'submit work'],
                'view-grades' => ['view grades', 'check grades', 'my grades', 'view scores'],
                'contact-instructor' => ['contact instructor', 'message instructor', 'email instructor', 'talk to teacher'],
                'ask-question' => ['ask question', 'post question', 'ask in forum', 'ask'],
                'join-discussion' => ['join discussion', 'discussion board', 'forum', 'join forum'],
                'download-certificate' => ['download certificate', 'get certificate', 'certificate', 'course certificate'],
                'view-portfolio' => ['view portfolio', 'my portfolio', 'learning portfolio', 'course portfolio'],
                'view-progress' => ['view progress', 'my progress', 'learning progress', 'course progress'],

                // Education: Instructor Actions
                'create-course' => ['create course', 'new course', 'make course', 'build course'],
                'upload-content' => ['upload content', 'add content', 'upload materials', 'add materials'],
                'set-course-price' => ['set course price', 'course price', 'set price', 'pricing'],
                'invite-students' => ['invite students', 'add students', 'invite to course', 'enroll students'],
                'view-student-progress' => ['view student progress', 'student progress', 'check progress', 'student performance'],
                'grade-assignment' => ['grade assignment', 'review assignment', 'mark assignment', 'evaluate assignment'],
                'post-announcement' => ['post announcement', 'announcement', 'class announcement', 'post message'],
                'view-analytics' => ['view analytics', 'course analytics', 'statistics', 'course stats'],
                'start-live-class' => ['start live class', 'live class', 'begin live class', 'start live session'],
                'answer-question' => ['answer question', 'reply to question', 'respond', 'answer'],

                // Education: Common Features
                'search-courses' => ['search courses', 'find courses', 'browse courses', 'look for courses'],
                'view-recommendations' => ['view recommendations', 'recommended courses', 'suggestions', 'course recommendations'],
                'view-course-history' => ['view course history', 'my courses', 'course history', 'completed courses'],
                'enable-notifications' => ['enable notifications', 'notifications', 'course notifications', 'turn on notifications'],
                'contact-support' => ['contact support', 'help', 'support', 'get help'],

                // Communication: Chat & Messaging
                'send-message' => ['send message', 'message', 'text message', 'send text'],
                'send-file' => ['send file', 'upload file', 'share file', 'send document'],
                'edit-message' => ['edit message', 'edit', 'modify message', 'change message'],
                'delete-message' => ['delete message', 'remove message', 'delete', 'remove'],
                'search-messages' => ['search messages', 'find messages', 'message history', 'search chat'],
                'mention-user' => ['mention user', 'mention', '@ mention', 'tag user'],
                'react-message' => ['react message', 'react', 'add reaction', 'emoji reaction'],
                'pin-message' => ['pin message', 'pin', 'pin to channel', 'important message'],
                'create-thread' => ['create thread', 'thread', 'reply thread', 'start thread'],

                // Communication: Calls & Video
                'start-call' => ['start call', 'call', 'voice call', 'video call'],
                'join-meeting' => ['join meeting', 'join', 'enter meeting', 'join call'],
                'toggle-camera' => ['toggle camera', 'camera', 'turn camera on', 'turn camera off'],
                'toggle-mic' => ['toggle mic', 'microphone', 'mute', 'unmute'],
                'change-background' => ['change background', 'virtual background', 'background', 'blur background'],
                'record-meeting' => ['record meeting', 'record', 'start recording', 'save meeting'],
                'share-screen' => ['share screen', 'screen share', 'share', 'present screen'],
                'raise-hand' => ['raise hand', 'hand up', 'raise', 'want to speak'],
                'mute-participant' => ['mute participant', 'mute user', 'silence user', 'mute'],

                // Communication: Groups & Channels
                'create-channel' => ['create channel', 'new channel', 'create group', 'new group'],
                'invite-member' => ['invite member', 'add member', 'invite user', 'add to channel'],
                'set-channel-info' => ['set channel info', 'channel info', 'channel description', 'edit channel'],
                'set-permissions' => ['set permissions', 'permissions', 'channel permissions', 'access control'],
                'assign-role' => ['assign role', 'role', 'set role', 'user role'],
                'leave-channel' => ['leave channel', 'leave', 'exit channel', 'leave group'],

                // Communication: Files & Documents
                'upload-file' => ['upload file', 'upload', 'add file', 'share file'],
                'view-file-versions' => ['view file versions', 'file versions', 'version history', 'file history'],
                'comment-document' => ['comment document', 'add comment', 'comment', 'annotate'],
                'search-files' => ['search files', 'find files', 'file search', 'search documents'],

                // Communication: Notifications & Settings
                'mute-channel' => ['mute channel', 'mute notifications', 'silence channel', 'disable notifications'],
                'enable-do-not-disturb' => ['enable do not disturb', 'do not disturb', 'dnd', 'quiet mode'],
                'change-theme' => ['change theme', 'theme', 'appearance', 'dark mode'],
                'set-status' => ['set status', 'status', 'update status', 'away status'],

                // Communication: Collaboration & Tasks
                'create-task' => ['create task', 'new task', 'add task', 'todo'],
                'sync-calendar' => ['sync calendar', 'calendar sync', 'connect calendar', 'link calendar'],
                'set-deadline' => ['set deadline', 'deadline', 'due date', 'set due date'],
                'open-whiteboard' => ['open whiteboard', 'whiteboard', 'drawing board', 'collaborative board'],
                'view-project-progress' => ['view project progress', 'project progress', 'progress', 'project status'],

                // Communication: Integrations
                'connect-app' => ['connect app', 'link app', 'integrate app', 'add integration'],
                'view-integrations' => ['view integrations', 'integrations', 'connected apps', 'app integrations'],
                'create-automation' => ['create automation', 'automation', 'workflow', 'bot'],

                // Communication: Security & Profile
                'update-profile' => ['update profile', 'edit profile', 'profile', 'change profile'],
                'enable-2fa' => ['enable 2fa', 'two factor authentication', '2fa', 'security'],
                'block-user' => ['block user', 'block', 'ban user', 'restrict user'],
                'view-privacy-settings' => ['view privacy settings', 'privacy settings', 'privacy', 'security settings'],

                // Communication: Admin Actions
                'delete-channel' => ['delete channel', 'remove channel', 'delete group', 'remove group'],
                'set-rules' => ['set rules', 'channel rules', 'rules', 'guidelines'],
                'view-activity-log' => ['view activity log', 'activity log', 'user activity', 'logs'],
                'view-analytics' => ['view analytics', 'analytics', 'statistics', 'usage stats'],

                // Communication: Common Features
                'sync-devices' => ['sync devices', 'sync', 'device sync', 'synchronize'],
                'view-chat-history' => ['view chat history', 'chat history', 'message history', 'conversation history'],

                // Development: Project & Code Management
                'create-project' => ['create project', 'new project', 'create repository', 'new repo'],
                'upload-code' => ['upload code', 'upload files', 'commit files', 'add files'],
                'edit-file' => ['edit file', 'edit', 'modify file', 'change file'],
                'view-version-history' => ['view version history', 'version history', 'file history', 'code history'],
                'compare-versions' => ['compare versions', 'diff', 'compare files', 'view diff'],
                'create-branch' => ['create branch', 'new branch', 'git branch', 'branch'],
                'view-commit-history' => ['view commit history', 'commit history', 'commits', 'git log'],

                // Development: Team Collaboration
                'create-pull-request' => ['create pull request', 'pull request', 'pr', 'create pr'],
                'review-code' => ['review code', 'code review', 'review', 'check code'],
                'comment-code' => ['comment code', 'add comment', 'comment', 'line comment'],
                'resolve-conflict' => ['resolve conflict', 'merge conflict', 'fix conflict', 'conflict'],
                'view-issues' => ['view issues', 'issues', 'bug tracker', 'tickets'],
                'create-issue' => ['create issue', 'new issue', 'report bug', 'issue'],
                'manage-team' => ['manage team', 'team members', 'collaborators', 'add member'],

                // Development: Publishing & Deploy
                'deploy-app' => ['deploy app', 'deploy', 'publish', 'deploy application'],
                'select-environment' => ['select environment', 'environment', 'deployment environment', 'env'],
                'set-custom-domain' => ['set custom domain', 'custom domain', 'domain', 'set domain'],
                'view-build-logs' => ['view build logs', 'build logs', 'logs', 'build output'],
                'restart-build' => ['restart build', 'rebuild', 'restart', 'run build again'],
                'rollback-deployment' => ['rollback deployment', 'rollback', 'revert deployment', 'undo deploy'],
                'enable-ssl' => ['enable ssl', 'ssl', 'https', 'enable https'],

                // Development: Technical Integrations
                'connect-database' => ['connect database', 'database', 'link database', 'db connection'],
                'connect-api' => ['connect api', 'external api', 'link api', 'api integration'],
                'set-environment-variables' => ['set environment variables', 'env variables', 'environment variables', 'env vars'],
                'test-api' => ['test api', 'api test', 'test endpoint', 'try api'],
                'create-automation-script' => ['create automation script', 'automation', 'script', 'build script'],

                // Development: Version Control
                'revert-changes' => ['revert changes', 'revert', 'undo changes', 'rollback code'],
                'view-contributions' => ['view contributions', 'contributions', 'contributors', 'user stats'],
                'merge-branch' => ['merge branch', 'merge', 'git merge', 'combine branch'],

                // Development: Testing & Monitoring
                'run-tests' => ['run tests', 'tests', 'test', 'execute tests'],
                'view-test-results' => ['view test results', 'test results', 'test report', 'test output'],
                'setup-cicd' => ['setup cicd', 'cicd', 'ci cd', 'continuous integration'],
                'monitor-performance' => ['monitor performance', 'performance', 'app performance', 'monitor'],
                'view-logs' => ['view logs', 'logs', 'error logs', 'system logs'],

                // Development: Security & Access
                'set-ssh-key' => ['set ssh key', 'ssh key', 'ssh', 'add ssh key'],
                'manage-permissions' => ['manage permissions', 'permissions', 'access control', 'user permissions'],
                'set-project-visibility' => ['set project visibility', 'project visibility', 'public private', 'visibility'],
                'enable-2fa' => ['enable 2fa', 'two factor authentication', '2fa', 'security'],
                'view-audit-log' => ['view audit log', 'audit log', 'activity log', 'security log'],

                // Development: Package Management
                'install-package' => ['install package', 'install', 'npm install', 'add package'],
                'update-packages' => ['update packages', 'update', 'upgrade packages', 'npm update'],
                'resolve-dependencies' => ['resolve dependencies', 'dependencies', 'fix conflicts', 'dependency issues'],
                'run-build-script' => ['run build script', 'build', 'npm run build', 'compile'],

                // Development: Environment Customization
                'configure-project' => ['configure project', 'project settings', 'settings', 'configuration'],
                'setup-local-environment' => ['setup local environment', 'local environment', 'dev environment', 'local setup'],
                'sync-repository' => ['sync repository', 'sync repo', 'sync', 'pull push'],
                'create-documentation' => ['create documentation', 'documentation', 'docs', 'readme'],

                // Development: Admin Actions
                'delete-project' => ['delete project', 'remove project', 'delete repo', 'remove repo'],
                'set-branch-protection' => ['set branch protection', 'branch protection', 'protect branch', 'branch rules'],
                'view-team-activity' => ['view team activity', 'team activity', 'activity', 'team stats'],
                'configure-integrations' => ['configure integrations', 'integrations', 'external integrations', 'setup integrations'],
                'view-statistics' => ['view statistics', 'statistics', 'stats', 'project stats'],

                // Development: Common Features
                'view-project-history' => ['view project history', 'project history', 'development history', 'history'],

                // AI: Interaction & Content Creation
                'chat-with-ai' => ['chat with ai', 'talk to ai', 'start chat', 'ai conversation'],
                'ask-question' => ['ask question', 'question', 'ask ai', 'query'],
                'create-content' => ['create content', 'write content', 'generate content', 'create article'],
                'translate-text' => ['translate text', 'translate', 'translate to', 'language translation'],
                'summarize-document' => ['summarize document', 'summarize', 'create summary', 'document summary'],
                'correct-grammar' => ['correct grammar', 'fix grammar', 'grammar check', 'spell check'],
                'generate-ideas' => ['generate ideas', 'get ideas', 'brainstorm', 'suggestions'],
                'generate-code' => ['generate code', 'write code', 'create code', 'code generation'],
                'optimize-code' => ['optimize code', 'improve code', 'refactor code', 'code optimization'],
                'convert-code' => ['convert code', 'translate code', 'code conversion', 'convert programming language'],

                // AI: Multimodal Generation
                'generate-image' => ['generate image', 'create image', 'make image', 'image generation'],
                'edit-image' => ['edit image', 'modify image', 'change image', 'image editing'],
                'remove-background' => ['remove background', 'background removal', 'transparent background', 'remove bg'],
                'generate-video' => ['generate video', 'create video', 'make video', 'video generation'],
                'text-to-speech' => ['text to speech', 'convert to speech', 'speak text', 'tts'],
                'speech-to-text' => ['speech to text', 'transcribe', 'voice to text', 'stt'],
                'generate-music' => ['generate music', 'create music', 'make music', 'music generation'],
                'create-design' => ['create design', 'make design', 'generate design', 'design logo'],

                // AI: Personalization & Training
                'create-assistant' => ['create assistant', 'make assistant', 'custom assistant', 'ai assistant'],
                'save-conversation' => ['save conversation', 'save chat', 'export conversation', 'download chat'],
                'set-tone' => ['set tone', 'change tone', 'communication style', 'writing style'],
                'train-model' => ['train model', 'custom model', 'train ai', 'fine tune model'],
                'use-advanced-prompt' => ['use advanced prompt', 'advanced prompt', 'better prompt', 'prompt engineering'],
                'access-api' => ['access api', 'use api', 'api access', 'developer api'],

                // AI: Integration & Collaboration
                'connect-app' => ['connect app', 'link app', 'integrate app', 'connect application'],
                'install-plugin' => ['install plugin', 'add plugin', 'plugin', 'extension'],
                'import-document' => ['import document', 'upload document', 'analyze document', 'load document'],
                'create-automation' => ['create automation', 'automation', 'workflow', 'automate'],
                'connect-database' => ['connect database', 'link database', 'database connection', 'db connection'],

                // AI: Data Analysis & Understanding
                'analyze-data' => ['analyze data', 'data analysis', 'analyze', 'process data'],
                'create-chart' => ['create chart', 'make chart', 'visualize data', 'generate chart'],
                'find-trends' => ['find trends', 'trends', 'data trends', 'insights'],
                'analyze-sentiment' => ['analyze sentiment', 'sentiment analysis', 'check sentiment', 'emotion analysis'],
                'categorize-text' => ['categorize text', 'classify text', 'text classification', 'categorize'],
                'classify-image' => ['classify image', 'image classification', 'identify image', 'image recognition'],
                'generate-report' => ['generate report', 'create report', 'automated report', 'data report'],

                // AI: Security & Account Management
                'manage-account' => ['manage account', 'account settings', 'account management', 'settings'],
                'view-history' => ['view history', 'conversation history', 'chat history', 'history'],
                'delete-history' => ['delete history', 'clear history', 'remove history', 'erase history'],
                'set-privacy' => ['set privacy', 'privacy settings', 'data privacy', 'privacy'],
                'manage-api-keys' => ['manage api keys', 'api keys', 'manage keys', 'api key settings'],
                'enable-2fa' => ['enable 2fa', 'two factor authentication', '2fa', 'security'],

                // AI: Payment & Subscription
                'upgrade-plan' => ['upgrade plan', 'upgrade', 'premium plan', 'subscription'],
                'view-usage' => ['view usage', 'usage', 'api usage', 'consumption'],
                'monitor-costs' => ['monitor costs', 'view costs', 'spending', 'monthly costs'],
                'view-billing' => ['view billing', 'billing', 'invoices', 'payment history'],

                // AI: Development & Testing
                'test-model' => ['test model', 'try model', 'sandbox', 'test ai'],
                'build-app' => ['build app', 'create app', 'develop app', 'application development'],
                'publish-model' => ['publish model', 'share model', 'upload model', 'deploy model'],
                'integrate-models' => ['integrate models', 'combine models', 'multi model', 'model integration'],
                'debug-response' => ['debug response', 'debug ai', 'fix response', 'troubleshoot'],
                'implement-ai' => ['implement ai', 'add ai', 'integrate ai', 'use ai in app'],

                // AI: Analytics & Monitoring
                'view-usage-report' => ['view usage report', 'usage report', 'model usage', 'usage statistics'],
                'analyze-quality' => ['analyze quality', 'quality analysis', 'response quality', 'check quality'],
                'view-api-consumption' => ['view api consumption', 'api consumption', 'api stats', 'consumption stats'],
                'view-logs' => ['view logs', 'logs', 'debug logs', 'monitoring logs'],

                // AI: Learning & Exploration
                'view-documentation' => ['view documentation', 'documentation', 'docs', 'api docs'],
                'test-feature' => ['test feature', 'try feature', 'experimental feature', 'beta feature'],
                'open-playground' => ['open playground', 'playground', 'ai playground', 'test playground'],
                'explore-models' => ['explore models', 'browse models', 'find models', 'model hub'],
            ],
        ];

        return $phrases[$locale][$command] ?? $phrases['en'][$command] ?? [];
    }
}

