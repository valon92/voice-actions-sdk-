#!/bin/bash

# Voice Actions SDK - Create cPanel Deployment Package
# Kjo script krijon një .zip file të gatshëm për deployment në cPanel

set -e

# Colors
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
BLUE='\033[0;34m'
CYAN='\033[0;36m'
NC='\033[0m' # No Color

echo -e "${BLUE}╔════════════════════════════════════════════════════════╗${NC}"
echo -e "${BLUE}║  Voice Actions SDK - cPanel Package Creator          ║${NC}"
echo -e "${BLUE}╚════════════════════════════════════════════════════════╝${NC}"
echo ""

# Check if we're in the project root
if [ ! -d "frontend" ] || [ ! -d "backend" ]; then
    echo -e "${RED}❌ Error: Please run this script from the project root${NC}"
    exit 1
fi

# Create package directory
PACKAGE_NAME="voiceactions-cpanel-$(date +%Y%m%d-%H%M%S)"
PACKAGE_DIR="packages/$PACKAGE_NAME"
mkdir -p "$PACKAGE_DIR"

echo -e "${CYAN}📦 Creating package: ${YELLOW}$PACKAGE_NAME${NC}"
echo ""

# Step 1: Build Frontend
echo -e "${CYAN}1️⃣  Building Frontend...${NC}"
cd frontend

if [ ! -d "node_modules" ]; then
    echo -e "${YELLOW}   Installing frontend dependencies...${NC}"
    npm install --silent
fi

echo -e "${YELLOW}   Building frontend for production...${NC}"
npm run build

if [ ! -d "dist" ]; then
    echo -e "${RED}❌ Error: Frontend build failed - dist/ directory not found${NC}"
    exit 1
fi

echo -e "${GREEN}   ✅ Frontend built successfully${NC}"
cd ..

# Step 2: Prepare Backend
echo -e "${CYAN}2️⃣  Preparing Backend...${NC}"
cd backend

if [ ! -d "vendor" ]; then
    echo -e "${YELLOW}   Installing backend dependencies...${NC}"
    composer install --optimize-autoloader --no-dev --no-interaction --quiet
fi

echo -e "${GREEN}   ✅ Backend prepared${NC}"
cd ..

# Step 3: Create package structure
echo -e "${CYAN}3️⃣  Creating package structure...${NC}"

# Frontend files
echo -e "${YELLOW}   Copying frontend files...${NC}"
mkdir -p "$PACKAGE_DIR/frontend"
cp -r frontend/dist/* "$PACKAGE_DIR/frontend/"

# Backend files (exclude unnecessary files)
echo -e "${YELLOW}   Copying backend files...${NC}"
mkdir -p "$PACKAGE_DIR/backend"

# Copy backend files excluding unnecessary ones
rsync -av --progress \
    --exclude='node_modules' \
    --exclude='.git' \
    --exclude='tests' \
    --exclude='.env' \
    --exclude='.env.example' \
    --exclude='storage/logs/*' \
    --exclude='storage/framework/cache/*' \
    --exclude='storage/framework/sessions/*' \
    --exclude='storage/framework/views/*' \
    --exclude='bootstrap/cache/*' \
    backend/ "$PACKAGE_DIR/backend/"

# Create .env.example from template
if [ -f "backend/.env.example" ]; then
    cp backend/.env.example "$PACKAGE_DIR/backend/.env.example"
elif [ ! -f "$PACKAGE_DIR/backend/.env.example" ]; then
    # Create basic .env.example
    cat > "$PACKAGE_DIR/backend/.env.example" << 'EOF'
APP_NAME="Voice Actions SDK"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://api.voiceactions.dev

LOG_CHANNEL=stack
LOG_LEVEL=error

# Database Configuration
DB_CONNECTION=sqlite
DB_DATABASE=/home/username/api.voiceactions.dev/database/database.sqlite

# CORS Configuration
CORS_ALLOWED_ORIGINS=https://voiceactions.dev,https://www.voiceactions.dev

# Session Configuration
SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=lax

# Cache Configuration
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
EOF
fi

# Step 4: Create deployment instructions
echo -e "${CYAN}4️⃣  Creating deployment instructions...${NC}"

cat > "$PACKAGE_DIR/DEPLOY_INSTRUCTIONS.md" << 'EOF'
# 🚀 Voice Actions SDK - cPanel Deployment Instructions

## 📋 Quick Deployment Guide

### Hapi 1: Upload Files në cPanel

#### Frontend Deployment:
1. Hap **File Manager** në cPanel
2. Shko te `public_html/`
3. Upload **TË GJITHA** file-at nga `frontend/` directory:
   - `index.html`
   - `assets/` (të gjitha file-at)

#### Backend Deployment:
1. Krijo subdomain `api.voiceactions.dev` në cPanel:
   - Shko te **Subdomains**
   - Krijo subdomain: `api`
   - Document Root: `~/api.voiceactions.dev`
   
2. Upload **TË GJITHA** file-at nga `backend/` directory në:
   - `~/api.voiceactions.dev/`

**OSE** nëse përdor subdirectory:
- Upload në `~/public_html/api/`

### Hapi 2: Konfiguro .env File

1. Në cPanel File Manager, shko te `~/api.voiceactions.dev/`
2. Krijo `.env` file:
   - Kopjo `.env.example` dhe riemërso në `.env`
   - Ose krijo manualisht

3. Edito `.env` file me vlerat e tua:

```env
APP_NAME="Voice Actions SDK"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://api.voiceactions.dev

# Database (SQLite - më e thjeshtë)
DB_CONNECTION=sqlite
DB_DATABASE=/home/username/api.voiceactions.dev/database/database.sqlite

# Ose MySQL
# DB_CONNECTION=mysql
# DB_HOST=localhost
# DB_DATABASE=your_database
# DB_USERNAME=your_username
# DB_PASSWORD=your_password

# CORS
CORS_ALLOWED_ORIGINS=https://voiceactions.dev,https://www.voiceactions.dev
```

### Hapi 3: Setup Backend

Hap **Terminal** në cPanel (ose përdor SSH) dhe ekzekuto:

```bash
# Shko te backend directory
cd ~/api.voiceactions.dev

# Generate app key
php artisan key:generate

# Krijo database file (nëse përdor SQLite)
mkdir -p database
touch database/database.sqlite
chmod 664 database/database.sqlite

# Run migrations
php artisan migrate

# Set file permissions
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chmod 644 .env

# Cache Laravel configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Hapi 4: Test Deployment

1. **Test Frontend:**
   - Hap browser: `https://voiceactions.dev`
   - Duhet të shfaqet homepage

2. **Test Backend API:**
   - Hap browser: `https://api.voiceactions.dev/api/commands/demo?locale=en-US&platform_name=stargate-ci`
   - Duhet të kthejë JSON me commands

3. **Test Registration:**
   ```bash
   curl -X POST https://api.voiceactions.dev/api/platforms/register \
     -H "Content-Type: application/json" \
     -d '{"name":"Test Platform","email":"test@example.com"}'
   ```

## 🔧 Troubleshooting

### Problem: 500 Internal Server Error

**Zgjidhja:**
```bash
cd ~/api.voiceactions.dev
tail -f storage/logs/laravel.log  # Shiko errors
php artisan config:clear
php artisan cache:clear
chmod -R 755 storage bootstrap/cache
```

### Problem: CORS Errors

**Zgjidhja:**
1. Verifiko `CORS_ALLOWED_ORIGINS` në `.env`
2. Clear cache: `php artisan config:clear && php artisan config:cache`

### Problem: Database Connection Failed

**Zgjidhja:**
1. Verifiko database credentials në `.env`
2. Për SQLite: `chmod 664 database/database.sqlite`
3. Për MySQL: Verifiko që database user ka permissions

### Problem: Frontend nuk ngarkohet

**Zgjidhja:**
1. Verifiko që `index.html` është në `public_html/`
2. Kontrollo browser console për errors
3. Verifiko që `assets/` directory ekziston

## 📞 Need Help?

Për më shumë detaje, shiko:
- `DEPLOY_CPANEL.md` - Udhëzime të detajuara
- `CPANEL_QUICK_START.md` - Quick start guide

---

**Package Version:** 1.0.0  
**Created:** $(date)
EOF

# Step 5: Create README
cat > "$PACKAGE_DIR/README.txt" << 'EOF'
╔════════════════════════════════════════════════════════╗
║     Voice Actions SDK - cPanel Deployment Package     ║
╚════════════════════════════════════════════════════════╝

KY PACKAGE ËSHTË GATI PËR DEPLOYMENT NË CPANEL!

📁 Struktura e Package:
├── frontend/          → Upload në ~/public_html/
├── backend/           → Upload në ~/api.voiceactions.dev/
└── DEPLOY_INSTRUCTIONS.md  → Lexo këtë file për udhëzime

🚀 Quick Start:
1. Extract këtë .zip file
2. Lexo DEPLOY_INSTRUCTIONS.md
3. Upload files në cPanel
4. Konfiguro .env file
5. Run: php artisan key:generate
6. Run: php artisan migrate

✅ Pas deployment:
- Frontend: https://voiceactions.dev
- Backend: https://api.voiceactions.dev/api/commands/demo

Për më shumë detaje, shiko DEPLOY_INSTRUCTIONS.md

---
Package Created: $(date)
EOF

# Step 6: Create .htaccess for backend (if subdirectory)
cat > "$PACKAGE_DIR/backend/.htaccess" << 'EOF'
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

# Step 7: Create zip archive
echo -e "${CYAN}5️⃣  Creating ZIP archive...${NC}"
cd packages
zip -r "${PACKAGE_NAME}.zip" "$PACKAGE_NAME" -q
cd ..

# Calculate sizes
FRONTEND_SIZE=$(du -sh "$PACKAGE_DIR/frontend" | cut -f1)
BACKEND_SIZE=$(du -sh "$PACKAGE_DIR/backend" | cut -f1)
ZIP_SIZE=$(du -sh "packages/${PACKAGE_NAME}.zip" | cut -f1)

# Summary
echo ""
echo -e "${GREEN}╔════════════════════════════════════════════════════════╗${NC}"
echo -e "${GREEN}║  ✅ Package Created Successfully!                     ║${NC}"
echo -e "${GREEN}╚════════════════════════════════════════════════════════╝${NC}"
echo ""
echo -e "${CYAN}📦 Package Information:${NC}"
echo -e "   Name: ${YELLOW}$PACKAGE_NAME${NC}"
echo -e "   Location: ${YELLOW}packages/${PACKAGE_NAME}${NC}"
echo -e "   ZIP File: ${YELLOW}packages/${PACKAGE_NAME}.zip${NC}"
echo ""
echo -e "${CYAN}📊 Package Sizes:${NC}"
echo -e "   Frontend: ${GREEN}$FRONTEND_SIZE${NC}"
echo -e "   Backend:  ${GREEN}$BACKEND_SIZE${NC}"
echo -e "   ZIP:      ${GREEN}$ZIP_SIZE${NC}"
echo ""
echo -e "${BLUE}📋 Next Steps:${NC}"
echo ""
echo "1. 📤 Upload ZIP file në cPanel:"
echo -e "   ${YELLOW}packages/${PACKAGE_NAME}.zip${NC}"
echo ""
echo "2. 📁 Extract në cPanel File Manager"
echo ""
echo "3. 📖 Lexo instruksionet:"
echo -e "   ${CYAN}DEPLOY_INSTRUCTIONS.md${NC} (në package)"
echo ""
echo "4. 🚀 Follow deployment steps në instruksione"
echo ""
echo -e "${GREEN}✅ Package është gati për deployment!${NC}"
echo ""

