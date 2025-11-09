# 📦 NPM Publishing Guide

**Data:** 2025-01-08  
**Status:** ✅ **READY FOR PUBLISHING**

---

## 📋 Overview

Ky guide shpjegon si të publikohet SDK në NPM për qasje publike.

---

## ✅ Prerequisites

1. **NPM Account** - Krijoni account në [npmjs.com](https://www.npmjs.com)
2. **Login në NPM** - `npm login` në terminal
3. **Git Repository** - SDK duhet të jetë në GitHub
4. **Build Process** - `npm run build` duhet të funksionojë

---

## 🚀 Publishing Steps

### ⚡ Quick Start (Automated Script)

Përdorni script-in automatizuar për publishing:

```bash
cd sdk
./publish.sh
```

Script-i do të:
- Verifikojë authentication
- Të pyesë për version bump
- Të ekzekutojë tests dhe build
- Të tregojë preview (dry-run)
- Të publikojë në NPM

### 1. Prepare SDK

```bash
cd sdk

# Install dependencies
npm install

# Run tests
npm test

# Build SDK
npm run build

# Verify build files exist
ls -la dist/
```

### 2. Update Version

Përdorni [Semantic Versioning](https://semver.org/):
- **MAJOR** (1.0.0 → 2.0.0) - Breaking changes
- **MINOR** (1.0.0 → 1.1.0) - New features, backward compatible
- **PATCH** (1.0.0 → 1.0.1) - Bug fixes

```bash
# Update version in package.json
npm version patch  # 1.0.0 → 1.0.1
npm version minor  # 1.0.0 → 1.1.0
npm version major  # 1.0.0 → 2.0.0

# Or manually edit package.json
```

### 3. Update CHANGELOG.md

Shtoni ndryshimet në `sdk/CHANGELOG.md`:

```markdown
## [1.0.1] - 2025-01-08

### Fixed
- Fixed microphone permission handling
- Improved error messages

### Changed
- Updated API endpoint defaults
```

### 4. Commit Changes

```bash
git add sdk/package.json sdk/CHANGELOG.md
git commit -m "chore: bump version to 1.0.1"
git push origin main
```

### 5. Publish to NPM

```bash
cd sdk

# Dry run (test without publishing)
npm publish --dry-run

# Publish
npm publish

# Or publish with public access (if scoped package)
npm publish --access public
```

### 6. Verify Publication

1. Shkoni në [npmjs.com/package/@voice-actions/sdk](https://www.npmjs.com/package/@voice-actions/sdk)
2. Verifikoni që versioni i ri është publik
3. Testoni instalimin:

```bash
npm install @voice-actions/sdk@latest
```

---

## 🔐 NPM Authentication

### First Time Setup

```bash
# Login to NPM
npm login

# Enter:
# - Username: your-npm-username
# - Password: your-npm-password
# - Email: your-email@example.com
# - OTP: (if 2FA enabled)
```

### Check Authentication

```bash
# Check who you're logged in as
npm whoami

# Check your packages
npm profile get
```

---

## 📝 Package Configuration

### package.json Fields

```json
{
  "name": "@voice-actions/sdk",
  "version": "1.0.0",
  "description": "Global Voice Control SDK for Web Applications",
  "main": "dist/voice-actions-sdk.js",
  "module": "dist/voice-actions-sdk.esm.js",
  "files": [
    "dist",
    "src",
    "README.md",
    "CHANGELOG.md"
  ],
  "publishConfig": {
    "access": "public"
  }
}
```

### Files Included

`files` field në `package.json` përcakton çfarë files përfshihen në publikim:

```json
"files": [
  "dist",           // Built files
  "src",            // Source files (optional)
  "README.md",      // Documentation
  "CHANGELOG.md"    // Version history
]
```

---

## 🔄 Versioning Strategy

### Semantic Versioning

- **1.0.0** - Initial release
- **1.0.1** - Bug fixes
- **1.1.0** - New features (backward compatible)
- **2.0.0** - Breaking changes

### Pre-release Versions

```bash
# Alpha release
npm version 1.1.0-alpha.1

# Beta release
npm version 1.1.0-beta.1

# Release candidate
npm version 1.1.0-rc.1
```

### Publishing Pre-releases

```bash
# Publish alpha/beta/rc
npm publish --tag alpha
npm publish --tag beta
npm publish --tag rc

# Install pre-release
npm install @voice-actions/sdk@alpha
npm install @voice-actions/sdk@beta
```

---

## 🏷️ NPM Tags

### Default Tags

- **latest** - Latest stable version (default)
- **next** - Next version (pre-release)
- **beta** - Beta versions
- **alpha** - Alpha versions

### Tag Management

```bash
# Publish with specific tag
npm publish --tag next

# Add tag to existing version
npm dist-tag add @voice-actions/sdk@1.0.1 next

# List tags
npm dist-tag ls @voice-actions/sdk

# Remove tag
npm dist-tag rm @voice-actions/sdk next
```

---

## 🔍 Pre-publish Checklist

- [ ] Version updated në `package.json`
- [ ] `CHANGELOG.md` updated
- [ ] `README.md` updated (nëse ka ndryshime)
- [ ] Tests passing (`npm test`)
- [ ] Build successful (`npm run build`)
- [ ] Build files verified (`ls dist/`)
- [ ] No sensitive data në package
- [ ] `.npmignore` ose `files` field configured correctly
- [ ] Git commit dhe push completed
- [ ] Dry run successful (`npm publish --dry-run`)

---

## 🚨 Common Issues

### 1. "You do not have permission to publish"

**Solution:**
- Verifikoni që jeni logged in: `npm whoami`
- Kontrolloni që package name është available
- Për scoped packages, shtoni `"publishConfig": { "access": "public" }`

### 2. "Package name already exists"

**Solution:**
- Ndryshoni package name në `package.json`
- Ose kontaktoni owner të package ekzistues

### 3. "Version already exists"

**Solution:**
- Bump version: `npm version patch`
- Ose publish me version të ri

### 4. "Files not included"

**Solution:**
- Shtoni files në `files` field në `package.json`
- Ose krijo `.npmignore` file

---

## 📊 Post-Publish

### 1. Verify Publication

```bash
# Check package info
npm view @voice-actions/sdk

# Check specific version
npm view @voice-actions/sdk@1.0.0

# Check downloads
npm view @voice-actions/sdk downloads
```

### 2. Update Documentation

- Update website/docs me version të ri
- Update integration examples
- Announce në social media/community

### 3. Monitor

- Monitor downloads në NPM
- Monitor issues në GitHub
- Monitor error tracking (Sentry)

---

## 🔄 Unpublishing

**⚠️ WARNING:** Unpublishing mund të shkaktojë probleme për përdoruesit.

### Unpublish Last Version (within 72 hours)

```bash
npm unpublish @voice-actions/sdk@1.0.1
```

### Deprecate Version (safer)

```bash
npm deprecate @voice-actions/sdk@1.0.0 "Use version 1.0.1 instead"
```

---

## 📈 Best Practices

1. **Always test locally** - `npm pack` dhe test në projekt lokal
2. **Use semantic versioning** - Follow semver strictly
3. **Update CHANGELOG** - Document all changes
4. **Tag releases** - Use Git tags për releases
5. **Test installation** - Test `npm install` pas publishing
6. **Monitor feedback** - Respond to issues quickly
7. **Document breaking changes** - Clearly mark breaking changes
8. **Use pre-releases** - Test beta/alpha versions before stable

---

## 🔗 Resources

- [NPM Documentation](https://docs.npmjs.com/)
- [Semantic Versioning](https://semver.org/)
- [NPM Package Best Practices](https://docs.npmjs.com/packages-and-modules/contributing-packages-to-the-registry)
- [NPM Package.json Reference](https://docs.npmjs.com/cli/v9/configuring-npm/package-json)

---

**Status:** ✅ **READY FOR PUBLISHING**

