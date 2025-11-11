#!/bin/bash

# Voice Actions SDK - Production Build Script
# Kjo script krijon një strukturë të plotë për production që mund të vendoset direkt në public_html

set -e

# Colors
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
BLUE='\033[0;34m'
NC='\033[0m'

echo -e "${BLUE}🚀 Voice Actions SDK - Production Build${NC}"
echo ""

# Check if we're in the project root
if [ ! -f "package.json" ] && [ ! -f "composer.json" ]; then
    echo -e "${RED}❌ Error: Please run this script from the project root${NC}"
    exit 1
fi

# Create production directory
PROD_DIR="production-build"
echo -e "${YELLOW}📁 Creating production directory: $PROD_DIR${NC}"
rm -rf $PROD_DIR
mkdir -p $PROD_DIR

# Step 1: Build Frontend with Production Config
echo -e "${YELLOW}📦 Step 1: Building frontend for production...${NC}"
cd frontend

# Create production .env file
cat > .env.production << EOF
VITE_API_URL=https://api.voiceactions.dev/api
VITE_SENTRY_DSN=
VITE_SENTRY_TRACES_SAMPLE_RATE=0.1
VITE_SENTRY_REPLAYS_SESSION_SAMPLE_RATE=0.1
EOF

# Install dependencies if needed
if [ ! -d "node_modules" ]; then
    echo "Installing frontend dependencies..."
    npm install
fi

# Build frontend
npm run build

# Copy frontend build to production directory
echo -e "${GREEN}✓ Frontend built${NC}"
cp -r dist/* ../$PROD_DIR/
cd ..

# Step 2: Prepare Backend
echo -e "${YELLOW}📦 Step 2: Preparing backend for production...${NC}"
cd backend

# Install dependencies if needed
if [ ! -d "vendor" ]; then
    echo "Installing backend dependencies..."
    composer install --no-dev --optimize-autoloader
fi

# Create production .env file
cat > .env.production << EOF
APP_NAME="Voice Actions SDK"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://api.voiceactions.dev

DB_CONNECTION=sqlite
DB_DATABASE=/home/voicdwgn/api.voiceactions.dev/database/database.sqlite

CORS_ALLOWED_ORIGINS=https://voiceactions.dev,https://www.voiceactions.dev

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=lax

LOG_CHANNEL=stack
LOG_LEVEL=error

SENTRY_LARAVEL_DSN=
SENTRY_TRACES_SAMPLE_RATE=0.1
EOF

# Cache configuration
php artisan config:cache --env=production
php artisan route:cache --env=production
php artisan view:cache --env=production

# Copy backend to production directory
mkdir -p ../$PROD_DIR/api
cp -r * ../$PROD_DIR/api/
cd ..

# Step 3: Create .htaccess for frontend
echo -e "${YELLOW}📝 Step 3: Creating .htaccess files...${NC}"
cat > $PROD_DIR/.htaccess << 'EOF'
# Voice Actions SDK - Frontend .htaccess

# Enable Rewrite Engine
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /
    
    # Handle Angular/Vue Router - redirect all requests to index.html
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ /index.html [L]
</IfModule>

# Security Headers
<IfModule mod_headers.c>
    Header set X-Content-Type-Options "nosniff"
    Header set X-Frame-Options "SAMEORIGIN"
    Header set X-XSS-Protection "1; mode=block"
    Header set Referrer-Policy "strict-origin-when-cross-origin"
</IfModule>

# Compression
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css text/javascript application/javascript application/json
</IfModule>

# Cache Control
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType image/jpg "access plus 1 year"
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/gif "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType image/svg+xml "access plus 1 year"
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
    ExpiresByType application/json "access plus 0 seconds"
    ExpiresByType text/html "access plus 0 seconds"
</IfModule>

# Prevent access to sensitive files
<FilesMatch "^\.">
    Order allow,deny
    Deny from all
</FilesMatch>
EOF

# Step 4: Create backend .htaccess
cat > $PROD_DIR/api/public/.htaccess << 'EOF'
# Voice Actions SDK - Backend .htaccess

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

# Step 5: Create deployment instructions
echo -e "${YELLOW}📝 Step 4: Creating deployment instructions...${NC}"
cat > $PROD_DIR/DEPLOYMENT_INSTRUCTIONS.md << 'EOF'
# 🚀 Deployment Instructions

## 📋 Hapat për Deployment

### 1. Upload Frontend Files
Kopjo të gjitha filet nga kjo directory në `~/public_html/`:
```bash
cp -r * ~/public_html/
```

### 2. Upload Backend Files
Kopjo `api/` directory në `~/api.voiceactions.dev/`:
```bash
cp -r api/* ~/api.voiceactions.dev/
```

### 3. Setup Backend Environment
```bash
cd ~/api.voiceactions.dev
cp .env.production .env
php artisan key:generate
```

### 4. Setup Database
```bash
cd ~/api.voiceactions.dev
mkdir -p database
touch database/database.sqlite
chmod 664 database/database.sqlite
php artisan migrate --force
```

### 5. Set Permissions
```bash
chmod -R 755 ~/api.voiceactions.dev/storage
chmod -R 755 ~/api.voiceactions.dev/bootstrap/cache
chmod 644 ~/api.voiceactions.dev/.env
```

### 6. Cache Configuration
```bash
cd ~/api.voiceactions.dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## ✅ Verifikimi

1. Test frontend: https://voiceactions.dev
2. Test backend: https://api.voiceactions.dev/api/v1/commands/demo

## 📝 Shënime

- Të gjitha konfigurimet janë për production
- API URL është konfiguruar për `https://api.voiceactions.dev/api`
- Frontend është i build-uar dhe gati për production
- Backend është i konfiguruar për production
EOF

# Step 6: Create quick deploy script
cat > $PROD_DIR/deploy.sh << 'EOF'
#!/bin/bash
# Quick deployment script - Run this on the server

set -e

HOME_DIR=$(eval echo ~$USER)
echo "Deploying to $HOME_DIR..."

# Deploy frontend
echo "Deploying frontend..."
cp -r * $HOME_DIR/public_html/ 2>/dev/null || true

# Deploy backend
echo "Deploying backend..."
mkdir -p $HOME_DIR/api.voiceactions.dev
cp -r api/* $HOME_DIR/api.voiceactions.dev/

# Setup backend
cd $HOME_DIR/api.voiceactions.dev
if [ ! -f ".env" ]; then
    cp .env.production .env
    php artisan key:generate
fi

# Setup database
mkdir -p database
touch database/database.sqlite
chmod 664 database/database.sqlite
php artisan migrate --force

# Set permissions
chmod -R 755 storage bootstrap/cache
chmod 644 .env

# Cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Deployment completed!"
EOF
chmod +x $PROD_DIR/deploy.sh

# Step 7: Create README
cat > $PROD_DIR/README.md << 'EOF'
# Voice Actions SDK - Production Build

Kjo është struktura e plotë e build-uar për production.

## 📁 Struktura

```
production-build/
├── index.html          # Frontend entry point
├── assets/             # Frontend assets (JS, CSS)
├── .htaccess           # Frontend Apache config
├── api/                # Backend Laravel application
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── public/         # Backend entry point
│   ├── routes/
│   ├── storage/
│   ├── vendor/
│   └── .env.production
└── deploy.sh           # Quick deployment script
```

## 🚀 Deployment

### Metoda 1: Quick Deploy (në server)
```bash
cd production-build
./deploy.sh
```

### Metoda 2: Manual Deploy
Shih `DEPLOYMENT_INSTRUCTIONS.md`

## ✅ Pas Deployment

1. Test: https://voiceactions.dev
2. Test API: https://api.voiceactions.dev/api/v1/commands/demo

## 📝 Shënime

- Frontend është i build-uar me production config
- Backend është i konfiguruar për production
- API URL: https://api.voiceactions.dev/api
- Të gjitha filet janë gati për production
EOF

echo ""
echo -e "${GREEN}✅ Production build completed!${NC}"
echo ""
echo -e "${BLUE}📁 Production files are in: $PROD_DIR/${NC}"
echo ""
echo -e "${YELLOW}📋 Next steps:${NC}"
echo "1. Upload $PROD_DIR/* to ~/public_html/"
echo "2. Upload $PROD_DIR/api/* to ~/api.voiceactions.dev/"
echo "3. Run: cd ~/api.voiceactions.dev && cp .env.production .env && php artisan key:generate"
echo "4. Run: php artisan migrate --force"
echo ""
echo -e "${BLUE}Ose përdor:${NC}"
echo "   cd $PROD_DIR && ./deploy.sh (në server)"

