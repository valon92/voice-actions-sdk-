# 🚀 Deployment Guide - voiceactions.dev (cPanel)

**Server:** server705.web-hosting.com  
**Domain:** voiceactions.dev  
**Username:** voicdwgn  
**Home Directory:** /home/voicdwgn

---

## 📋 Përmbledhje

Ky guide shpjegon si të deployosh Voice Actions SDK në cPanel server-in e voiceactions.dev.

---

## 🎯 Para Deployment

### Kërkesat

- ✅ cPanel access (https://server705.web-hosting.com:2083)
- ✅ FTP/SSH access (nëse është i aktivizuar)
- ✅ PHP 8.2+ (verifiko në cPanel)
- ✅ MySQL/SQLite database
- ✅ Composer (nëse nuk ekziston, installohet automatikisht)

### Informacioni i Nevojshëm

- **Domain:** voiceactions.dev
- **Username:** voicdwgn
- **Home Directory:** /home/voicdwgn
- **Public HTML:** /home/voicdwgn/public_html

---

## 📦 Metoda 1: Deployment Manual (Recommended për fillim)

### Hapi 1: Përgatit Files për Upload

```bash
# Në lokal, ekzekuto script-in për të krijuar package
cd /Users/valonsylejmani/Projekte/VoiceActionsSDK
./deploy-cpanel-full.sh
```

Kjo krijon një `.zip` file në `packages/` directory.

### Hapi 2: Upload Files në cPanel

1. **Hyni në cPanel:**
   - Shkoni në: https://server705.web-hosting.com:2083
   - Login me username: `voicdwgn`

2. **Upload .zip file:**
   - Shkoni në **File Manager**
   - Navigate në `/home/voicdwgn/public_html`
   - Upload `.zip` file që u krijua

3. **Extract files:**
   - Right-click në `.zip` file
   - Select **Extract**
   - Extract në `/home/voicdwgn/public_html`

### Hapi 3: Organizo Files

Pas extraction, struktura duhet të jetë:

```
/home/voicdwgn/public_html/
├── api/              # Laravel backend
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── public/
│   └── ...
├── assets/           # Frontend build files
│   ├── index-*.js
│   └── index-*.css
├── index.html        # Frontend entry point
└── .htaccess         # Apache configuration
```

### Hapi 4: Konfiguro Backend

1. **Krijo `.env` file:**

Në cPanel File Manager, navigo në `/home/voicdwgn/public_html/api/` dhe krijo `.env` file:

```env
APP_NAME="Voice Actions SDK"
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://voiceactions.dev

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=voicdwgn_voiceactions
DB_USERNAME=voicdwgn_dbuser
DB_PASSWORD=YOUR_DB_PASSWORD

CORS_ALLOWED_ORIGINS=https://voiceactions.dev,https://www.voiceactions.dev

SESSION_DRIVER=database
SESSION_LIFETIME=120

# Stripe (nëse përdoret)
STRIPE_KEY=sk_live_...
STRIPE_SECRET=sk_live_...
STRIPE_WEBHOOK_SECRET=whsec_...
```

2. **Generate APP_KEY:**

Nëse nuk ke APP_KEY, mund ta gjenerosh në terminal (nëse ke SSH access):

```bash
cd /home/voicdwgn/public_html/api
php artisan key:generate
```

Ose mund ta gjenerosh lokal dhe ta kopjosh në `.env`.

### Hapi 5: Krijo Database

1. **Në cPanel:**
   - Shkoni në **MySQL Databases**
   - Krijo database të ri: `voicdwgn_voiceactions`
   - Krijo user të ri dhe jepi të gjitha privileges
   - Shkruaj credentials në `.env` file

2. **Run Migrations:**

Nëse ke SSH access:

```bash
cd /home/voicdwgn/public_html/api
php artisan migrate --force
```

Ose mund të ekzekutosh migrations manualisht nëpërmjet phpMyAdmin.

### Hapi 6: Konfiguro Apache/.htaccess

Krijo `.htaccess` në `/home/voicdwgn/public_html/api/public/`:

```apache
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
```

### Hapi 7: Konfiguro Routes

Krijo `.htaccess` në `/home/voicdwgn/public_html/` (root):

```apache
# Frontend routes
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
```

### Hapi 8: Set File Permissions

Nëse ke SSH access:

```bash
cd /home/voicdwgn/public_html
chmod -R 755 api/storage api/bootstrap/cache
chown -R voicdwgn:voicdwgn api/storage api/bootstrap/cache
```

### Hapi 9: Install Composer Dependencies

Nëse ke SSH access:

```bash
cd /home/voicdwgn/public_html/api
composer install --no-dev --optimize-autoloader
```

Ose mund të upload-osh `vendor/` directory direkt.

### Hapi 10: Cache Laravel Config

Nëse ke SSH access:

```bash
cd /home/voicdwgn/public_html/api
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 📦 Metoda 2: Deployment via Git (Recommended për updates)

### Hapi 1: Setup Git në cPanel

1. **Në cPanel:**
   - Shkoni në **Git Version Control**
   - Click **Create**
   - Repository Name: `voice-actions-sdk`
   - Repository URL: `https://github.com/valon92/voice-actions-sdk-.git`
   - Branch: `main`
   - Path: `/home/voicdwgn/public_html`

2. **Clone Repository:**

cPanel do të clone repository automatikisht.

### Hapi 2: Konfiguro Auto-Deploy

Krijo `.cpanel.yml` në root të projektit:

```yaml
---
deployment:
  tasks:
    - export DEPLOYPATH=/home/voicdwgn/public_html
    - /bin/cp -R frontend/dist/* $DEPLOYPATH/
    - /bin/cp -R backend/* $DEPLOYPATH/api/
    - cd $DEPLOYPATH/api && /usr/local/bin/php /usr/local/bin/composer install --no-dev --optimize-autoloader
    - cd $DEPLOYPATH/api && /usr/local/bin/php artisan config:cache
    - cd $DEPLOYPATH/api && /usr/local/bin/php artisan route:cache
    - cd $DEPLOYPATH/api && /usr/local/bin/php artisan view:cache
```

### Hapi 3: Push Changes

Çdo herë që push-osh në GitHub, cPanel do të deploy-ojë automatikisht.

---

## 🔧 Konfigurim i Detajuar

### 1. Database Setup

**Nëse përdor MySQL:**

```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=voicdwgn_voiceactions
DB_USERNAME=voicdwgn_dbuser
DB_PASSWORD=your_password
```

**Nëse përdor SQLite:**

```env
DB_CONNECTION=sqlite
DB_DATABASE=/home/voicdwgn/public_html/api/database/database.sqlite
```

Krijo file `database.sqlite`:

```bash
touch /home/voicdwgn/public_html/api/database/database.sqlite
chmod 664 /home/voicdwgn/public_html/api/database/database.sqlite
```

### 2. API URL Configuration

Në frontend, sigurohu që API URL është:

```javascript
// Production
const API_URL = 'https://voiceactions.dev/api';

// Ose relative
const API_URL = '/api';
```

### 3. CORS Configuration

Në `api/config/cors.php`:

```php
'paths' => ['api/*', 'sanctum/csrf-cookie'],
'allowed_methods' => ['*'],
'allowed_origins' => [
    'https://voiceactions.dev',
    'https://www.voiceactions.dev',
],
'allowed_headers' => ['*'],
'exposed_headers' => [],
'max_age' => 0,
'supports_credentials' => true,
```

### 4. File Permissions

```bash
# Storage dhe cache directories
chmod -R 775 /home/voicdwgn/public_html/api/storage
chmod -R 775 /home/voicdwgn/public_html/api/bootstrap/cache

# Database file (nëse SQLite)
chmod 664 /home/voicdwgn/public_html/api/database/database.sqlite
```

---

## 🧪 Testimi

### 1. Test API

```bash
curl https://voiceactions.dev/api/platforms
```

Duhet të kthejë:
```json
{
  "success": true,
  "message": "Voice Actions SDK API is running successfully!"
}
```

### 2. Test Frontend

Shkoni në: https://voiceactions.dev

Duhet të shfaqet homepage.

### 3. Test SDK

```bash
curl https://voiceactions.dev/sdk/voice-actions-sdk.min.js
```

Duhet të kthejë JavaScript file.

---

## 🔄 Updates

### Manual Update:

1. Upload files të reja në cPanel File Manager
2. Run migrations (nëse ka):
   ```bash
   php artisan migrate --force
   ```
3. Clear cache:
   ```bash
   php artisan config:clear
   php artisan route:clear
   php artisan view:clear
   php artisan cache:clear
   ```

### Git Update:

1. Push changes në GitHub
2. cPanel do të deploy-ojë automatikisht (nëse ke konfiguruar Git Version Control)

---

## ⚠️ Troubleshooting

### Problem: 500 Internal Server Error

**Zgjidhja:**
1. Kontrollo `.env` file
2. Kontrollo file permissions
3. Kontrollo Laravel logs: `api/storage/logs/laravel.log`

### Problem: API nuk funksionon

**Zgjidhja:**
1. Verifiko `.htaccess` në `api/public/`
2. Verifiko që routes janë cached: `php artisan route:cache`
3. Kontrollo CORS configuration

### Problem: Database Connection Error

**Zgjidhja:**
1. Verifiko database credentials në `.env`
2. Verifiko që database ekziston
3. Verifiko që user ka privileges

### Problem: Frontend nuk shfaqet

**Zgjidhja:**
1. Verifiko që `index.html` ekziston në root
2. Verifiko `.htaccess` në root
3. Kontrollo browser console për errors

---

## 📞 Support

Nëse ke probleme:
1. Kontrollo logs: `api/storage/logs/laravel.log`
2. Kontrollo cPanel error logs
3. Kontakto support nëse problemi vazhdon

---

**Status:** ✅ **READY FOR DEPLOYMENT**  
**Last Updated:** 2025-12-17

