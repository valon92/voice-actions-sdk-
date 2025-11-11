# 🔐 SSH Setup Guide për cPanel Server

**Server:** server705.web-hosting.com  
**Username:** voicdwgn  
**Domain:** voiceactions.dev

---

## 📋 Para Lidhjes

### 1. Verifiko SSH Access

Nëse nuk ke SSH key, vendos password authentication në cPanel:
- Shko te **"SSH Access"** në cPanel
- Aktivizo SSH access nëse nuk është aktivizuar

### 2. Generate SSH Key (opsionale, por e rekomanduar)

```bash
# Në kompjuterin lokal
ssh-keygen -t ed25519 -C "voiceactions-dev"

# Kopjo public key
cat ~/.ssh/id_ed25519.pub
```

Pastaj shtoje në cPanel:
- Shko te **"SSH Access"** → **"Manage SSH Keys"**
- Kliko **"Import Key"**
- Paste public key dhe save

---

## 🔌 Lidhja me Server

### Metoda 1: SSH me Password

```bash
ssh voicdwgn@server705.web-hosting.com
```

### Metoda 2: SSH me Key (më e sigurt)

```bash
ssh -i ~/.ssh/id_ed25519 voicdwgn@server705.web-hosting.com
```

Ose konfiguro në `~/.ssh/config`:

```
Host voiceactions
    HostName server705.web-hosting.com
    User voicdwgn
    IdentityFile ~/.ssh/id_ed25519
```

Pastaj lidhu me:
```bash
ssh voiceactions
```

---

## 🚀 Hapat e Shpejtë pas Lidhjes

### 1. Verifiko Strukturën

```bash
# Verifiko që jemi në home directory
pwd
# Duhet të jetë: /home/voicdwgn

# Verifiko strukturën
ls -la
# Duhet të shohësh: public_html, git, etj.
```

### 2. Download Setup Script

```bash
# Ose kopjo setup-server.sh në server
# Ose ekzekuto komandat manualisht
```

### 3. Ekzekuto Setup Script

```bash
# Nëse ke ngarkuar script-in
chmod +x setup-server.sh
./setup-server.sh

# Ose ekzekuto komandat manualisht (shih më poshtë)
```

---

## 📝 Komandat Manuale (nëse nuk përdor script)

### 1. Setup Git Version Control (në cPanel)

1. Shko te **"Git Version Control"** në cPanel
2. Kliko **"Create"**
3. Konfiguro:
   ```
   Repository Name: voiceactions-frontend
   Repository URL: https://github.com/valon92/voice-actions-sdk-.git
   Repository Branch: main
   Deployment Path: /home/voicdwgn/public_html
   ```
4. Kliko **"Create"**

### 2. Clone Backend Repository

```bash
cd ~
mkdir -p git/voiceactions-backend
cd git/voiceactions-backend
git clone https://github.com/valon92/voice-actions-sdk-.git .
git checkout main
```

### 3. Build Frontend

```bash
# Frontend duhet të jetë tashmë në ~/git/voiceactions-frontend (nga Git Version Control)
cd ~/git/voiceactions-frontend/frontend
npm install
npm run build

# Kopjo në public_html
cp -r dist/* ~/public_html/
```

### 4. Setup Backend

```bash
# Krijo API directory
mkdir -p ~/api.voiceactions.dev

# Kopjo backend files
cp -r ~/git/voiceactions-backend/backend/* ~/api.voiceactions.dev/

# Install dependencies
cd ~/api.voiceactions.dev
composer install --no-dev --optimize-autoloader
```

### 5. Konfiguro Environment

```bash
cd ~/api.voiceactions.dev

# Krijo .env
cp .env.production.example .env

# Ose krijo manualisht
cat > .env << 'EOF'
APP_NAME="Voice Actions SDK"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://api.voiceactions.dev

DB_CONNECTION=sqlite
DB_DATABASE=/home/voicdwgn/api.voiceactions.dev/database/database.sqlite

CORS_ALLOWED_ORIGINS=https://voiceactions.dev,https://www.voiceactions.dev

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=lax
EOF

# Generate app key
php artisan key:generate
```

### 6. Setup Database

```bash
cd ~/api.voiceactions.dev

# Krijo database directory
mkdir -p database
touch database/database.sqlite
chmod 664 database/database.sqlite

# Run migrations
php artisan migrate --force
```

### 7. Set Permissions

```bash
chmod -R 755 ~/api.voiceactions.dev/storage
chmod -R 755 ~/api.voiceactions.dev/bootstrap/cache
chmod 644 ~/api.voiceactions.dev/.env
```

### 8. Cache Configuration

```bash
cd ~/api.voiceactions.dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🔍 Verifikimi

### Test Frontend

```bash
# Në browser
https://voiceactions.dev
```

### Test Backend

```bash
# Në browser ose curl
curl https://api.voiceactions.dev/api/v1/commands/demo
```

### Check Logs

```bash
# Laravel logs
tail -f ~/api.voiceactions.dev/storage/logs/laravel.log

# Web server logs (nëse ke access)
tail -f ~/logs/access_log
tail -f ~/logs/error_log
```

---

## 🔄 Update Deployment

### Manual Update

```bash
# Frontend
cd ~/git/voiceactions-frontend
git pull origin main
cd frontend
npm install
npm run build
cp -r dist/* ~/public_html/

# Backend
cd ~/git/voiceactions-backend
git pull origin main
cd backend
composer install --no-dev --optimize-autoloader
cp -r * ~/api.voiceactions.dev/
cd ~/api.voiceactions.dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Auto-Update me Webhook

Shih `CPANEL_DEPLOYMENT.md` për webhook setup.

---

## 🛠️ Troubleshooting

### Problem: Git pull kërkon authentication

**Zgjidhja:**
```bash
# Përdor personal access token
git remote set-url origin https://YOUR_TOKEN@github.com/valon92/voice-actions-sdk-.git
```

### Problem: npm install dështon

**Zgjidhja:**
```bash
# Verifiko Node.js version
node -v
npm -v

# Nëse version është i vjetër, përdor Node Version Manager
# Ose kontakto hosting provider për update
```

### Problem: Composer install dështon

**Zgjidhja:**
```bash
# Verifiko PHP version
php -v

# Verifiko memory limit
php -i | grep memory_limit

# Nëse është shumë i ulët, kontakto hosting provider
```

### Problem: Permission denied

**Zgjidhja:**
```bash
# Set proper permissions
chmod -R 755 ~/api.voiceactions.dev/storage
chmod -R 755 ~/api.voiceactions.dev/bootstrap/cache
```

---

## 📚 Resources

- [cPanel SSH Access Documentation](https://docs.cpanel.net/cpanel/security/ssh-access/)
- [Git Version Control in cPanel](https://docs.cpanel.net/cpanel/software/git-version-control/)
- `CPANEL_DEPLOYMENT.md` - Detailed deployment guide

---

**Dokumenti i krijuar:** 2025-01-29  
**Status:** ✅ Gati për SSH setup

