# 🚀 Deployment Guide - voiceactions.dev

**Server:** server705.web-hosting.com  
**Domain:** voiceactions.dev  
**Username:** voicdwgn  
**Home Directory:** /home/voicdwgn

---

## ⚡ Quick Start (5 Minuta)

### Hapi 1: Krijo Package Lokal

```bash
cd /Users/valonsylejmani/Projekte/VoiceActionsSDK
./deploy-voiceactions-dev.sh
```

Kjo krijon një `.zip` file në `packages/` directory.

### Hapi 2: Upload në cPanel

1. **Login në cPanel:**
   - URL: https://server705.web-hosting.com:2083
   - Username: `voicdwgn`

2. **Upload Package:**
   - Shkoni në **File Manager**
   - Navigate në `/home/voicdwgn/public_html`
   - Upload `.zip` file që u krijua
   - Right-click → **Extract**

### Hapi 3: Konfiguro Backend

1. **Krijo `.env` file:**
   - Në File Manager, navigo në `public_html/api/`
   - Krijo file `.env` me këtë përmbajtje:

```env
APP_NAME="Voice Actions SDK"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://voiceactions.dev

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=voicdwgn_voiceactions
DB_USERNAME=voicdwgn_dbuser
DB_PASSWORD=YOUR_PASSWORD

CORS_ALLOWED_ORIGINS=https://voiceactions.dev,https://www.voiceactions.dev

SESSION_DRIVER=database
SESSION_LIFETIME=120
```

2. **Generate APP_KEY:**
   - Nëse ke SSH access:
     ```bash
     cd /home/voicdwgn/public_html/api
     php artisan key:generate
     ```
   - Ose gjenero lokal dhe kopjo në `.env`

3. **Krijo Database:**
   - Shkoni në cPanel → **MySQL Databases**
   - Krijo database: `voicdwgn_voiceactions`
   - Krijo user dhe jepi privileges
   - Update credentials në `.env`

4. **Run Migrations:**
   - Nëse ke SSH access:
     ```bash
     cd /home/voicdwgn/public_html/api
     php artisan migrate --force
     ```
   - Ose përdor phpMyAdmin për të importuar SQL

5. **Cache Laravel:**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

### Hapi 4: Set Permissions

```bash
chmod -R 755 /home/voicdwgn/public_html/api/storage
chmod -R 755 /home/voicdwgn/public_html/api/bootstrap/cache
```

### Hapi 5: Test

1. **Frontend:** https://voiceactions.dev
2. **API:** https://voiceactions.dev/api/platforms
3. **SDK:** https://voiceactions.dev/sdk/voice-actions-sdk.min.js

---

## 📁 Struktura e Files në Server

```
/home/voicdwgn/public_html/
├── index.html              # Frontend entry point
├── assets/                 # Frontend build files
│   ├── index-*.js
│   └── index-*.css
├── sdk/                    # Hosted SDK files
│   ├── voice-actions-sdk.min.js
│   └── voice-actions-sdk.min.js.map
├── api/                    # Laravel backend
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── public/
│   │   └── index.php       # API entry point
│   ├── routes/
│   ├── storage/
│   ├── vendor/
│   └── .env
└── .htaccess               # Apache configuration
```

---

## 🔧 Konfigurim i Detajuar

### 1. .htaccess për Root

Krijo `.htaccess` në `/home/voicdwgn/public_html/`:

```apache
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

### 2. .htaccess për API

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

### 3. Database Setup

**MySQL (Recommended):**

```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=voicdwgn_voiceactions
DB_USERNAME=voicdwgn_dbuser
DB_PASSWORD=your_password
```

**SQLite (Alternative):**

```env
DB_CONNECTION=sqlite
DB_DATABASE=/home/voicdwgn/public_html/api/database/database.sqlite
```

Krijo file:
```bash
touch /home/voicdwgn/public_html/api/database/database.sqlite
chmod 664 /home/voicdwgn/public_html/api/database/database.sqlite
```

---

## 🔄 Updates

### Metoda 1: Manual Update

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
4. Re-cache:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

### Metoda 2: Git Auto-Deploy

1. **Setup Git Version Control në cPanel:**
   - Shkoni në cPanel → **Git Version Control**
   - Click **Create**
   - Repository URL: `https://github.com/valon92/voice-actions-sdk-.git`
   - Branch: `main`
   - Path: `/home/voicdwgn/public_html`

2. **Push Changes:**
   - Çdo push në GitHub do të deploy-ojë automatikisht

---

## ⚠️ Troubleshooting

### Problem: 500 Internal Server Error

**Zgjidhja:**
1. Kontrollo `.env` file
2. Kontrollo file permissions:
   ```bash
   chmod -R 755 api/storage api/bootstrap/cache
   ```
3. Kontrollo Laravel logs:
   ```bash
   tail -f api/storage/logs/laravel.log
   ```

### Problem: API nuk funksionon

**Zgjidhja:**
1. Verifiko `.htaccess` në `api/public/`
2. Verifiko që routes janë cached:
   ```bash
   php artisan route:cache
   ```
3. Kontrollo CORS configuration në `.env`

### Problem: Database Connection Error

**Zgjidhja:**
1. Verifiko database credentials në `.env`
2. Verifiko që database ekziston në cPanel
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

