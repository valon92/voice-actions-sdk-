# 🚀 Auto Setup - Udhëzime të Shpejta

## 📋 Si të përdoret

### Hapi 1: Upload File
Vendos `auto-setup.php` në `~/public_html/auto-setup.php`

### Hapi 2: Hape në Browser
Hape: `https://voiceactions.dev/auto-setup.php`

### Hapi 3: Kliko "Start Auto Setup"
Script-i do të:
- ✅ Clone/pull nga GitHub
- ✅ Build frontend dhe backend
- ✅ Kopjo filet në vendet e duhura
- ✅ Setup database dhe konfigurim
- ✅ Cache configuration

### Hapi 4: Fshi File-in (IMPORTANT!)
**PAS SETUP-IT, FSHI `auto-setup.php` për siguri!**

---

## ⚠️ Kërkesat

- Node.js 18+ (për frontend build)
- PHP 8.1+ (për backend)
- Composer (për backend dependencies)
- Git (për clone/pull)
- SSH access (për ekzekutim komandash)

---

## 🔐 Siguri

Ky file ka akses të plotë në server. Për siguri më të madhe:

1. **Restrict by IP** - Edito `auto-setup.php` dhe shto IP-në tënde:
```php
$allowed_ips = ['127.0.0.1', '::1', 'YOUR_IP_HERE'];
```

2. **Password Protection** - Shto password check:
```php
if (!isset($_POST['password']) || $_POST['password'] !== 'your_secret_password') {
    die('Access denied');
}
```

3. **Fshi pas përdorimit** - Gjithmonë fshi file-in pas setup-it!

---

## 📁 Çfarë bën script-i

1. **Krijon direktoritë e nevojshme:**
   - `~/git/voiceactions-frontend`
   - `~/git/voiceactions-backend`
   - `~/api.voiceactions.dev`

2. **Clone/Pull nga GitHub:**
   - Pull latest changes nga repository

3. **Build Frontend:**
   - `npm install`
   - `npm run build`
   - Kopjo `dist/*` në `public_html/`

4. **Setup Backend:**
   - Kopjo filet në `api.voiceactions.dev/`
   - `composer install`
   - Krijo `.env` file
   - `php artisan key:generate`
   - Setup database
   - `php artisan migrate`
   - Cache configuration

5. **Set Permissions:**
   - `chmod -R 755 storage bootstrap/cache`

---

## 🐛 Troubleshooting

### Problem: "Permission denied"
**Zgjidhja:**
```bash
chmod 755 ~/public_html/auto-setup.php
```

### Problem: npm/composer nuk funksionon
**Zgjidhja:**
- Verifiko që Node.js dhe Composer janë në PATH
- Ose përdor full path: `/usr/local/bin/npm`

### Problem: Git clone dështon
**Zgjidhja:**
- Verifiko që repository është public
- Ose konfiguro SSH keys për private repo

---

## ✅ Pas Setup-it

1. Test frontend: https://voiceactions.dev
2. Test backend: https://api.voiceactions.dev/api/v1/commands/demo
3. **FSHI `auto-setup.php`!**

---

**Dokumenti i krijuar:** 2025-01-29  
**Status:** ✅ Gati për përdorim

