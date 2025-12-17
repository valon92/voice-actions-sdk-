# 🔔 Notification System Guide - Voice Actions SDK

**Data:** 2025-12-17  
**Status:** ✅ **READY FOR USE**

---

## 📋 Overview

Sistemi i notifikimeve ju lejon të informoni përdoruesit e platformës suaj për:
- **Funksionalitetin e Voice Actions** - Si të përdorin voice commands
- **Ndryshimet dhe përditësimet** - Çfarë ka ndryshuar në SDK
- **Features të reja** - Funksionalitete të reja që janë shtuar
- **Udhëzime** - Informacione të rëndësishme për përdoruesit

Notifikimet shfaqen automatikisht për përdoruesit që përdorin Voice Actions SDK në platformën tuaj.

---

## 🚀 Si Funksionon

### 1. **Automatikisht në SDK**
Kur përdoruesit integrojnë Voice Actions SDK në platformën tuaj, notifikimet shfaqen automatikisht:
- Në fillim të session-it
- Çdo 5 minuta (për notifikime të reja)
- Në pozicionin e sipërm të djathtë të faqes

### 2. **Menaxhim nga Platform Dashboard**
Si platform owner, ju mund të:
- Krijoni notifikime të reja
- Menaxhoni notifikime ekzistuese
- Shihni statistika për notifikime

---

## 📝 Krijo Notifikim të Ri

### Via API (Recommended)

```bash
curl -X POST https://api.voiceactions.dev/api/notifications/create \
  -H "X-API-Key: your-api-key" \
  -H "Content-Type: application/json" \
  -d '{
    "type": "feature",
    "title": "New Voice Commands Available!",
    "message": "We've added 50+ new voice commands for video interactions. Try saying 'like video' or 'comment video'!",
    "action_url": "https://your-platform.com/voice-commands",
    "action_text": "View Commands",
    "is_active": true,
    "is_dismissible": true,
    "priority": 10,
    "target_audience": ["all"]
  }'
```

### Via Database (Direct)

```sql
INSERT INTO notifications (
  platform_id,
  type,
  title,
  message,
  action_url,
  action_text,
  is_active,
  is_dismissible,
  priority,
  target_audience,
  created_at,
  updated_at
) VALUES (
  1, -- Your platform ID
  'update',
  'Voice Actions Updated!',
  'We've improved voice recognition accuracy by 30%. Try it now!',
  'https://your-platform.com/changelog',
  'Learn More',
  true,
  true,
  5,
  '["all"]',
  NOW(),
  NOW()
);
```

---

## 🎨 Llojet e Notifikimeve

### 1. **info** (Informacion)
```json
{
  "type": "info",
  "title": "Voice Actions Available",
  "message": "You can now control this platform using voice commands. Click the microphone icon to start!"
}
```

### 2. **update** (Përditësim)
```json
{
  "type": "update",
  "title": "SDK Updated",
  "message": "Voice Actions SDK has been updated with new features and improvements."
}
```

### 3. **feature** (Feature i Ri)
```json
{
  "type": "feature",
  "title": "New Feature: Wake Words",
  "message": "You can now activate voice control by saying 'Hey [Platform Name]'!",
  "action_url": "https://your-platform.com/features",
  "action_text": "Learn More"
}
```

### 4. **warning** (Paralajmërim)
```json
{
  "type": "warning",
  "title": "Microphone Permission Required",
  "message": "Please enable microphone access to use voice commands."
}
```

### 5. **success** (Sukses)
```json
{
  "type": "success",
  "title": "Voice Control Enabled",
  "message": "Voice Actions is now active. Start speaking to control the platform!"
}
```

---

## ⚙️ Konfigurim

### Priority (Prioriteti)
- **0-10**: Normal priority
- **11-50**: High priority (shfaqet më lart)
- **51-100**: Critical priority (shfaqet më së pari)

### Target Audience (Audienca)
- **`["all"]`**: Të gjithë përdoruesit
- **`["user123", "user456"]`**: Vetëm përdoruesit specifikë
- **`[]`**: Asnjë përdorues (deaktivizuar)

### Scheduling (Orari)
- **`starts_at`**: Kur të fillojë shfaqja
- **`ends_at`**: Kur të mbarojë shfaqja
- **`null`**: Shfaqet gjithmonë (nëse `is_active = true`)

---

## 📊 Shembuj të Përdorimit

### 1. **Informoj Përdoruesit për Voice Commands**

```json
{
  "type": "info",
  "title": "🎤 Voice Commands Available",
  "message": "Control this platform with your voice! Try saying 'go to home', 'open settings', or 'search videos'.",
  "action_url": "/help/voice-commands",
  "action_text": "View All Commands",
  "priority": 10,
  "target_audience": ["all"]
}
```

### 2. **Annonco Feature të Ri**

```json
{
  "type": "feature",
  "title": "✨ New: Video Voice Controls",
  "message": "You can now control videos with voice commands! Say 'play video', 'pause video', 'like video', or 'comment video'.",
  "action_url": "/features/video-controls",
  "action_text": "Try It Now",
  "priority": 15,
  "target_audience": ["all"]
}
```

### 3. **Informoj për Përditësim**

```json
{
  "type": "update",
  "title": "🔄 Voice Actions Updated",
  "message": "We've improved voice recognition accuracy and added support for more commands. The update is automatic!",
  "priority": 5,
  "target_audience": ["all"]
}
```

### 4. **Paralajmërim për Permission**

```json
{
  "type": "warning",
  "title": "⚠️ Microphone Permission Needed",
  "message": "To use voice commands, please allow microphone access in your browser settings.",
  "action_url": "/help/microphone-permission",
  "action_text": "How to Enable",
  "priority": 20,
  "target_audience": ["all"]
}
```

---

## 🔧 API Endpoints

### 1. **Get Active Notifications** (Public - SDK uses this)
```
GET /api/notifications?platform_name=your-platform&user_identifier=user123&session_id=session456
```

**Response:**
```json
{
  "success": true,
  "notifications": [
    {
      "id": 1,
      "type": "feature",
      "title": "New Feature Available",
      "message": "Try our new voice commands!",
      "action_url": "https://example.com",
      "action_text": "Learn More",
      "is_dismissible": true,
      "priority": 10
    }
  ],
  "count": 1
}
```

### 2. **Dismiss Notification** (Public - SDK uses this)
```
POST /api/notifications/{id}/dismiss
Content-Type: application/json

{
  "platform_name": "your-platform",
  "user_identifier": "user123",
  "session_id": "session456"
}
```

### 3. **Create Notification** (Requires API Key)
```
POST /api/notifications/create
X-API-Key: your-api-key
Content-Type: application/json

{
  "type": "feature",
  "title": "New Feature",
  "message": "Description here",
  "action_url": "https://example.com",
  "action_text": "Learn More",
  "is_active": true,
  "is_dismissible": true,
  "priority": 10,
  "target_audience": ["all"]
}
```

### 4. **Get Notification Stats** (Requires API Key)
```
GET /api/notifications/stats
X-API-Key: your-api-key
```

**Response:**
```json
{
  "success": true,
  "stats": {
    "total_notifications": 10,
    "active_notifications": 3,
    "total_views": 1250,
    "avg_views_per_notification": 125
  }
}
```

---

## 💻 Integrim në SDK

Notifikimet shfaqen automatikisht kur SDK inicializohet:

```javascript
const sdk = new VoiceActionsSDK({
  apiKey: 'your-api-key',
  platform: 'your-platform',
  locale: 'en-US',
  notificationsEnabled: true, // Default: true
  notificationCheckInterval: 300000, // Check every 5 minutes (default)
  onCommand: (command) => {
    // Handle commands
  }
});
```

### Disable Notifications

```javascript
const sdk = new VoiceActionsSDK({
  apiKey: 'your-api-key',
  platform: 'your-platform',
  notificationsEnabled: false, // Disable notifications
  onCommand: (command) => {
    // Handle commands
  }
});
```

---

## 📈 Best Practices

### 1. **Mos Abuzoni**
- Mos krijoni shumë notifikime njëkohësisht
- Përdorni priority për të prioritizuar notifikimet më të rëndësishme
- Vendosni `ends_at` për notifikime që duhen shfaqur vetëm për një kohë të caktuar

### 2. **Bëj Mesazhet Të Qarta**
- Përdorni titull të shkurtër dhe të qartë
- Mesazhi duhet të jetë i shkurtër dhe i kuptueshëm
- Shtoni action button për më shumë informacion

### 3. **Target Audience**
- Përdorni `["all"]` për notifikime të përgjithshme
- Përdorni user IDs specifikë për notifikime të personalizuara
- Konsideroni përdorimin e `starts_at` dhe `ends_at` për kampanja

### 4. **Monitoro Performancën**
- Shihni statistika për sa shumë përdorues kanë parë notifikimet
- Hiqni notifikime që nuk janë më të rëndësishme
- Përditësoni notifikime të vjetra me informacion të ri

---

## 🎯 Use Cases

### 1. **Onboarding**
Informoni përdoruesit e rinj për funksionalitetin e Voice Actions:
```json
{
  "type": "info",
  "title": "Welcome! Try Voice Commands",
  "message": "Control this platform with your voice. Click the microphone icon to start!",
  "action_url": "/tutorial/voice-commands",
  "action_text": "Watch Tutorial",
  "priority": 15
}
```

### 2. **Feature Announcements**
Annonco features të reja:
```json
{
  "type": "feature",
  "title": "New: Voice Search",
  "message": "You can now search using voice commands. Just say 'search for [your query]'!",
  "action_url": "/features/voice-search",
  "action_text": "Try It Now",
  "priority": 20
}
```

### 3. **Updates**
Informoni për përditësime:
```json
{
  "type": "update",
  "title": "Voice Recognition Improved",
  "message": "We've updated our voice recognition engine for better accuracy. No action needed!",
  "priority": 5
}
```

### 4. **Maintenance**
Informoni për maintenance:
```json
{
  "type": "warning",
  "title": "Scheduled Maintenance",
  "message": "Voice Actions will be temporarily unavailable on Dec 20, 2-4 AM EST.",
  "priority": 25,
  "starts_at": "2025-12-19 00:00:00",
  "ends_at": "2025-12-20 04:00:00"
}
```

---

## ✅ Checklist për Notifikime

- [ ] Titulli është i qartë dhe i shkurtër
- [ ] Mesazhi është i kuptueshëm
- [ ] Type është i përshtatshëm (info, update, feature, warning, success)
- [ ] Priority është vendosur saktë
- [ ] Target audience është vendosur saktë
- [ ] Action URL dhe text janë vendosur (nëse nevojiten)
- [ ] `is_dismissible` është vendosur saktë
- [ ] `starts_at` dhe `ends_at` janë vendosur (nëse nevojiten)
- [ ] `is_active` është `true`

---

## 🔗 Lidhje me Dokumentacionin e Tjerë

- [SDK README](./sdk/README.md) - Dokumentacion i plotë i SDK
- [Integration Guide](./frontend/src/pages/docs/IntegrationGuide.vue) - Si të integrosh SDK
- [Platform Dashboard](./frontend/src/pages/PlatformDashboard.vue) - Menaxhim i platformës

---

**Status:** ✅ **READY FOR USE**  
**Maintained by:** Voice Actions SDK Team

