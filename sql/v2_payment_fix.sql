-- ============================================================
-- PRIME ESTATE MANAGEMENT SYSTEM - PAYMENT ENUM FIX
-- ============================================================
-- Fixes ENUM mismatches that cause mock payments to silently fail,
-- preventing booking confirmation and tenant/rent record creation.
-- ============================================================

USE real_estate_db;

-- Fix 1: Widen payment_method ENUM to accept all used values
ALTER TABLE payments MODIFY COLUMN payment_method VARCHAR(50) NOT NULL COMMENT 'Method of payment';

-- Fix 2: Widen payment_status ENUM to include 'completed' value
ALTER TABLE payments MODIFY COLUMN payment_status ENUM('pending', 'verified', 'rejected', 'completed') DEFAULT 'pending' COMMENT 'Payment verification status';

-- ============================================================
-- DIAGNOSTIC: Check for confirmed bookings that are missing tenant records
-- Run this SELECT to see if any confirmed rental bookings lack a tenant record
-- ============================================================
-- SELECT b.id as booking_id, b.client_id, b.property_id, b.booking_status, b.payment_status,
--        p.listing_type, p.title,
--        t.id as tenant_id
-- FROM bookings b
-- JOIN properties p ON b.property_id = p.id
-- LEFT JOIN tenants t ON t.user_id = b.client_id AND t.property_id = b.property_id
-- WHERE b.booking_status = 'confirmed'
--   AND p.listing_type = 'rent'
--   AND t.id IS NULL;

-- ============================================================
-- MANUAL FIX: If the above diagnostic returns rows, run these
-- to manually create the missing tenant and rent records.
-- Replace the VALUES with actual data from the diagnostic query.
-- ============================================================
-- INSERT INTO tenants (user_id, property_id, contact_info, lease_start, lease_end)
-- SELECT b.client_id, b.property_id, u.phone, b.start_date,
--        COALESCE(b.end_date, DATE_ADD(b.start_date, INTERVAL 1 YEAR))
-- FROM bookings b
-- JOIN users u ON b.client_id = u.id
-- JOIN properties p ON b.property_id = p.id
-- LEFT JOIN tenants t ON t.user_id = b.client_id AND t.property_id = b.property_id
-- WHERE b.booking_status = 'confirmed'
--   AND p.listing_type = 'rent'
--   AND t.id IS NULL;

-- Then create rent records for the newly created tenants:
-- INSERT INTO rent (tenant_id, property_id, amount, payment_date, balance, status)
-- SELECT t.id, t.property_id, b.total_amount, CURDATE(), 0.00, 'paid'
-- FROM tenants t
-- JOIN bookings b ON b.client_id = t.user_id AND b.property_id = t.property_id
-- LEFT JOIN rent r ON r.tenant_id = t.id
-- WHERE b.booking_status = 'confirmed'
--   AND r.id IS NULL;

-- Ensure the user role is set to 'tenant':
-- UPDATE users u
-- JOIN tenants t ON t.user_id = u.id
-- SET u.role = 'tenant'
-- WHERE u.role = 'client';
