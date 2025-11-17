# Instalimi i Voice Actions SDK nga GitHub për Testime Lokale

Ky dokument shpjegon si të instalosh SDK-në direkt nga GitHub në një projekt tjetër për testime lokale.

## 🔍 Problemi

Repository në GitHub mund të duket bosh nëse SDK është në një subdirectory (`sdk/`). Duhet të specifikosh path-in e saktë.

## ✅ Zgjidhje: Instalim nga GitHub me Path të Saktë

### Metoda 1: Instalim nga GitHub me subdirectory (Rekomanduar)

```bash
# Në projektin tënd
npm install git+https://github.com/valon92/voice-actions-sdk-.git#main --save
```

**Shënim:** Nëse repository ka strukturë `sdk/` si subdirectory, duhet të specifikosh path-in:

```bash
# Nëse SDK është në sdk/ subdirectory
npm install git+https://github.com/valon92/voice-actions-sdk-.git#main:./sdk --save
```

### Metoda 2: Instalim nga Local Path (Më e lehtë për testime)

Nëse projektet e tua janë në të njëjtin workspace:

```bash
# Në projektin tënd
npm install /Users/valonsylejmani/Projekte/VoiceActionsSDK/sdk --save
```

Ose me relative path:

```bash
# Nëse projektet janë në të njëjtin parent directory
npm install ../VoiceActionsSDK/sdk --save
```

### Metoda 3: npm link (Për development)

```bash
# 1. Në VoiceActionsSDK/sdk
cd /Users/valonsylejmani/Projekte/VoiceActionsSDK/sdk
npm link

# 2. Në projektin tënd
cd /path/to/your-project
npm link @valon92/voice-actions-sdk
```

## 🧪 Testimi i Instalimit

### 1. Verifikoni që është instaluar

```bash
# Në projektin tënd
npm list @valon92/voice-actions-sdk
```

### 2. Testoni import

```javascript
// test-import.js
import VoiceActionsSDK from '@valon92/voice-actions-sdk';

console.log('SDK imported:', VoiceActionsSDK);
```

### 3. Testoni inicializimin

```javascript
import VoiceActionsSDK, { VoiceActionsWidget } from '@valon92/voice-actions-sdk';

const sdk = new VoiceActionsSDK({
  apiKey: 'demo-key',
  apiUrl: 'http://localhost:8000/api',
  platform: 'test',
  userIdentifier: 'test-user',
  debug: true
});

console.log('SDK initialized:', sdk.isInitialized);
```

## 🔧 Troubleshooting

### Problemi: "Cannot find module '@valon92/voice-actions-sdk'"

**Zgjidhje 1:** Instalo nga local path
```bash
npm install /Users/valonsylejmani/Projekte/VoiceActionsSDK/sdk --save
```

**Zgjidhje 2:** Përdor npm link
```bash
# Në VoiceActionsSDK/sdk
npm link

# Në projektin tënd
npm link @valon92/voice-actions-sdk
```

**Zgjidhje 3:** Verifikoni që package.json ka emrin e saktë
```json
{
  "name": "@valon92/voice-actions-sdk"
}
```

### Problemi: "Repository appears empty"

**Zgjidhje:** Përdor local path ose npm link
```bash
# Local path
npm install /Users/valonsylejmani/Projekte/VoiceActionsSDK/sdk --save
```

### Problemi: "Module not found" pas instalimit

**Zgjidhje:** 
1. Kontrolloni që `node_modules/@valon92/voice-actions-sdk` ekziston
2. Restart dev server
3. Clear cache: `rm -rf node_modules package-lock.json && npm install`

## 📦 Verifikimi i Strukturës

### Kontrolloni që SDK ka strukturën e duhur:

```bash
# Në VoiceActionsSDK/sdk
ls -la
# Duhet të shohësh:
# - package.json
# - src/
# - dist/
# - README.md
```

### Kontrolloni package.json:

```bash
cat package.json | grep -A 5 '"name"'
# Duhet të shohësh:
# "name": "@valon92/voice-actions-sdk"
```

## 🚀 Quick Start për Testime

### 1. Instalo SDK (zgjidh një metodë):

```bash
# Metoda A: Local path (më e lehtë)
npm install /Users/valonsylejmani/Projekte/VoiceActionsSDK/sdk --save

# Metoda B: npm link
cd /Users/valonsylejmani/Projekte/VoiceActionsSDK/sdk && npm link
cd /path/to/your-project && npm link @valon92/voice-actions-sdk
```

### 2. Start Backend:

```bash
cd /Users/valonsylejmani/Projekte/VoiceActionsSDK/backend
php artisan serve
```

### 3. Import dhe test në projektin tënd:

```javascript
import VoiceActionsSDK, { VoiceActionsWidget } from '@valon92/voice-actions-sdk';

const sdk = new VoiceActionsSDK({
  apiKey: 'demo-key',
  apiUrl: 'http://localhost:8000/api',
  platform: 'test',
  userIdentifier: 'test-user',
  debug: true,
  onCommand: (command) => {
    console.log('Command:', command);
  }
});

const widget = new VoiceActionsWidget({
  sdk: sdk,
  autoCheck: true
});
```

## 💡 Rekomandim

Për testime lokale, **përdor local path** ose **npm link** sepse:
- ✅ Më e shpejtë
- ✅ Nuk varet nga GitHub
- ✅ Mund të bësh ndryshime dhe të testosh menjëherë
- ✅ Nuk ka probleme me repository structure

## 📝 Checklist

- [ ] SDK instaluar në projekt
- [ ] `node_modules/@valon92/voice-actions-sdk` ekziston
- [ ] Import funksionon pa errors
- [ ] SDK inicializohet
- [ ] Widget shfaqet
- [ ] Voice recognition funksionon

## 🔄 Pas Testimeve

Kur të kesh testuar dhe gjithçka funksionon:
1. Update version në SDK: `npm version patch`
2. Commit dhe push në GitHub
3. Publiko në NPM: `npm publish`
4. Update projektin tënd për të përdorur NPM version

