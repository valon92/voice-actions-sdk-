╔════════════════════════════════════════════════════════╗
║     Voice Actions SDK - cPanel Deployment Package     ║
╚════════════════════════════════════════════════════════╝

KY PACKAGE ËSHTË GATI PËR DEPLOYMENT NË CPANEL!

📁 Struktura e Package:
├── frontend/          → Upload në ~/public_html/
├── backend/           → Upload në ~/api.voiceactions.dev/
└── DEPLOY_INSTRUCTIONS.md  → Lexo këtë file për udhëzime

🚀 Quick Start:
1. Extract këtë .zip file
2. Lexo DEPLOY_INSTRUCTIONS.md
3. Upload files në cPanel
4. Konfiguro .env file
5. Run: php artisan key:generate
6. Run: php artisan migrate

✅ Pas deployment:
- Frontend: https://voiceactions.dev
- Backend: https://api.voiceactions.dev/api/commands/demo

Për më shumë detaje, shiko DEPLOY_INSTRUCTIONS.md

---
Package Created: $(date)
