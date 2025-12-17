# 🗄️ SQLite Setup & Optimization Guide

**Data:** 2025-01-14  
**Status:** ✅ **OPTIMIZED FOR SQLITE**

---

## 📋 Overview

Ky guide shpjegon si të optimizosh SQLite për Voice Actions SDK platform deri sa të rritet numri i përdoruesve dhe të migrojë në PostgreSQL/MySQL.

---

## ✅ Optimizime të Implementuara

### 1. WAL Mode (Write-Ahead Logging) ✅

**Pse:**
- Better concurrency për reads dhe writes
- Faster writes
- Better performance për high write volume

**Implementation:**
- Automatikisht enabled në `AppServiceProvider.php`
- Configurable në `.env`

### 2. Indexes Optimization ✅

**Composite Indexes:**
- `usage_tracking`: (platform_id, timestamp, event)
- `usage_tracking`: (platform_id, created_at)
- `subscriptions`: (platform_id, status)
- `invoices`: (platform_id, status, created_at)
- `payments`: (platform_id, status, created_at)
- `usage_billing`: (platform_id, month, status)

### 3. Query Optimization ✅

**Transactions:**
- Usage tracking me transactions për atomicity
- Critical operations në transactions

**Query Improvements:**
- Optimized date queries
- Index-friendly queries
- Efficient counter updates

### 4. Connection Settings ✅

**SQLite Configuration:**
- WAL mode enabled
- Foreign keys enabled
- Cache size: 10MB
- Synchronous: NORMAL (balance safety/performance)
- Temp store: MEMORY

---

## 🚀 Setup Instructions

### Step 1: Run Migrations

```bash
cd backend
php artisan migrate
```

Kjo do të krijojë të gjitha tables dhe indexes.

### Step 2: Verify SQLite Optimization

**Check WAL mode:**
```bash
sqlite3 database/database.sqlite "PRAGMA journal_mode;"
# Should return: wal
```

**Check indexes:**
```bash
sqlite3 database/database.sqlite ".indexes"
# Should show all indexes including composite ones
```

### Step 3: Test Performance

**Monitor database size:**
```bash
ls -lh database/database.sqlite
```

**Check query performance:**
- Monitor slow queries në Laravel logs
- Use `DB::enableQueryLog()` për debugging

---

## 📊 Performance Expectations

### SQLite Limits (Optimized):

**Recommended Limits:**
- **Users:** Up to 10K active users ✅
- **Writes/Day:** Up to 100K writes/day ✅
- **Database Size:** Up to 5GB ✅
- **Concurrent Connections:** Limited (WAL mode helps) ✅

**Performance:**
- **Reads:** Very fast (indexed queries)
- **Writes:** Good (WAL mode, transactions)
- **Concurrency:** Improved (WAL mode)

---

## 🔧 Maintenance

### Regular Maintenance Tasks

**1. VACUUM (Weekly/Monthly):**
```sql
-- Cleanup deleted data, optimize database
VACUUM;
```

**2. ANALYZE (Weekly/Monthly):**
```sql
-- Update query planner statistics
ANALYZE;
```

**3. Check Database Size:**
```bash
# Monitor growth
du -h database/database.sqlite
```

**4. Backup:**
```bash
# Simple backup
cp database/database.sqlite database/database.sqlite.backup
```

---

## 📈 Monitoring Growth

### When to Consider Migration:

**Upgrade to PostgreSQL/MySQL kur:**
- ✅ Database size > 5GB
- ✅ > 10K active users
- ✅ > 100K writes/day
- ✅ Need for high availability
- ✅ Multi-server deployment
- ✅ Complex analytics queries

### Migration Path:

1. **SQLite (Current)** - 0-10K users ✅
2. **Monitor Growth** - Track metrics
3. **Plan Migration** - Choose PostgreSQL/MySQL
4. **Migrate** - Export/import data

---

## 🎯 Best Practices

### 1. Use Transactions

**Për Multiple Operations:**
```php
DB::transaction(function () {
    DB::table('usage_tracking')->insert(...);
    DB::table('usage_counters')->updateOrInsert(...);
});
```

### 2. Batch Operations

**Për High Volume (Future Enhancement):**
```php
// Instead of loop
DB::table('usage_tracking')->insert([
    ['platform_id' => 1, 'event' => 'command_executed', ...],
    ['platform_id' => 1, 'event' => 'command_executed', ...],
    // ... more records
]);
```

### 3. Limit Queries

**Për Large Datasets:**
```php
DB::table('usage_tracking')
    ->where('platform_id', $id)
    ->orderBy('timestamp', 'desc')
    ->limit(1000) // Always limit
    ->get();
```

### 4. Index-Friendly Queries

**Use indexed columns:**
```php
// Good - uses index
->where('platform_id', $id)
->where('timestamp', '>=', $date)

// Avoid - can't use index efficiently
->whereRaw('DATE(timestamp) = ?', [$date])
```

---

## 🔍 Troubleshooting

### Problem: Slow Queries

**Solution:**
- Check if indexes are used: `EXPLAIN QUERY PLAN`
- Add missing indexes
- Optimize query structure

### Problem: Database Locked

**Solution:**
- Ensure WAL mode is enabled
- Use transactions për multiple operations
- Check for long-running queries

### Problem: Database Size Growing Fast

**Solution:**
- Run VACUUM periodically
- Archive old usage_tracking data
- Consider migration to PostgreSQL/MySQL

---

## 📋 Checklist

### Setup ✅
- [x] SQLite configured në `database.php`
- [x] WAL mode enabled në `AppServiceProvider`
- [x] Foreign keys enabled
- [x] Migrations run

### Optimization ✅
- [x] Composite indexes created
- [x] Query optimization implemented
- [x] Transactions për critical operations
- [x] Connection settings optimized

### Monitoring ⚠️
- [ ] Setup database size monitoring
- [ ] Track write volume
- [ ] Monitor query performance
- [ ] Setup alerts për limits

### Maintenance ⚠️
- [ ] Schedule VACUUM (weekly/monthly)
- [ ] Schedule ANALYZE (weekly/monthly)
- [ ] Setup automated backups
- [ ] Plan migration timeline

---

## 🚀 Next Steps

1. **Run Migrations:**
   ```bash
   php artisan migrate
   ```

2. **Verify Optimization:**
   ```bash
   sqlite3 database/database.sqlite "PRAGMA journal_mode;"
   ```

3. **Monitor Performance:**
   - Track database size
   - Monitor query times
   - Check write volume

4. **Plan Migration:**
   - When approaching limits
   - Choose PostgreSQL/MySQL
   - Setup migration process

---

**Status:** ✅ **SQLITE OPTIMIZED - READY FOR MVP & EARLY GROWTH**

**Note:** SQLite është perfect për fillim. Kur platforma të rritet (>10K users), migro në PostgreSQL për better scalability.

---

## ✅ Çfarë Është Optimizuar:

### 1. AppServiceProvider ✅
- WAL mode enabled automatikisht
- Foreign keys enabled
- Cache size optimized (10MB)
- Synchronous mode: NORMAL
- Temp store: MEMORY

### 2. Migrations ✅
- Composite indexes për common queries
- Optimized për SQLite compatibility

### 3. UsageController ✅
- Transactions për atomicity
- Optimized counter updates
- Index-friendly queries

### 4. Maintenance Scripts ✅
- `artisan-maintenance.sh` - Automated maintenance
- `database/maintenance.sql` - SQL maintenance commands

---

## 🚀 Quick Start

**1. Run Migrations:**
```bash
cd backend
php artisan migrate
```

**2. Verify Optimization:**
```bash
sqlite3 database/database.sqlite "PRAGMA journal_mode;"
# Should return: wal
```

**3. Run Maintenance (Weekly):**
```bash
./artisan-maintenance.sh
```

---

**Status:** ✅ **SQLITE FULLY OPTIMIZED - READY FOR PRODUCTION**

