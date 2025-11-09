#!/bin/bash

# Voice Actions SDK - Deployment Script for voiceactions.dev
# Usage: ./deploy.sh [staging|production]

set -e

ENVIRONMENT=${1:-production}
echo "🚀 Starting deployment to voiceactions.dev ($ENVIRONMENT)..."

# Colors for output
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# Check if we're in the project root
if [ ! -f "package.json" ] && [ ! -f "composer.json" ]; then
    echo -e "${RED}❌ Error: Please run this script from the project root${NC}"
    exit 1
fi

# Build Frontend
echo -e "${YELLOW}📦 Building frontend...${NC}"
cd frontend
if [ ! -d "node_modules" ]; then
    echo "Installing frontend dependencies..."
    npm install
fi

if [ "$ENVIRONMENT" = "production" ]; then
    npm run build
    echo -e "${GREEN}✅ Frontend built successfully${NC}"
else
    echo "Skipping build for staging (use production for full build)"
fi
cd ..

# Prepare Backend
echo -e "${YELLOW}📦 Preparing backend...${NC}"
cd backend
if [ ! -d "vendor" ]; then
    echo "Installing backend dependencies..."
    composer install --optimize-autoloader --no-dev
fi

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo -e "${GREEN}✅ Backend prepared successfully${NC}"
cd ..

# Build SDK (optional, for CDN)
echo -e "${YELLOW}📦 Building SDK...${NC}"
cd sdk
if [ ! -d "node_modules" ]; then
    echo "Installing SDK dependencies..."
    npm install
fi
npm run build
echo -e "${GREEN}✅ SDK built successfully${NC}"
cd ..

# Summary
echo ""
echo -e "${GREEN}✅ Build complete!${NC}"
echo ""
echo "📋 Next steps:"
echo "1. Upload frontend/dist/ to voiceactions.dev"
echo "2. Upload backend/ to api.voiceactions.dev"
echo "3. Configure .env files on server"
echo "4. Run migrations: php artisan migrate"
echo "5. Set proper file permissions"
echo ""
echo "📚 See DEPLOYMENT_VOICEACTIONS_DEV.md for detailed instructions"

