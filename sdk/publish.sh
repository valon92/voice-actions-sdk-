#!/bin/bash

# NPM Publishing Script for Voice Actions SDK
# This script helps publish the SDK to NPM

set -e

echo "🚀 Voice Actions SDK - NPM Publishing Script"
echo "=============================================="
echo ""

# Check if we're in the SDK directory
if [ ! -f "package.json" ]; then
    echo "❌ Error: package.json not found. Please run this script from the sdk/ directory."
    exit 1
fi

# Check if npm is installed
if ! command -v npm &> /dev/null; then
    echo "❌ Error: npm is not installed. Please install Node.js and npm first."
    exit 1
fi

# Check if user is logged in to npm
echo "📋 Checking NPM authentication..."
if ! npm whoami &> /dev/null; then
    echo "⚠️  You are not logged in to NPM."
    echo "   Please run: npm login"
    echo ""
    read -p "Do you want to login now? (y/n) " -n 1 -r
    echo ""
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        npm login
    else
        echo "❌ Publishing cancelled. Please login first."
        exit 1
    fi
else
    NPM_USER=$(npm whoami)
    echo "✅ Logged in as: $NPM_USER"
fi

echo ""
echo "📦 Current package info:"
npm view @voice-actions/sdk version 2>/dev/null || echo "   Package not yet published"
echo "   Local version: $(node -p "require('./package.json').version")"
echo ""

# Ask for version bump type
echo "📈 Version bump options:"
echo "   1) patch (1.0.0 → 1.0.1) - Bug fixes"
echo "   2) minor (1.0.0 → 1.1.0) - New features"
echo "   3) major (1.0.0 → 2.0.0) - Breaking changes"
echo "   4) Skip version bump (use current version)"
echo ""
read -p "Select version bump type (1-4): " VERSION_CHOICE

case $VERSION_CHOICE in
    1)
        echo "📝 Bumping patch version..."
        npm version patch --no-git-tag-version
        ;;
    2)
        echo "📝 Bumping minor version..."
        npm version minor --no-git-tag-version
        ;;
    3)
        echo "📝 Bumping major version..."
        npm version major --no-git-tag-version
        ;;
    4)
        echo "⏭️  Skipping version bump"
        ;;
    *)
        echo "❌ Invalid choice. Exiting."
        exit 1
        ;;
esac

NEW_VERSION=$(node -p "require('./package.json').version")
echo "✅ New version: $NEW_VERSION"
echo ""

# Run tests
echo "🧪 Running tests..."
if npm test -- --run 2>/dev/null; then
    echo "✅ Tests passed"
else
    echo "⚠️  Tests failed or skipped. Continuing anyway..."
fi
echo ""

# Build SDK
echo "🔨 Building SDK..."
npm run build
if [ $? -eq 0 ]; then
    echo "✅ Build successful"
else
    echo "❌ Build failed. Please fix errors before publishing."
    exit 1
fi
echo ""

# Dry run
echo "🔍 Running dry-run (preview what will be published)..."
npm publish --dry-run
echo ""

# Confirm publishing
read -p "🚀 Ready to publish version $NEW_VERSION to NPM? (y/n) " -n 1 -r
echo ""
if [[ ! $REPLY =~ ^[Yy]$ ]]; then
    echo "❌ Publishing cancelled."
    exit 0
fi

# Publish
echo "📤 Publishing to NPM..."
npm publish --access public

if [ $? -eq 0 ]; then
    echo ""
    echo "✅ Successfully published @voice-actions/sdk@$NEW_VERSION to NPM!"
    echo ""
    echo "🔗 Package URL: https://www.npmjs.com/package/@voice-actions/sdk"
    echo ""
    echo "📦 Install with: npm install @voice-actions/sdk@$NEW_VERSION"
    echo ""
    echo "💡 Next steps:"
    echo "   1. Update CHANGELOG.md with new version"
    echo "   2. Commit version changes: git add package.json CHANGELOG.md && git commit -m 'chore: publish v$NEW_VERSION'"
    echo "   3. Create git tag: git tag v$NEW_VERSION && git push origin v$NEW_VERSION"
    echo "   4. Update documentation if needed"
else
    echo "❌ Publishing failed. Please check the error messages above."
    exit 1
fi

