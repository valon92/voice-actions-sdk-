#!/bin/bash

# Voice Actions SDK - Server Setup Script
# Run this script AFTER connecting via SSH to your cPanel server
# Usage: ./setup-server.sh

set -e

# Colors
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
BLUE='\033[0;34m'
NC='\033[0m'

echo -e "${BLUE}🚀 Voice Actions SDK - Server Setup${NC}"
echo ""

# Check if we're on the server
if [ ! -d "$HOME/public_html" ]; then
    echo -e "${RED}❌ Error: This script should be run on the cPanel server${NC}"
    exit 1
fi

# Get username from home directory
USERNAME=$(basename $HOME)
echo -e "${GREEN}✓ Detected username: $USERNAME${NC}"
echo ""

# Step 1: Setup Git Version Control
echo -e "${YELLOW}📦 Step 1: Setting up Git Version Control...${NC}"
echo ""
echo "Please configure Git Version Control in cPanel:"
echo "1. Go to cPanel → Git Version Control"
echo "2. Click 'Create'"
echo "3. Configure:"
echo "   - Repository Name: voiceactions-frontend"
echo "   - Repository URL: https://github.com/valon92/voice-actions-sdk-.git"
echo "   - Repository Branch: main"
echo "   - Deployment Path: $HOME/public_html"
echo ""
read -p "Press Enter after configuring Git Version Control..."

# Step 2: Create API subdomain directory
echo -e "${YELLOW}📁 Step 2: Creating API subdomain directory...${NC}"
if [ ! -d "$HOME/api.voiceactions.dev" ]; then
    mkdir -p $HOME/api.voiceactions.dev
    echo -e "${GREEN}✓ Created $HOME/api.voiceactions.dev${NC}"
else
    echo -e "${YELLOW}⚠ Directory already exists${NC}"
fi

# Step 3: Setup backend Git repository
echo -e "${YELLOW}📦 Step 3: Setting up backend Git repository...${NC}"
if [ ! -d "$HOME/git/voiceactions-backend" ]; then
    mkdir -p $HOME/git/voiceactions-backend
    cd $HOME/git/voiceactions-backend
    git clone https://github.com/valon92/voice-actions-sdk-.git .
    git checkout main
    echo -e "${GREEN}✓ Backend repository cloned${NC}"
else
    echo -e "${YELLOW}⚠ Backend repository already exists${NC}"
    cd $HOME/git/voiceactions-backend
    git pull origin main
fi

# Step 4: Build and deploy frontend
echo -e "${YELLOW}🏗️  Step 4: Building frontend...${NC}"
if [ -d "$HOME/git/voiceactions-frontend" ]; then
    cd $HOME/git/voiceactions-frontend/frontend
    if [ ! -d "node_modules" ]; then
        npm install
    fi
    npm run build
    echo -e "${GREEN}✓ Frontend built${NC}"
    
    # Copy to public_html
    cp -r dist/* $HOME/public_html/
    echo -e "${GREEN}✓ Frontend deployed to public_html${NC}"
else
    echo -e "${YELLOW}⚠ Frontend repository not found. Please configure Git Version Control first.${NC}"
fi

# Step 5: Build and deploy backend
echo -e "${YELLOW}🏗️  Step 5: Building backend...${NC}"
cd $HOME/git/voiceactions-backend/backend

# Install Composer dependencies
if [ ! -d "vendor" ]; then
    composer install --no-dev --optimize-autoloader
    echo -e "${GREEN}✓ Backend dependencies installed${NC}"
fi

# Copy backend files to API directory
cp -r * $HOME/api.voiceactions.dev/
echo -e "${GREEN}✓ Backend files copied to api.voiceactions.dev${NC}"

# Step 6: Setup environment file
echo -e "${YELLOW}⚙️  Step 6: Setting up environment file...${NC}"
cd $HOME/api.voiceactions.dev

if [ ! -f ".env" ]; then
    if [ -f ".env.production.example" ]; then
        cp .env.production.example .env
        echo -e "${GREEN}✓ Created .env from .env.production.example${NC}"
    else
        echo -e "${YELLOW}⚠ .env.production.example not found. Creating basic .env...${NC}"
        cat > .env << EOF
APP_NAME="Voice Actions SDK"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://api.voiceactions.dev

DB_CONNECTION=sqlite
DB_DATABASE=$HOME/api.voiceactions.dev/database/database.sqlite

CORS_ALLOWED_ORIGINS=https://voiceactions.dev,https://www.voiceactions.dev

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=lax
EOF
    fi
    
    # Generate app key
    php artisan key:generate
    echo -e "${GREEN}✓ App key generated${NC}"
else
    echo -e "${YELLOW}⚠ .env already exists${NC}"
fi

# Step 7: Setup database
echo -e "${YELLOW}🗄️  Step 7: Setting up database...${NC}"
cd $HOME/api.voiceactions.dev

# Create database directory if it doesn't exist
mkdir -p database
touch database/database.sqlite
chmod 664 database/database.sqlite

# Run migrations
php artisan migrate --force
echo -e "${GREEN}✓ Database migrations completed${NC}"

# Step 8: Set permissions
echo -e "${YELLOW}🔐 Step 8: Setting file permissions...${NC}"
chmod -R 755 $HOME/api.voiceactions.dev/storage
chmod -R 755 $HOME/api.voiceactions.dev/bootstrap/cache
chmod 644 $HOME/api.voiceactions.dev/.env
echo -e "${GREEN}✓ Permissions set${NC}"

# Step 9: Cache configuration
echo -e "${YELLOW}⚡ Step 9: Caching configuration...${NC}"
cd $HOME/api.voiceactions.dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo -e "${GREEN}✓ Configuration cached${NC}"

# Step 10: Setup webhook (optional)
echo -e "${YELLOW}🔗 Step 10: Setting up webhook (optional)...${NC}"
if [ ! -f "$HOME/public_html/cpanel-webhook.php" ]; then
    echo "Would you like to setup auto-deployment webhook? (y/n)"
    read -p "> " setup_webhook
    
    if [ "$setup_webhook" = "y" ]; then
        # Download webhook file from GitHub or create it
        cat > $HOME/public_html/cpanel-webhook.php << 'WEBHOOK_EOF'
<?php
// Webhook handler - configure secret in GitHub
$webhook_secret = 'CHANGE_THIS_SECRET';
$payload = file_get_contents('php://input');
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';

if (!empty($webhook_secret)) {
    $expected = 'sha256=' . hash_hmac('sha256', $payload, $webhook_secret);
    if (!hash_equals($expected, $signature)) {
        http_response_code(401);
        die('Unauthorized');
    }
}

$data = json_decode($payload, true);
if ($data['ref'] === 'refs/heads/main') {
    $git_dir = dirname(__FILE__) . '/../git/voiceactions-frontend';
    shell_exec("cd $git_dir && git pull origin main 2>&1");
    shell_exec("cd $git_dir/frontend && npm install && npm run build 2>&1");
    shell_exec("cp -r $git_dir/frontend/dist/* " . dirname(__FILE__) . "/ 2>&1");
    echo "Deployed";
}
WEBHOOK_EOF
        chmod 644 $HOME/public_html/cpanel-webhook.php
        echo -e "${GREEN}✓ Webhook file created${NC}"
        echo -e "${YELLOW}⚠ Remember to:${NC}"
        echo "  1. Update webhook secret in cpanel-webhook.php"
        echo "  2. Configure webhook in GitHub with the same secret"
    fi
else
    echo -e "${YELLOW}⚠ Webhook file already exists${NC}"
fi

echo ""
echo -e "${GREEN}✅ Server setup completed!${NC}"
echo ""
echo -e "${BLUE}📋 Next steps:${NC}"
echo ""
echo "1. ✅ Verify frontend: https://voiceactions.dev"
echo "2. ✅ Verify backend: https://api.voiceactions.dev/api/v1/commands/demo"
echo "3. ⚙️  Update .env with production values (Sentry, email, etc.)"
echo "4. 🔐 Configure SSL certificates in cPanel"
echo "5. 📊 Setup monitoring and error tracking"
echo ""
echo -e "${BLUE}📚 For detailed information, see CPANEL_DEPLOYMENT.md${NC}"

