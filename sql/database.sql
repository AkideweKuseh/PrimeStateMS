-- ============================================================
-- REAL ESTATE MANAGEMENT SYSTEM DATABASE
-- ============================================================
-- This database stores all information for the real estate system
-- including users, properties, bookings, and payments
-- ============================================================

-- Create the database
CREATE DATABASE IF NOT EXISTS real_estate_db 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE real_estate_db;

-- ============================================================
-- TABLE: users
-- ============================================================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL COMMENT 'Full name of the user',
    email VARCHAR(100) NOT NULL UNIQUE COMMENT 'Email address for login',
    phone VARCHAR(20) DEFAULT NULL COMMENT 'Contact phone number',
    password VARCHAR(255) NOT NULL COMMENT 'Hashed password using password_hash()',
    role ENUM('admin', 'client') DEFAULT 'client' COMMENT 'User role for access control',
    status ENUM('active', 'inactive') DEFAULT 'active' COMMENT 'Account status',
    profile_picture VARCHAR(255) DEFAULT NULL COMMENT 'Profile image filename',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Account creation date',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last update date',
    INDEX idx_email (email),
    INDEX idx_role (role),
    INDEX idx_status (status)
) ENGINE=InnoDB COMMENT='User accounts for admin and client access';

-- ============================================================
-- TABLE: properties
-- ============================================================
CREATE TABLE properties (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL COMMENT 'Property title or name',
    description TEXT NOT NULL COMMENT 'Full description of the property',
    property_type ENUM('house', 'apartment', 'villa', 'land', 'commercial', 'office') NOT NULL COMMENT 'Type of property',
    listing_type ENUM('rent', 'sale') NOT NULL COMMENT 'Whether property is for rent or sale',
    price DECIMAL(15, 2) NOT NULL COMMENT 'Property price in local currency',
    address VARCHAR(255) NOT NULL COMMENT 'Street address',
    city VARCHAR(100) NOT NULL COMMENT 'City name',
    state VARCHAR(100) NOT NULL COMMENT 'State/Province',
    zip_code VARCHAR(20) DEFAULT NULL COMMENT 'Postal/ZIP code',
    country VARCHAR(100) DEFAULT 'Ghana' COMMENT 'Country name',
    bedrooms INT DEFAULT 0 COMMENT 'Number of bedrooms',
    bathrooms INT DEFAULT 0 COMMENT 'Number of bathrooms',
    area_sqft DECIMAL(10, 2) DEFAULT NULL COMMENT 'Area in square feet',
    status ENUM('available', 'booked', 'sold', 'unavailable') DEFAULT 'available' COMMENT 'Current property status',
    is_featured BOOLEAN DEFAULT FALSE COMMENT 'Whether property is featured on homepage',
    main_image VARCHAR(255) DEFAULT NULL COMMENT 'Main property image filename',
    additional_images TEXT DEFAULT NULL COMMENT 'JSON array of additional image filenames',
    added_by INT NOT NULL COMMENT 'User ID of admin who added this property',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Property listing date',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last update date',
    FOREIGN KEY (added_by) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_property_type (property_type),
    INDEX idx_listing_type (listing_type),
    INDEX idx_status (status),
    INDEX idx_city (city),
    INDEX idx_price (price),
    INDEX idx_featured (is_featured)
) ENGINE=InnoDB COMMENT='Property listings in the system';

-- ============================================================
-- TABLE: bookings
-- ============================================================
CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    property_id INT NOT NULL COMMENT 'Property being booked',
    client_id INT NOT NULL COMMENT 'Client who made the booking',
    booking_date DATE NOT NULL COMMENT 'Date when booking was made',
    start_date DATE NOT NULL COMMENT 'Move-in or start date',
    end_date DATE DEFAULT NULL COMMENT 'Move-out or end date (NULL for purchases)',
    total_amount DECIMAL(15, 2) NOT NULL COMMENT 'Total booking amount',
    payment_status ENUM('pending', 'partial', 'completed') DEFAULT 'pending' COMMENT 'Payment completion status',
    booking_status ENUM('pending', 'confirmed', 'cancelled', 'completed') DEFAULT 'pending' COMMENT 'Overall booking status',
    notes TEXT DEFAULT NULL COMMENT 'Special requests or notes from client',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Booking creation time',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last update time',
    FOREIGN KEY (property_id) REFERENCES properties(id) ON DELETE CASCADE,
    FOREIGN KEY (client_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_property_id (property_id),
    INDEX idx_client_id (client_id),
    INDEX idx_booking_date (booking_date),
    INDEX idx_payment_status (payment_status),
    INDEX idx_booking_status (booking_status)
) ENGINE=InnoDB COMMENT='Property bookings made by clients';

-- ============================================================
-- TABLE: payments
-- ============================================================
CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT NOT NULL COMMENT 'Booking this payment belongs to',
    amount DECIMAL(15, 2) NOT NULL COMMENT 'Payment amount',
    payment_method ENUM('cash', 'bank_transfer', 'mobile_money', 'credit_card', 'debit_card') NOT NULL COMMENT 'Method of payment',
    transaction_reference VARCHAR(100) DEFAULT NULL COMMENT 'Bank or mobile money transaction reference',
    payment_status ENUM('pending', 'verified', 'rejected') DEFAULT 'pending' COMMENT 'Payment verification status',
    payment_date DATE NOT NULL COMMENT 'Date payment was made',
    recorded_by INT NOT NULL COMMENT 'Admin who recorded/verified payment',
    notes TEXT DEFAULT NULL COMMENT 'Payment notes or remarks',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Payment record creation time',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last update time',
    FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE,
    FOREIGN KEY (recorded_by) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_booking_id (booking_id),
    INDEX idx_payment_date (payment_date),
    INDEX idx_payment_status (payment_status)
) ENGINE=InnoDB COMMENT='Payment records for bookings';

-- ============================================================
-- SAMPLE DATA
-- ============================================================
-- Admin: admin@primeestate.com / Admin@123
INSERT INTO users (full_name, email, phone, password, role, status) VALUES
('System Administrator', 'admin@primeestate.com', '+233241234567', 
 '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
 'admin', 'active');

-- Client: client@example.com / Client@123
INSERT INTO users (full_name, email, phone, password, role, status) VALUES
('John Doe', 'client@example.com', '+233240000000', 
 '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
 'client', 'active');

-- Sample Properties
INSERT INTO properties (title, description, property_type, listing_type, price, address, city, state, zip_code, bedrooms, bathrooms, area_sqft, status, is_featured, added_by) VALUES
('Luxury 3-Bedroom Apartment', 'Stunning apartment with city views, modern kitchen, and gym access.', 'apartment', 'rent', 3500.00, '45 Independence Avenue', 'Accra', 'Greater Accra', '00233', 3, 2, 1800.00, 'available', TRUE, 1),
('Spacious Family House', 'Beautiful 4-bedroom house with large garden and garage in a quiet neighborhood.', 'house', 'sale', 850000.00, '12 East Legon Hills', 'Accra', 'Greater Accra', '00233', 4, 3, 3200.00, 'available', TRUE, 1),
('Modern Office Complex', 'Prime commercial space suitable for corporate offices.', 'office', 'rent', 12000.00, '88 Liberation Road', 'Accra', 'Greater Accra', '00233', 0, 4, 5000.00, 'available', FALSE, 1);
