#!/bin/bash

# Voice Actions SDK - Complete cPanel Deployment Script
# Usage: ./deploy-cpanel-full.sh [options]
# Options:
#   --frontend-only    Build dhe deploy vetëm frontend
#   --backend-only     Build dhe deploy vetëm backend
#   --skip-build       Skip build, vetëm kopjo files
#   --help             Shfaq këtë help

set -e

# Colors
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
BLUE='\033[0;34m'
CYAN='\033[0;36m'
NC='\033[0m' # No Color

# Default values
DEPLOY_FRONTEND=true
DEPLOY_BACKEND=true
SKIP_BUILD=false
CPANEL_USER=""
CPANEL_HOST=""
FRONTEND_PATH="public_html"
BACKEND_PATH="api.voiceactions.dev"

# Parse arguments
while [[ $# -gt 0 ]]; do
    case $1 in
        --frontend-only)
            DEPLOY_FRONTEND=true
            DEPLOY_BACKEND=false
            shift
            ;;
        --backend-only)
            DEPLOY_FRONTEND=false
            DEPLOY_BACKEND=true
            shift
            ;;
        --skip-build)
            SKIP_BUILD=true
            shift
            ;;
        --cpanel-user)
            CPANEL_USER="$2"
            shift 2
            ;;
        --cpanel-host)
            CPANEL_HOST="$2"
            shift 2
            ;;
        --frontend-path)
            FRONTEND_PATH="$2"
            shift 2
            ;;
        --backend-path)
            BACKEND_PATH="$2"
            shift 2
            ;;
        --help)
            echo "Usage: $0 [options]"
            echo ""
            echo "Options:"
            echo "  --frontend-only      Deploy vetëm frontend"
            echo "  --backend-only       Deploy vetëm backend"
            echo "  --skip-build         Skip build process"
            echo "  --cpanel-user USER   cPanel username"
            echo "  --cpanel-host HOST   cPanel hostname (për SSH)"
            echo "  --frontend-path PATH Path për frontend (default: public_html)"
            echo "  --backend-path PATH  Path për backend (default: api.voiceactions.dev)"
            echo "  --help               Shfaq këtë help"
            exit 0
            ;;
        *)
            echo -e "${RED}Unknown option: $1${NC}"
            echo "Use --help për të parë options"
            exit 1
            ;;
    esac
done

echo -e "${BLUE}╔════════════════════════════════════════════════════════╗${NC}"
echo -e "${BLUE}║  Voice Actions SDK - cPanel Deployment Script        ║${NC}"
echo -e "${BLUE}╚════════════════════════════════════════════════════════╝${NC}"
echo ""

# Check if we're in the project root
if [ ! -d "frontend" ] || [ ! -d "backend" ]; then
    echo -e "${RED}❌ Error: Please run this script from the project root${NC}"
    exit 1
fi

# Function to build frontend
build_frontend() {
    echo -e "${CYAN}📦 Building Frontend...${NC}"
    echo ""
    
    cd frontend
    
    if [ ! -d "node_modules" ]; then
        echo -e "${YELLOW}Installing frontend dependencies...${NC}"
        npm install
    fi
    
    echo -e "${YELLOW}Building frontend for production...${NC}"
    npm run build
    
    if [ ! -d "dist" ]; then
        echo -e "${RED}❌ Error: Frontend build failed - dist/ directory not found${NC}"
        exit 1
    fi
    
    echo -e "${GREEN}✅ Frontend built successfully${NC}"
    echo -e "   Output: ${CYAN}frontend/dist/${NC}"
    cd ..
}

# Function to build backend
build_backend() {
    echo -e "${CYAN}📦 Preparing Backend...${NC}"
    echo ""
    
    cd backend
    
    if [ ! -d "vendor" ]; then
        echo -e "${YELLOW}Installing backend dependencies...${NC}"
        composer install --optimize-autoloader --no-dev --no-interaction
    fi
    
    echo -e "${YELLOW}Caching Laravel configuration...${NC}"
    php artisan config:cache 2>/dev/null || echo "⚠️  Config cache skipped"
    php artisan route:cache 2>/dev/null || echo "⚠️  Route cache skipped"
    php artisan view:cache 2>/dev/null || echo "⚠️  View cache skipped"
    
    echo -e "${GREEN}✅ Backend prepared successfully${NC}"
    cd ..
}

# Function to create deployment package
create_package() {
    echo -e "${CYAN}📦 Creating Deployment Package...${NC}"
    echo ""
    
    PACKAGE_DIR="voiceactions-deploy-$(date +%Y%m%d-%H%M%S)"
    mkdir -p "$PACKAGE_DIR"
    
    if [ "$DEPLOY_FRONTEND" = true ]; then
        echo -e "${YELLOW}Packaging frontend...${NC}"
        mkdir -p "$PACKAGE_DIR/frontend"
        cp -r frontend/dist/* "$PACKAGE_DIR/frontend/"
    fi
    
    if [ "$DEPLOY_BACKEND" = true ]; then
        echo -e "${YELLOW}Packaging backend...${NC}"
        mkdir -p "$PACKAGE_DIR/backend"
        
        # Copy backend files (exclude unnecessary files)
        rsync -av --progress \
            --exclude='node_modules' \
            --exclude='.git' \
            --exclude='tests' \
            --exclude='.env.example' \
            --exclude='.env' \
            --exclude='storage/logs/*' \
            --exclude='storage/framework/cache/*' \
            --exclude='storage/framework/sessions/*' \
            --exclude='storage/framework/views/*' \
            backend/ "$PACKAGE_DIR/backend/"
        
        # Create .env.example from backend
        if [ -f "backend/.env.example" ]; then
            cp backend/.env.example "$PACKAGE_DIR/backend/.env.example"
        fi
    fi
    
    # Create deployment instructions
    cat > "$PACKAGE_DIR/DEPLOY_INSTRUCTIONS.txt" << EOF
Voice Actions SDK - Deployment Instructions
===========================================

Generated: $(date)

FRONTEND DEPLOYMENT:
-------------------
1. Upload të gjitha file-at nga 'frontend/' directory në:
   ~/public_html/

2. Sigurohu që index.html është në root të public_html

BACKEND DEPLOYMENT:
------------------
1. Upload të gjitha file-at nga 'backend/' directory në:
   ~/api.voiceactions.dev/ (nëse subdomain)
   Ose ~/public_html/api/ (nëse subdirectory)

2. Krijo .env file:
   cp .env.example .env
   # Pastaj edito .env me vlerat e tua

3. Generate app key:
   php artisan key:generate

4. Run migrations:
   php artisan migrate

5. Set permissions:
   chmod -R 755 storage
   chmod -R 755 bootstrap/cache
   chmod 644 .env

6. Cache configuration:
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache

TESTING:
--------
- Frontend: https://voiceactions.dev
- Backend: https://api.voiceactions.dev/api/commands/demo

Për më shumë detaje, shiko DEPLOY_CPANEL.md
EOF
    
    echo -e "${GREEN}✅ Package created: ${CYAN}$PACKAGE_DIR${NC}"
    echo ""
    echo -e "${BLUE}📋 Package contents:${NC}"
    du -sh "$PACKAGE_DIR"/*
    echo ""
    
    # Create zip archive
    echo -e "${YELLOW}Creating zip archive...${NC}"
    zip -r "${PACKAGE_DIR}.zip" "$PACKAGE_DIR" > /dev/null
    echo -e "${GREEN}✅ Archive created: ${CYAN}${PACKAGE_DIR}.zip${NC}"
    echo ""
}

# Main execution
echo -e "${BLUE}Starting deployment process...${NC}"
echo ""

# Build if not skipped
if [ "$SKIP_BUILD" = false ]; then
    if [ "$DEPLOY_FRONTEND" = true ]; then
        build_frontend
        echo ""
    fi
    
    if [ "$DEPLOY_BACKEND" = true ]; then
        build_backend
        echo ""
    fi
fi

# Create package
create_package

# Summary
echo -e "${GREEN}╔════════════════════════════════════════════════════════╗${NC}"
echo -e "${GREEN}║  ✅ Deployment Package Created Successfully!          ║${NC}"
echo -e "${GREEN}╚════════════════════════════════════════════════════════╝${NC}"
echo ""
echo -e "${CYAN}📦 Package Location:${NC}"
echo -e "   Directory: ${YELLOW}$PACKAGE_DIR${NC}"
echo -e "   Archive:   ${YELLOW}${PACKAGE_DIR}.zip${NC}"
echo ""
echo -e "${BLUE}📋 Next Steps:${NC}"
echo ""
echo "1. 📤 Upload package në cPanel:"
echo "   - Upload ${PACKAGE_DIR}.zip në cPanel File Manager"
echo "   - Extract në location të përshtatshëm"
echo ""
echo "2. 📁 Upload files:"
if [ "$DEPLOY_FRONTEND" = true ]; then
    echo "   - Frontend: Upload $PACKAGE_DIR/frontend/* to ~/public_html/"
fi
if [ "$DEPLOY_BACKEND" = true ]; then
    echo "   - Backend: Upload $PACKAGE_DIR/backend/* to ~/$BACKEND_PATH/"
fi
echo ""
echo "3. ⚙️  Configure:"
echo "   - Krijo .env file për backend"
echo "   - Run: php artisan key:generate"
echo "   - Run: php artisan migrate"
echo ""
echo "4. 🔐 Set permissions:"
echo "   - chmod -R 755 storage"
echo "   - chmod -R 755 bootstrap/cache"
echo ""
echo -e "${CYAN}📚 Për më shumë detaje, shiko:${NC}"
echo "   - DEPLOY_CPANEL.md (udhëzime të detajuara)"
echo "   - $PACKAGE_DIR/DEPLOY_INSTRUCTIONS.txt (në package)"
echo ""

