<?php
/**
 * Voice Actions SDK - cPanel Webhook Handler
 * 
 * Kjo file përdoret për auto-deployment nga GitHub webhooks
 * 
 * SECURITY: Sigurohu që kjo file është e mbrojtur!
 * - Përdor authentication token
 * - Ose vendos në location që nuk është publike
 */

// Configuration
$WEBHOOK_SECRET = getenv('WEBHOOK_SECRET') ?: 'your_webhook_secret_here_change_this';
$DEPLOY_PATH = getenv('DEPLOY_PATH') ?: '/home/username/voice-actions-sdk';
$FRONTEND_PATH = getenv('FRONTEND_PATH') ?: '/home/username/public_html';
$BACKEND_PATH = getenv('BACKEND_PATH') ?: '/home/username/api.voiceactions.dev';
$LOG_FILE = getenv('LOG_FILE') ?: '/home/username/deployment.log';

// Get payload
$payload = file_get_contents('php://input');
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';

// Verify signature
if (!empty($signature)) {
    $expectedSignature = 'sha256=' . hash_hmac('sha256', $payload, $WEBHOOK_SECRET);
    if (!hash_equals($expectedSignature, $signature)) {
        http_response_code(401);
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Unauthorized - Invalid signature']);
        exit;
    }
}

// Parse payload
$data = json_decode($payload, true);

// Check if this is a push to main branch
if (!isset($data['ref']) || $data['ref'] !== 'refs/heads/main') {
    http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode(['status' => 'skipped', 'reason' => 'Not main branch']);
    exit;
}

// Log deployment start
$logEntry = date('Y-m-d H:i:s') . " - Deployment started\n";
file_put_contents($LOG_FILE, $logEntry, FILE_APPEND);

try {
    // Change to deploy path
    chdir($DEPLOY_PATH);
    
    // Pull latest changes
    $output = [];
    exec('git pull origin main 2>&1', $output, $returnCode);
    $logEntry .= "Git pull: " . implode("\n", $output) . "\n";
    
    if ($returnCode !== 0) {
        throw new Exception('Git pull failed');
    }
    
    // Build frontend
    $output = [];
    exec('cd frontend && npm install && npm run build 2>&1', $output, $returnCode);
    $logEntry .= "Frontend build: " . implode("\n", $output) . "\n";
    
    if ($returnCode !== 0) {
        throw new Exception('Frontend build failed');
    }
    
    // Deploy frontend
    $output = [];
    exec("cp -r frontend/dist/* $FRONTEND_PATH/ 2>&1", $output, $returnCode);
    $logEntry .= "Frontend deploy: " . implode("\n", $output) . "\n";
    
    // Build backend
    $output = [];
    exec('cd backend && composer install --no-dev --optimize-autoloader 2>&1', $output, $returnCode);
    $logEntry .= "Backend install: " . implode("\n", $output) . "\n";
    
    if ($returnCode !== 0) {
        throw new Exception('Backend install failed');
    }
    
    // Deploy backend
    $output = [];
    exec("rsync -av --exclude='node_modules' --exclude='.git' --exclude='tests' backend/ $BACKEND_PATH/ 2>&1", $output, $returnCode);
    $logEntry .= "Backend deploy: " . implode("\n", $output) . "\n";
    
    // Laravel optimization
    chdir($BACKEND_PATH);
    $output = [];
    exec('php artisan config:cache 2>&1', $output, $returnCode);
    exec('php artisan route:cache 2>&1', $output, $returnCode);
    exec('php artisan view:cache 2>&1', $output, $returnCode);
    $logEntry .= "Laravel cache: " . implode("\n", $output) . "\n";
    
    // Set permissions
    exec("chmod -R 755 $BACKEND_PATH/storage 2>&1");
    exec("chmod -R 755 $BACKEND_PATH/bootstrap/cache 2>&1");
    
    $logEntry .= date('Y-m-d H:i:s') . " - Deployment completed successfully!\n\n";
    file_put_contents($LOG_FILE, $logEntry, FILE_APPEND);
    
    http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'success',
        'message' => 'Deployment completed successfully',
        'timestamp' => date('Y-m-d H:i:s')
    ]);
    
} catch (Exception $e) {
    $logEntry .= "ERROR: " . $e->getMessage() . "\n";
    $logEntry .= date('Y-m-d H:i:s') . " - Deployment failed!\n\n";
    file_put_contents($LOG_FILE, $logEntry, FILE_APPEND);
    
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage(),
        'timestamp' => date('Y-m-d H:i:s')
    ]);
}
