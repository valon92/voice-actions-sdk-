# 🔍 Sentry Error Tracking & Monitoring Setup

**Data:** 2025-01-08  
**Status:** ✅ **SENTRY INTEGRATED**

---

## 📋 Overview

Sentry është integruar për error tracking dhe monitoring në:
- ✅ Backend (Laravel)
- ✅ Frontend (Vue.js)

Sentry ofron:
- Real-time error tracking
- Performance monitoring
- Session replay
- Release tracking
- User context
- Custom tags dhe metadata

---

## 🚀 Setup Guide

### 1. Krijoni Sentry Account

1. Shkoni në [sentry.io](https://sentry.io)
2. Krijoni account (free tier available)
3. Krijoni një projekt të ri:
   - **Backend:** Zgjidhni "Laravel"
   - **Frontend:** Zgjidhni "Vue.js"
4. Kopjoni DSN (Data Source Name) për çdo projekt

### 2. Backend Configuration (Laravel)

#### Install Dependencies

```bash
cd backend
composer require sentry/sentry-laravel
```

#### Environment Variables

Shtoni në `backend/.env`:

```env
# Sentry Configuration
SENTRY_LARAVEL_DSN=https://your-dsn@sentry.io/project-id
SENTRY_RELEASE=1.0.0
SENTRY_ENVIRONMENT=production
SENTRY_TRACES_SAMPLE_RATE=0.1
SENTRY_PROFILES_SAMPLE_RATE=0.0
SENTRY_SEND_DEFAULT_PII=false
```

#### Publish Configuration (Optional)

```bash
php artisan vendor:publish --provider="Sentry\Laravel\ServiceProvider"
```

#### Test Integration

```bash
php artisan tinker
>>> \Sentry\captureMessage('Test message from Laravel');
```

---

### 3. Frontend Configuration (Vue.js)

#### Install Dependencies

```bash
cd frontend
npm install @sentry/vue
```

#### Environment Variables

Shtoni në `frontend/.env` ose `frontend/.env.production`:

```env
# Sentry Configuration
VITE_SENTRY_DSN=https://your-dsn@sentry.io/project-id
VITE_SENTRY_TRACES_SAMPLE_RATE=0.1
VITE_SENTRY_REPLAYS_SESSION_SAMPLE_RATE=0.1
```

#### Manual Error Reporting

Në komponentët Vue, mund të raportoni errors manualisht:

```javascript
import * as Sentry from '@sentry/vue'

// Capture exception
try {
  // Your code
} catch (error) {
  Sentry.captureException(error, {
    tags: {
      component: 'VoiceDemo',
    },
    extra: {
      customData: 'value',
    },
  })
}

// Capture message
Sentry.captureMessage('Something went wrong', 'warning')

// Set user context
Sentry.setUser({
  id: '123',
  email: 'user@example.com',
  username: 'username',
})
```

---

## 🔧 Configuration Options

### Backend (Laravel)

**File:** `backend/config/sentry.php`

**Key Options:**
- `dsn` - Sentry DSN (required)
- `environment` - Environment name (production, staging, development)
- `traces_sample_rate` - Performance monitoring sample rate (0.0 to 1.0)
- `profiles_sample_rate` - Profiling sample rate
- `send_default_pii` - Send personally identifiable information
- `ignore_exceptions` - Exceptions to ignore
- `ignore_transactions` - Transactions to ignore

### Frontend (Vue.js)

**File:** `frontend/src/main.js`

**Key Options:**
- `dsn` - Sentry DSN (required)
- `tracesSampleRate` - Performance monitoring sample rate
- `replaysSessionSampleRate` - Session replay sample rate
- `replaysOnErrorSampleRate` - Replay on error (always 1.0)
- `environment` - Environment name
- `beforeSend` - Filter sensitive data before sending

---

## 🛡️ Security & Privacy

### Sensitive Data Filtering

Sentry automatikisht filtra:
- API keys nga request headers
- Authorization tokens
- Personal information (nëse `send_default_pii` është false)

### Custom Filtering

Për të filtruar të dhëna të tjera sensitive, përditësoni `beforeSend`:

**Backend:**
```php
// backend/config/sentry.php
'before_send' => [App\Services\SentryFilter::class, 'beforeSend'],
```

**Frontend:**
```javascript
// frontend/src/main.js
beforeSend(event, hint) {
  // Remove sensitive data
  if (event.request?.data) {
    delete event.request.data.password
    delete event.request.data.api_key
  }
  return event
}
```

---

## 📊 Features

### 1. Error Tracking

Të gjitha exceptions dhe errors dërgohen automatikisht në Sentry:
- Backend exceptions (Laravel)
- Frontend JavaScript errors
- API errors
- Network errors

### 2. Performance Monitoring

Track performance për:
- API requests
- Database queries
- Frontend page loads
- Component render times

### 3. Session Replay

Record user sessions për debugging:
- User interactions
- Console logs
- Network requests
- DOM changes

### 4. Release Tracking

Track errors për çdo release:
```bash
# Backend
SENTRY_RELEASE=1.0.1

# Frontend
VITE_SENTRY_RELEASE=1.0.1
```

### 5. User Context

Shto user information për debugging:
```php
// Backend
\Sentry\configureScope(function (\Sentry\State\Scope $scope): void {
    $scope->setUser([
        'id' => $platform->id,
        'username' => $platform->name,
        'plan' => $platform->plan,
    ]);
});
```

```javascript
// Frontend
Sentry.setUser({
  id: user.id,
  email: user.email,
})
```

---

## 🧪 Testing

### Test Backend Integration

```bash
cd backend
php artisan tinker

# Test error capture
\Sentry\captureException(new \Exception('Test error'));

# Test message
\Sentry\captureMessage('Test message', 'info');
```

### Test Frontend Integration

Në browser console:
```javascript
// Test error capture
Sentry.captureException(new Error('Test error'));

// Test message
Sentry.captureMessage('Test message', 'info');
```

---

## 📈 Monitoring Dashboard

Pas setup, mund të shihni:

1. **Issues** - Të gjitha errors dhe exceptions
2. **Performance** - API response times, database queries
3. **Releases** - Errors për çdo release
4. **Users** - Errors për çdo user
5. **Alerts** - Notifications për errors kritike

---

## 🔔 Alerts & Notifications

Konfiguro alerts në Sentry dashboard:
- Email notifications
- Slack integration
- Discord integration
- PagerDuty integration
- Custom webhooks

---

## 💰 Pricing

Sentry ofron:
- **Free Tier:** 5,000 events/month
- **Team:** $26/month - 50,000 events
- **Business:** $80/month - 200,000 events
- **Enterprise:** Custom pricing

Për production, rekomandohet të përdorni sample rates për të reduktuar numrin e events:
- `traces_sample_rate: 0.1` (10% of requests)
- `replaysSessionSampleRate: 0.1` (10% of sessions)

---

## ✅ Checklist

- [ ] Krijoni Sentry account
- [ ] Krijoni projekte për Backend dhe Frontend
- [ ] Kopjoni DSN për çdo projekt
- [ ] Shtoni environment variables në `.env` files
- [ ] Install dependencies (`composer require` dhe `npm install`)
- [ ] Testoni integration
- [ ] Konfiguro alerts
- [ ] Setup release tracking
- [ ] Review dhe konfiguro privacy settings

---

## 📝 Notes

- Sentry aktivizohet automatikisht nëse DSN është konfiguruar
- Nëse DSN nuk është konfiguruar, aplikacioni funksionon normalisht (pa Sentry)
- Errors loggohen edhe në Laravel logs (si backup)
- Sensitive data (API keys, tokens) filtrahen automatikisht
- Performance monitoring mund të ndikojë në performance (përdorni sample rates)

---

**Status:** ✅ **SENTRY INTEGRATION COMPLETE**

