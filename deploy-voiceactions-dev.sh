#!/bin/bash

# Voice Actions SDK - Deployment Script për voiceactions.dev
# Server: server705.web-hosting.com
# Domain: voiceactions.dev
# Username: voicdwgn

set -e

# Colors
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
BLUE='\033[0;34m'
CYAN='\033[0;36m'
NC='\033[0m' # No Color

echo -e "${BLUE}╔════════════════════════════════════════════════════════╗${NC}"
echo -e "${BLUE}║  Voice Actions SDK - Deployment për voiceactions.dev  ║${NC}"
echo -e "${BLUE}╚════════════════════════════════════════════════════════╝${NC}"
echo ""

# Configuration
DOMAIN="voiceactions.dev"
USERNAME="voicdwgn"
SERVER="server705.web-hosting.com"
DEPLOY_PATH="/home/voicdwgn/public_html"
PACKAGE_NAME="voiceactions-dev-$(date +%Y%m%d-%H%M%S)"

# Check if we're in the project root
if [ ! -d "frontend" ] || [ ! -d "backend" ]; then
    echo -e "${RED}❌ Error: Please run this script from the project root${NC}"
    exit 1
fi

echo -e "${CYAN}📦 Step 1: Building frontend...${NC}"
cd frontend
npm install
npm run build
cd ..

echo -e "${CYAN}📦 Step 2: Building SDK...${NC}"
cd sdk
npm install
npm run build
cd ..

echo -e "${CYAN}📦 Step 3: Installing backend dependencies...${NC}"
cd backend
composer install --no-dev --optimize-autoloader
cd ..

echo -e "${CYAN}📦 Step 4: Creating deployment package...${NC}"
PACKAGE_DIR="packages/$PACKAGE_NAME"
mkdir -p "$PACKAGE_DIR"

# Copy frontend build
echo -e "${YELLOW}  → Copying frontend build...${NC}"
mkdir -p "$PACKAGE_DIR"
cp -r frontend/dist/* "$PACKAGE_DIR/"

# Copy SDK files
echo -e "${YELLOW}  → Copying SDK files...${NC}"
mkdir -p "$PACKAGE_DIR/sdk"
cp sdk/dist/voice-actions-sdk.min.js "$PACKAGE_DIR/sdk/"
cp sdk/dist/voice-actions-sdk.min.js.map "$PACKAGE_DIR/sdk/"

# Copy backend
echo -e "${YELLOW}  → Copying backend...${NC}"
mkdir -p "$PACKAGE_DIR/api"
cp -r backend/* "$PACKAGE_DIR/api/"

# Remove unnecessary files
echo -e "${YELLOW}  → Cleaning up...${NC}"
rm -rf "$PACKAGE_DIR/api/node_modules" 2>/dev/null || true
rm -rf "$PACKAGE_DIR/api/tests" 2>/dev/null || true
rm -rf "$PACKAGE_DIR/api/.git" 2>/dev/null || true
rm -rf "$PACKAGE_DIR/api/.env.example" 2>/dev/null || true

# Create .htaccess files
echo -e "${YELLOW}  → Creating .htaccess files...${NC}"

# Root .htaccess
cat > "$PACKAGE_DIR/.htaccess" << 'EOF'
<IfModule mod_rewrite.c>
    RewriteEngine On
    
    # API routes - redirect to Laravel backend
    RewriteCond %{REQUEST_URI} ^/api/(.*)$
    RewriteRule ^api/(.*)$ /api/public/index.php [L]
    
    # SDK routes - serve SDK files
    RewriteCond %{REQUEST_URI} ^/sdk/(.*)$
    RewriteRule ^sdk/(.*)$ /sdk/$1 [L]
    
    # Frontend routes - serve index.html
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ /index.html [L]
</IfModule>
EOF

# API public .htaccess
cat > "$PACKAGE_DIR/api/public/.htaccess" << 'EOF'
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
EOF

# Create deployment instructions
cat > "$PACKAGE_DIR/DEPLOY_INSTRUCTIONS.txt" << EOF
Voice Actions SDK - Deployment Instructions
===========================================

Server: ${SERVER}
Domain: ${DOMAIN}
Username: ${USERNAME}
Deploy Path: ${DEPLOY_PATH}

DEPLOYMENT STEPS:
=================

1. Upload this entire directory to cPanel File Manager:
   - Navigate to: /home/${USERNAME}/public_html
   - Upload all files

2. Set file permissions:
   - chmod 755 api/storage
   - chmod 755 api/bootstrap/cache
   - chmod 664 api/database/database.sqlite (if using SQLite)

3. Create .env file in api/ directory:
   - Copy api/.env.example to api/.env
   - Update database credentials
   - Update APP_URL=https://${DOMAIN}
   - Generate APP_KEY: php artisan key:generate

4. Create database:
   - Go to cPanel > MySQL Databases
   - Create database: ${USERNAME}_voiceactions
   - Create user and grant privileges

5. Run migrations:
   - php artisan migrate --force

6. Cache Laravel:
   - php artisan config:cache
   - php artisan route:cache
   - php artisan view:cache

7. Test:
   - Visit: https://${DOMAIN}
   - Test API: https://${DOMAIN}/api/platforms
   - Test SDK: https://${DOMAIN}/sdk/voice-actions-sdk.min.js

For detailed instructions, see: DEPLOY_VOICEACTIONS_DEV.md
EOF

# Create ZIP file
echo -e "${CYAN}📦 Step 5: Creating ZIP archive...${NC}"
cd packages
zip -r "${PACKAGE_NAME}.zip" "$PACKAGE_NAME" > /dev/null
cd ..

PACKAGE_SIZE=$(du -sh "packages/${PACKAGE_NAME}.zip" | cut -f1)

echo ""
echo -e "${GREEN}✅ Package created successfully!${NC}"
echo ""
echo -e "${CYAN}📦 Package Details:${NC}"
echo -e "   Name: ${PACKAGE_NAME}.zip"
echo -e "   Location: packages/${PACKAGE_NAME}.zip"
echo -e "   Size: ${PACKAGE_SIZE}"
echo ""
echo -e "${YELLOW}📤 Next Steps:${NC}"
echo -e "   1. Upload packages/${PACKAGE_NAME}.zip to cPanel File Manager"
echo -e "   2. Extract in /home/${USERNAME}/public_html"
echo -e "   3. Follow instructions in DEPLOY_INSTRUCTIONS.txt"
echo ""
echo -e "${BLUE}📚 For detailed instructions, see: DEPLOY_VOICEACTIONS_DEV.md${NC}"
echo ""

