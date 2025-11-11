# 🚀 Deployment në cPanel përmes GitHub

**Domain:** voiceactions.dev  
**Hosting:** cPanel  
**Deployment Method:** GitHub Integration

---

## 📋 Përmbledhje

Ky dokument përmbledh hapat për deployment të Voice Actions SDK në cPanel duke përdorur Git Version Control.

---

## 🎯 Para Deployment

### 1. Krijo GitHub Repository (nëse nuk ekziston)

```bash
# Nëse repository ekziston tashmë, skip këtë hap
git remote add origin https://github.com/valon92/voice-actions-sdk-.git
git push -u origin main
```

### 2. Përgatit Repository për cPanel

Krijo `.cpanel.yml` në root të projektit për auto-deployment:

```yaml
---
deployment:
  tasks:
    - export DEPLOYPATH=/home/username/public_html
    - /bin/cp -R frontend/dist/* $DEPLOYPATH/
    - /bin/cp -R backend/* $DEPLOYPATH/api/
    - cd $DEPLOYPATH/api && /usr/local/bin/php composer.phar install --no-dev --optimize-autoloader
    - cd $DEPLOYPATH/api && /usr/local/bin/php artisan config:cache
    - cd $DEPLOYPATH/api && /usr/local/bin/php artisan route:cache
    - cd $DEPLOYPATH/api && /usr/local/bin/php artisan view:cache
```

**OSE** përdor manual deployment (më e thjeshtë për fillim).

---

## 🔧 Hapat e Deployment në cPanel

### Hapi 1: Hap Git Version Control në cPanel

1. **Login në cPanel**
2. Shko te **"Git Version Control"** (në "Software" section)
3. Kliko **"Create"** për të krijuar një repository të ri

### Hapi 2: Konfiguro Repository

**Për Frontend (voiceactions.dev):**

```
Repository Name: voiceactions-frontend
Repository URL: https://github.com/valon92/voice-actions-sdk-.git
Repository Branch: main
Deployment Path: /home/username/public_html
```

**Për Backend (api.voiceactions.dev):**

```
Repository Name: voiceactions-backend
Repository URL: https://github.com/valon92/voice-actions-sdk-.git
Repository Branch: main
Deployment Path: /home/username/api.voiceactions.dev
```

### Hapi 3: Build Script për Frontend

Krijo `build-frontend.sh` në root të projektit:

```bash
#!/bin/bash
# Build script për frontend në cPanel

cd frontend
npm install
npm run build
cd ..

# Kopjo files në public_html
cp -r frontend/dist/* public_html/
```

### Hapi 4: Build Script për Backend

Krijo `build-backend.sh` në root të projektit:

```bash
#!/bin/bash
# Build script për backend në cPanel

cd backend
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
cd ..
```

---

## 📁 Struktura e Direktorive në cPanel

```
/home/username/
├── public_html/              # Frontend (voiceactions.dev)
│   ├── index.html
│   ├── assets/
│   └── ...
├── api.voiceactions.dev/     # Backend (api.voiceactions.dev)
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── public/
│   │   └── index.php        # Entry point
│   ├── routes/
│   ├── storage/
│   ├── vendor/
│   └── .env
└── git/                      # Git repositories (automatikisht krijuar)
    ├── voiceactions-frontend/
    └── voiceactions-backend/
```

---

## 🔄 Deployment Workflow

### Metoda 1: Manual Deployment (Rekomanduar për fillim)

1. **Pull nga GitHub:**
   ```bash
   cd ~/git/voiceactions-frontend
   git pull origin main
   ```

2. **Build Frontend:**
   ```bash
   cd ~/git/voiceactions-frontend/frontend
   npm install
   npm run build
   ```

3. **Kopjo Files:**
   ```bash
   cp -r ~/git/voiceactions-frontend/frontend/dist/* ~/public_html/
   ```

4. **Build Backend:**
   ```bash
   cd ~/git/voiceactions-backend/backend
   composer install --no-dev --optimize-autoloader
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

5. **Kopjo Backend Files:**
   ```bash
   cp -r ~/git/voiceactions-backend/backend/* ~/api.voiceactions.dev/
   ```

### Metoda 2: Auto-Deployment me Webhook (Avancuar)

1. **Krijo Webhook në GitHub:**
   - Shko te Settings → Webhooks → Add webhook
   - Payload URL: `https://voiceactions.dev/cpanel-webhook.php`
   - Content type: `application/json`
   - Events: `Just the push event`

2. **Krijo `cpanel-webhook.php` në public_html:**

```php
<?php
// cpanel-webhook.php
// Sigurohu që kjo file është e sigurt dhe kërkon authentication

$secret = 'your_webhook_secret_here';
$payload = file_get_contents('php://input');
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';

if (!hash_equals('sha256=' . hash_hmac('sha256', $payload, $secret), $signature)) {
    http_response_code(401);
    die('Unauthorized');
}

$data = json_decode($payload, true);

if ($data['ref'] === 'refs/heads/main') {
    // Execute deployment script
    $output = shell_exec('cd ~/git/voiceactions-frontend && git pull origin main 2>&1');
    $output .= shell_exec('cd ~/git/voiceactions-frontend/frontend && npm install && npm run build 2>&1');
    $output .= shell_exec('cp -r ~/git/voiceactions-frontend/frontend/dist/* ~/public_html/ 2>&1');
    
    // Log deployment
    file_put_contents('/home/username/deployment.log', date('Y-m-d H:i:s') . "\n" . $output . "\n\n", FILE_APPEND);
    
    echo "Deployment completed";
} else {
    echo "Not main branch, skipping deployment";
}
?>
```

---

## 🔐 Konfigurim i Sigurisë

### 1. File Permissions

```bash
# Frontend
chmod 755 ~/public_html
chmod 644 ~/public_html/*.html
chmod 755 ~/public_html/assets

# Backend
chmod 755 ~/api.voiceactions.dev
chmod 755 ~/api.voiceactions.dev/storage
chmod 755 ~/api.voiceactions.dev/bootstrap/cache
chmod 644 ~/api.voiceactions.dev/.env
```

### 2. .env Configuration

Krijo `.env` në `~/api.voiceactions.dev/.env`:

```env
APP_NAME="Voice Actions SDK"
APP_ENV=production
APP_KEY=base64:your_generated_key_here
APP_DEBUG=false
APP_URL=https://api.voiceactions.dev

DB_CONNECTION=sqlite
DB_DATABASE=/home/username/api.voiceactions.dev/database/database.sqlite

CORS_ALLOWED_ORIGINS=https://voiceactions.dev,https://www.voiceactions.dev

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=lax
```

### 3. Generate App Key

```bash
cd ~/api.voiceactions.dev
php artisan key:generate
```

---

## 📝 cPanel Cron Jobs (për Auto-Deployment)

Krijo cron job në cPanel për të pull-uar automatikisht nga GitHub:

1. Shko te **"Cron Jobs"** në cPanel
2. Kliko **"Create New Cron Job"**
3. Konfiguro:

```
Minute: 0
Hour: * (çdo orë)
Day: * (çdo ditë)
Month: * (çdo muaj)
Weekday: * (çdo ditë të javës)
Command: cd ~/git/voiceactions-frontend && git pull origin main && cd frontend && npm install && npm run build && cp -r dist/* ~/public_html/
```

---

## 🚀 Quick Deployment Script

Krijo `deploy-cpanel.sh` në root të projektit:

```bash
#!/bin/bash
# Quick deployment script për cPanel

echo "🚀 Starting deployment to cPanel..."

# Frontend
echo "📦 Building frontend..."
cd frontend
npm install
npm run build
cd ..

# Backend
echo "📦 Building backend..."
cd backend
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
cd ..

echo "✅ Build complete!"
echo ""
echo "📋 Next steps:"
echo "1. Upload frontend/dist/* to ~/public_html/"
echo "2. Upload backend/* to ~/api.voiceactions.dev/"
echo "3. Configure .env file"
echo "4. Set proper file permissions"
```

---

## 🔍 Troubleshooting

### Problem: Git pull nuk funksionon
**Zgjidhja:**
- Verifiko që SSH keys janë konfiguruar në cPanel
- Ose përdor HTTPS me personal access token

### Problem: npm install dështon
**Zgjidhja:**
- Verifiko që Node.js version është i përditësuar në cPanel
- Kontrollo disk space (20 GB SSD)

### Problem: Composer install dështon
**Zgjidhja:**
- Verifiko që PHP version është 8.1+ në cPanel
- Kontrollo memory limit në php.ini

### Problem: File permissions errors
**Zgjidhja:**
```bash
chmod -R 755 ~/api.voiceactions.dev/storage
chmod -R 755 ~/api.voiceactions.dev/bootstrap/cache
```

---

## 📊 Monitoring

### 1. Check Deployment Logs

```bash
# Nëse ke webhook deployment
tail -f ~/deployment.log

# Check Laravel logs
tail -f ~/api.voiceactions.dev/storage/logs/laravel.log
```

### 2. Check Git Status

```bash
cd ~/git/voiceactions-frontend
git status
git log --oneline -5
```

---

## ✅ Post-Deployment Checklist

- [ ] Verifiko që frontend është accessible në https://voiceactions.dev
- [ ] Verifiko që backend API është accessible në https://api.voiceactions.dev/api/v1/commands/demo
- [ ] Testo registration flow
- [ ] Testo login flow
- [ ] Testo voice demo page
- [ ] Verifiko SSL certificates
- [ ] Testo CORS configuration
- [ ] Verifiko file permissions
- [ ] Testo database connections
- [ ] Verifiko error tracking (Sentry)

---

## 🔗 Resources

- [cPanel Git Version Control Documentation](https://docs.cpanel.net/cpanel/software/git-version-control/)
- [GitHub Webhooks Documentation](https://docs.github.com/en/developers/webhooks-and-events/webhooks)

---

**Dokumenti i krijuar:** 2025-01-29  
**Status:** ✅ Gati për deployment në cPanel


