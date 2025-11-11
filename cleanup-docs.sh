#!/bin/bash

# Cleanup unnecessary .md files
# This script removes old status files, duplicates, and outdated documentation

set -e

echo "🧹 Cleaning up unnecessary .md files..."

# Files to delete (old status files, duplicates, outdated docs)
FILES_TO_DELETE=(
    # Old status files
    "CHANGES_SUMMARY.md"
    "EXPECTED_USAGE_ANALYSIS.md"
    "DATABASE_STATUS.md"
    "REGISTRATION_FIX_COMPLETE.md"
    "CORS_FIX_COMPLETE.md"
    "PROJECT_AUDIT_AND_MISSING.md"
    "FIXES_APPLIED.md"
    "GITHUB_PUSH_SUCCESS.md"
    "PUSH_TO_GITHUB_NOW.md"
    "PROJECT_COMPLETE.md"
    "GITHUB_PUSH_INSTRUCTIONS.md"
    "RECOVERY_COMPLETE.md"
    "PROJECT_RECOVERY_PLAN.md"
    "GIT_CLEANUP_SUMMARY.md"
    
    # Duplicates/outdated guides
    "UNIVERSAL_COMMANDS_GUIDE.md"
    "UNIVERSAL_SDK_GUIDE.md"
    "INSTAGRAM_INTEGRATION_GUIDE.md"
    "YOUTUBE_INTEGRATION_GUIDE.md"
    "SDK_USAGE_GUIDE.md"
    "PRODUCTION_SETUP.md"  # Replaced by PRODUCTION_PACKAGE_GUIDE.md
    "README_AUTO_SETUP.md"  # Replaced by auto-setup.php
    "sdk/PUBLISH_INSTRUCTIONS.md"  # Replaced by NPM_PUBLISHING_GUIDE.md
    
    # Old structure docs (if outdated)
    "PROJECT_STRUCTURE.md"  # Keep if still relevant, but likely outdated
)

# Count files to delete
DELETED=0
NOT_FOUND=0

for file in "${FILES_TO_DELETE[@]}"; do
    if [ -f "$file" ]; then
        echo "🗑️  Deleting: $file"
        rm "$file"
        ((DELETED++))
    else
        echo "⚠️  Not found: $file"
        ((NOT_FOUND++))
    fi
done

echo ""
echo "✅ Cleanup complete!"
echo "   Deleted: $DELETED files"
echo "   Not found: $NOT_FOUND files"
echo ""
echo "📋 Remaining important docs:"
echo "   - README.md (main)"
echo "   - PRODUCTION_PACKAGE_GUIDE.md"
echo "   - CPANEL_DEPLOYMENT.md"
echo "   - SSH_SETUP_GUIDE.md"
echo "   - DEPLOYMENT_VOICEACTIONS_DEV.md"
echo "   - SENTRY_SETUP.md"
echo "   - TESTING_GUIDE.md"
echo "   - NPM_PUBLISHING_GUIDE.md"
echo "   - TROUBLESHOOTING.md"
echo "   - REMAINING_TASKS.md"
echo "   - docs/UNIVERSAL_COMMANDS_REFERENCE.md"
echo "   - sdk/README.md"
echo "   - sdk/CHANGELOG.md"

