# Production Configuration - voiceactions.dev

Ky dokument përmbledh të gjitha konfigurimet e nevojshme për deployment në production për domain-in `voiceactions.dev`.

## 🌐 Domains

- **Frontend:** https://voiceactions.dev
- **Backend API:** https://api.voiceactions.dev
- **API Base URL:** https://api.voiceactions.dev/api

## 📋 Environment Variables

### Backend (.env)

```env
APP_NAME="Voice Actions SDK"
APP_ENV=production
APP_KEY=base64:... # Generate me: php artisan key:generate
APP_DEBUG=false
APP_URL=https://api.voiceactions.dev
FRONTEND_URL=https://voiceactions.dev

DB_CONNECTION=sqlite
DB_DATABASE=/path/to/database/database.sqlite

# Sentry (Optional)
SENTRY_LARAVEL_DSN=
SENTRY_TRACES_SAMPLE_RATE=0.1

# CORS
CORS_ALLOWED_ORIGINS=https://voiceactions.dev,https://www.voiceactions.dev
```

### Frontend (.env.production)

```env
VITE_API_URL=https://api.voiceactions.dev/api
```

## 🔧 Konfigurime të Përditësuara

### 1. CORS Configuration (`backend/config/cors.php`)

✅ Tashmë konfiguruar për të lejuar:
- `https://voiceactions.dev`
- `https://www.voiceactions.dev`
- Localhost në development

### 2. Frontend API URL

✅ Konfiguruar në:
- `frontend/src/main.js` - Axios baseURL
- `frontend/src/pages/VoiceDemo.vue` - Fetch API URL

Përdor relative path `/api` në development (Vite proxy) dhe `https://api.voiceactions.dev/api` në production.

### 3. SDK Configuration (`sdk/src/index.js`)

✅ Automatikisht detekton:
- Localhost → `http://localhost:8000/api`
- Production → `https://api.voiceactions.dev/api`

## 🚀 Deployment Checklist

### Backend (api.voiceactions.dev)

- [ ] Krijo `.env` file me konfigurimet e mësipërme
- [ ] Run `php artisan key:generate`
- [ ] Run `php artisan migrate`
- [ ] Set permissions: `chmod -R 755 storage bootstrap/cache`
- [ ] Test API: `curl https://api.voiceactions.dev/api/commands/demo`

### Frontend (voiceactions.dev)

- [ ] Build me: `VITE_API_URL=https://api.voiceactions.dev/api npm run build`
- [ ] Upload `dist/` contents në public_html
- [ ] Test: `https://voiceactions.dev`

## 🔒 Security

1. **CORS:** Vetëm `voiceactions.dev` dhe `www.voiceactions.dev` janë të lejuara
2. **HTTPS:** Të gjitha requests duhet të jenë HTTPS
3. **API Keys:** Ruhen hashed në database
4. **Rate Limiting:** Aktiv për të gjitha API routes

## 📝 Notes

- Në development, frontend përdor Vite proxy (`/api`) që redirect në `localhost:8000`
- Në production, frontend përdor direkt `https://api.voiceactions.dev/api`
- SDK automatikisht detekton environment dhe përdor URL-në e duhur

## 🧪 Testing

```bash
# Test Frontend
curl https://voiceactions.dev

# Test Backend API
curl https://api.voiceactions.dev/api/commands/demo

# Test CORS
curl -H "Origin: https://voiceactions.dev" \
     -H "Access-Control-Request-Method: GET" \
     -X OPTIONS \
     https://api.voiceactions.dev/api/commands/demo
```

## 📞 Support

Nëse keni probleme me konfigurimin, kontaktoni:
- **Email:** support@voiceactions.io
- **Documentation:** https://voiceactions.dev/docs/integration

