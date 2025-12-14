# 🚀 Voice Actions SDK - cPanel Deployment Guide

**Version:** 1.0.0  
**Last Updated:** 2025-01-29

---

## 📋 Përmbledhje

Ky dokument përmban udhëzime të detajuara për deployment të Voice Actions SDK në cPanel hosting. Projekti përbëhet nga:

- **Frontend**: Vue.js aplikacion (deploy në `public_html`)
- **Backend**: Laravel API (deploy në subdomain ose subdirectory)
- **SDK**: JavaScript library (përfshihet në frontend build)

---

## 🎯 Para Deployment

### Kërkesat

- ✅ cPanel hosting me PHP 8.2+
- ✅ Node.js 18+ (për build frontend)
- ✅ Composer (për Laravel dependencies)
- ✅ MySQL ose SQLite database
- ✅ SSH access (opsionale, por e rekomanduar)

### Informacioni i Nevojshëm

- Domain name (p.sh. `voiceactions.dev`)
- Subdomain për API (p.sh. `api.voiceactions.dev`) ose subdirectory (`voiceactions.dev/api`)
- Database credentials
- cPanel username

---

## 📦 Metoda 1: Manual Deployment (Rekomanduar për Fillim)

### Hapi 1: Build Projektin Lokal

```bash
# Klono repository
git clone https://github.com/valon92/voice-actions-sdk-.git
cd voice-actions-sdk-

# Build frontend
cd frontend
npm install
npm run build
cd ..

# Build backend (opsionale - mund të bëhet direkt në server)
cd backend
composer install --no-dev --optimize-autoloader
cd ..
```

### Hapi 2: Upload Files në cPanel

#### 2.1 Frontend Files

1. Hap **File Manager** në cPanel
2. Shko te `public_html/`
3. Upload të gjitha file-at nga `frontend/dist/`:
   - `index.html`
   - `assets/` (të gjitha file-at e build-uar)

#### 2.2 Backend Files

1. Krijo subdomain `api.voiceactions.dev` në cPanel (ose përdor subdirectory)
2. Upload të gjitha file-at nga `backend/` në:
   - `~/api.voiceactions.dev/` (nëse subdomain)
   - Ose `~/public_html/api/` (nëse subdirectory)

**Struktura e Backend:**
```
api.voiceactions.dev/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
│   └── index.php  # Entry point
├── routes/
├── storage/
├── vendor/
└── .env
```

**E rëndësishme:** Nëse përdor subdirectory, duhet të konfigurosh `.htaccess` për të redirect-uar requests në `public/index.php`.

### Hapi 3: Konfiguro .env File

1. Krijo `.env` file në `~/api.voiceactions.dev/.env`:

```env
APP_NAME="Voice Actions SDK"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://api.voiceactions.dev

LOG_CHANNEL=stack
LOG_LEVEL=error

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

# Ose përdor SQLite (më e thjeshtë)
# DB_CONNECTION=sqlite
# DB_DATABASE=/home/username/api.voiceactions.dev/database/database.sqlite

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

# Sentry (opsionale)
SENTRY_LARAVEL_DSN=
SENTRY_TRACES_SAMPLE_RATE=0.0
```

2. Generate App Key:
```bash
cd ~/api.voiceactions.dev
php artisan key:generate
```

### Hapi 4: Setup Database

#### Opsioni A: MySQL (Rekomanduar për Production)

1. Krijo database në cPanel:
   - Shko te **MySQL Databases**
   - Krijo database dhe user
   - Jep permissions

2. Run migrations:
```bash
cd ~/api.voiceactions.dev
php artisan migrate
```

#### Opsioni B: SQLite (Më e thjeshtë)

1. Krijo database file:
```bash
cd ~/api.voiceactions.dev/database
touch database.sqlite
chmod 664 database.sqlite
```

2. Run migrations:
```bash
cd ~/api.voiceactions.dev
php artisan migrate
```

### Hapi 5: Set File Permissions

```bash
# Storage dhe cache directories
chmod -R 755 ~/api.voiceactions.dev/storage
chmod -R 755 ~/api.voiceactions.dev/bootstrap/cache

# .env file
chmod 644 ~/api.voiceactions.dev/.env

# Public directory
chmod -R 755 ~/api.voiceactions.dev/public
```

### Hapi 6: Konfiguro Laravel Public Directory

Nëse backend është në subdirectory (`public_html/api/`), krijo `.htaccess` në root:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

Ose nëse përdor subdomain, sigurohu që `DocumentRoot` është `~/api.voiceactions.dev/public`.

### Hapi 7: Cache Laravel Configuration

```bash
cd ~/api.voiceactions.dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🔄 Metoda 2: Git Deployment (Automatik)

### Hapi 1: Setup Git në cPanel

1. Shko te **Git Version Control** në cPanel
2. Kliko **"Create"**
3. Konfiguro:
   ```
   Repository Name: voice-actions-sdk
   Repository URL: https://github.com/valon92/voice-actions-sdk-.git
   Repository Branch: main
   Deployment Path: /home/username/voice-actions-sdk
   ```

### Hapi 2: Krijo Deployment Script

Krijo `deploy.sh` në `~/voice-actions-sdk/`:

```bash
#!/bin/bash
# Deployment script për cPanel

set -e

echo "🚀 Starting deployment..."

# Frontend
echo "📦 Building frontend..."
cd frontend
npm install
npm run build
cp -r dist/* ~/public_html/
cd ..

# Backend
echo "📦 Building backend..."
cd backend
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Kopjo backend files (duke përjashtuar node_modules, .git, etj.)
rsync -av --exclude='node_modules' --exclude='.git' --exclude='tests' \
  ~/voice-actions-sdk/backend/ ~/api.voiceactions.dev/

cd ..

echo "✅ Deployment complete!"
```

### Hapi 3: Auto-Deploy me Webhook

1. Krijo `cpanel-webhook.php` në `public_html/`:

```php
<?php
// cpanel-webhook.php
// Sigurohu që kjo file është e sigurt!

$secret = 'your_webhook_secret_here';
$payload = file_get_contents('php://input');
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';

// Verify signature
$expectedSignature = 'sha256=' . hash_hmac('sha256', $payload, $secret);
if (!hash_equals($expectedSignature, $signature)) {
    http_response_code(401);
    die('Unauthorized');
}

$data = json_decode($payload, true);

if ($data['ref'] === 'refs/heads/main') {
    // Execute deployment
    $output = shell_exec('cd ~/voice-actions-sdk && git pull origin main 2>&1');
    $output .= shell_exec('cd ~/voice-actions-sdk && bash deploy.sh 2>&1');
    
    // Log
    file_put_contents('/home/username/deployment.log', 
        date('Y-m-d H:i:s') . "\n" . $output . "\n\n", FILE_APPEND);
    
    echo json_encode(['status' => 'success', 'output' => $output]);
} else {
    echo json_encode(['status' => 'skipped', 'reason' => 'Not main branch']);
}
?>
```

2. Konfiguro GitHub Webhook:
   - URL: `https://voiceactions.dev/cpanel-webhook.php`
   - Secret: (përdor të njëjtin secret si në PHP)
   - Content type: `application/json`
   - Events: `Just the push event`

---

## 🔧 Konfigurim i cPanel

### 1. PHP Version

1. Shko te **Select PHP Version** në cPanel
2. Zgjidh **PHP 8.2** ose më të lartë
3. Aktivizo extensions:
   - `pdo_mysql` ose `pdo_sqlite`
   - `mbstring`
   - `openssl`
   - `fileinfo`
   - `json`

### 2. Node.js Version

1. Shko te **Setup Node.js App** në cPanel
2. Krijo aplikacion me Node.js 18+ (për build)
3. Ose përdor Node.js selector nëse është i disponueshëm

### 3. Cron Jobs (për Auto-Deployment)

1. Shko te **Cron Jobs**
2. Krijo cron job:

```
Minute: 0
Hour: * 
Day: * 
Month: * 
Weekday: * 
Command: cd ~/voice-actions-sdk && git pull origin main && bash deploy.sh
```

---

## 📁 Struktura e Direktorive në cPanel

```
/home/username/
├── public_html/                    # Frontend
│   ├── index.html
│   ├── assets/
│   │   ├── index-*.js
│   │   └── index-*.css
│   └── cpanel-webhook.php          # (opsionale)
│
├── api.voiceactions.dev/           # Backend (subdomain)
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   │   └── database.sqlite        # (nëse përdor SQLite)
│   ├── public/
│   │   └── index.php              # Entry point
│   ├── routes/
│   ├── storage/
│   │   ├── framework/
│   │   └── logs/
│   ├── vendor/
│   └── .env
│
└── voice-actions-sdk/              # Git repository (nëse përdor Git)
    ├── frontend/
    ├── backend/
    └── deploy.sh
```

---

## 🔐 Siguria

### 1. .env File Protection

Krijo `.htaccess` në root të backend për të mbrojtur `.env`:

```apache
<Files .env>
    Order allow,deny
    Deny from all
</Files>
```

### 2. Storage Permissions

```bash
chmod -R 755 ~/api.voiceactions.dev/storage
chmod -R 755 ~/api.voiceactions.dev/bootstrap/cache
```

### 3. Disable Directory Listing

Krijo `.htaccess` në `public_html/`:

```apache
Options -Indexes
```

---

## ✅ Post-Deployment Checklist

- [ ] Frontend është accessible: `https://voiceactions.dev`
- [ ] Backend API është accessible: `https://api.voiceactions.dev/api/commands/demo`
- [ ] Database migrations janë run: `php artisan migrate`
- [ ] File permissions janë set: `chmod -R 755 storage bootstrap/cache`
- [ ] .env file është konfiguruar dhe e sigurt
- [ ] SSL certificate është aktiv (HTTPS)
- [ ] CORS është konfiguruar në `.env`
- [ ] Error logging funksionon: `tail -f storage/logs/laravel.log`
- [ ] Testo registration flow
- [ ] Testo login flow
- [ ] Testo voice demo page
- [ ] Testo SDK integration

---

## 🧪 Testing Deployment

### Test Frontend

```bash
# Në browser
https://voiceactions.dev
```

### Test Backend API

```bash
# Test demo endpoint
curl https://api.voiceactions.dev/api/commands/demo?locale=en-US&platform_name=stargate-ci

# Test platform registration
curl -X POST https://api.voiceactions.dev/api/platforms/register \
  -H "Content-Type: application/json" \
  -d '{"name":"Test Platform","email":"test@example.com"}'
```

---

## 🔍 Troubleshooting

### Problem: 500 Internal Server Error

**Zgjidhja:**
1. Kontrollo Laravel logs: `tail -f ~/api.voiceactions.dev/storage/logs/laravel.log`
2. Verifiko file permissions
3. Kontrollo `.env` configuration
4. Verifiko që `APP_KEY` është set

### Problem: CORS Errors

**Zgjidhja:**
1. Verifiko `CORS_ALLOWED_ORIGINS` në `.env`
2. Clear cache: `php artisan config:clear`
3. Re-cache: `php artisan config:cache`

### Problem: Database Connection Failed

**Zgjidhja:**
1. Verifiko database credentials në `.env`
2. Testo connection: `php artisan tinker` → `DB::connection()->getPdo();`
3. Verifiko që database user ka permissions

### Problem: Frontend nuk ngarkohet

**Zgjidhja:**
1. Verifiko që `index.html` është në `public_html/`
2. Kontrollo browser console për errors
3. Verifiko që `assets/` directory ekziston dhe ka files

### Problem: API Routes nuk funksionojnë

**Zgjidhja:**
1. Verifiko `.htaccess` në `public/` directory
2. Clear route cache: `php artisan route:clear`
3. Re-cache: `php artisan route:cache`
4. Verifiko që `mod_rewrite` është enabled në Apache

---

## 📊 Monitoring

### Check Logs

```bash
# Laravel logs
tail -f ~/api.voiceactions.dev/storage/logs/laravel.log

# Deployment logs (nëse përdor webhook)
tail -f ~/deployment.log

# Apache error logs (nëse ka)
tail -f ~/logs/error_log
```

### Check Status

```bash
# Check PHP version
php -v

# Check Composer
composer --version

# Check Node.js
node -v
npm -v

# Check database connection
cd ~/api.voiceactions.dev
php artisan tinker
# Pastaj: DB::connection()->getPdo();
```

---

## 🔄 Update Deployment

### Manual Update

1. Pull latest changes:
```bash
cd ~/voice-actions-sdk
git pull origin main
```

2. Rebuild dhe redeploy:
```bash
bash deploy.sh
```

### Automatic Update (me Webhook)

Push në `main` branch dhe webhook do të ekzekutojë deployment automatikisht.

---

## 📞 Support

Nëse has probleme gjatë deployment:

1. Kontrollo logs (Laravel, Apache, deployment)
2. Verifiko file permissions
3. Kontrollo `.env` configuration
4. Testo endpoints individualisht

---

**Dokumenti i krijuar:** 2025-01-29  
**Status:** ✅ Gati për deployment

