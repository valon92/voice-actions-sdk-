# 🧪 Testing Guide

**Data:** 2025-01-08  
**Status:** ✅ **TESTS IMPLEMENTED**

---

## 📋 Overview

Projekti tani ka test coverage për:
- ✅ Backend (PHPUnit)
- ✅ Frontend (Vitest)
- ✅ SDK (Vitest)

---

## 🔧 Backend Tests (PHPUnit)

### Setup

```bash
cd backend
composer install
```

### Run Tests

```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature
php artisan test --testsuite=Unit

# Run specific test file
php artisan test tests/Feature/PlatformControllerTest.php

# With coverage
php artisan test --coverage
```

### Test Files

**Feature Tests:**
- `tests/Feature/PlatformControllerTest.php` - Platform registration, login, plan determination
- `tests/Feature/CommandControllerTest.php` - Command fetching, demo endpoint, locale support
- `tests/Feature/UsageControllerTest.php` - Usage tracking, statistics

**Unit Tests:**
- `tests/Unit/ApiKeyMiddlewareTest.php` - API key authentication
- `tests/Unit/RateLimitMiddlewareTest.php` - Rate limiting functionality

### Test Coverage

**PlatformController:**
- ✅ Platform registration with API key generation
- ✅ Plan determination (free/pro/enterprise)
- ✅ Rate limits creation based on plan
- ✅ Platform login with API key
- ✅ Validation errors

**CommandController:**
- ✅ Demo endpoint (no API key required)
- ✅ Commands endpoint (requires API key)
- ✅ Multi-language support
- ✅ Locale support (en-US, sq-AL, es-ES, fr-FR)

**UsageController:**
- ✅ Usage tracking
- ✅ Statistics retrieval
- ✅ Usage counters
- ✅ Monthly tracking

**Middleware:**
- ✅ API key validation
- ✅ Rate limiting per minute/hour/day
- ✅ Rate limit headers
- ✅ Retry-After headers

---

## 🎨 Frontend Tests (Vitest)

### Setup

```bash
cd frontend
npm install
```

### Run Tests

```bash
# Run all tests
npm test

# Watch mode
npm test -- --watch

# UI mode
npm run test:ui

# Coverage
npm run test:coverage
```

### Test Files

- `tests/unit/App.test.js` - App component tests
- `tests/integration/api.test.js` - API integration tests

### Adding More Tests

Për të shtuar më shumë tests:

```javascript
// tests/unit/ComponentName.test.js
import { describe, it, expect } from 'vitest'
import { mount } from '@vue/test-utils'
import ComponentName from '@/components/ComponentName.vue'

describe('ComponentName', () => {
  it('should render correctly', () => {
    const wrapper = mount(ComponentName)
    expect(wrapper.exists()).toBe(true)
  })
})
```

---

## 📦 SDK Tests (Vitest)

### Setup

```bash
cd sdk
npm install
```

### Run Tests

```bash
# Run all tests
npm test

# Watch mode
npm test -- --watch

# UI mode
npm run test:ui

# Coverage
npm run test:coverage
```

### Test Files

- `tests/sdk.test.js` - SDK initialization, command matching, error handling

### Test Coverage

**SDK Tests:**
- ✅ SDK initialization with API key
- ✅ SDK initialization without API key (demo mode)
- ✅ Command matching
- ✅ Error handling and fallback

---

## 🚀 CI/CD Integration

### GitHub Actions Example

```yaml
name: Tests

on: [push, pull_request]

jobs:
  backend-tests:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.2'
      - name: Install dependencies
        run: |
          cd backend
          composer install
      - name: Run tests
        run: |
          cd backend
          php artisan test

  frontend-tests:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      - name: Setup Node
        uses: actions/setup-node@v3
        with:
          node-version: '18'
      - name: Install dependencies
        run: |
          cd frontend
          npm install
      - name: Run tests
        run: |
          cd frontend
          npm test

  sdk-tests:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      - name: Setup Node
        uses: actions/setup-node@v3
        with:
          node-version: '18'
      - name: Install dependencies
        run: |
          cd sdk
          npm install
      - name: Run tests
        run: |
          cd sdk
          npm test
```

---

## 📊 Test Statistics

### Backend
- **Feature Tests:** 3 files, ~20+ tests
- **Unit Tests:** 2 files, ~10+ tests
- **Total:** ~30+ tests

### Frontend
- **Unit Tests:** 1 file, 2+ tests
- **Integration Tests:** 1 file, 2+ tests
- **Total:** 4+ tests

### SDK
- **SDK Tests:** 1 file, 4+ tests
- **Total:** 4+ tests

---

## ✅ Best Practices

1. **Write tests before fixing bugs** - TDD approach
2. **Test edge cases** - Empty inputs, null values, etc.
3. **Mock external dependencies** - API calls, database, etc.
4. **Keep tests isolated** - Each test should be independent
5. **Use descriptive test names** - `test_should_do_something_when_condition`
6. **Run tests frequently** - Before commits, after changes

---

## 🔍 Debugging Tests

### Backend

```bash
# Verbose output
php artisan test --verbose

# Stop on first failure
php artisan test --stop-on-failure

# Filter by test name
php artisan test --filter test_platform_registration
```

### Frontend/SDK

```bash
# Verbose output
npm test -- --reporter=verbose

# Debug mode
npm test -- --inspect-brk
```

---

**Status:** ✅ **TESTING FRAMEWORK IMPLEMENTED**

