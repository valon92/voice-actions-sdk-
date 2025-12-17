#!/bin/bash

# SQLite Maintenance Script
# Run this weekly/monthly për optimal performance

echo "🗄️  SQLite Maintenance Script"
echo "=============================="
echo ""

DB_PATH="database/database.sqlite"

if [ ! -f "$DB_PATH" ]; then
    echo "❌ Database file not found: $DB_PATH"
    exit 1
fi

echo "📊 Current Database Size:"
du -h "$DB_PATH"
echo ""

echo "🔍 Checking WAL Mode:"
sqlite3 "$DB_PATH" "PRAGMA journal_mode;"
echo ""

echo "📈 Checking Indexes:"
sqlite3 "$DB_PATH" ".indexes" | wc -l
echo "indexes found"
echo ""

echo "🧹 Running VACUUM (this may take a while)..."
sqlite3 "$DB_PATH" "VACUUM;"
echo "✅ VACUUM completed"
echo ""

echo "📊 Running ANALYZE..."
sqlite3 "$DB_PATH" "ANALYZE;"
echo "✅ ANALYZE completed"
echo ""

echo "📊 New Database Size:"
du -h "$DB_PATH"
echo ""

echo "✅ Maintenance completed!"

