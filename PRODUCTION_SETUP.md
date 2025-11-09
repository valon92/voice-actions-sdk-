# 🚀 Production Setup Guide

**Data:** 2025-01-08  
**Status:** ✅ **PRODUCTION READY**

---

## 📋 Para Deployment

### 1. Environment Variables

Kopjo `.env.example` në `.env` dhe plotëso variablat:

```bash
cp .env.example .env
php artisan key:generate
```

**Variablat e rëndësishme për production:**

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://api.voiceactions.io

FRONTEND_URL=https://voiceactions.io

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=voice_actions_sdk
DB_USERNAME=your_db_user
DB_PASSWORD=your_secure_password

CACHE_STORE=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
```

### 2. Database Setup

```bash
# Run migrations
php artisan migrate --force

# Optional: Seed test data
php artisan db:seed
```

### 3. CORS Configuration

CORS është konfiguruar automatikisht bazuar në `APP_ENV`:
- **Local:** Lejon `*` (të gjitha origins)
- **Production:** Lejon vetëm `FRONTEND_URL` dhe `APP_URL`

Për të shtuar domain të tjera në production, shto në `backend/config/cors.php`:

```php
'allowed_origins' => [
    env('FRONTEND_URL'),
    env('APP_URL'),
    'https://your-custom-domain.com',
],
```

### 4. Cache Configuration

Për production, rekomandohet Redis:

```bash
# Install Redis
sudo apt-get install redis-server

# Update .env
CACHE_STORE=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
```

### 5. Rate Limiting

Rate limiting është implementuar automatikisht bazuar në plan:

- **Free Plan:** 60/min, 1K/hour, 10K/day
- **Pro Plan:** 1K/min, 50K/hour, 1M/day
- **Enterprise Plan:** 10K/min, 500K/hour, 10M/day

Limitet janë ruajtur në `api_rate_limits` table dhe kontrollohen automatikisht nga `RateLimitMiddleware`.

### 6. Security Checklist

- ✅ API keys janë hashed
- ✅ Rate limiting implementuar
- ✅ CORS konfiguruar për production
- ✅ Error logging aktiv
- ⚠️ SSL/HTTPS (duhet konfiguruar në server)
- ⚠️ Firewall rules (duhet konfiguruar në server)
- ⚠️ Database backups (duhet konfiguruar)

---

## 🔧 Server Configuration

### Nginx Configuration Example

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name api.voiceactions.io;
    
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name api.voiceactions.io;

    root /var/www/voice-actions-sdk/backend/public;
    index index.php;

    ssl_certificate /path/to/cert.pem;
    ssl_certificate_key /path/to/key.pem;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### PHP-FPM Configuration

```ini
; /etc/php/8.2/fpm/pool.d/www.conf
pm = dynamic
pm.max_children = 50
pm.start_servers = 10
pm.min_spare_servers = 5
pm.max_spare_servers = 20
pm.max_requests = 500
```

---

## 📊 Monitoring

### Log Files

Laravel logs janë në `storage/logs/laravel.log`. Për production:

```bash
# Rotate logs
sudo logrotate -f /etc/logrotate.d/laravel
```

### Error Tracking

✅ **Sentry** është integruar për error tracking dhe monitoring.

**Setup:**
1. Krijoni Sentry account në [sentry.io](https://sentry.io)
2. Shtoni DSN në `.env`:
   ```env
   SENTRY_LARAVEL_DSN=https://your-dsn@sentry.io/project-id
   SENTRY_ENVIRONMENT=production
   ```
3. Shiko `SENTRY_SETUP.md` për guide të plotë

**Features:**
- Real-time error tracking
- Performance monitoring
- Session replay
- Release tracking
- Custom alerts

Konsidero edhe:
- **New Relic** - Performance monitoring
- **Datadog** - Full-stack monitoring

---

## 🔄 Deployment Process

### 1. Pre-deployment

```bash
# Update code
git pull origin main

# Install dependencies
composer install --no-dev --optimize-autoloader
npm install --production

# Clear caches
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 2. Run Migrations

```bash
php artisan migrate --force
```

### 3. Restart Services

```bash
# Restart PHP-FPM
sudo systemctl restart php8.2-fpm

# Restart Nginx
sudo systemctl restart nginx

# Restart Queue Workers (if using)
php artisan queue:restart
```

---

## 🧪 Testing Production

### Health Check Endpoint

```bash
curl https://api.voiceactions.io/api/platforms
```

### Test Rate Limiting

```bash
# Test with API key
for i in {1..100}; do
  curl -H "X-API-Key: your-api-key" \
    https://api.voiceactions.io/api/commands
done
```

---

## 📝 Notes

- Rate limiting përdor Laravel Cache (Redis recommended për production)
- CORS headers përfshijnë rate limit information
- Të gjitha errors loggohen në `storage/logs/laravel.log`
- API responses janë konsistente me `success` dhe `error` fields

---

**Status:** ✅ **READY FOR PRODUCTION**

