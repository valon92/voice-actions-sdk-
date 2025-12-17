-- SQLite Maintenance Scripts
-- Run these periodically për optimal performance

-- 1. VACUUM - Cleanup deleted data and optimize database
VACUUM;

-- 2. ANALYZE - Update query planner statistics
ANALYZE;

-- 3. Check database size
-- Run: sqlite3 database/database.sqlite "SELECT page_count * page_size as size FROM pragma_page_count(), pragma_page_size();"

-- 4. Check WAL mode
-- Run: sqlite3 database/database.sqlite "PRAGMA journal_mode;"

-- 5. Check indexes
-- Run: sqlite3 database/database.sqlite ".indexes"

-- 6. Archive old usage_tracking data (optional - për large datasets)
-- DELETE FROM usage_tracking WHERE timestamp < datetime('now', '-1 year');

