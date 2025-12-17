# 💰 Usage-Based Billing Guide

**Data:** 2025-01-14  
**Status:** ⚠️ **DUHET TË IMPLEMENTOHET**

---

## 📋 Overview

Ky guide shpjegon si funksionon usage-based billing për përdoruesit që instalojnë Voice Actions SDK si npm library dhe e integrojnë në platformën e tyre.

---

## 🔄 Si Funksionon Aktualisht

### 1. SDK Tracking

Kur një developer instalon SDK-n si npm package:

```javascript
import VoiceActionsSDK from '@voice-actions/sdk'

const sdk = new VoiceActionsSDK({
  apiKey: 'va_...', // API key nga registration
  platform: 'youtube',
  onCommand: (command) => {
    // Handle command
  }
})
```

Kur një komandë ekzekutohet, SDK-ja automatikisht:
1. Rrit `usageCount`
2. Dërgon request në `/api/usage/track` me event `command_executed`
3. Backend ruan në `usage_tracking` dhe `usage_counters` tables

### 2. Current Billing System

Aktualisht sistemi ka:
- **Free Plan:** Deri në 9,999 komanda/muaj
- **Pro Plan:** $99/muaj për 10K-999K komanda
- **Enterprise Plan:** Custom pricing për 1M+ komanda

**PROBLEM:** Pagesa është fikse, jo bazuar në përdorimin aktual.

---

## 🎯 Si Duhet të Funksionojë Usage-Based Billing

### Skenari 1: Pay-as-you-go (Metered Billing)

Përdoruesit paguajnë për çdo komandë mbi limit-in e planit:

1. **Free Plan:** 
   - 0-9,999 komanda/muaj: **Falas**
   - 10,000+ komanda: **$0.01 për komandë** (mbi limit)

2. **Pro Plan:**
   - 0-999,999 komanda/muaj: **$99/muaj** (flat rate)
   - 1,000,000+ komanda: **$0.005 për komandë** (mbi limit)

3. **Enterprise Plan:**
   - Custom pricing bazuar në volume

### Skenari 2: Tiered Pricing

Përdoruesit paguajnë bazuar në tier:

- **Tier 1:** 0-9,999 komanda = $0
- **Tier 2:** 10,000-99,999 komanda = $0.01/komandë
- **Tier 3:** 100,000-999,999 komanda = $0.008/komandë
- **Tier 4:** 1,000,000+ komanda = $0.005/komandë

### Skenari 3: Hybrid (Recommended)

Kombinon subscription + usage:

1. **Base Subscription:** $99/muaj për Pro plan
2. **Included Usage:** 10,000 komanda/muaj
3. **Overage:** $0.01 për komandë mbi limit

---

## 🔧 Implementation Plan

### Faza 1: Usage Limits & Enforcement

**Krijo middleware për të kontrolluar limits:**

```php
// CheckUsageLimits Middleware
- Kontrollon usage për muajin aktual
- Krahaso me plan limits
- Nëse ka arritur limit, kthen error ose kërkon upgrade
```

### Faza 2: Usage Calculation & Billing

**Krijo UsageBillingController:**

```php
// calculateMonthlyUsage() - Llogarit usage për muajin aktual
// calculateOverage() - Llogarit komanda mbi limit
// generateUsageInvoice() - Krijo invoice për overage
```

### Faza 3: Stripe Metered Billing

**Integro me Stripe Usage Records:**

```php
// Stripe metered billing për pay-as-you-go
// Krijo usage records në Stripe
// Stripe automatikisht llogarit dhe fakturon
```

### Faza 4: Usage Dashboard

**Krijo frontend component:**

```vue
// UsageDashboard.vue
- Shfaq usage për muajin aktual
- Shfaq limits dhe overage
- Shfaq billing estimate
- Upgrade options
```

---

## 📊 Database Schema Updates

### Shto në `platforms` table:

```php
- usage_limit (integer) - Limit për muajin aktual
- usage_current (integer) - Usage aktual për muajin
- billing_model (enum) - 'fixed', 'metered', 'hybrid'
- overage_rate (decimal) - Çmim për komandë mbi limit
```

### Krijo `usage_billing` table:

```php
- id
- platform_id
- month (Y-m format)
- base_subscription_amount
- usage_amount
- overage_amount
- total_amount
- stripe_invoice_id
- status
- created_at, updated_at
```

---

## 💳 Stripe Integration

### Option 1: Metered Billing (Recommended)

1. **Create Stripe Subscription** me metered price
2. **Send Usage Records** në Stripe çdo ditë
3. **Stripe automatikisht fakturon** bazuar në usage

```php
// Stripe Usage Records API
Stripe\UsageRecord::create([
    'subscription_item' => $subscriptionItemId,
    'quantity' => $usageCount,
    'timestamp' => time(),
]);
```

### Option 2: Invoice After Usage

1. **Track usage** në database
2. **Në fund të muajit**, llogarit overage
3. **Krijo invoice** në Stripe për overage
4. **Dërgo invoice** te customer

---

## 🔐 Usage Enforcement

### Middleware: CheckUsageLimits

```php
class CheckUsageLimits
{
    public function handle($request, $next)
    {
        $platformId = $request->input('api_platform_id');
        $platform = Platform::find($platformId);
        
        // Get current month usage
        $currentUsage = $this->getCurrentMonthUsage($platformId);
        $limit = $this->getPlanLimit($platform->plan);
        
        // Check if limit exceeded
        if ($currentUsage >= $limit) {
            // Check if has active subscription
            if ($platform->subscription_status === 'active') {
                // Allow but track for billing
                return $next($request);
            } else {
                // Block and require upgrade
                return response()->json([
                    'success' => false,
                    'error' => 'Usage limit exceeded',
                    'current_usage' => $currentUsage,
                    'limit' => $limit,
                    'upgrade_url' => '/checkout'
                ], 429);
            }
        }
        
        return $next($request);
    }
}
```

---

## 📈 Usage Dashboard Features

### Frontend Component: UsageDashboard.vue

**Features:**
1. **Current Usage Display:**
   - Komanda për muajin aktual
   - Limit për plan
   - Percentage used
   - Days remaining

2. **Billing Estimate:**
   - Base subscription cost
   - Overage estimate (nëse ka)
   - Total estimate

3. **Usage History:**
   - Monthly usage chart
   - Billing history
   - Invoice downloads

4. **Upgrade Options:**
   - Upgrade to higher plan
   - Add usage credits
   - Contact sales

---

## 🚀 Implementation Steps

### Step 1: Update Database Schema

```bash
php artisan make:migration add_usage_billing_fields_to_platforms
php artisan make:migration create_usage_billing_table
```

### Step 2: Create Usage Billing Controller

```bash
php artisan make:controller UsageBillingController
```

### Step 3: Create Middleware

```bash
php artisan make:middleware CheckUsageLimits
```

### Step 4: Update UsageController

- Shto logic për të kontrolluar limits
- Shto logic për të llogaritur overage

### Step 5: Create Frontend Components

- `UsageDashboard.vue` - Usage display dhe billing
- Update `PlatformDashboard.vue` me usage info

### Step 6: Stripe Integration

- Configure metered billing në Stripe
- Send usage records
- Handle invoices

---

## 📋 Checklist

### Database ⚠️
- [ ] Add usage_billing_fields to platforms table
- [ ] Create usage_billing table
- [ ] Create usage_limits table (optional)

### Backend ⚠️
- [ ] Create CheckUsageLimits middleware
- [ ] Create UsageBillingController
- [ ] Update UsageController për limits
- [ ] Stripe metered billing integration
- [ ] Usage calculation logic
- [ ] Invoice generation logic

### Frontend ⚠️
- [ ] Create UsageDashboard component
- [ ] Update PlatformDashboard me usage
- [ ] Usage charts dhe graphs
- [ ] Billing estimate display
- [ ] Upgrade prompts

### Testing ⚠️
- [ ] Test usage tracking
- [ ] Test limit enforcement
- [ ] Test overage calculation
- [ ] Test Stripe usage records
- [ ] Test invoice generation

---

## 💡 Recommended Approach

**Hybrid Model (Subscription + Usage):**

1. **Base Subscription:** $99/muaj për Pro plan
2. **Included Usage:** 10,000 komanda/muaj
3. **Overage Billing:** 
   - Track usage në real-time
   - Në fund të muajit, llogarit overage
   - Krijo invoice për overage
   - Stripe automatikisht fakturon

**Benefits:**
- Predictable base cost
- Fair pricing për high usage
- Easy për customers të kuptojnë
- Flexible për different needs

---

## 🔗 Resources

- [Stripe Metered Billing](https://stripe.com/docs/billing/subscriptions/metered-billing)
- [Stripe Usage Records](https://stripe.com/docs/api/usage_records)
- [Stripe Invoicing](https://stripe.com/docs/billing/invoices/overview)

---

**Status:** ✅ **USAGE-BASED BILLING ËSHTË IMPLEMENTUAR**

---

## ✅ Çfarë Është Implementuar:

### Database Migrations ✅
- [x] `add_usage_billing_fields_to_platforms_table.php` - Usage fields në platforms
- [x] `create_usage_billing_table.php` - Usage billing records

### Backend Implementation ✅
- [x] `CheckUsageLimits` Middleware - Kontrollon limits për çdo request
- [x] `UsageBillingController` - Usage tracking dhe billing calculation
- [x] Routes të shtuara për usage billing
- [x] Middleware alias në Kernel.php

### Frontend Components ✅
- [x] `UsageDashboard.vue` - Usage display dhe billing estimate
- [x] Integrated në `PlatformDashboard.vue`

### Features ✅
- [x] Real-time usage tracking
- [x] Usage limits enforcement
- [x] Overage calculation
- [x] Billing estimate display
- [x] Usage history
- [x] Stripe invoice generation për overage

---

## 🔄 Si Funksionon Tani:

### 1. SDK Tracking (Automatik)

Kur një developer instalon SDK-n si npm package dhe ekzekuton komanda:

```javascript
import VoiceActionsSDK from '@voice-actions/sdk'

const sdk = new VoiceActionsSDK({
  apiKey: 'va_...',
  platform: 'youtube',
  onCommand: (command) => {
    // Komanda ekzekutohet
  }
})
```

**Çfarë ndodh automatikisht:**
1. SDK dërgon request në `/api/usage/track` me event `command_executed`
2. Backend ruan në `usage_tracking` dhe `usage_counters` tables
3. `CheckUsageLimits` middleware kontrollon nëse ka arritur limit
4. Nëse ka arritur limit dhe nuk ka subscription, kthen error 429
5. Nëse ka subscription, lejon por track për billing

### 2. Usage Limits

**Free Plan:**
- Limit: 9,999 komanda/muaj
- Nëse arrihet limit → **Blocked** (kërkon upgrade)

**Pro Plan:**
- Limit: 999,999 komanda/muaj
- Base subscription: $99/muaj
- Overage: $0.01 për komandë mbi limit
- Nëse arrihet limit → **Allowed** (overage charges apply)

**Enterprise Plan:**
- Limit: 10,000,000 komanda/muaj
- Custom pricing

### 3. Billing Calculation

**Në fund të muajit:**
1. `UsageBillingController::calculateMonthlyBilling()` llogarit usage
2. Llogarit overage (komanda mbi limit)
3. Krijo invoice në Stripe për overage
4. Stripe automatikisht fakturon customer

**Example:**
- Pro plan: $99/muaj base
- Usage: 1,100,000 komanda
- Included: 999,999 komanda
- Overage: 1,001 komanda × $0.01 = $10.01
- **Total: $109.01**

### 4. Usage Dashboard

**Frontend component (`UsageDashboard.vue`):**
- Shfaq usage për muajin aktual
- Progress bar me percentage
- Billing estimate (base + overage)
- Warnings kur approaching limit
- Upgrade prompts

---

## 📊 API Endpoints

### Get Current Usage
```
GET /api/usage/current
Headers: X-API-Key: va_...

Response:
{
  "success": true,
  "usage": {
    "current": 5000,
    "limit": 9999,
    "overage": 0,
    "percentage": 50.0,
    "days_remaining": 15
  },
  "billing": {
    "base_subscription": 99.00,
    "overage_rate": 0.01,
    "overage_amount": 0.00,
    "total_estimate": 99.00
  },
  "plan": "free",
  "has_subscription": false
}
```

### Get Billing History
```
GET /api/usage/billing-history
Headers: X-API-Key: va_...

Response:
{
  "success": true,
  "billing_history": [
    {
      "month": "2025-01",
      "usage_count": 15000,
      "overage_count": 5001,
      "base_subscription": 99.00,
      "overage_amount": 50.01,
      "total_amount": 149.01,
      "status": "paid"
    }
  ]
}
```

---

## 🔐 Usage Enforcement

**Middleware: `CheckUsageLimits`**

- Kontrollon usage për çdo request që kërkon API key
- Nëse free plan dhe ka arritur limit → **429 Error**
- Nëse paid plan dhe ka arritur limit → **Allow** (track për billing)

**Error Response (429):**
```json
{
  "success": false,
  "error": "Usage limit exceeded",
  "message": "You have reached your monthly usage limit. Please upgrade to continue using the service.",
  "current_usage": 10000,
  "limit": 9999,
  "upgrade_url": "/checkout?plan=pro"
}
```

---

## 💡 Best Practices për Developers

### 1. Monitor Usage

```javascript
// Check usage periodically
const checkUsage = async () => {
  const response = await fetch('/api/usage/current', {
    headers: {
      'X-API-Key': apiKey
    }
  });
  const data = await response.json();
  
  if (data.usage.percentage >= 80) {
    console.warn('Approaching usage limit!');
  }
};
```

### 2. Handle Rate Limits

```javascript
// SDK automatically handles rate limits
sdk.onError = (error) => {
  if (error.type === 'USAGE_LIMIT_EXCEEDED') {
    // Redirect to upgrade page
    window.location.href = '/checkout?plan=pro';
  }
};
```

### 3. Optimize Usage

- Përdor caching për komanda të shpeshta
- Implement batch processing kur është e mundur
- Monitor usage patterns

---

## 🚀 Next Steps

1. **Run Migrations:**
   ```bash
   cd backend
   php artisan migrate
   ```

2. **Configure Cron Job** (për monthly billing calculation):
   ```bash
   # Në crontab
   0 0 1 * * php /path/to/artisan usage:calculate-billing
   ```

3. **Test Usage Tracking:**
   - Install SDK si npm package
   - Execute komanda
   - Verify tracking në dashboard
   - Test limit enforcement

---

**Status:** ✅ **USAGE-BASED BILLING ËSHTË IMPLEMENTUAR**

