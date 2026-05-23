-- ============================================================
-- PRIME ESTATE MANAGEMENT SYSTEM - V2.0 SCHEMA FIXES
-- ============================================================
-- Widens VARCHAR columns to match V-2.0 specification

USE real_estate_db;

-- Fix 1: Widen full_name from VARCHAR(100) to VARCHAR(150)
ALTER TABLE users MODIFY COLUMN full_name VARCHAR(150) NOT NULL COMMENT 'Full name of the user';

-- Fix 2: Widen email from VARCHAR(100) to VARCHAR(120)
-- Note: Do NOT add UNIQUE here — the existing unique index is preserved by MODIFY COLUMN
ALTER TABLE users MODIFY COLUMN email VARCHAR(120) NOT NULL COMMENT 'Email address for login';
