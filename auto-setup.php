<?php
/**
 * Voice Actions SDK - Auto Setup Script
 * 
 * Vendos këtë file në ~/public_html/auto-setup.php
 * Pastaj hape në browser: https://voiceactions.dev/auto-setup.php
 * 
 * Ky script do të:
 * 1. Clone/pull nga GitHub
 * 2. Build frontend dhe backend
 * 3. Kopjo filet në vendet e duhura
 * 4. Setup database dhe konfigurim
 * 
 * PAS SETUP-IT, FSHI KËTË FILE për siguri!
 */

// Security: Only allow access from localhost or specific IP
$allowed_ips = ['127.0.0.1', '::1']; // Add your IP if needed
$client_ip = $_SERVER['REMOTE_ADDR'] ?? '';

// Uncomment to restrict access
// if (!in_array($client_ip, $allowed_ips) && $client_ip !== 'YOUR_IP_HERE') {
//     http_response_code(403);
//     die('Access denied');
// }

// Set execution time limit
set_time_limit(600); // 10 minutes
ini_set('memory_limit', '512M');

// Get home directory
$home = dirname(__DIR__);
$username = basename($home);

// Output buffer for real-time feedback
ob_start();
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voice Actions SDK - Auto Setup</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
            padding: 20px;
            min-height: 100vh;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            padding: 30px;
        }
        h1 {
            color: #667eea;
            margin-bottom: 10px;
            font-size: 28px;
        }
        .subtitle {
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }
        .step {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px;
            margin: 15px 0;
            border-radius: 5px;
        }
        .step-title {
            font-weight: bold;
            color: #667eea;
            margin-bottom: 10px;
            font-size: 16px;
        }
        .output {
            background: #1e1e1e;
            color: #d4d4d4;
            padding: 15px;
            border-radius: 5px;
            font-family: 'Courier New', monospace;
            font-size: 12px;
            max-height: 400px;
            overflow-y: auto;
            margin: 10px 0;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .success { color: #4caf50; }
        .error { color: #f44336; }
        .warning { color: #ff9800; }
        .info { color: #2196f3; }
        .btn {
            background: #667eea;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 10px 5px;
            transition: background 0.3s;
        }
        .btn:hover { background: #5568d3; }
        .btn-danger {
            background: #f44336;
        }
        .btn-danger:hover { background: #d32f2f; }
        .status {
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
        }
        .status.success { background: #e8f5e9; color: #2e7d32; }
        .status.error { background: #ffebee; color: #c62828; }
        .status.info { background: #e3f2fd; color: #1565c0; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚀 Voice Actions SDK - Auto Setup</h1>
        <p class="subtitle">Setup automatik për deployment në cPanel</p>

        <?php
        function log_output($message, $type = 'info') {
            $colors = [
                'success' => '✓',
                'error' => '✗',
                'warning' => '⚠',
                'info' => 'ℹ'
            ];
            $icon = $colors[$type] ?? '•';
            echo "<div class='status $type'>$icon $message</div>";
            flush();
            ob_flush();
        }

        function execute_command($command, $description) {
            log_output("$description...", 'info');
            $output = [];
            $return_var = 0;
            exec($command . ' 2>&1', $output, $return_var);
            $result = implode("\n", $output);
            
            if ($return_var === 0) {
                log_output("$description - SUCCESS", 'success');
                return ['success' => true, 'output' => $result];
            } else {
                log_output("$description - FAILED: $result", 'error');
                return ['success' => false, 'output' => $result];
            }
        }

        // Check if setup button was clicked
        if (isset($_POST['run_setup'])) {
            echo '<div class="output">';
            echo "Starting auto setup...\n";
            echo "Home directory: $home\n";
            echo "Username: $username\n\n";
            flush();
            ob_flush();

            $errors = [];
            $warnings = [];

            // Step 1: Create directories
            log_output("Step 1: Creating directories...", 'info');
            $dirs = [
                "$home/git/voiceactions-frontend",
                "$home/git/voiceactions-backend",
                "$home/api.voiceactions.dev",
                "$home/api.voiceactions.dev/database",
                "$home/api.voiceactions.dev/storage",
                "$home/api.voiceactions.dev/bootstrap/cache"
            ];

            foreach ($dirs as $dir) {
                if (!is_dir($dir)) {
                    mkdir($dir, 0755, true);
                    log_output("Created: $dir", 'success');
                }
            }

            // Step 2: Clone/Pull Frontend
            log_output("Step 2: Setting up frontend repository...", 'info');
            $frontend_git = "$home/git/voiceactions-frontend";
            
            if (!is_dir("$frontend_git/.git")) {
                $result = execute_command(
                    "cd $frontend_git && git clone https://github.com/valon92/voice-actions-sdk-.git . 2>&1",
                    "Cloning frontend repository"
                );
                if (!$result['success']) $errors[] = "Frontend clone failed";
            } else {
                $result = execute_command(
                    "cd $frontend_git && git pull origin main 2>&1",
                    "Pulling latest frontend changes"
                );
            }

            // Step 3: Clone/Pull Backend
            log_output("Step 3: Setting up backend repository...", 'info');
            $backend_git = "$home/git/voiceactions-backend";
            
            if (!is_dir("$backend_git/.git")) {
                $result = execute_command(
                    "cd $backend_git && git clone https://github.com/valon92/voice-actions-sdk-.git . 2>&1",
                    "Cloning backend repository"
                );
                if (!$result['success']) $errors[] = "Backend clone failed";
            } else {
                $result = execute_command(
                    "cd $backend_git && git pull origin main 2>&1",
                    "Pulling latest backend changes"
                );
            }

            // Step 4: Build Frontend
            log_output("Step 4: Building frontend...", 'info');
            $frontend_dir = "$frontend_git/frontend";
            
            if (is_dir($frontend_dir)) {
                // Install dependencies
                if (!is_dir("$frontend_dir/node_modules")) {
                    $result = execute_command(
                        "cd $frontend_dir && npm install 2>&1",
                        "Installing frontend dependencies"
                    );
                    if (!$result['success']) $warnings[] = "Frontend npm install had issues";
                }

                // Build
                $result = execute_command(
                    "cd $frontend_dir && npm run build 2>&1",
                    "Building frontend"
                );
                
                if ($result['success']) {
                    // Copy to public_html
                    $dist_dir = "$frontend_dir/dist";
                    if (is_dir($dist_dir)) {
                        $result = execute_command(
                            "cp -r $dist_dir/* $home/public_html/ 2>&1",
                            "Copying frontend to public_html"
                        );
                        if (!$result['success']) $errors[] = "Frontend copy failed";
                    }
                } else {
                    $errors[] = "Frontend build failed";
                }
            } else {
                $warnings[] = "Frontend directory not found";
            }

            // Step 5: Setup Backend
            log_output("Step 5: Setting up backend...", 'info');
            $backend_dir = "$backend_git/backend";
            $api_dir = "$home/api.voiceactions.dev";

            if (is_dir($backend_dir)) {
                // Copy backend files
                $result = execute_command(
                    "cp -r $backend_dir/* $api_dir/ 2>&1",
                    "Copying backend files"
                );

                // Install Composer dependencies
                if (is_file("$api_dir/composer.json")) {
                    $result = execute_command(
                        "cd $api_dir && composer install --no-dev --optimize-autoloader 2>&1",
                        "Installing backend dependencies"
                    );
                    if (!$result['success']) $warnings[] = "Composer install had issues";
                }

                // Setup .env
                $env_file = "$api_dir/.env";
                if (!is_file($env_file)) {
                    $env_example = "$api_dir/.env.production.example";
                    if (is_file($env_example)) {
                        copy($env_example, $env_file);
                        log_output("Created .env from .env.production.example", 'success');
                    } else {
                        // Create basic .env
                        $env_content = <<<ENV
APP_NAME="Voice Actions SDK"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://api.voiceactions.dev

DB_CONNECTION=sqlite
DB_DATABASE=$api_dir/database/database.sqlite

CORS_ALLOWED_ORIGINS=https://voiceactions.dev,https://www.voiceactions.dev

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=lax
ENV;
                        file_put_contents($env_file, $env_content);
                        log_output("Created basic .env file", 'success');
                    }
                }

                // Generate app key
                if (is_file("$api_dir/artisan")) {
                    $result = execute_command(
                        "cd $api_dir && php artisan key:generate --force 2>&1",
                        "Generating app key"
                    );
                }

                // Setup database
                $db_file = "$api_dir/database/database.sqlite";
                if (!is_file($db_file)) {
                    touch($db_file);
                    chmod($db_file, 0664);
                    log_output("Created database file", 'success');
                }

                // Run migrations
                if (is_file("$api_dir/artisan")) {
                    $result = execute_command(
                        "cd $api_dir && php artisan migrate --force 2>&1",
                        "Running database migrations"
                    );
                    if (!$result['success']) $warnings[] = "Migrations had issues";
                }

                // Set permissions
                execute_command(
                    "chmod -R 755 $api_dir/storage $api_dir/bootstrap/cache 2>&1",
                    "Setting file permissions"
                );

                // Cache configuration
                if (is_file("$api_dir/artisan")) {
                    execute_command("cd $api_dir && php artisan config:cache 2>&1", "Caching config");
                    execute_command("cd $api_dir && php artisan route:cache 2>&1", "Caching routes");
                    execute_command("cd $api_dir && php artisan view:cache 2>&1", "Caching views");
                }
            } else {
                $errors[] = "Backend directory not found";
            }

            echo '</div>';

            // Summary
            echo '<div style="margin-top: 20px;">';
            if (empty($errors)) {
                log_output("✅ Setup completed successfully!", 'success');
                echo '<p style="margin-top: 15px;"><strong>Next steps:</strong></p>';
                echo '<ul style="margin-left: 20px; margin-top: 10px;">';
                echo '<li>Test frontend: <a href="https://voiceactions.dev" target="_blank">https://voiceactions.dev</a></li>';
                echo '<li>Test backend: <a href="https://api.voiceactions.dev/api/v1/commands/demo" target="_blank">https://api.voiceactions.dev/api/v1/commands/demo</a></li>';
                echo '<li><strong style="color: red;">IMPORTANT: Delete this file (auto-setup.php) for security!</strong></li>';
                echo '</ul>';
            } else {
                log_output("❌ Setup completed with errors. Please check the output above.", 'error');
                echo '<p style="margin-top: 15px;"><strong>Errors encountered:</strong></p>';
                echo '<ul style="margin-left: 20px; margin-top: 10px;">';
                foreach ($errors as $error) {
                    echo "<li style='color: red;'>$error</li>";
                }
                echo '</ul>';
            }
            
            if (!empty($warnings)) {
                echo '<p style="margin-top: 15px;"><strong>Warnings:</strong></p>';
                echo '<ul style="margin-left: 20px; margin-top: 10px;">';
                foreach ($warnings as $warning) {
                    echo "<li style='color: orange;'>$warning</li>";
                }
                echo '</ul>';
            }
            echo '</div>';
        } else {
            // Show setup form
            ?>
            <div class="step">
                <div class="step-title">📋 Para se të fillosh:</div>
                <ul style="margin-left: 20px; margin-top: 10px;">
                    <li>Sigurohu që ke SSH access në server</li>
                    <li>Verifiko që Node.js dhe Composer janë të instaluar</li>
                    <li>Kjo do të marrë 5-10 minuta</li>
                </ul>
            </div>

            <div class="step">
                <div class="step-title">⚠️ Siguri:</div>
                <p style="margin-top: 10px;">
                    <strong>PAS SETUP-IT, FSHI KËTË FILE!</strong> Ky file ka akses të plotë në server.
                </p>
            </div>

            <form method="POST" style="margin-top: 30px;">
                <button type="submit" name="run_setup" class="btn">
                    🚀 Start Auto Setup
                </button>
            </form>

            <div style="margin-top: 30px; padding: 15px; background: #fff3cd; border-radius: 5px; border-left: 4px solid #ffc107;">
                <strong>ℹ️ Informacion:</strong>
                <ul style="margin-left: 20px; margin-top: 10px;">
                    <li>Home directory: <code><?php echo $home; ?></code></li>
                    <li>Username: <code><?php echo $username; ?></code></li>
                    <li>Public HTML: <code><?php echo dirname(__FILE__); ?></code></li>
                </ul>
            </div>
            <?php
        }
        ?>
    </div>
</body>
</html>

