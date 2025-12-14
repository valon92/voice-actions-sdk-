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
