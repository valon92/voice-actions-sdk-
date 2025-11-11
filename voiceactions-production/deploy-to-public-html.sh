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
