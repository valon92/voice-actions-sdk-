# 📦 Publishing Instructions

## Quick Start

### Step 1: Create NPM Account (if you don't have one)

1. Go to [npmjs.com/signup](https://www.npmjs.com/signup)
2. Create a free account
3. Verify your email

### Step 2: Login to NPM

```bash
cd sdk
npm login
```

Enter your:
- Username
- Password
- Email
- OTP (if 2FA enabled)

### Step 3: Publish

**Option A: Use the automated script**
```bash
./publish.sh
```

**Option B: Manual publish**
```bash
# Build SDK
npm run build

# Publish
npm publish --access public
```

## Verify Publication

After publishing, verify at:
- https://www.npmjs.com/package/@voice-actions/sdk

## Install Test

Test the published package:
```bash
npm install @voice-actions/sdk@latest
```

## Troubleshooting

### "You do not have permission to publish"
- Make sure you're logged in: `npm whoami`
- For scoped packages, ensure `publishConfig.access` is set to `"public"` in package.json

### "Package name already exists"
- The package name `@voice-actions/sdk` might be taken
- You may need to use a different scope or name

### "Version already exists"
- Bump the version: `npm version patch`

## Next Steps After Publishing

1. ✅ Update CHANGELOG.md with new version
2. ✅ Commit changes: `git add . && git commit -m "chore: publish v1.0.0"`
3. ✅ Create git tag: `git tag v1.0.0 && git push origin v1.0.0`
4. ✅ Update documentation
5. ✅ Announce the release

