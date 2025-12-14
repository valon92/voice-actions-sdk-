# 🚀 cPanel Quick Start Guide

**Voice Actions SDK - Deployment në 5 minuta**

---

## ⚡ Quick Deployment

### Metoda 1: Përdor Deployment Script (Më e Shpejtë)

```bash
# 1. Klono projektin
git clone https://github.com/valon92/voice-actions-sdk-.git
cd voice-actions-sdk-

# 2. Run deployment script
chmod +x deploy-cpanel-full.sh
./deploy-cpanel-full.sh

# 3. Upload package në cPanel
# - Upload voiceactions-deploy-*.zip në cPanel File Manager
# - Extract dhe follow instructions
```

### Metoda 2: Manual Build dhe Upload

```bash
# 1. Build frontend
cd frontend
npm install
npm run build
cd ..

# 2. Prepare backend
cd backend
composer install --no-dev --optimize-autoloader
cd ..

# 3. Upload files:
# - frontend/dist/* → ~/public_html/
# - backend/* → ~/api.voiceactions.dev/
```

---

## 📋 Checklist e Shpejtë

### Para Upload

- [ ] Projekt është build-uar (`npm run build` për frontend)
- [ ] Dependencies janë installuar (`composer install` për backend)
- [ ] Package është krijuar (nëse përdor script)

### Pas Upload

- [ ] Frontend files janë në `~/public_html/`
- [ ] Backend files janë në `~/api.voiceactions.dev/`
- [ ] `.env` file është krijuar dhe konfiguruar
- [ ] `APP_KEY` është generated (`php artisan key:generate`)
- [ ] Database migrations janë run (`php artisan migrate`)
- [ ] File permissions janë set (`chmod -R 755 storage bootstrap/cache`)

### Testing

- [ ] Frontend: `https://voiceactions.dev` - shfaqet
- [ ] Backend: `https://api.voiceactions.dev/api/commands/demo` - kthen JSON
- [ ] Registration: `POST /api/platforms/register` - funksionon

---

## 🔧 Konfigurim i Shpejtë

### 1. Krijo .env File

```bash
cd ~/api.voiceactions.dev
cp .env.example .env
# Pastaj edito .env me vlerat e tua
```

### 2. Minimum .env Configuration

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://api.voiceactions.dev

DB_CONNECTION=sqlite
DB_DATABASE=/home/username/api.voiceactions.dev/database/database.sqlite

CORS_ALLOWED_ORIGINS=https://voiceactions.dev
```

### 3. Setup Database

```bash
# Për SQLite (më e thjeshtë)
touch database/database.sqlite
chmod 664 database/database.sqlite
php artisan migrate

# Ose për MySQL
# Konfiguro DB_* në .env dhe run:
php artisan migrate
```

### 4. Generate Key dhe Cache

```bash
php artisan key:generate
php artisan config:cache
php artisan route:cache
```

---

## 🎯 Common Issues dhe Zgjidhje

### Issue: 500 Error

```bash
# Check logs
tail -f storage/logs/laravel.log

# Common fixes
php artisan config:clear
php artisan cache:clear
chmod -R 755 storage bootstrap/cache
```

### Issue: CORS Error

```bash
# Update .env
CORS_ALLOWED_ORIGINS=https://voiceactions.dev,https://www.voiceactions.dev

# Clear cache
php artisan config:clear
php artisan config:cache
```

### Issue: Route Not Found

```bash
# Clear route cache
php artisan route:clear
php artisan route:cache
```

---

## 📞 Need Help?

Shiko dokumentacionin e plotë: `DEPLOY_CPANEL.md`

---

**Quick Start Version:** 1.0.0  
**Last Updated:** 2025-01-29

