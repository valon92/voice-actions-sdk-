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

                // E-Commerce: Account Management
                'create-account' => ['krijo llogari', 'regjistrohu', 'llogari e re', 'sign up'],
                'update-personal-info' => ['perditeso informacionin personal', 'ndrysho informacion', 'edito te dhenat'],
                'save-shipping-address' => ['ruaj adresen e dergeses', 'ruaj adrese', 'shto adrese'],
                'save-payment-method' => ['ruaj metod pagese', 'ruaj karte', 'shto karte krediti'],
                'view-order-history' => ['shiko historine e porosive', 'porosite e mia', 'historiku i porosive'],
                'change-password' => ['ndrysho fjalekalimin', 'perditeso fjalekalimin', 'fjalekalim i ri'],
                'manage-subscriptions' => ['menaxho abonimet', 'abonimet', 'abonimet e mia'],
                'manage-notifications' => ['menaxho njoftimet', 'settings njoftimesh', 'njoftime email'],

                // E-Commerce: Product Search & Discovery
                'search-products' => ['kerko produkte', 'gjej produkte', 'kerko', 'kujto produkte'],
                'filter-products' => ['filtro produkte', 'filtro', 'filtro sipas cmimit'],
                'browse-categories' => ['shfleto kategori', 'kategori', 'shiko kategori'],
                'voice-search' => ['kerkim me ze', 'kerko me ze', 'fol per te kerkuar'],
                'image-search' => ['kerkim me foto', 'kerko me foto', 'kerkim vizual'],
                'compare-products' => ['krahaso produkte', 'krahasim', 'krahaso'],
                'view-recommendations' => ['shiko rekomandime', 'rekomandime', 'produkte te sugjeruara'],
                'view-related-products' => ['shiko produkte te lidhura', 'produkte te ngjashme', 'mund te te pelqejne'],
                'add-to-wishlist' => ['shto ne wishlist', 'ruaj per me vone', 'wishlist', 'shto ne te preferuarat'],

                // E-Commerce: Order Management
                'add-to-cart' => ['shto ne shporte', 'shto ne kosh', 'blej tani', 'shto produkt'],
                'view-cart' => ['shiko shporten', 'shporta', 'koshi im', 'shporte'],
                'update-quantity' => ['perditeso sasine', 'ndrysho sasine', 'sasi', 'perditeso sasi'],
                'remove-from-cart' => ['hiq nga shporta', 'fshij nga shporta', 'hiq produkt'],
                'apply-coupon' => ['aplikoj kupon', 'perdore kupon', 'kupon', 'kode zbritje'],
                'select-shipping' => ['zgjedh derges', 'metod dergese', 'zgjedh transport'],
                'checkout' => ['checkout', 'porosise', 'blej', 'perfundo porosine'],
                'save-billing-info' => ['ruaj informacion faturimi', 'adrese faturimi'],
                'track-order' => ['ndjek porosine', 'tracking porosie', 'ku eshte porosia ime'],
                'cancel-order' => ['anulo porosine', 'anulo', 'anulo blerjen'],
                'print-invoice' => ['printo fature', 'shkarko fature', 'fature', 'receipt'],

                // E-Commerce: Payments & Transactions
                'select-payment-method' => ['zgjedh metod pagese', 'zgjedh pagese', 'si te paguaj'],
                'use-loyalty-points' => ['perdore pike besnikerie', 'shkembe pike', 'aplikoj pike'],
                'view-transaction-history' => ['shiko historine e transaksioneve', 'historiku pagesash', 'transaksionet'],
                'request-refund' => ['kerko rimbursim', 'rimbursim', 'kthe parate'],
                'apply-promo-code' => ['aplikoj kode promocioni', 'kode promocioni', 'zbritje'],
                'view-payment-methods' => ['shiko metodat e pageses', 'kartat e ruajtura', 'metodat e mia'],

                // E-Commerce: Shipping & Delivery
                'select-shipping-company' => ['zgjedh kompani transporti', 'kompani dergese', 'transportues'],
                'set-delivery-address' => ['vendos adrese dergese', 'adrese dergese', 'ku te dergohet'],
                'select-pickup-point' => ['zgjedh pike marrje', 'pike marrje', 'merr nga'],
                'track-shipment' => ['ndjek dergesen', 'ndjek paketen', 'ku eshte paketa'],
                'change-delivery-address' => ['ndrysho adrese dergese', 'perditeso adrese', 'adrese e re'],
                'confirm-delivery' => ['konfirmo dergese', 'marr', 'pakete e marre'],
                'view-shipping-notifications' => ['shiko njoftimet e dergeses', 'perditesime dergese'],

                // E-Commerce: Communication & Support
                'contact-seller' => ['kontakto shitestin', 'mesazh shitestit', 'bisedo me shitestin'],
                'open-chat' => ['hape chat', 'chat', 'fillo chat', 'bisede'],
                'contact-support' => ['kontakto mbështetjen', 'mbështetje klienti', 'ndihme', 'support'],
                'report-product' => ['raporto produkt', 'raporto', 'flag produkt'],
                'open-dispute' => ['hape mosmarrëveshje', 'mosmarrëveshje', 'ankese'],
                'rate-seller' => ['vlereso shitestin', 'review shitestit', 'rating shitestit'],

                // E-Commerce: Reviews & Ratings
                'rate-product' => ['vlereso produkt', 'vlereso', 'jep rating', 'yje'],
                'write-review' => ['shkruaj review', 'review', 'shkruaj nje review', 'koment produkt'],
                'upload-product-photo' => ['ngarko foto produkti', 'shto foto', 'foto produkti'],
                'view-reviews' => ['shiko reviews', 'reviews', 'reviews klientesh', 'lexo reviews'],
                'filter-reviews' => ['filtro reviews', 'filtro sipas rating', 'reviews pozitive'],
                'report-review' => ['raporto review', 'flag review'],
                'upload-review-video' => ['ngarko video review', 'video review', 'shto video'],

                // E-Commerce: Loyalty & Rewards
                'view-loyalty-points' => ['shiko pike besnikerie', 'pike besnikerie', 'piket e mia', 'balanca pikesh'],
                'redeem-points' => ['shkembe pike', 'perdore pike', 'zbritje me pike'],
                'activate-membership' => ['aktivizo abonim', 'abonim', 'prime membership', 'subscribe'],
                'view-exclusive-offers' => ['shiko oferta ekskluzive', 'oferta ekskluzive', 'oferta speciale'],
                'refer-friend' => ['refero mik', 'referral', 'fto mik', 'program referral'],

                // E-Commerce: Returns & Refunds
                'request-return' => ['kerko kthim', 'kthe produkt', 'kthe artikull', 'dergo mbrapa'],
                'track-refund' => ['ndjek rimbursimin', 'status rimbursimi', 'ku eshte rimbursimi'],
                'upload-return-evidence' => ['ngarko dëshmi kthimi', 'ngarko foto', 'foto dëmtimi'],
                'choose-replacement' => ['zgjedh zëvendësim', 'zëvendësim ose rimbursim', 'këmbim'],
                'view-return-history' => ['shiko historine e kthimeve', 'historiku kthimesh', 'kthimet e mia'],

                // E-Commerce: Seller Features
                'create-store' => ['krijo dyqan', 'hape dyqan', 'dyqan i ri', 'llogari shitestit'],
                'add-product' => ['shto produkt', 'produkt i ri', 'listo produkt', 'ngarko produkt'],
                'manage-orders' => ['menaxho porosite', 'porosite', 'porosite shitestit'],
                'view-sales-stats' => ['shiko stats shitjesh', 'statistika shitjesh', 'raport shitjesh', 'fitime'],
                'create-promotion' => ['krijo promocion', 'promocion i ri', 'sale', 'zbritje'],
                'create-ad' => ['krijo reklame', 'reklame e paguar', 'reklamo produkt'],
                'manage-reviews' => ['menaxho reviews', 'reviews klientesh', 'reviews produktesh'],

                // Gaming: Account Management
                'create-gaming-account' => ['krijo llogari gaming', 'regjistrohu gaming', 'llogari gaming e re'],
                'set-avatar' => ['vendos avatar', 'ndrysho avatar', 'perditeso avatar', 'avatar i ri'],
                'change-gamertag' => ['ndrysho gamertag', 'ndrysho username', 'ndrysho emer lojtari'],
                'link-platform' => ['lidh platforme', 'lidh steam', 'lidh epic', 'lidh xbox'],
                'view-purchase-history' => ['shiko historine e blerjeve', 'blerjet e mia', 'historiku blerjesh'],
                'manage-subscription' => ['menaxho abonim', 'abonim gaming', 'playstation plus', 'xbox game pass'],
                'view-installed-games' => ['shiko lojrat e instaluara', 'lojrat e mia', 'biblioteka lojrave'],
                'set-payment-method' => ['vendos metod pagese', 'metod pagese', 'ruaj karte'],

                // Gaming: Game Discovery & Purchase
                'search-games' => ['kerko lojra', 'gjej lojra', 'kerko loje'],
                'filter-games' => ['filtro lojra', 'filtro sipas zhanrit', 'filtro sipas cmimit'],
                'view-game-details' => ['shiko detajet e lojes', 'detajet e lojes', 'info loje'],
                'watch-trailer' => ['shiko trailer', 'trailer loje', 'video trailer'],
                'buy-game' => ['blej loje', 'porosise loje', 'merr loje'],
                'pre-order-game' => ['pre-order loje', 'rezervo loje', 'preorder'],
                'apply-game-coupon' => ['aplikoj kupon loje', 'perdore kupon', 'kupon loje'],
                'view-game-reviews' => ['shiko reviews loje', 'reviews loje', 'lexo reviews'],

                // Gaming: Download & Installation
                'download-game' => ['shkarko loje', 'shkarko', 'merr loje'],
                'install-game' => ['instalo loje', 'instalo', 'vendos loje'],
                'manage-storage' => ['menaxho ruajtje', 'ruajtje', 'pastro hapesire'],
                'update-game' => ['perditeso loje', 'update loje', 'patch loje'],
                'install-dlc' => ['instalo dlc', 'shkarko dlc', 'merr dlc'],
                'download-beta' => ['shkarko beta', 'version beta', 'early access'],
                'pause-download' => ['pauzo shkarkim', 'pauzo', 'ndal shkarkim'],
                'resume-download' => ['vazhdo shkarkim', 'vazhdo', 'rifillo shkarkim'],

                // Gaming: Gameplay & Interaction
                'launch-game' => ['fillo loje', 'luaj loje', 'hape loje'],
                'invite-friend' => ['fto mik', 'fto ne loje', 'shto mik ne loje'],
                'create-party' => ['krijo party', 'party i ri', 'fillo party'],
                'join-party' => ['hyr ne party', 'hyr', 'bashko ne party'],
                'open-voice-chat' => ['hape voice chat', 'voice chat', 'fillo voice chat'],
                'toggle-fullscreen' => ['ndrysho fullscreen', 'fullscreen', 'ekran i plote'],
                'save-game' => ['ruaj loje', 'ruaj progres', 'ruaj'],
                'sync-cloud-save' => ['sinkronizo cloud save', 'cloud save', 'sinkronizo ruajtje'],

                // Gaming: Game Library
                'view-library' => ['shiko biblioteken', 'biblioteka lojrave', 'biblioteka ime'],
                'filter-library' => ['filtro biblioteken', 'filtro lojra', 'organizo biblioteken'],
                'create-collection' => ['krijo koleksion', 'koleksion i ri', 'koleksion lojrave'],
                'view-game-stats' => ['shiko stats loje', 'statistika loje', 'koha e luajtur'],
                'toggle-auto-update' => ['ndrysho auto-update', 'auto-update', 'update automatik'],
                'backup-game' => ['backup loje', 'backup', 'ruaj backup'],
                'uninstall-game' => ['cinstalo loje', 'hiq loje', 'fshij loje'],

                // Gaming: Community & Social
                'add-friend' => ['shto mik', 'kerkes miqesie', 'shto lojtar'],
                'view-friends-activity' => ['shiko aktivitetin e miqve', 'aktivitet miqve', 'cfare po luajne miqte'],
                'create-group' => ['krijo grup', 'grup gaming', 'klan', 'guild'],
                'write-game-review' => ['shkruaj review loje', 'review loje', 'shkruaj review'],
                'share-screenshot' => ['ndaj screenshot', 'screenshot', 'ndaj foto'],
                'share-gameplay-clip' => ['ndaj gameplay clip', 'gameplay clip', 'ndaj video'],
                'view-leaderboard' => ['shiko leaderboard', 'leaderboard', 'renditje', 'top lojtare'],
                'share-achievement' => ['ndaj achievement', 'ndaj trophy', 'posto achievement'],

                // Gaming: Achievements & Rewards
                'unlock-achievement' => ['hape achievement', 'achievement i hapur', 'merr achievement'],
                'view-achievement-progress' => ['shiko progresin e achievement', 'progres achievement', 'achievements'],
                'compare-achievements' => ['krahaso achievements', 'krahaso me miqte', 'krahasim achievements'],
                'view-rewards' => ['shiko shperblimet', 'shperblime', 'shperblimet e mia'],
                'claim-reward' => ['merr shperblim', 'kolekto shperblim', 'claim'],
                'view-xp' => ['shiko xp', 'experience points', 'xp', 'nivel'],

                // Gaming: Communication & Support
                'open-game-chat' => ['hape game chat', 'game chat', 'chat', 'text chat'],
                'report-player' => ['raporto lojtar', 'raporto', 'raporto perdorues'],
                'report-cheater' => ['raporto cheater', 'raporto hacker', 'cheater', 'hacker'],
                'report-bug' => ['raporto bug', 'bug report', 'raporto problem'],
                'block-player' => ['blloko lojtar', 'blloko', 'blloko perdorues'],
                'mute-player' => ['mute lojtar', 'mute', 'hesht lojtar'],

                // Gaming: Microtransactions & In-Game Purchases
                'buy-item' => ['blej item', 'porosise item', 'merr item'],
                'buy-skin' => ['blej skin', 'porosise skin', 'merr skin'],
                'activate-battle-pass' => ['aktivizo battle pass', 'battle pass', 'season pass'],
                'gift-game' => ['dhuro loje', 'dergo loje', 'dhuro'],
                'view-marketplace' => ['shiko marketplace', 'marketplace', 'tregtim'],

                // Gaming: Security & Privacy
                'set-privacy-level' => ['vendos nivel privatësi', 'nivel privatësi', 'settings privatësi'],
                'block-unknown' => ['blloko te panjohur', 'blloko te huaj', 'modalitet privat'],
                'report-fraud' => ['raporto mashtrim', 'mashtrim', 'scam'],
                'enable-steam-guard' => ['aktivizo steam guard', 'steam guard', 'aktivizo guard'],

                // Gaming: Refunds & Ownership
                'request-game-refund' => ['kerko rimbursim loje', 'rimbursim loje', 'kthe loje'],
                'view-refund-policy' => ['shiko politiken e rimbursimit', 'politike rimbursimi', 'kushte kthimi'],
                'view-licenses' => ['shiko licencat', 'licenca lojrave', 'licenca'],
                'check-ownership' => ['kontrollo pronësi', 'verifiko pronësi', 'kontrollo licencë'],

                // Gaming: Game Experience Personalization
                'change-language' => ['ndrysho gjuhen', 'gjuhe loje', 'settings gjuhe'],
                'configure-controller' => ['konfiguro kontrollues', 'settings kontrollues', 'setup kontrollues'],
                'set-key-bindings' => ['vendos key bindings', 'key bindings', 'kontrolla', 'settings tastiere'],
                'toggle-overlay' => ['ndrysho overlay', 'overlay', 'in-game overlay'],
                'connect-streaming' => ['lidh streaming', 'streaming', 'twitch', 'youtube gaming'],
                'view-events' => ['shiko evente', 'evente gaming', 'turne', 'evente'],

                // Gaming: Device & Platform Integration
                'sync-devices' => ['sinkronizo pajisje', 'sinkronizo', 'cloud sync'],
                'connect-vr' => ['lidh vr', 'vr headset', 'virtual reality', 'oculus'],
                'enable-cross-platform' => ['aktivizo cross-platform', 'cross-platform', 'cross play'],
                'connect-controller' => ['lidh kontrollues', 'kontrollues', 'gamepad'],

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

                // E-Commerce: Account Management
                'create-account' => ['crear cuenta', 'registrarse', 'registro', 'nueva cuenta'],
                'update-personal-info' => ['actualizar información personal', 'editar información', 'cambiar datos'],
                'save-shipping-address' => ['guardar dirección de envío', 'guardar dirección', 'agregar dirección'],
                'save-payment-method' => ['guardar método de pago', 'guardar tarjeta', 'agregar tarjeta'],
                'view-order-history' => ['ver historial de pedidos', 'mis pedidos', 'pedidos anteriores'],
                'change-password' => ['cambiar contraseña', 'actualizar contraseña', 'nueva contraseña'],
                'manage-subscriptions' => ['gestionar suscripciones', 'suscripciones', 'mis suscripciones'],
                'manage-notifications' => ['gestionar notificaciones', 'configuración de notificaciones', 'notificaciones email'],

                // E-Commerce: Product Search & Discovery
                'search-products' => ['buscar productos', 'encontrar productos', 'buscar', 'buscar artículos'],
                'filter-products' => ['filtrar productos', 'filtrar', 'aplicar filtro', 'filtrar por precio'],
                'browse-categories' => ['explorar categorías', 'categorías', 'ver categorías', 'comprar por categoría'],
                'voice-search' => ['búsqueda por voz', 'buscar por voz', 'hablar para buscar'],
                'image-search' => ['búsqueda por imagen', 'buscar por imagen', 'búsqueda visual'],
                'compare-products' => ['comparar productos', 'comparar', 'comparación de productos'],
                'view-recommendations' => ['ver recomendaciones', 'recomendaciones', 'productos sugeridos'],
                'view-related-products' => ['ver productos relacionados', 'productos relacionados', 'productos similares'],
                'add-to-wishlist' => ['agregar a lista de deseos', 'guardar para después', 'lista de deseos', 'favoritos'],

                // E-Commerce: Order Management
                'add-to-cart' => ['agregar al carrito', 'agregar a la bolsa', 'comprar ahora', 'agregar producto'],
                'view-cart' => ['ver carrito', 'carrito de compras', 'mi carrito', 'carrito'],
                'update-quantity' => ['actualizar cantidad', 'cambiar cantidad', 'cantidad', 'actualizar cantidad'],
                'remove-from-cart' => ['eliminar del carrito', 'quitar del carrito', 'eliminar producto'],
                'apply-coupon' => ['aplicar cupón', 'usar cupón', 'código de descuento', 'cupón'],
                'select-shipping' => ['seleccionar envío', 'elegir envío', 'método de envío', 'método de entrega'],
                'checkout' => ['pagar', 'proceder al pago', 'realizar pedido', 'comprar'],
                'save-billing-info' => ['guardar información de facturación', 'dirección de facturación'],
                'track-order' => ['rastrear pedido', 'seguimiento de pedido', 'dónde está mi pedido'],
                'cancel-order' => ['cancelar pedido', 'cancelar', 'anular compra'],
                'print-invoice' => ['imprimir factura', 'descargar factura', 'factura', 'recibo'],

                // E-Commerce: Payments & Transactions
                'select-payment-method' => ['seleccionar método de pago', 'elegir pago', 'método de pago', 'cómo pagar'],
                'use-loyalty-points' => ['usar puntos de fidelidad', 'canjear puntos', 'aplicar puntos'],
                'view-transaction-history' => ['ver historial de transacciones', 'historial de pagos', 'historial de compras'],
                'request-refund' => ['solicitar reembolso', 'reembolso', 'devolución de dinero'],
                'apply-promo-code' => ['aplicar código promocional', 'código promocional', 'código de descuento'],
                'view-payment-methods' => ['ver métodos de pago', 'métodos de pago', 'tarjetas guardadas'],

                // E-Commerce: Shipping & Delivery
                'select-shipping-company' => ['seleccionar empresa de envío', 'empresa de transporte', 'transportista'],
                'set-delivery-address' => ['establecer dirección de entrega', 'dirección de entrega', 'dónde entregar'],
                'select-pickup-point' => ['seleccionar punto de recogida', 'punto de recogida', 'recoger de'],
                'track-shipment' => ['rastrear envío', 'rastrear paquete', 'dónde está mi paquete'],
                'change-delivery-address' => ['cambiar dirección de entrega', 'actualizar dirección', 'nueva dirección'],
                'confirm-delivery' => ['confirmar entrega', 'recibido', 'entrega confirmada', 'paquete recibido'],
                'view-shipping-notifications' => ['ver notificaciones de envío', 'actualizaciones de entrega'],

                // E-Commerce: Communication & Support
                'contact-seller' => ['contactar vendedor', 'mensaje al vendedor', 'hablar con vendedor'],
                'open-chat' => ['abrir chat', 'chat', 'iniciar chat', 'chat de cliente'],
                'contact-support' => ['contactar soporte', 'soporte al cliente', 'ayuda', 'soporte'],
                'report-product' => ['reportar producto', 'reportar', 'marcar producto', 'producto falso'],
                'open-dispute' => ['abrir disputa', 'disputa', 'presentar disputa', 'queja'],
                'rate-seller' => ['calificar vendedor', 'reseña vendedor', 'calificación vendedor'],

                // E-Commerce: Reviews & Ratings
                'rate-product' => ['calificar producto', 'calificar', 'dar calificación', 'estrellas'],
                'write-review' => ['escribir reseña', 'reseña', 'escribir una reseña', 'reseña de producto'],
                'upload-product-photo' => ['subir foto del producto', 'agregar foto', 'foto del producto'],
                'view-reviews' => ['ver reseñas', 'reseñas', 'reseñas de clientes', 'leer reseñas'],
                'filter-reviews' => ['filtrar reseñas', 'filtrar por calificación', 'reseñas positivas'],
                'report-review' => ['reportar reseña', 'marcar reseña', 'reseña falsa'],
                'upload-review-video' => ['subir video reseña', 'video reseña', 'agregar video'],

                // E-Commerce: Loyalty & Rewards
                'view-loyalty-points' => ['ver puntos de fidelidad', 'puntos de fidelidad', 'mis puntos', 'saldo de puntos'],
                'redeem-points' => ['canjear puntos', 'usar puntos', 'intercambiar puntos', 'descuento con puntos'],
                'activate-membership' => ['activar membresía', 'membresía', 'membresía prime', 'suscribirse'],
                'view-exclusive-offers' => ['ver ofertas exclusivas', 'ofertas exclusivas', 'ofertas especiales'],
                'refer-friend' => ['referir amigo', 'referido', 'invitar amigo', 'programa de referidos'],

                // E-Commerce: Returns & Refunds
                'request-return' => ['solicitar devolución', 'devolver producto', 'devolver artículo', 'enviar de vuelta'],
                'track-refund' => ['rastrear reembolso', 'estado del reembolso', 'dónde está mi reembolso'],
                'upload-return-evidence' => ['subir evidencia de devolución', 'subir foto', 'foto de daño'],
                'choose-replacement' => ['elegir reemplazo', 'reemplazo o reembolso', 'intercambio'],
                'view-return-history' => ['ver historial de devoluciones', 'historial de devoluciones', 'mis devoluciones'],

                // E-Commerce: Seller Features
                'create-store' => ['crear tienda', 'abrir tienda', 'nueva tienda', 'cuenta de vendedor'],
                'add-product' => ['agregar producto', 'nuevo producto', 'listar producto', 'subir producto'],
                'manage-orders' => ['gestionar pedidos', 'pedidos', 'pedidos del vendedor'],
                'view-sales-stats' => ['ver estadísticas de ventas', 'estadísticas de ventas', 'reporte de ventas', 'ingresos'],
                'create-promotion' => ['crear promoción', 'nueva promoción', 'oferta', 'descuento'],
                'create-ad' => ['crear anuncio', 'anuncio patrocinado', 'publicidad', 'promocionar producto'],
                'manage-reviews' => ['gestionar reseñas', 'reseñas de clientes', 'reseñas de productos'],

                // Gaming: Account Management
                'create-gaming-account' => ['crear cuenta gaming', 'registrarse gaming', 'cuenta gaming nueva'],
                'set-avatar' => ['establecer avatar', 'cambiar avatar', 'actualizar avatar', 'nuevo avatar'],
                'change-gamertag' => ['cambiar gamertag', 'cambiar nombre de usuario', 'cambiar nombre jugador'],
                'link-platform' => ['vincular plataforma', 'vincular steam', 'vincular epic', 'vincular xbox'],
                'view-purchase-history' => ['ver historial de compras', 'mis compras', 'historial compras'],
                'manage-subscription' => ['gestionar suscripción', 'suscripción gaming', 'playstation plus', 'xbox game pass'],
                'view-installed-games' => ['ver juegos instalados', 'mis juegos', 'biblioteca juegos'],
                'set-payment-method' => ['establecer método de pago', 'método de pago', 'guardar tarjeta'],

                // Gaming: Game Discovery & Purchase
                'search-games' => ['buscar juegos', 'encontrar juegos', 'buscar juego'],
                'filter-games' => ['filtrar juegos', 'filtrar por género', 'filtrar por precio'],
                'view-game-details' => ['ver detalles del juego', 'detalles del juego', 'info juego'],
                'watch-trailer' => ['ver trailer', 'trailer del juego', 'video trailer'],
                'buy-game' => ['comprar juego', 'adquirir juego', 'obtener juego'],
                'pre-order-game' => ['pre-ordenar juego', 'reservar juego', 'preorder'],
                'apply-game-coupon' => ['aplicar cupón juego', 'usar cupón', 'cupón juego'],
                'view-game-reviews' => ['ver reseñas del juego', 'reseñas del juego', 'leer reseñas'],

                // Gaming: Download & Installation
                'download-game' => ['descargar juego', 'descargar', 'obtener juego'],
                'install-game' => ['instalar juego', 'instalar', 'configurar juego'],
                'manage-storage' => ['gestionar almacenamiento', 'almacenamiento', 'liberar espacio'],
                'update-game' => ['actualizar juego', 'update juego', 'parchear juego'],
                'install-dlc' => ['instalar dlc', 'descargar dlc', 'obtener dlc'],
                'download-beta' => ['descargar beta', 'versión beta', 'early access'],
                'pause-download' => ['pausar descarga', 'pausar', 'detener descarga'],
                'resume-download' => ['reanudar descarga', 'reanudar', 'continuar descarga'],

                // Gaming: Gameplay & Interaction
                'launch-game' => ['iniciar juego', 'jugar juego', 'abrir juego'],
                'invite-friend' => ['invitar amigo', 'invitar al juego', 'agregar amigo al juego'],
                'create-party' => ['crear party', 'party nuevo', 'iniciar party'],
                'join-party' => ['unirse al party', 'unirse', 'entrar al party'],
                'open-voice-chat' => ['abrir voice chat', 'voice chat', 'iniciar voice chat'],
                'toggle-fullscreen' => ['alternar pantalla completa', 'pantalla completa', 'maximizar'],
                'save-game' => ['guardar juego', 'guardar progreso', 'guardar'],
                'sync-cloud-save' => ['sincronizar cloud save', 'cloud save', 'sincronizar guardado'],

                // Gaming: Game Library
                'view-library' => ['ver biblioteca', 'biblioteca de juegos', 'mi biblioteca'],
                'filter-library' => ['filtrar biblioteca', 'filtrar juegos', 'organizar biblioteca'],
                'create-collection' => ['crear colección', 'colección nueva', 'colección de juegos'],
                'view-game-stats' => ['ver estadísticas del juego', 'estadísticas del juego', 'tiempo jugado'],
                'toggle-auto-update' => ['alternar auto-actualización', 'auto-actualización', 'actualización automática'],
                'backup-game' => ['hacer backup del juego', 'backup', 'guardar backup'],
                'uninstall-game' => ['desinstalar juego', 'eliminar juego', 'quitar juego'],

                // Gaming: Community & Social
                'add-friend' => ['agregar amigo', 'solicitud de amistad', 'agregar jugador'],
                'view-friends-activity' => ['ver actividad de amigos', 'actividad amigos', 'qué juegan amigos'],
                'create-group' => ['crear grupo', 'grupo gaming', 'clan', 'guild'],
                'write-game-review' => ['escribir reseña del juego', 'reseña del juego', 'escribir reseña'],
                'share-screenshot' => ['compartir screenshot', 'screenshot', 'compartir imagen'],
                'share-gameplay-clip' => ['compartir gameplay clip', 'gameplay clip', 'compartir video'],
                'view-leaderboard' => ['ver leaderboard', 'leaderboard', 'clasificación', 'top jugadores'],
                'share-achievement' => ['compartir achievement', 'compartir trofeo', 'publicar achievement'],

                // Gaming: Achievements & Rewards
                'unlock-achievement' => ['desbloquear achievement', 'achievement desbloqueado', 'obtener achievement'],
                'view-achievement-progress' => ['ver progreso de achievement', 'progreso achievement', 'achievements'],
                'compare-achievements' => ['comparar achievements', 'comparar con amigos', 'comparación achievements'],
                'view-rewards' => ['ver recompensas', 'recompensas', 'mis recompensas'],
                'claim-reward' => ['reclamar recompensa', 'obtener recompensa', 'colectar recompensa'],
                'view-xp' => ['ver xp', 'experience points', 'xp', 'nivel'],

                // Gaming: Communication & Support
                'open-game-chat' => ['abrir game chat', 'game chat', 'chat', 'text chat'],
                'report-player' => ['reportar jugador', 'reportar', 'reportar usuario'],
                'report-cheater' => ['reportar cheater', 'reportar hacker', 'cheater', 'hacker'],
                'report-bug' => ['reportar bug', 'bug report', 'reportar problema'],
                'block-player' => ['bloquear jugador', 'bloquear', 'bloquear usuario'],
                'mute-player' => ['silenciar jugador', 'silenciar', 'mute jugador'],

                // Gaming: Microtransactions & In-Game Purchases
                'buy-item' => ['comprar item', 'adquirir item', 'obtener item'],
                'buy-skin' => ['comprar skin', 'adquirir skin', 'obtener skin'],
                'activate-battle-pass' => ['activar battle pass', 'battle pass', 'season pass'],
                'gift-game' => ['regalar juego', 'enviar juego', 'regalar'],
                'view-marketplace' => ['ver marketplace', 'marketplace', 'intercambio'],

                // Gaming: Security & Privacy
                'set-privacy-level' => ['establecer nivel de privacidad', 'nivel de privacidad', 'configuración privacidad'],
                'block-unknown' => ['bloquear desconocidos', 'bloquear extraños', 'modo privado'],
                'report-fraud' => ['reportar fraude', 'fraude', 'estafa'],
                'enable-steam-guard' => ['activar steam guard', 'steam guard', 'activar guard'],

                // Gaming: Refunds & Ownership
                'request-game-refund' => ['solicitar reembolso del juego', 'reembolso del juego', 'devolver juego'],
                'view-refund-policy' => ['ver política de reembolso', 'política reembolso', 'términos reembolso'],
                'view-licenses' => ['ver licencias', 'licencias de juegos', 'licencias'],
                'check-ownership' => ['verificar propiedad', 'verificar propiedad', 'verificar licencia'],

                // Gaming: Game Experience Personalization
                'change-language' => ['cambiar idioma', 'idioma del juego', 'configuración idioma'],
                'configure-controller' => ['configurar controlador', 'configuración controlador', 'setup controlador'],
                'set-key-bindings' => ['establecer key bindings', 'key bindings', 'controles', 'configuración teclado'],
                'toggle-overlay' => ['alternar overlay', 'overlay', 'in-game overlay'],
                'connect-streaming' => ['conectar streaming', 'streaming', 'twitch', 'youtube gaming'],
                'view-events' => ['ver eventos', 'eventos gaming', 'torneos', 'eventos'],

                // Gaming: Device & Platform Integration
                'sync-devices' => ['sincronizar dispositivos', 'sincronizar', 'cloud sync'],
                'connect-vr' => ['conectar vr', 'vr headset', 'realidad virtual', 'oculus'],
                'enable-cross-platform' => ['activar cross-platform', 'cross-platform', 'cross play'],
                'connect-controller' => ['conectar controlador', 'controlador', 'gamepad'],

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

                // E-Commerce: Account Management
                'create-account' => ['créer un compte', 's\'inscrire', 'enregistrement', 'nouveau compte'],
                'update-personal-info' => ['mettre à jour les informations personnelles', 'modifier informations', 'changer données'],
                'save-shipping-address' => ['enregistrer adresse de livraison', 'enregistrer adresse', 'ajouter adresse'],
                'save-payment-method' => ['enregistrer méthode de paiement', 'enregistrer carte', 'ajouter carte'],
                'view-order-history' => ['voir historique des commandes', 'mes commandes', 'commandes précédentes'],
                'change-password' => ['changer mot de passe', 'mettre à jour mot de passe', 'nouveau mot de passe'],
                'manage-subscriptions' => ['gérer abonnements', 'abonnements', 'mes abonnements'],
                'manage-notifications' => ['gérer notifications', 'paramètres notifications', 'notifications email'],

                // E-Commerce: Product Search & Discovery
                'search-products' => ['rechercher produits', 'trouver produits', 'rechercher', 'chercher articles'],
                'filter-products' => ['filtrer produits', 'filtrer', 'appliquer filtre', 'filtrer par prix'],
                'browse-categories' => ['parcourir catégories', 'catégories', 'voir catégories', 'acheter par catégorie'],
                'voice-search' => ['recherche vocale', 'rechercher par voix', 'parler pour rechercher'],
                'image-search' => ['recherche par image', 'rechercher par image', 'recherche visuelle'],
                'compare-products' => ['comparer produits', 'comparer', 'comparaison de produits'],
                'view-recommendations' => ['voir recommandations', 'recommandations', 'produits suggérés'],
                'view-related-products' => ['voir produits associés', 'produits associés', 'produits similaires'],
                'add-to-wishlist' => ['ajouter à la liste de souhaits', 'enregistrer pour plus tard', 'liste de souhaits', 'favoris'],

                // E-Commerce: Order Management
                'add-to-cart' => ['ajouter au panier', 'ajouter au sac', 'acheter maintenant', 'ajouter produit'],
                'view-cart' => ['voir panier', 'panier', 'mon panier', 'panier d\'achat'],
                'update-quantity' => ['mettre à jour quantité', 'changer quantité', 'quantité', 'modifier quantité'],
                'remove-from-cart' => ['retirer du panier', 'supprimer du panier', 'retirer produit'],
                'apply-coupon' => ['appliquer coupon', 'utiliser coupon', 'code de réduction', 'coupon'],
                'select-shipping' => ['sélectionner livraison', 'choisir livraison', 'méthode de livraison'],
                'checkout' => ['paiement', 'procéder au paiement', 'passer commande', 'acheter'],
                'save-billing-info' => ['enregistrer informations de facturation', 'adresse de facturation'],
                'track-order' => ['suivre commande', 'suivi de commande', 'où est ma commande'],
                'cancel-order' => ['annuler commande', 'annuler', 'annuler achat'],
                'print-invoice' => ['imprimer facture', 'télécharger facture', 'facture', 'reçu'],

                // E-Commerce: Payments & Transactions
                'select-payment-method' => ['sélectionner méthode de paiement', 'choisir paiement', 'méthode de paiement', 'comment payer'],
                'use-loyalty-points' => ['utiliser points de fidélité', 'échanger points', 'appliquer points'],
                'view-transaction-history' => ['voir historique transactions', 'historique paiements', 'historique achats'],
                'request-refund' => ['demander remboursement', 'remboursement', 'retour d\'argent'],
                'apply-promo-code' => ['appliquer code promo', 'code promotionnel', 'code de réduction'],
                'view-payment-methods' => ['voir méthodes de paiement', 'méthodes de paiement', 'cartes enregistrées'],

                // E-Commerce: Shipping & Delivery
                'select-shipping-company' => ['sélectionner entreprise de livraison', 'transporteur', 'compagnie de livraison'],
                'set-delivery-address' => ['définir adresse de livraison', 'adresse de livraison', 'où livrer'],
                'select-pickup-point' => ['sélectionner point de retrait', 'point de retrait', 'retirer de'],
                'track-shipment' => ['suivre envoi', 'suivre colis', 'où est mon colis'],
                'change-delivery-address' => ['changer adresse de livraison', 'mettre à jour adresse', 'nouvelle adresse'],
                'confirm-delivery' => ['confirmer livraison', 'reçu', 'livraison confirmée', 'colis reçu'],
                'view-shipping-notifications' => ['voir notifications livraison', 'mises à jour livraison'],

                // E-Commerce: Communication & Support
                'contact-seller' => ['contacter vendeur', 'message au vendeur', 'parler au vendeur'],
                'open-chat' => ['ouvrir chat', 'chat', 'démarrer chat', 'chat client'],
                'contact-support' => ['contacter support', 'support client', 'aide', 'support'],
                'report-product' => ['signaler produit', 'signaler', 'marquer produit', 'produit faux'],
                'open-dispute' => ['ouvrir litige', 'litige', 'déposer litige', 'plainte'],
                'rate-seller' => ['évaluer vendeur', 'avis vendeur', 'note vendeur'],

                // E-Commerce: Reviews & Ratings
                'rate-product' => ['évaluer produit', 'évaluer', 'donner note', 'étoiles'],
                'write-review' => ['écrire avis', 'avis', 'écrire un avis', 'avis produit'],
                'upload-product-photo' => ['télécharger photo produit', 'ajouter photo', 'photo produit'],
                'view-reviews' => ['voir avis', 'avis', 'avis clients', 'lire avis'],
                'filter-reviews' => ['filtrer avis', 'filtrer par note', 'avis positifs'],
                'report-review' => ['signaler avis', 'marquer avis', 'avis faux'],
                'upload-review-video' => ['télécharger vidéo avis', 'vidéo avis', 'ajouter vidéo'],

                // E-Commerce: Loyalty & Rewards
                'view-loyalty-points' => ['voir points fidélité', 'points fidélité', 'mes points', 'solde points'],
                'redeem-points' => ['échanger points', 'utiliser points', 'réduction avec points'],
                'activate-membership' => ['activer abonnement', 'abonnement', 'abonnement prime', 's\'abonner'],
                'view-exclusive-offers' => ['voir offres exclusives', 'offres exclusives', 'offres spéciales'],
                'refer-friend' => ['parrainer ami', 'parrainage', 'inviter ami', 'programme parrainage'],

                // E-Commerce: Returns & Refunds
                'request-return' => ['demander retour', 'retourner produit', 'retourner article', 'renvoyer'],
                'track-refund' => ['suivre remboursement', 'état remboursement', 'où est mon remboursement'],
                'upload-return-evidence' => ['télécharger preuve retour', 'télécharger photo', 'photo dommage'],
                'choose-replacement' => ['choisir remplacement', 'remplacement ou remboursement', 'échange'],
                'view-return-history' => ['voir historique retours', 'historique retours', 'mes retours'],

                // E-Commerce: Seller Features
                'create-store' => ['créer boutique', 'ouvrir boutique', 'nouvelle boutique', 'compte vendeur'],
                'add-product' => ['ajouter produit', 'nouveau produit', 'lister produit', 'télécharger produit'],
                'manage-orders' => ['gérer commandes', 'commandes', 'commandes vendeur'],
                'view-sales-stats' => ['voir statistiques ventes', 'statistiques ventes', 'rapport ventes', 'revenus'],
                'create-promotion' => ['créer promotion', 'nouvelle promotion', 'promotion', 'réduction'],
                'create-ad' => ['créer publicité', 'publicité sponsorisée', 'publicité', 'promouvoir produit'],
                'manage-reviews' => ['gérer avis', 'avis clients', 'avis produits'],

                // Gaming: Account Management
                'create-gaming-account' => ['créer compte gaming', 's\'inscrire gaming', 'compte gaming nouveau'],
                'set-avatar' => ['définir avatar', 'changer avatar', 'mettre à jour avatar', 'nouveau avatar'],
                'change-gamertag' => ['changer gamertag', 'changer nom d\'utilisateur', 'changer nom joueur'],
                'link-platform' => ['lier plateforme', 'lier steam', 'lier epic', 'lier xbox'],
                'view-purchase-history' => ['voir historique achats', 'mes achats', 'historique achats'],
                'manage-subscription' => ['gérer abonnement', 'abonnement gaming', 'playstation plus', 'xbox game pass'],
                'view-installed-games' => ['voir jeux installés', 'mes jeux', 'bibliothèque jeux'],
                'set-payment-method' => ['définir méthode de paiement', 'méthode de paiement', 'enregistrer carte'],

                // Gaming: Game Discovery & Purchase
                'search-games' => ['rechercher jeux', 'trouver jeux', 'chercher jeu'],
                'filter-games' => ['filtrer jeux', 'filtrer par genre', 'filtrer par prix'],
                'view-game-details' => ['voir détails du jeu', 'détails du jeu', 'info jeu'],
                'watch-trailer' => ['voir trailer', 'trailer du jeu', 'vidéo trailer'],
                'buy-game' => ['acheter jeu', 'acquérir jeu', 'obtenir jeu'],
                'pre-order-game' => ['pré-commander jeu', 'réserver jeu', 'preorder'],
                'apply-game-coupon' => ['appliquer coupon jeu', 'utiliser coupon', 'coupon jeu'],
                'view-game-reviews' => ['voir avis du jeu', 'avis du jeu', 'lire avis'],

                // Gaming: Download & Installation
                'download-game' => ['télécharger jeu', 'télécharger', 'obtenir jeu'],
                'install-game' => ['installer jeu', 'installer', 'configurer jeu'],
                'manage-storage' => ['gérer stockage', 'stockage', 'libérer espace'],
                'update-game' => ['mettre à jour jeu', 'update jeu', 'patcher jeu'],
                'install-dlc' => ['installer dlc', 'télécharger dlc', 'obtenir dlc'],
                'download-beta' => ['télécharger beta', 'version beta', 'early access'],
                'pause-download' => ['mettre en pause téléchargement', 'pause', 'arrêter téléchargement'],
                'resume-download' => ['reprendre téléchargement', 'reprendre', 'continuer téléchargement'],

                // Gaming: Gameplay & Interaction
                'launch-game' => ['lancer jeu', 'jouer jeu', 'ouvrir jeu'],
                'invite-friend' => ['inviter ami', 'inviter au jeu', 'ajouter ami au jeu'],
                'create-party' => ['créer party', 'party nouveau', 'démarrer party'],
                'join-party' => ['rejoindre party', 'rejoindre', 'entrer dans party'],
                'open-voice-chat' => ['ouvrir voice chat', 'voice chat', 'démarrer voice chat'],
                'toggle-fullscreen' => ['basculer plein écran', 'plein écran', 'maximiser'],
                'save-game' => ['sauvegarder jeu', 'sauvegarder progression', 'sauvegarder'],
                'sync-cloud-save' => ['synchroniser cloud save', 'cloud save', 'synchroniser sauvegarde'],

                // Gaming: Game Library
                'view-library' => ['voir bibliothèque', 'bibliothèque de jeux', 'ma bibliothèque'],
                'filter-library' => ['filtrer bibliothèque', 'filtrer jeux', 'organiser bibliothèque'],
                'create-collection' => ['créer collection', 'collection nouvelle', 'collection de jeux'],
                'view-game-stats' => ['voir statistiques du jeu', 'statistiques du jeu', 'temps de jeu'],
                'toggle-auto-update' => ['basculer auto-mise à jour', 'auto-mise à jour', 'mise à jour automatique'],
                'backup-game' => ['sauvegarder jeu', 'backup', 'créer backup'],
                'uninstall-game' => ['désinstaller jeu', 'supprimer jeu', 'retirer jeu'],

                // Gaming: Community & Social
                'add-friend' => ['ajouter ami', 'demande d\'amitié', 'ajouter joueur'],
                'view-friends-activity' => ['voir activité des amis', 'activité amis', 'ce que jouent amis'],
                'create-group' => ['créer groupe', 'groupe gaming', 'clan', 'guild'],
                'write-game-review' => ['écrire avis du jeu', 'avis du jeu', 'écrire avis'],
                'share-screenshot' => ['partager screenshot', 'screenshot', 'partager image'],
                'share-gameplay-clip' => ['partager gameplay clip', 'gameplay clip', 'partager vidéo'],
                'view-leaderboard' => ['voir leaderboard', 'leaderboard', 'classement', 'top joueurs'],
                'share-achievement' => ['partager achievement', 'partager trophée', 'publier achievement'],

                // Gaming: Achievements & Rewards
                'unlock-achievement' => ['débloquer achievement', 'achievement débloqué', 'obtenir achievement'],
                'view-achievement-progress' => ['voir progrès achievement', 'progrès achievement', 'achievements'],
                'compare-achievements' => ['comparer achievements', 'comparer avec amis', 'comparaison achievements'],
                'view-rewards' => ['voir récompenses', 'récompenses', 'mes récompenses'],
                'claim-reward' => ['réclamer récompense', 'obtenir récompense', 'collecter récompense'],
                'view-xp' => ['voir xp', 'experience points', 'xp', 'niveau'],

                // Gaming: Communication & Support
                'open-game-chat' => ['ouvrir game chat', 'game chat', 'chat', 'text chat'],
                'report-player' => ['signaler joueur', 'signaler', 'signaler utilisateur'],
                'report-cheater' => ['signaler cheater', 'signaler hacker', 'cheater', 'hacker'],
                'report-bug' => ['signaler bug', 'bug report', 'signaler problème'],
                'block-player' => ['bloquer joueur', 'bloquer', 'bloquer utilisateur'],
                'mute-player' => ['couper le son joueur', 'couper le son', 'mute joueur'],

                // Gaming: Microtransactions & In-Game Purchases
                'buy-item' => ['acheter item', 'acquérir item', 'obtenir item'],
                'buy-skin' => ['acheter skin', 'acquérir skin', 'obtenir skin'],
                'activate-battle-pass' => ['activer battle pass', 'battle pass', 'season pass'],
                'gift-game' => ['offrir jeu', 'envoyer jeu', 'offrir'],
                'view-marketplace' => ['voir marketplace', 'marketplace', 'échange'],

                // Gaming: Security & Privacy
                'set-privacy-level' => ['définir niveau de confidentialité', 'niveau confidentialité', 'paramètres confidentialité'],
                'block-unknown' => ['bloquer inconnus', 'bloquer étrangers', 'mode privé'],
                'report-fraud' => ['signaler fraude', 'fraude', 'arnaque'],
                'enable-steam-guard' => ['activer steam guard', 'steam guard', 'activer guard'],

                // Gaming: Refunds & Ownership
                'request-game-refund' => ['demander remboursement jeu', 'remboursement jeu', 'retourner jeu'],
                'view-refund-policy' => ['voir politique remboursement', 'politique remboursement', 'conditions remboursement'],
                'view-licenses' => ['voir licences', 'licences de jeux', 'licences'],
                'check-ownership' => ['vérifier propriété', 'vérifier propriété', 'vérifier licence'],

                // Gaming: Game Experience Personalization
                'change-language' => ['changer langue', 'langue du jeu', 'paramètres langue'],
                'configure-controller' => ['configurer contrôleur', 'paramètres contrôleur', 'setup contrôleur'],
                'set-key-bindings' => ['définir key bindings', 'key bindings', 'contrôles', 'paramètres clavier'],
                'toggle-overlay' => ['basculer overlay', 'overlay', 'in-game overlay'],
                'connect-streaming' => ['connecter streaming', 'streaming', 'twitch', 'youtube gaming'],
                'view-events' => ['voir événements', 'événements gaming', 'tournois', 'événements'],

                // Gaming: Device & Platform Integration
                'sync-devices' => ['synchroniser appareils', 'synchroniser', 'cloud sync'],
                'connect-vr' => ['connecter vr', 'vr headset', 'réalité virtuelle', 'oculus'],
                'enable-cross-platform' => ['activer cross-platform', 'cross-platform', 'cross play'],
                'connect-controller' => ['connecter contrôleur', 'contrôleur', 'gamepad'],

                // Basic
                'click' => ['cliquer', 'toucher', 'appuyer', 'sélectionner'],
            ],
        ];

        return $phrases[$locale][$command] ?? $phrases['en'][$command] ?? [];
    }
}

