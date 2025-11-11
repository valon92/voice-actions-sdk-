#!/bin/bash

# Voice Actions SDK - cPanel Deployment Script
# Usage: ./deploy-cpanel.sh [frontend|backend|all]

set -e

DEPLOY_TARGET=${1:-all}

# Colors for output
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo -e "${BLUE}🚀 Voice Actions SDK - cPanel Deployment${NC}"
echo ""

# Check if we're in the project root
if [ ! -f "package.json" ] && [ ! -f "composer.json" ]; then
    echo -e "${RED}❌ Error: Please run this script from the project root${NC}"
    exit 1
fi

# Function to build frontend
build_frontend() {
    echo -e "${YELLOW}📦 Building frontend...${NC}"
    cd frontend
    
    if [ ! -d "node_modules" ]; then
        echo "Installing frontend dependencies..."
        npm install
    fi
    
    npm run build
    echo -e "${GREEN}✅ Frontend built successfully${NC}"
    echo "   Output: frontend/dist/"
    cd ..
}

# Function to build backend
build_backend() {
    echo -e "${YELLOW}📦 Building backend...${NC}"
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
}

# Function to build SDK
build_sdk() {
    echo -e "${YELLOW}📦 Building SDK...${NC}"
    cd sdk
    
    if [ ! -d "node_modules" ]; then
        echo "Installing SDK dependencies..."
        npm install
    fi
    
    npm run build
    echo -e "${GREEN}✅ SDK built successfully${NC}"
    cd ..
}

# Main deployment logic
case $DEPLOY_TARGET in
    frontend)
        build_frontend
        ;;
    backend)
        build_backend
        ;;
    sdk)
        build_sdk
        ;;
    all)
        build_frontend
        build_backend
        build_sdk
        ;;
    *)
        echo -e "${RED}❌ Invalid target: $DEPLOY_TARGET${NC}"
        echo "Usage: ./deploy-cpanel.sh [frontend|backend|sdk|all]"
        exit 1
        ;;
esac

echo ""
echo -e "${GREEN}✅ Build complete!${NC}"
echo ""
echo -e "${BLUE}📋 Next steps for cPanel deployment:${NC}"
echo ""
echo "1. 📤 Upload files to cPanel:"
echo "   - Frontend: Upload frontend/dist/* to ~/public_html/"
echo "   - Backend: Upload backend/* to ~/api.voiceactions.dev/"
echo ""
echo "2. ⚙️  Configure environment:"
echo "   - Copy backend/.env.production.example to ~/api.voiceactions.dev/.env"
echo "   - Update .env with your production values"
echo "   - Run: php artisan key:generate"
echo ""
echo "3. 🔐 Set file permissions:"
echo "   chmod -R 755 ~/api.voiceactions.dev/storage"
echo "   chmod -R 755 ~/api.voiceactions.dev/bootstrap/cache"
echo ""
echo "4. 🗄️  Setup database:"
echo "   cd ~/api.voiceactions.dev"
echo "   php artisan migrate"
echo ""
echo "5. ✅ Test deployment:"
echo "   - Frontend: https://voiceactions.dev"
echo "   - Backend: https://api.voiceactions.dev/api/v1/commands/demo"
echo ""
echo -e "${BLUE}📚 See CPANEL_DEPLOYMENT.md for detailed instructions${NC}"


