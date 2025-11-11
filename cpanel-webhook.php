<?php
/**
 * cPanel Webhook Handler for GitHub Auto-Deployment
 * 
 * Place this file in ~/public_html/cpanel-webhook.php
 * Configure webhook secret in GitHub repository settings
 * 
 * Security: This file should be protected with .htaccess or moved outside public_html
 */

// Webhook secret (set this in GitHub webhook configuration)
$webhook_secret = 'your_webhook_secret_here_change_this';

// Get payload
$payload = file_get_contents('php://input');
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';

// Verify signature
if (!empty($webhook_secret)) {
    $expected_signature = 'sha256=' . hash_hmac('sha256', $payload, $webhook_secret);
    if (!hash_equals($expected_signature, $signature)) {
        http_response_code(401);
        die('Unauthorized: Invalid signature');
    }
}

// Parse payload
$data = json_decode($payload, true);

// Log deployment attempt
$log_file = dirname(__FILE__) . '/../deployment.log';
$log_entry = date('Y-m-d H:i:s') . " - Webhook triggered\n";
$log_entry .= "Branch: " . ($data['ref'] ?? 'unknown') . "\n";
$log_entry .= "Commit: " . ($data['head_commit']['id'] ?? 'unknown') . "\n";
$log_entry .= "Message: " . ($data['head_commit']['message'] ?? 'unknown') . "\n\n";

// Only deploy if push is to main branch
if (isset($data['ref']) && $data['ref'] === 'refs/heads/main') {
    $log_entry .= "✅ Deployment started...\n";
    
    // Change to git directory
    $git_dir = dirname(__FILE__) . '/../git/voiceactions-frontend';
    
    // Pull latest changes
    $output = shell_exec("cd $git_dir && git pull origin main 2>&1");
    $log_entry .= "Git pull output:\n$output\n";
    
    // Build frontend
    $frontend_dir = "$git_dir/frontend";
    $output = shell_exec("cd $frontend_dir && npm install && npm run build 2>&1");
    $log_entry .= "Frontend build output:\n$output\n";
    
    // Copy frontend files
    $public_html = dirname(__FILE__);
    $dist_dir = "$frontend_dir/dist";
    $output = shell_exec("cp -r $dist_dir/* $public_html/ 2>&1");
    $log_entry .= "Frontend copy output:\n$output\n";
    
    // Build backend
    $backend_git_dir = dirname(__FILE__) . '/../git/voiceactions-backend';
    $backend_dir = "$backend_git_dir/backend";
    $output = shell_exec("cd $backend_git_dir && git pull origin main 2>&1");
    $log_entry .= "Backend git pull output:\n$output\n";
    
    $output = shell_exec("cd $backend_dir && composer install --no-dev --optimize-autoloader 2>&1");
    $log_entry .= "Backend composer output:\n$output\n";
    
    $output = shell_exec("cd $backend_dir && php artisan config:cache && php artisan route:cache && php artisan view:cache 2>&1");
    $log_entry .= "Backend cache output:\n$output\n";
    
    // Copy backend files
    $api_dir = dirname(__FILE__) . '/../api.voiceactions.dev';
    $output = shell_exec("cp -r $backend_dir/* $api_dir/ 2>&1");
    $log_entry .= "Backend copy output:\n$output\n";
    
    // Set permissions
    $output = shell_exec("chmod -R 755 $api_dir/storage $api_dir/bootstrap/cache 2>&1");
    $log_entry .= "Permissions output:\n$output\n";
    
    $log_entry .= "✅ Deployment completed!\n";
    $log_entry .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    
    echo "Deployment completed successfully";
} else {
    $log_entry .= "⏭️  Skipped: Not main branch\n";
    $log_entry .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
    
    echo "Skipped: Not main branch";
}

// Write to log file
file_put_contents($log_file, $log_entry, FILE_APPEND);


