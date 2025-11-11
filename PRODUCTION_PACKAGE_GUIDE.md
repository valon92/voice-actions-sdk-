# 🚀 Production Package Guide - Strukturë e Plotë për Deployment

## 📦 Çfarë është Production Package?

Kjo është një strukturë **e plotë dhe e gatshme** që përmban:
- ✅ Frontend i build-uar (Vue.js) - gati për production
- ✅ Backend i konfiguruar (Laravel) - gati për production  
- ✅ Të gjitha konfigurimet për `voiceactions.dev`
- ✅ .htaccess files për Apache
- ✅ Deployment script automatik

**Nuk ka nevojë të ndryshosh asgjë!** Thjesht upload dhe deploy.

---

## 🎯 Si të Krijohet Package

### Hapi 1: Build Package Lokal

```bash
cd /path/to/VoiceActionsSDK
./create-production-package.sh
```

Kjo do të krijojë directory `voiceactions-production/` me të gjitha filet e nevojshme.

---

## 📤 Deployment në cPanel (3 Hapa)

### Hapi 1: Upload Package në Server

**Opsioni A: Përmes cPanel File Manager**
1. Shko te cPanel → File Manager
2. Upload `voiceactions-production/` directory
3. Extract nëse është .zip

**Opsioni B: Përmes SSH**
```bash
# Në kompjuterin lokal
cd voiceactions-production
tar -czf voiceactions-production.tar.gz *
scp -r * voicdwgn@server705.web-hosting.com:~/voiceactions-production/
```

**Opsioni C: Përmes Git (nëse ke push-uar)**
```bash
# Në server
cd ~
git clone https://github.com/valon92/voice-actions-sdk-.git temp-clone
cd temp-clone
./create-production-package.sh
mv voiceactions-production ~/
cd ~
rm -rf temp-clone
```

### Hapi 2: Ekzekuto Deployment Script

```bash
# SSH në server
ssh voicdwgn@server705.web-hosting.com

# Navigo te package
cd ~/voiceactions-production

# Ekzekuto deployment
./deploy-to-public-html.sh
```

Script-i do të:
- ✅ Kopjojë frontend në `~/public_html/`
- ✅ Kopjojë backend në `~/api.voiceactions.dev/`
- ✅ Setup `.env` file
- ✅ Generate app key
- ✅ Setup database
- ✅ Run migrations
- ✅ Set permissions
- ✅ Cache configuration

### Hapi 3: Verifiko

1. **Frontend:** https://voiceactions.dev
2. **Backend API:** https://api.voiceactions.dev/api/v1/commands/demo

---

## 📁 Struktura e Package-it

```
voiceactions-production/
├── index.html              # Frontend entry point
├── assets/                 # Frontend assets (JS, CSS, images)
│   ├── index-*.css
│   └── index-*.js
├── .htaccess               # Frontend Apache config (Vue Router)
├── api/                    # Backend Laravel application
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── public/            # Backend entry point
│   │   ├── index.php
│   │   └── .htaccess
│   ├── routes/
│   ├── storage/
│   ├── vendor/
│   └── .env.production    # Production environment template
├── deploy-to-public-html.sh  # Deployment script
└── README.md              # Documentation
```

---

## 🔧 Manual Deployment (nëse script-i nuk funksionon)

### 1. Deploy Frontend

```bash
# Kopjo frontend files në public_html
cp -r ~/voiceactions-production/index.html ~/public_html/
cp -r ~/voiceactions-production/assets ~/public_html/
cp ~/voiceactions-production/.htaccess ~/public_html/
```

### 2. Deploy Backend

```bash
# Krijo API directory
mkdir -p ~/api.voiceactions.dev

# Kopjo backend files
cp -r ~/voiceactions-production/api/* ~/api.voiceactions.dev/
```

### 3. Setup Backend

```bash
cd ~/api.voiceactions.dev

# Setup environment
cp .env.production .env
php artisan key:generate

# Setup database
mkdir -p database
touch database/database.sqlite
chmod 664 database/database.sqlite
php artisan migrate --force

# Set permissions
chmod -R 755 storage bootstrap/cache
chmod 644 .env

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## ✅ Çfarë është Konfiguruar Automatikisht

### Frontend
- ✅ API URL: `https://api.voiceactions.dev/api`
- ✅ Build për production (minified, optimized)
- ✅ Vue Router konfiguruar
- ✅ .htaccess për SPA routing

### Backend
- ✅ APP_URL: `https://api.voiceactions.dev`
- ✅ CORS: `https://voiceactions.dev`
- ✅ Database: SQLite në `database/database.sqlite`
- ✅ Environment: Production
- ✅ Debug: Disabled

---

## 🔄 Update Deployment

Kur bën ndryshime në kod:

1. **Build package përsëri:**
   ```bash
   ./create-production-package.sh
   ```

2. **Upload përsëri në server:**
   ```bash
   # Ose përdor Git Version Control në cPanel
   ```

3. **Redeploy:**
   ```bash
   cd ~/voiceactions-production
   ./deploy-to-public-html.sh
   ```

---

## 🐛 Troubleshooting

### Problem: Frontend nuk shfaqet
**Zgjidhja:**
- Verifiko që `.htaccess` është në `public_html/`
- Verifiko që mod_rewrite është aktivizuar në Apache

### Problem: Backend API nuk funksionon
**Zgjidhja:**
```bash
cd ~/api.voiceactions.dev
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
```

### Problem: Database errors
**Zgjidhja:**
```bash
cd ~/api.voiceactions.dev
chmod 664 database/database.sqlite
php artisan migrate:fresh --force
```

### Problem: Permission denied
**Zgjidhja:**
```bash
chmod -R 755 ~/api.voiceactions.dev/storage
chmod -R 755 ~/api.voiceactions.dev/bootstrap/cache
```

---

## 📝 Shënime të Rëndësishme

1. **Nuk ka nevojë të ndryshosh filet** - gjithçka është konfiguruar për production
2. **API URL është hardcoded** për `api.voiceactions.dev`
3. **Frontend është i build-uar** - nuk ka nevojë për `npm install` në server
4. **Backend dependencies janë instaluar** - `vendor/` directory është përfshirë
5. **Database do të krijohet automatikisht** kur run `migrate`

---

## 🎉 Përmbledhje

1. ✅ Build package: `./create-production-package.sh`
2. ✅ Upload `voiceactions-production/` në server
3. ✅ Run: `./deploy-to-public-html.sh`
4. ✅ Test: https://voiceactions.dev

**Gjithçka është gati dhe konfiguruar!** 🚀

---

**Dokumenti i krijuar:** 2025-01-29  
**Status:** ✅ Gati për deployment

