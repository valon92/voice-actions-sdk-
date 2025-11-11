#!/bin/bash

# Voice Actions SDK - Create Complete Production Package
# Kjo script krijon një package të plotë që mund të vendoset direkt në public_html

set -e

# Colors
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
BLUE='\033[0;34m'
NC='\033[0m'

echo -e "${BLUE}🚀 Voice Actions SDK - Complete Production Package${NC}"
echo ""

# Check if we're in the project root
if [ ! -d "frontend" ] || [ ! -d "backend" ]; then
    echo -e "${RED}❌ Error: Please run this script from the project root (must have frontend/ and backend/ directories)${NC}"
    exit 1
fi

# Create production package directory
PACKAGE_DIR="voiceactions-production"
echo -e "${YELLOW}📁 Creating production package: $PACKAGE_DIR${NC}"
rm -rf $PACKAGE_DIR
mkdir -p $PACKAGE_DIR

# Step 1: Fix frontend hardcoded URLs
echo -e "${YELLOW}🔧 Step 1: Fixing frontend URLs for production...${NC}"
cd frontend/src

# Replace localhost:8000 with production API URL
find . -type f -name "*.vue" -o -name "*.js" | xargs sed -i.bak 's|http://localhost:8000|https://api.voiceactions.dev|g'
find . -type f -name "*.vue" -o -name "*.js" | xargs sed -i.bak 's|localhost:8000|api.voiceactions.dev|g'

# Clean up backup files
find . -name "*.bak" -delete

cd ../..

# Step 2: Build Frontend with Production Config
echo -e "${YELLOW}📦 Step 2: Building frontend for production...${NC}"
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
VITE_API_URL=https://api.voiceactions.dev/api npm run build

# Copy frontend build to package
echo -e "${GREEN}✓ Frontend built${NC}"
cp -r dist/* ../$PACKAGE_DIR/
cd ..

# Step 3: Prepare Backend
echo -e "${YELLOW}📦 Step 3: Preparing backend for production...${NC}"
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

# Copy backend to package
mkdir -p ../$PACKAGE_DIR/api
cp -r * ../$PACKAGE_DIR/api/
cd ..

# Step 4: Create .htaccess for frontend
echo -e "${YELLOW}📝 Step 4: Creating configuration files...${NC}"
cat > $PACKAGE_DIR/.htaccess << 'EOF'
# Voice Actions SDK - Frontend .htaccess

<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /
    
    # Handle Vue Router - redirect all requests to index.html
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
EOF

# Step 5: Create deployment script
cat > $PACKAGE_DIR/deploy-to-public-html.sh << 'EOF'
#!/bin/bash
# Deploy to public_html - Run this on the server

set -e

HOME_DIR=$(eval echo ~$USER)
echo "🚀 Deploying Voice Actions SDK to $HOME_DIR..."

# Deploy frontend to public_html
echo "📦 Deploying frontend to public_html..."
cp -r index.html assets .htaccess $HOME_DIR/public_html/ 2>/dev/null || true
# Copy all other frontend files
find . -maxdepth 1 -type f -not -name "*.sh" -not -name "*.md" -not -name "api" -exec cp {} $HOME_DIR/public_html/ \;

# Deploy backend to api subdomain
echo "📦 Deploying backend to api.voiceactions.dev..."
mkdir -p $HOME_DIR/api.voiceactions.dev
cp -r api/* $HOME_DIR/api.voiceactions.dev/

# Setup backend environment
echo "⚙️  Setting up backend environment..."
cd $HOME_DIR/api.voiceactions.dev
if [ ! -f ".env" ]; then
    if [ -f ".env.production" ]; then
        cp .env.production .env
    fi
    php artisan key:generate --force
fi

# Setup database
echo "🗄️  Setting up database..."
mkdir -p database
touch database/database.sqlite
chmod 664 database/database.sqlite
php artisan migrate --force

# Set permissions
echo "🔐 Setting permissions..."
chmod -R 755 storage bootstrap/cache
chmod 644 .env

# Cache configuration
echo "⚡ Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo ""
echo "✅ Deployment completed!"
echo ""
echo "📋 Next steps:"
echo "1. Test frontend: https://voiceactions.dev"
echo "2. Test backend: https://api.voiceactions.dev/api/v1/commands/demo"
echo "3. Configure SSL certificates in cPanel"
EOF
chmod +x $PACKAGE_DIR/deploy-to-public-html.sh

# Step 6: Create README
cat > $PACKAGE_DIR/README.md << 'EOF'
# 🚀 Voice Actions SDK - Production Package

Kjo është package e plotë e gatshme për production. Mund të vendoset direkt në `public_html` dhe të funksionojë pa ndryshime.

## 📁 Çfarë përmban

- ✅ Frontend i build-uar (Vue.js + Vite)
- ✅ Backend i konfiguruar (Laravel)
- ✅ .htaccess files për Apache
- ✅ Deployment script automatik
- ✅ Konfigurim për production

## 🚀 Deployment (3 hapa)

### Hapi 1: Upload Package
Upload të gjithë këtë directory në server (përmes FTP, cPanel File Manager, ose SSH)

### Hapi 2: Ekzekuto Deployment Script
```bash
cd voiceactions-production
./deploy-to-public-html.sh
```

### Hapi 3: Verifiko
- Frontend: https://voiceactions.dev
- Backend: https://api.voiceactions.dev/api/v1/commands/demo

## 📝 Shënime

- Të gjitha URL-të janë konfiguruar për production
- API URL: `https://api.voiceactions.dev/api`
- Frontend është i build-uar dhe gati
- Backend është i konfiguruar për production
- Database do të krijohet automatikisht

## 🔧 Manual Deployment (nëse script-i nuk funksionon)

1. **Frontend:**
   ```bash
   cp -r * ~/public_html/
   ```

2. **Backend:**
   ```bash
   mkdir -p ~/api.voiceactions.dev
   cp -r api/* ~/api.voiceactions.dev/
   cd ~/api.voiceactions.dev
   cp .env.production .env
   php artisan key:generate
   php artisan migrate --force
   chmod -R 755 storage bootstrap/cache
   php artisan config:cache
   ```

## ✅ Pas Deployment

Gjithçka duhet të funksionojë si në localhost!
EOF

# Step 7: Create .gitignore for package
cat > $PACKAGE_DIR/.gitignore << 'EOF'
# Ignore everything - this is a production package
*
!.gitignore
!README.md
!deploy-to-public-html.sh
EOF

echo ""
echo -e "${GREEN}✅ Production package created!${NC}"
echo ""
echo -e "${BLUE}📁 Package location: $PACKAGE_DIR/${NC}"
echo ""
echo -e "${YELLOW}📋 Deployment:${NC}"
echo "1. Upload $PACKAGE_DIR/ në server"
echo "2. SSH në server: cd voiceactions-production"
echo "3. Run: ./deploy-to-public-html.sh"
echo ""
echo -e "${GREEN}🎉 Gati për deployment!${NC}"

