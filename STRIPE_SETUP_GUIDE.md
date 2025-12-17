# 💳 Stripe Setup Guide

**Data:** 2025-01-14  
**Status:** ✅ **READY FOR CONFIGURATION**

---

## 📋 Overview

Ky guide shpjegon si të konfigurohet Stripe për payment processing në Voice Actions SDK.

---

## 🔧 Setup Steps

### 1. Create Stripe Account

1. Shkoni në [stripe.com](https://stripe.com) dhe krijoni një account
2. Verifikoni email-in dhe complete setup-in

### 2. Get API Keys

1. Shkoni në [Stripe Dashboard > Developers > API keys](https://dashboard.stripe.com/apikeys)
2. Copy **Publishable key** (fillon me `pk_test_...` ose `pk_live_...`)
3. Copy **Secret key** (fillon me `sk_test_...` ose `sk_live_...`)

### 3. Create Products & Prices

1. Shkoni në [Stripe Dashboard > Products](https://dashboard.stripe.com/products)
2. Klikoni **"Add product"**

#### Pro Plan Product:
- **Name:** Voice Actions SDK - Pro Plan
- **Description:** Pro plan for Voice Actions SDK (10K - 999K commands/month)
- **Pricing:** 
  - **Recurring:** Monthly
  - **Price:** $99.00 USD
- **Copy Price ID** (fillon me `price_...`)

#### Enterprise Plan Product:
- **Name:** Voice Actions SDK - Enterprise Plan
- **Description:** Enterprise plan for Voice Actions SDK (1M+ commands/month)
- **Pricing:**
  - **Recurring:** Monthly
  - **Price:** Custom (contact sales)
- **Copy Price ID** (fillon me `price_...`)

### 4. Configure Webhook

1. Shkoni në [Stripe Dashboard > Developers > Webhooks](https://dashboard.stripe.com/webhooks)
2. Klikoni **"Add endpoint"**
3. **Endpoint URL:** `https://yourdomain.com/api/payment/webhook`
4. **Events to send:**
   - `checkout.session.completed`
   - `customer.subscription.created`
   - `customer.subscription.updated`
   - `customer.subscription.deleted`
   - `invoice.payment_succeeded`
   - `invoice.payment_failed`
5. **Copy Signing secret** (fillon me `whsec_...`)

### 5. Update Environment Variables

Shtoni në `backend/.env`:

```env
# Stripe Configuration
STRIPE_KEY=pk_test_... # Publishable key
STRIPE_SECRET=sk_test_... # Secret key
STRIPE_WEBHOOK_SECRET=whsec_... # Webhook signing secret

# Stripe Price IDs
STRIPE_PRICE_PRO=price_... # Pro plan price ID
STRIPE_PRICE_ENTERPRISE=price_... # Enterprise plan price ID
```

### 6. Test Payment Flow

1. **Test Card Numbers:**
   - **Success:** `4242 4242 4242 4242`
   - **Decline:** `4000 0000 0000 0002`
   - **3D Secure:** `4000 0025 0000 3155`

2. **Test Flow:**
   - Register platform me Pro plan
   - Complete checkout
   - Verify subscription në dashboard
   - Test cancel/resume subscription

---

## 🔐 Security Best Practices

1. **Never commit `.env` file** - Stripe keys duhet të jenë private
2. **Use different keys** për development/production
3. **Verify webhook signatures** - Stripe verifies automatically
4. **Monitor webhook logs** në Stripe Dashboard
5. **Use HTTPS** për webhook endpoint

---

## 📊 Production Checklist

- [ ] Stripe account verified
- [ ] Live API keys configured
- [ ] Products & prices created
- [ ] Webhook endpoint configured
- [ ] Webhook signing secret added
- [ ] Environment variables set
- [ ] Test payment flow successful
- [ ] Monitor webhook logs

---

## 🚨 Troubleshooting

### Webhook Not Receiving Events

1. Check webhook URL është accessible
2. Verify webhook secret në `.env`
3. Check server logs për errors
4. Test webhook në Stripe Dashboard

### Payment Fails

1. Check Stripe API keys janë correct
2. Verify price IDs janë correct
3. Check customer creation succeeds
4. Review Stripe Dashboard për errors

### Subscription Not Updating

1. Check webhook events janë configured
2. Verify webhook handler logic
3. Check database migrations janë run
4. Review server logs

---

## 📚 Resources

- [Stripe Documentation](https://stripe.com/docs)
- [Stripe API Reference](https://stripe.com/docs/api)
- [Stripe Testing](https://stripe.com/docs/testing)
- [Stripe Webhooks](https://stripe.com/docs/webhooks)

---

**Status:** ✅ **READY FOR CONFIGURATION**

