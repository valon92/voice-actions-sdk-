# Deployment Guide - voiceactions.dev

**Domain:** voiceactions.dev  
**Hosting Plan:**
- 3 Websites
- 20 GB SSD
- 30 Mailboxes
- AI Website Builder
- AI Tools

---

## 📋 Përmbledhje

Ky dokument përmbledh hapat për deployment të Voice Actions SDK në domain-in `voiceactions.dev`.

---

## 🎯 Struktura e Deployment

### 1. **Frontend (Vue.js + Vite)**
- **URL:** https://voiceactions.dev
- **Build Command:** `npm run build`
- **Output:** `frontend/dist/`
- **Port:** 443 (HTTPS)

### 2. **Backend (Laravel API)**
- **URL:** https://api.voiceactions.dev
- **Port:** 443 (HTTPS)
- **Database:** SQLite ose MySQL (në varësi të hosting plan)

### 3. **SDK CDN (Opsionale)**
- **URL:** https://cdn.voiceactions.dev
- **Files:** `sdk/dist/*.js`

---

## 🔧 Konfigurim i Environment Variables

### Frontend (.env.production)

```env
# API Configuration
VITE_API_URL=https://api.voiceactions.dev/api

# Sentry Configuration
VITE_SENTRY_DSN=your_sentry_dsn_here
VITE_SENTRY_TRACES_SAMPLE_RATE=0.1
VITE_SENTRY_REPLAYS_SESSION_SAMPLE_RATE=0.1

# App Configuration
VITE_APP_NAME=Voice Actions SDK
VITE_APP_ENV=production
```

### Backend (.env)

```env
APP_NAME="Voice Actions SDK"
APP_ENV=production
APP_KEY=base64:your_app_key_here
APP_DEBUG=false
APP_URL=https://api.voiceactions.dev

# Database Configuration
DB_CONNECTION=sqlite
DB_DATABASE=/path/to/database.sqlite
# OSE për MySQL:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=voiceactions
# DB_USERNAME=your_username
# DB_PASSWORD=your_password

# CORS Configuration
CORS_ALLOWED_ORIGINS=https://voiceactions.dev,https://www.voiceactions.dev

# Sentry Configuration
SENTRY_LARAVEL_DSN=your_sentry_dsn_here
SENTRY_TRACES_SAMPLE_RATE=0.1

# Session Configuration
SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=lax
```

---

## 📦 Hapat e Deployment

### Hapi 1: Përgatitja e Files

```bash
# 1. Build Frontend
cd frontend
npm install
npm run build
# Output: frontend/dist/

# 2. Përgatit Backend
cd ../backend
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Hapi 2: Upload Files në Server

**Frontend Files:**
- Upload të gjithë përmbajtjen e `frontend/dist/` në root directory të `voiceactions.dev`
- Ose në `public_html/` directory

**Backend Files:**
- Upload të gjithë përmbajtjen e `backend/` në `api.voiceactions.dev`
- Sigurohu që `storage/` dhe `bootstrap/cache/` kanë permissions të duhura (775)

### Hapi 3: Konfigurim i Database

```bash
# Nëse përdor SQLite
touch database/database.sqlite
chmod 664 database/database.sqlite

# Nëse përdor MySQL
php artisan migrate
php artisan db:seed  # Nëse ka seeders
```

### Hapi 4: Konfigurim i Web Server

#### Nginx Configuration (p.sh. për cPanel)

**Frontend (voiceactions.dev):**
```nginx
server {
    listen 443 ssl http2;
    server_name voiceactions.dev www.voiceactions.dev;
    
    root /path/to/frontend/dist;
    index index.html;
    
    # SSL Configuration
    ssl_certificate /path/to/ssl/cert.pem;
    ssl_certificate_key /path/to/ssl/key.pem;
    
    # SPA Routing
    location / {
        try_files $uri $uri/ /index.html;
    }
    
    # Static Assets
    location /assets/ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }
}
```

**Backend (api.voiceactions.dev):**
```nginx
server {
    listen 443 ssl http2;
    server_name api.voiceactions.dev;
    
    root /path/to/backend/public;
    index index.php;
    
    # SSL Configuration
    ssl_certificate /path/to/ssl/cert.pem;
    ssl_certificate_key /path/to/ssl/key.pem;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    # Deny access to hidden files
    location ~ /\. {
        deny all;
    }
}
```

#### Apache Configuration (.htaccess)

**Frontend (frontend/dist/.htaccess):**
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /
    RewriteRule ^index\.html$ - [L]
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule . /index.html [L]
</IfModule>

# Cache static assets
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType image/jpg "access plus 1 year"
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType text/css "access plus 1 year"
    ExpiresByType application/javascript "access plus 1 year"
</IfModule>
```

**Backend (backend/public/.htaccess):**
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

---

## 🔐 Siguria

### 1. SSL Certificate
- Aktivizo SSL për të dy domain-et
- Përdor Let's Encrypt (falas) ose certificate komerciale

### 2. CORS Configuration
- Konfiguro CORS në backend për të lejuar vetëm `voiceactions.dev`
- Përditëso `backend/config/cors.php`:

```php
'allowed_origins' => [
    'https://voiceactions.dev',
    'https://www.voiceactions.dev',
],
```

### 3. Environment Variables
- **MOS** commit `.env` files në Git
- Përdor environment variables të server-it
- Sigurohu që `APP_DEBUG=false` në production

### 4. File Permissions
```bash
# Backend
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

---

## 📊 Monitoring & Analytics

### 1. Sentry Error Tracking
- Konfiguro Sentry DSN në të dy frontend dhe backend
- Monitoro errors dhe performance

### 2. Log Files
- Backend logs: `backend/storage/logs/laravel.log`
- Web server logs: `/var/log/nginx/` ose `/var/log/apache2/`

### 3. Database Backups
- Konfiguro automatik backups për database
- Ruaj backups në cloud storage (p.sh. AWS S3, Google Cloud Storage)

---

## 🚀 Deployment Script

Krijo `deploy.sh` për automatizim:

```bash
#!/bin/bash

echo "🚀 Starting deployment to voiceactions.dev..."

# Build Frontend
echo "📦 Building frontend..."
cd frontend
npm install
npm run build
cd ..

# Prepare Backend
echo "📦 Preparing backend..."
cd backend
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
cd ..

# Upload files (përdor rsync, scp, ose FTP)
echo "📤 Uploading files..."
# rsync -avz --exclude 'node_modules' --exclude '.git' frontend/dist/ user@server:/path/to/frontend/
# rsync -avz --exclude 'node_modules' --exclude '.git' backend/ user@server:/path/to/backend/

echo "✅ Deployment complete!"
```

---

## 🔄 Post-Deployment Checklist

- [ ] Verifiko që frontend është accessible në https://voiceactions.dev
- [ ] Verifiko që backend API është accessible në https://api.voiceactions.dev/api/v1/commands/demo
- [ ] Testo registration flow
- [ ] Testo login flow
- [ ] Testo voice demo page
- [ ] Verifiko SSL certificates
- [ ] Testo CORS configuration
- [ ] Verifiko error tracking (Sentry)
- [ ] Testo database connections
- [ ] Verifiko file permissions
- [ ] Testo API rate limiting
- [ ] Verifiko email functionality (nëse përdoret)

---

## 📧 Email Configuration

Nëse hosting plan përfshin 30 mailboxes, mund të konfigurosh email për:

- **Support:** support@voiceactions.dev
- **Info:** info@voiceactions.dev
- **Noreply:** noreply@voiceactions.dev

**Laravel Mail Configuration (.env):**
```env
MAIL_MAILER=smtp
MAIL_HOST=mail.voiceactions.dev
MAIL_PORT=587
MAIL_USERNAME=noreply@voiceactions.dev
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@voiceactions.dev
MAIL_FROM_NAME="${APP_NAME}"
```

---

## 🌐 DNS Configuration

Konfiguro DNS records:

```
A Record:
voiceactions.dev -> IP_ADDRESS
www.voiceactions.dev -> IP_ADDRESS

CNAME Record:
api.voiceactions.dev -> voiceactions.dev
cdn.voiceactions.dev -> voiceactions.dev (opsionale)
```

---

## 📝 Notes

1. **AI Website Builder:** Nëse hosting plan përfshin AI Website Builder, mund të përdoret për landing pages ose dokumentacion
2. **AI Tools:** Mund të integrohen për automatizim të deployment ose monitoring
3. **Storage:** 20 GB SSD është i mjaftueshëm për fillim, por monitoro usage
4. **Multiple Websites:** Mund të përdorësh 2 websites të tjera për:
   - Staging environment
   - Documentation site
   - Demo site

---

## 🆘 Troubleshooting

### Problem: CORS Errors
**Zgjidhja:** Verifiko `backend/config/cors.php` dhe sigurohu që origins janë të sakta

### Problem: 500 Internal Server Error
**Zgjidhja:** 
- Kontrollo `storage/logs/laravel.log`
- Verifiko file permissions
- Kontrollo `.env` configuration

### Problem: Frontend nuk ngarkon
**Zgjidhja:**
- Verifiko që `dist/` files janë uploaded
- Kontrollo nginx/apache configuration
- Verifiko SSL certificate

---

**Dokumenti i krijuar:** 2025-01-29  
**Status:** ✅ Gati për deployment

