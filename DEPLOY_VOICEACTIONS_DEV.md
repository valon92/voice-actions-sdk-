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

Kjo metodë lejon deployment automatik çdo herë që push-osh ndryshime në GitHub. cPanel do të pull-ojë automatikisht dhe do të ekzekutojë deployment tasks.

### Hapi 1: Verifiko që .cpanel.yml Ekziston

Projekti tashmë ka `.cpanel.yml` file në root që përmban konfigurimin e deployment. Verifiko që ekziston:

```bash
# Në lokal
cat .cpanel.yml
```

Duhet të shohësh konfigurimin me paths për `voicdwgn` user.

### Hapi 2: Setup Git Version Control në cPanel

1. **Login në cPanel:**
   - Shkoni në: https://server705.web-hosting.com:2083
   - Login me username: `voicdwgn`
   - Password: (password-i juaj)

2. **Hap Git Version Control:**
   - Në cPanel, shkoni në seksionin **"Software"**
   - Klikoni në **"Git Version Control"** (ose kërko "Git" në search)
   - Nëse nuk e shihni, mund të jetë në **"Advanced"** section

3. **Krijo Repository të Ri:**
   - Klikoni butonin **"Create"** ose **"Clone a Repository"**
   - Plotëso formularin me këto vlera:

   **Repository Name:**
   ```
   voice-actions-sdk
   ```

   **Repository URL:**
   ```
   https://github.com/valon92/voice-actions-sdk-.git
   ```
   
   **Repository Branch:**
   ```
   main
   ```
   
   **Deployment Path:**
   ```
   /home/voicdwgn/public_html
   ```
   
   **Important Notes:**
   - Deployment Path duhet të jetë **saktësisht** `/home/voicdwgn/public_html`
   - Nëse path nuk ekziston, cPanel do të krijojë automatikisht
   - Nëse path ekziston dhe ka files, cPanel do të pyesë për konfirmim

4. **Konfiguro Auto-Deploy (Opsionale):**
   - Nëse dëshiron deployment automatik, aktivizo **"Auto Deploy"**
   - Kjo do të deploy-ojë automatikisht çdo herë që push-osh në GitHub
   - Ose mund të deploy-osh manualisht duke klikuar **"Deploy"** button

5. **Kliko "Create" ose "Clone":**
   - cPanel do të fillojë të clone repository
   - Kjo mund të zgjasë 1-2 minuta në varësi të madhësisë së projektit
   - Pas përfundimit, do të shohësh status "Cloned Successfully"

### Hapi 3: Verifiko .cpanel.yml Configuration

Pas clone, cPanel do të lexojë `.cpanel.yml` file nga repository dhe do të ekzekutojë deployment tasks. Verifiko që `.cpanel.yml` përmban:

```yaml
---
# cPanel Deployment Configuration
# Kjo file përdoret nga cPanel Git Version Control për auto-deployment
# Server: server705.web-hosting.com
# Domain: voiceactions.dev
# Username: voicdwgn

deployment:
  tasks:
    # Pull latest changes
    - export DEPLOYPATH=/home/voicdwgn/public_html
    - export APIPATH=/home/voicdwgn/public_html/api
    
    # Frontend deployment
    - echo "Building frontend..."
    - cd frontend && npm install && npm run build
    - /bin/cp -R frontend/dist/* $DEPLOYPATH/
    
    # Copy SDK files
    - echo "Copying SDK files..."
    - mkdir -p $DEPLOYPATH/sdk
    - /bin/cp sdk/dist/voice-actions-sdk.min.js $DEPLOYPATH/sdk/
    - /bin/cp sdk/dist/voice-actions-sdk.min.js.map $DEPLOYPATH/sdk/
    
    # Backend deployment
    - echo "Preparing backend..."
    - cd backend
    - /usr/local/bin/php /usr/local/bin/composer install --no-dev --optimize-autoloader
    - /bin/cp -R backend/* $APIPATH/ --exclude=node_modules --exclude=.git --exclude=tests
    
    # Laravel optimization
    - cd $APIPATH
    - /usr/local/bin/php artisan config:cache
    - /usr/local/bin/php artisan route:cache
    - /usr/local/bin/php artisan view:cache
    
    # Set permissions
    - chmod -R 755 $APIPATH/storage
    - chmod -R 755 $APIPATH/bootstrap/cache
    
    - echo "Deployment completed successfully!"
```

**Çfarë bën çdo task:**

1. **`export DEPLOYPATH`** - Vendos path-in ku do të deploy-ohet frontend
2. **`export APIPATH`** - Vendos path-in ku do të deploy-ohet backend
3. **`cd frontend && npm install && npm run build`** - Build frontend (instalon dependencies dhe krijon production build)
4. **`/bin/cp -R frontend/dist/* $DEPLOYPATH/`** - Kopjon frontend build files në public_html
5. **`mkdir -p $DEPLOYPATH/sdk`** - Krijo directory për SDK files
6. **`/bin/cp sdk/dist/voice-actions-sdk.min.js ...`** - Kopjon SDK files
7. **`cd backend && composer install`** - Instalon PHP dependencies për backend
8. **`/bin/cp -R backend/* $APIPATH/`** - Kopjon backend files në api directory
9. **`php artisan config:cache`** - Cache Laravel configuration për performance
10. **`php artisan route:cache`** - Cache routes për performance
11. **`php artisan view:cache`** - Cache views për performance
12. **`chmod -R 755 ...`** - Set file permissions për storage dhe cache directories

### Hapi 4: Manual Deployment (Për herë të parë)

Pas clone, për herë të parë duhet të deploy-osh manualisht:

1. **Në cPanel Git Version Control:**
   - Gjej repository-in `voice-actions-sdk`
   - Kliko butonin **"Deploy"** ose **"Update from Remote"**
   - cPanel do të:
     - Pull latest changes nga GitHub
     - Ekzekutojë tasks nga `.cpanel.yml`
     - Deploy-ojë files në `/home/voicdwgn/public_html`

2. **Verifiko Deployment:**
   - Shkoni në File Manager
   - Navigate në `/home/voicdwgn/public_html`
   - Verifiko që files janë kopjuar:
     - `index.html` (frontend)
     - `assets/` directory (frontend build)
     - `sdk/` directory (SDK files)
     - `api/` directory (backend)

### Hapi 5: Konfiguro Backend (Pas Deployment)

Pas deployment, duhet të konfigurosh backend:

1. **Krijo `.env` file:**
   - Në File Manager, navigo në `/home/voicdwgn/public_html/api/`
   - Krijo file `.env` (shiko seksionin "Konfiguro Backend" më lart)

2. **Generate APP_KEY:**
   - Nëse ke SSH access:
     ```bash
     cd /home/voicdwgn/public_html/api
     php artisan key:generate
     ```
   - Ose përdor Terminal në cPanel (nëse është i disponueshëm)

3. **Krijo Database:**
   - Shkoni në cPanel → **MySQL Databases**
   - Krijo database dhe user
   - Update credentials në `.env`

4. **Run Migrations:**
   ```bash
   cd /home/voicdwgn/public_html/api
   php artisan migrate --force
   ```

5. **Set Permissions:**
   ```bash
   chmod -R 755 /home/voicdwgn/public_html/api/storage
   chmod -R 755 /home/voicdwgn/public_html/api/bootstrap/cache
   ```

### Hapi 6: Auto-Deploy Setup (Opsionale)

Për deployment automatik çdo herë që push-osh në GitHub:

1. **Në cPanel Git Version Control:**
   - Gjej repository-in `voice-actions-sdk`
   - Kliko **"Manage"** ose **"Settings"**
   - Aktivizo **"Auto Deploy"** ose **"Automatic Deployment"**
   - Ruaj ndryshimet

2. **Test Auto-Deploy:**
   - Bëj një ndryshim të vogël në projekt (p.sh., update README.md)
   - Push në GitHub:
     ```bash
     git add .
     git commit -m "Test auto-deploy"
     git push origin main
     ```
   - Pas 1-2 minuta, cPanel do të deploy-ojë automatikisht

3. **Verifiko Deployment:**
   - Shkoni në File Manager
   - Verifiko që files janë përditësuar
   - Ose shkoni në website dhe verifiko që ndryshimet janë të dukshme

### Hapi 7: Manual Deploy (Nëse Auto-Deploy nuk funksionon)

Nëse auto-deploy nuk funksionon, mund të deploy-osh manualisht:

1. **Në cPanel Git Version Control:**
   - Gjej repository-in `voice-actions-sdk`
   - Kliko **"Update from Remote"** ose **"Pull"**
   - Pastaj kliko **"Deploy"**

2. **Ose përmes SSH (nëse ke access):**
   ```bash
   cd /home/voicdwgn/git/voice-actions-sdk
   git pull origin main
   # Deployment do të ekzekutohet automatikisht nga .cpanel.yml
   ```

### ⚠️ Important Notes

1. **.cpanel.yml duhet të jetë në root:**
   - File `.cpanel.yml` duhet të jetë në root të repository (së bashku me `frontend/`, `backend/`, `sdk/`)
   - cPanel do të lexojë këtë file automatikisht

2. **Paths duhet të jenë absolute:**
   - Përdor absolute paths si `/home/voicdwgn/public_html`
   - Mos përdor relative paths si `~/public_html`

3. **Permissions:**
   - Pas deployment, verifiko file permissions
   - Storage dhe cache directories duhen të kenë 755 permissions

4. **Composer dhe npm:**
   - cPanel duhet të ketë Composer dhe npm të instaluar
   - Nëse nuk janë, kontakto hosting provider

5. **PHP Version:**
   - Verifiko që PHP version është 8.2+ në cPanel → Select PHP Version

### 🔄 Workflow për Updates

1. **Bëj ndryshime lokal:**
   ```bash
   # Bëj ndryshime në kod
   git add .
   git commit -m "Update feature"
   git push origin main
   ```

2. **cPanel Auto-Deploy:**
   - cPanel do të detektojë push në GitHub
   - Do të pull-ojë automatikisht
   - Do të ekzekutojë deployment tasks nga `.cpanel.yml`
   - Do të deploy-ojë files në server

3. **Verifiko:**
   - Shkoni në https://voiceactions.dev
   - Verifiko që ndryshimet janë të dukshme

### 🧪 Test Deployment

Pas setup, testo deployment:

1. **Bëj një ndryshim të vogël:**
   ```bash
   echo "# Test" >> README.md
   git add README.md
   git commit -m "Test deployment"
   git push origin main
   ```

2. **Prit 1-2 minuta** për auto-deploy

3. **Verifiko në server:**
   - Shkoni në File Manager
   - Verifiko që files janë përditësuar
   - Ose shkoni në website dhe verifiko ndryshimet

### ❌ Troubleshooting

**Problem: Git Version Control nuk shfaqet në cPanel**

**Zgjidhja:**
- Kontakto hosting provider për të aktivizuar Git Version Control
- Ose përdor manual deployment (Metoda 1)

**Problem: Auto-deploy nuk funksionon**

**Zgjidhja:**
1. Verifiko që `.cpanel.yml` ekziston në root të repository
2. Verifiko që paths janë absolute dhe të sakta
3. Kontrollo cPanel error logs
4. Përdor manual deploy si workaround

**Problem: Deployment fails me error**

**Zgjidhja:**
1. Kontrollo cPanel deployment logs
2. Verifiko që Composer dhe npm janë të instaluar
3. Verifiko file permissions
4. Kontrollo `.cpanel.yml` syntax

---

**Për më shumë informacion, shiko:** `VOICEACTIONS_DEV_DEPLOYMENT.md`

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

