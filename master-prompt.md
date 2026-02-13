# 🏢 REAL ESTATE MANAGEMENT SYSTEM - COMPLETE BUILD SPECIFICATION

## 📋 EXECUTIVE SUMMARY

You are tasked with building a **complete, production-ready Real Estate Management System** as a final year academic project. This system must be built from scratch using raw PHP (NO FRAMEWORKS), with extensive documentation suitable for academic evaluation by non-technical examiners.

---

## 🎯 PROJECT OBJECTIVES

### Primary Goals
1. Provide a centralized platform for managing real estate properties, clients, bookings, and payments
2. Enable clients to search, view, and book properties online seamlessly
3. Allow administrators to manage property listings, monitor bookings, and generate reports
4. Ensure secure handling of client data and payment transactions
5. Reduce manual paperwork and improve accuracy of property management operations
6. Provide real-time updates on property availability and booking status

### Success Criteria
- ✅ Two distinct user roles (Admin and Client) with role-based access control
- ✅ Complete CRUD operations for all entities
- ✅ Secure authentication and authorization system
- ✅ Responsive UI using Bootstrap 5
- ✅ Real-time search and filtering
- ✅ Visual reports using Chart.js
- ✅ Comprehensive inline documentation for non-technical reviewers
- ✅ Professional README with setup instructions
- ✅ Clean, modular, maintainable code

---

## 💻 TECHNOLOGY STACK (STRICT REQUIREMENTS)

### Backend
- **PHP 8.0+** (raw PHP, NO frameworks like Laravel, CodeIgniter, etc.)
- **PDO (PHP Data Objects)** for all database operations
- **Object-Oriented Programming (OOP)** - all code must use classes
- **MVC-inspired architecture** (custom implementation)
- **Sessions** for authentication and state management

### Database
- **MySQL 8.0+** via XAMPP
- **phpMyAdmin** for database management
- **Prepared Statements** (mandatory for security)
- **Foreign Key Constraints** for data integrity
- **Proper Normalization** (at least 3NF)

### Frontend
- **HTML5** with semantic markup
- **CSS3** with custom styles
- **Bootstrap 5.3** for responsive design
- **Vanilla JavaScript** (minimal usage, NO jQuery)
- **Chart.js 4.0+** for data visualization
- **Font Awesome 6.0+** for icons

### Server Environment
- **XAMPP** (Apache + MySQL + PHP)
- Must run on: `http://localhost/real-estate-system/`
- **htaccess** for URL rewriting (optional enhancement)

---

## 📁 COMPLETE PROJECT STRUCTURE

Create the following **EXACT** folder structure:
````
real-estate-system/
│
├── config/
│   ├── Database.php              # Database connection class using PDO
│   └── config.php                # Application configuration constants
│
├── core/
│   ├── Auth.php                  # Authentication helper class
│   ├── Helper.php                # Utility functions (redirect, alert, etc.)
│   └── Validator.php             # Input validation class
│
├── models/
│   ├── User.php                  # User model (login, register, role management)
│   ├── Property.php              # Property CRUD operations
│   ├── Booking.php               # Booking management
│   ├── Payment.php               # Payment recording
│   └── Report.php                # Report generation logic
│
├── controllers/
│   ├── AuthController.php        # Login, register, logout handling
│   ├── PropertyController.php    # Property CRUD operations
│   ├── BookingController.php     # Booking management
│   ├── PaymentController.php     # Payment recording
│   ├── ReportController.php      # Report generation
│   └── SearchController.php      # Property search and filtering
│
├── views/
│   ├── layouts/
│   │   ├── header.php           # Common header (navigation, meta tags)
│   │   ├── footer.php           # Common footer
│   │   ├── admin-sidebar.php   # Admin dashboard sidebar
│   │   └── client-sidebar.php  # Client dashboard sidebar
│   │
│   ├── auth/
│   │   ├── login.php            # Login page
│   │   ├── register.php         # Registration page
│   │   └── forgot-password.php  # Password recovery (optional)
│   │
│   ├── admin/
│   │   ├── dashboard.php        # Admin dashboard with statistics
│   │   ├── properties/
│   │   │   ├── index.php        # List all properties
│   │   │   ├── create.php       # Add new property form
│   │   │   ├── edit.php         # Edit property form
│   │   │   └── view.php         # View property details
│   │   │
│   │   ├── bookings/
│   │   │   ├── index.php        # List all bookings
│   │   │   └── view.php         # View booking details
│   │   │
│   │   ├── payments/
│   │   │   ├── index.php        # List all payments
│   │   │   ├── record.php       # Record new payment
│   │   │   └── receipt.php      # Generate receipt
│   │   │
│   │   └── reports/
│   │       ├── index.php        # Reports dashboard
│   │       ├── properties.php   # Property reports
│   │       ├── bookings.php     # Booking reports
│   │       └── revenue.php      # Revenue reports
│   │
│   ├── client/
│   │   ├── dashboard.php        # Client dashboard
│   │   ├── properties/
│   │   │   ├── index.php        # Browse properties
│   │   │   ├── search.php       # Search properties
│   │   │   └── view.php         # View property details
│   │   │
│   │   ├── bookings/
│   │   │   ├── index.php        # My bookings
│   │   │   ├── create.php       # Book a property
│   │   │   └── view.php         # View booking details
│   │   │
│   │   └── payments/
│   │       ├── index.php        # My payments
│   │       └── receipt.php      # View receipt
│   │
│   ├── public/
│   │   ├── home.php             # Public home page
│   │   ├── about.php            # About page
│   │   ├── contact.php          # Contact page
│   │   └── properties.php       # Public property listings
│   │
│   └── errors/
│       ├── 404.php              # Page not found
│       └── 403.php              # Access denied
│
├── public/
│   ├── css/
│   │   ├── style.css            # Custom styles
│   │   └── admin.css            # Admin-specific styles
│   │
│   ├── js/
│   │   ├── main.js              # Common JavaScript functions
│   │   ├── search.js            # Search functionality
│   │   └── charts.js            # Chart.js configurations
│   │
│   ├── images/
│   │   ├── logo.png             # Site logo
│   │   └── default-property.jpg # Default property image
│   │
│   └── index.php                # Application entry point
│
├── uploads/
│   └── properties/              # Property images storage
│       └── .htaccess            # Prevent direct access to PHP files
│
├── sql/
│   └── database.sql             # Complete database schema with sample data
│
├── docs/
│   ├── API_DOCUMENTATION.md     # Endpoint documentation
│   ├── DATABASE_SCHEMA.md       # Database structure explanation
│   ├── USER_GUIDE.md            # User manual
│   └── DEVELOPER_GUIDE.md       # Development guide
│
├── .htaccess                    # Apache configuration (optional)
├── .gitignore                   # Git ignore file
└── README.md                    # Complete project documentation
````

---

## 🗄️ DATABASE SCHEMA (COMPLETE SPECIFICATION)

### Create the following SQL schema with detailed comments:
````sql
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
-- Purpose: Stores user accounts for both admins and clients
-- This table handles authentication and role-based access
-- ============================================================
CREATE TABLE users (
    -- Unique identifier for each user
    id INT AUTO_INCREMENT PRIMARY KEY,
    
    -- User's full name
    full_name VARCHAR(100) NOT NULL COMMENT 'Full name of the user',
    
    -- Email address (used for login)
    email VARCHAR(100) NOT NULL UNIQUE COMMENT 'Email address for login',
    
    -- Phone number for contact
    phone VARCHAR(20) DEFAULT NULL COMMENT 'Contact phone number',
    
    -- Hashed password (never store plain text passwords)
    password VARCHAR(255) NOT NULL COMMENT 'Hashed password using password_hash()',
    
    -- User role: admin or client
    role ENUM('admin', 'client') DEFAULT 'client' COMMENT 'User role for access control',
    
    -- Account status
    status ENUM('active', 'inactive') DEFAULT 'active' COMMENT 'Account status',
    
    -- Profile picture filename (optional)
    profile_picture VARCHAR(255) DEFAULT NULL COMMENT 'Profile image filename',
    
    -- Timestamps
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Account creation date',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last update date',
    
    -- Indexes for faster queries
    INDEX idx_email (email),
    INDEX idx_role (role),
    INDEX idx_status (status)
) ENGINE=InnoDB COMMENT='User accounts for admin and client access';

-- ============================================================
-- TABLE: properties
-- ============================================================
-- Purpose: Stores all property listings in the system
-- Each property can be rented or sold
-- ============================================================
CREATE TABLE properties (
    -- Unique identifier for each property
    id INT AUTO_INCREMENT PRIMARY KEY,
    
    -- Property title/name
    title VARCHAR(200) NOT NULL COMMENT 'Property title or name',
    
    -- Detailed description of the property
    description TEXT NOT NULL COMMENT 'Full description of the property',
    
    -- Property type (house, apartment, land, etc.)
    property_type ENUM('house', 'apartment', 'villa', 'land', 'commercial', 'office') NOT NULL COMMENT 'Type of property',
    
    -- Transaction type
    listing_type ENUM('rent', 'sale') NOT NULL COMMENT 'Whether property is for rent or sale',
    
    -- Property price
    price DECIMAL(15, 2) NOT NULL COMMENT 'Property price in local currency',
    
    -- Location details
    address VARCHAR(255) NOT NULL COMMENT 'Street address',
    city VARCHAR(100) NOT NULL COMMENT 'City name',
    state VARCHAR(100) NOT NULL COMMENT 'State/Province',
    zip_code VARCHAR(20) DEFAULT NULL COMMENT 'Postal/ZIP code',
    country VARCHAR(100) DEFAULT 'Ghana' COMMENT 'Country name',
    
    -- Property specifications
    bedrooms INT DEFAULT 0 COMMENT 'Number of bedrooms',
    bathrooms INT DEFAULT 0 COMMENT 'Number of bathrooms',
    area_sqft DECIMAL(10, 2) DEFAULT NULL COMMENT 'Area in square feet',
    
    -- Property status
    status ENUM('available', 'booked', 'sold', 'unavailable') DEFAULT 'available' COMMENT 'Current property status',
    
    -- Featured property flag
    is_featured BOOLEAN DEFAULT FALSE COMMENT 'Whether property is featured on homepage',
    
    -- Main property image
    main_image VARCHAR(255) DEFAULT NULL COMMENT 'Main property image filename',
    
    -- Additional images (stored as JSON array)
    additional_images TEXT DEFAULT NULL COMMENT 'JSON array of additional image filenames',
    
    -- Who added this property
    added_by INT NOT NULL COMMENT 'User ID of admin who added this property',
    
    -- Timestamps
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Property listing date',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last update date',
    
    -- Foreign key relationship
    FOREIGN KEY (added_by) REFERENCES users(id) ON DELETE CASCADE,
    
    -- Indexes for search optimization
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
-- Purpose: Tracks property bookings made by clients
-- Links clients to properties they want to book
-- ============================================================
CREATE TABLE bookings (
    -- Unique identifier for each booking
    id INT AUTO_INCREMENT PRIMARY KEY,
    
    -- Reference to the property being booked
    property_id INT NOT NULL COMMENT 'Property being booked',
    
    -- Reference to the client making the booking
    client_id INT NOT NULL COMMENT 'Client who made the booking',
    
    -- Booking dates
    booking_date DATE NOT NULL COMMENT 'Date when booking was made',
    start_date DATE NOT NULL COMMENT 'Move-in or start date',
    end_date DATE DEFAULT NULL COMMENT 'Move-out or end date (NULL for purchases)',
    
    -- Booking amount
    total_amount DECIMAL(15, 2) NOT NULL COMMENT 'Total booking amount',
    
    -- Payment status
    payment_status ENUM('pending', 'partial', 'completed') DEFAULT 'pending' COMMENT 'Payment completion status',
    
    -- Booking status
    booking_status ENUM('pending', 'confirmed', 'cancelled', 'completed') DEFAULT 'pending' COMMENT 'Overall booking status',
    
    -- Additional notes
    notes TEXT DEFAULT NULL COMMENT 'Special requests or notes from client',
    
    -- Timestamps
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Booking creation time',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last update time',
    
    -- Foreign key relationships
    FOREIGN KEY (property_id) REFERENCES properties(id) ON DELETE CASCADE,
    FOREIGN KEY (client_id) REFERENCES users(id) ON DELETE CASCADE,
    
    -- Indexes for reporting
    INDEX idx_property_id (property_id),
    INDEX idx_client_id (client_id),
    INDEX idx_booking_date (booking_date),
    INDEX idx_payment_status (payment_status),
    INDEX idx_booking_status (booking_status)
) ENGINE=InnoDB COMMENT='Property bookings made by clients';

-- ============================================================
-- TABLE: payments
-- ============================================================
-- Purpose: Records all payments made for bookings
-- Tracks payment history and status
-- ============================================================
CREATE TABLE payments (
    -- Unique identifier for each payment
    id INT AUTO_INCREMENT PRIMARY KEY,
    
    -- Reference to the booking this payment is for
    booking_id INT NOT NULL COMMENT 'Booking this payment belongs to',
    
    -- Payment amount
    amount DECIMAL(15, 2) NOT NULL COMMENT 'Payment amount',
    
    -- Payment method
    payment_method ENUM('cash', 'bank_transfer', 'mobile_money', 'credit_card', 'debit_card') NOT NULL COMMENT 'Method of payment',
    
    -- Transaction reference
    transaction_reference VARCHAR(100) DEFAULT NULL COMMENT 'Bank or mobile money transaction reference',
    
    -- Payment status
    payment_status ENUM('pending', 'verified', 'rejected') DEFAULT 'pending' COMMENT 'Payment verification status',
    
    -- Payment date
    payment_date DATE NOT NULL COMMENT 'Date payment was made',
    
    -- Who recorded this payment
    recorded_by INT NOT NULL COMMENT 'Admin who recorded/verified payment',
    
    -- Additional notes
    notes TEXT DEFAULT NULL COMMENT 'Payment notes or remarks',
    
    -- Timestamps
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Payment record creation time',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last update time',
    
    -- Foreign key relationships
    FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE,
    FOREIGN KEY (recorded_by) REFERENCES users(id) ON DELETE CASCADE,
    
    -- Indexes for reporting
    INDEX idx_booking_id (booking_id),
    INDEX idx_payment_date (payment_date),
    INDEX idx_payment_status (payment_status)
) ENGINE=InnoDB COMMENT='Payment records for bookings';

-- ============================================================
-- TABLE: notifications (Optional Enhancement)
-- ============================================================
-- Purpose: Stores system notifications for users
-- Used to notify users about booking confirmations, payments, etc.
-- ============================================================
CREATE TABLE notifications (
    -- Unique identifier for each notification
    id INT AUTO_INCREMENT PRIMARY KEY,
    
    -- User who receives this notification
    user_id INT NOT NULL COMMENT 'Recipient user ID',
    
    -- Notification title
    title VARCHAR(200) NOT NULL COMMENT 'Notification title',
    
    -- Notification message
    message TEXT NOT NULL COMMENT 'Notification message content',
    
    -- Notification type for styling
    type ENUM('info', 'success', 'warning', 'error') DEFAULT 'info' COMMENT 'Notification type',
    
    -- Read status
    is_read BOOLEAN DEFAULT FALSE COMMENT 'Whether notification has been read',
    
    -- Optional link
    link VARCHAR(255) DEFAULT NULL COMMENT 'Optional link to relevant page',
    
    -- Timestamps
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Notification creation time',
    read_at TIMESTAMP NULL DEFAULT NULL COMMENT 'Time when notification was read',
    
    -- Foreign key relationship
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    
    -- Indexes
    INDEX idx_user_id (user_id),
    INDEX idx_is_read (is_read),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB COMMENT='System notifications for users';

-- ============================================================
-- SAMPLE DATA FOR TESTING
-- ============================================================

-- Insert default admin account
-- Email: admin@realestate.com
-- Password: Admin@123
INSERT INTO users (full_name, email, phone, password, role, status) VALUES
('System Administrator', 'admin@realestate.com', '+233241234567', 
 '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', -- Password: Admin@123
 'admin', 'active');

-- Insert sample client accounts
-- Password for all: Client@123
INSERT INTO users (full_name, email, phone, password, role, status) VALUES
('John Mensah', 'john@example.com', '+233241234568', 
 '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
 'client', 'active'),
('Sarah Asante', 'sarah@example.com', '+233241234569', 
 '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
 'client', 'active');

-- Insert sample properties
INSERT INTO properties (title, description, property_type, listing_type, price, address, city, state, zip_code, bedrooms, bathrooms, area_sqft, status, is_featured, added_by) VALUES
('Modern 3-Bedroom Apartment', 'Beautiful apartment in the heart of Accra with modern amenities', 'apartment', 'rent', 2500.00, '123 Independence Ave', 'Accra', 'Greater Accra', '00233', 3, 2, 1500.00, 'available', TRUE, 1),
('Luxury Villa in East Legon', 'Spacious villa with swimming pool and garden', 'villa', 'sale', 450000.00, '45 East Legon Hills', 'Accra', 'Greater Accra', '00233', 5, 4, 4000.00, 'available', TRUE, 1),
('Commercial Office Space', 'Prime office space in business district', 'office', 'rent', 5000.00, '78 Liberation Road', 'Accra', 'Greater Accra', '00233', 0, 2, 2000.00, 'available', FALSE, 1);

-- ============================================================
-- END OF DATABASE SCHEMA
-- ============================================================
````

---

## 🏗️ CORE SYSTEM FILES (BUILD EACH FILE WITH EXTENSIVE COMMENTS)

### 1. config/Database.php

**Purpose:** Establishes secure database connection using PDO

**Requirements:**
- Use PDO with exception handling
- Set PDO attributes for security
- Use prepared statements
- Handle connection errors gracefully
- Include detailed comments explaining each step

**Code Template:**
````php
<?php
/**
 * ================================================================
 * DATABASE CONNECTION CLASS
 * ================================================================
 * 
 * This file handles the database connection for the entire system.
 * It uses PDO (PHP Data Objects) which is a secure way to connect
 * to databases in PHP.
 * 
 * WHY PDO?
 * - Prevents SQL injection attacks
 * - Supports prepared statements
 * - Works with multiple database types
 * - Better error handling
 * 
 * @author Your Name
 * @version 1.0
 * ================================================================
 */

class Database {
    
    // Database configuration constants
    // These store the connection details for our MySQL database
    private $host = "localhost";          // Database server location
    private $db_name = "real_estate_db";  // Database name
    private $username = "root";            // Database username (default in XAMPP)
    private $password = "";                // Database password (empty by default in XAMPP)
    private $charset = "utf8mb4";         // Character encoding for proper text storage
    
    // This variable will hold our database connection
    public $conn;
    
    /**
     * ================================================================
     * GET DATABASE CONNECTION
     * ================================================================
     * 
     * This method creates and returns a database connection.
     * It's called whenever we need to interact with the database.
     * 
     * HOW IT WORKS:
     * 1. Creates a DSN (Data Source Name) string with connection details
     * 2. Attempts to connect to the database using PDO
     * 3. Sets important security options
     * 4. Returns the connection if successful
     * 5. Shows error message if connection fails
     * 
     * @return PDO|null Database connection object or null if failed
     * ================================================================
     */
    public function getConnection() {
        
        // Start with no connection
        $this->conn = null;
        
        try {
            // Create the DSN (Data Source Name) string
            // This tells PDO where our database is and what it's called
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=" . $this->charset;
            
            // Try to establish connection to the database
            $this->conn = new PDO($dsn, $this->username, $this->password);
            
            // Set PDO attributes for security and error handling
            
            // 1. Set error mode to throw exceptions
            // This means if something goes wrong, we'll know about it immediately
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // 2. Use real prepared statements
            // This prevents SQL injection attacks
            $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            
            // 3. Set default fetch mode to associative array
            // This makes it easier to work with query results
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
        } catch(PDOException $exception) {
            // If connection fails, show a user-friendly error message
            // In production, you might want to log this instead of displaying it
            echo "Database Connection Error: " . $exception->getMessage();
        }
        
        // Return the connection (or null if it failed)
        return $this->conn;
    }
}

/**
 * ================================================================
 * USAGE EXAMPLE
 * ================================================================
 * 
 * To use this database connection in other files:
 * 
 * // Include this file
 * require_once '../config/Database.php';
 * 
 * // Create a database object
 * $database = new Database();
 * 
 * // Get the connection
 * $db = $database->getConnection();
 * 
 * // Now you can use $db to run queries
 * ================================================================
 */
?>
````

### 2. config/config.php

**Purpose:** Store application-wide configuration constants

**Requirements:**
- Define application constants
- Set timezone
- Define file upload settings
- Set session configuration
- Include detailed explanations

**Code Template:**
````php
<?php
/**
 * ================================================================
 * APPLICATION CONFIGURATION FILE
 * ================================================================
 * 
 * This file contains all the configuration settings for the
 * Real Estate Management System. These settings control how
 * the application behaves.
 * 
 * WHAT'S INCLUDED:
 * - Application paths and URLs
 * - Session configuration
 * - File upload settings
 * - Security settings
 * - Timezone settings
 * 
 * @author Your Name
 * @version 1.0
 * ================================================================
 */

// ================================================================
// APPLICATION PATHS
// ================================================================
// These define where different parts of the application are located

// Base URL of the application (change this if your folder name is different)
define('BASE_URL', 'http://localhost/real-estate-system/');

// Public URL for assets (CSS, JS, images)
define('ASSETS_URL', BASE_URL . 'public/');

// Upload directory for property images
define('UPLOAD_DIR', __DIR__ . '/../uploads/properties/');
define('UPLOAD_URL', BASE_URL . 'uploads/properties/');

// ================================================================
// SESSION CONFIGURATION
// ================================================================
// These settings control how user sessions work

// Session name (makes sessions more secure)
define('SESSION_NAME', 'REAL_ESTATE_SESSION');

// Session lifetime (in seconds) - 2 hours
define('SESSION_LIFETIME', 7200);

// ================================================================
// FILE UPLOAD SETTINGS
// ================================================================
// These control what files users can upload and their size limits

// Maximum file size for property images (5MB in bytes)
define('MAX_FILE_SIZE', 5242880);

// Allowed image file extensions
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'gif', 'webp']);

// Maximum number of images per property
define('MAX_IMAGES_PER_PROPERTY', 5);

// ================================================================
// PAGINATION SETTINGS
// ================================================================
// Control how many items appear per page in listings

// Properties per page
define('PROPERTIES_PER_PAGE', 12);

// Bookings per page
define('BOOKINGS_PER_PAGE', 20);

// Payments per page
define('PAYMENTS_PER_PAGE', 20);

// ================================================================
// DATE AND TIME SETTINGS
// ================================================================
// Set the timezone for the application

// Set timezone (change to your local timezone)
date_default_timezone_set('Africa/Accra');

// Date format for display
define('DATE_FORMAT', 'd M Y');

// Date-time format for display
define('DATETIME_FORMAT', 'd M Y H:i A');

// ================================================================
// APPLICATION INFORMATION
// ================================================================
// Basic information about the application

// Application name
define('APP_NAME', 'Real Estate Management System');

// Application version
define('APP_VERSION', '1.0.0');

// Contact email
define('CONTACT_EMAIL', 'info@realestate.com');

// Contact phone
define('CONTACT_PHONE', '+233 24 123 4567');

// ================================================================
// SECURITY SETTINGS
// ================================================================

// Password minimum length
define('MIN_PASSWORD_LENGTH', 8);

// Enable password strength requirements (true/false)
define('REQUIRE_STRONG_PASSWORD', true);

// Login attempts before lockout
define('MAX_LOGIN_ATTEMPTS', 5);

// Lockout duration in minutes
define('LOCKOUT_DURATION', 30);

// ================================================================
// EMAIL SETTINGS (For future enhancement)
// ================================================================

// SMTP settings for sending emails
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'your-email@gmail.com');
define('SMTP_PASSWORD', 'your-email-password');

// ================================================================
// CURRENCY SETTINGS
// ================================================================

// Currency symbol
define('CURRENCY_SYMBOL', 'GH₵');

// Currency code
define('CURRENCY_CODE', 'GHS');

// ================================================================
// START SESSION
// ================================================================
// Start the session if not already started

if (session_status() === PHP_SESSION_NONE) {
    // Configure session settings
    ini_set('session.cookie_httponly', 1);  // Prevent JavaScript access to cookies
    ini_set('session.use_only_cookies', 1);  // Only use cookies for sessions
    ini_set('session.cookie_secure', 0);     // Set to 1 if using HTTPS
    
    // Set session lifetime
    ini_set('session.gc_maxlifetime', SESSION_LIFETIME);
    
    // Start the session
    session_name(SESSION_NAME);
    session_start();
}

/**
 * ================================================================
 * USAGE EXAMPLE
 * ================================================================
 * 
 * To use these configuration settings in other files:
 * 
 * // Include this file
 * require_once '../config/config.php';
 * 
 * // Now you can use any defined constant
 * echo BASE_URL;  // Outputs: http://localhost/real-estate-system/
 * echo APP_NAME;  // Outputs: Real Estate Management System
 * 
 * ================================================================
 */
?>
````

### 3. core/Auth.php

**Purpose:** Handle authentication and authorization

**Requirements:**
- Check if user is logged in
- Check user roles
- Require authentication for protected pages
- Redirect unauthorized users
- Extensive explanatory comments

[CONTINUE WITH REMAINING FILES...]

---

## 📊 FEATURE IMPLEMENTATION GUIDE

### Feature 1: User Authentication System

#### Files to Create:
1. `models/User.php` - User model with register, login, logout methods
2. `controllers/AuthController.php` - Handle authentication requests
3. `views/auth/login.php` - Login page
4. `views/auth/register.php` - Registration page

#### Detailed Requirements:

**1.1 Registration Flow:**
````
User fills form → Validate input → Check if email exists → 
Hash password → Insert into database → Redirect to login
````

**Comment Requirements:**
- Explain why we hash passwords
- Explain what each validation checks for
- Explain the redirect logic

**1.2 Login Flow:**
````
User submits credentials → Check email exists → 
Verify password → Create session → Redirect based on role
````

**Comment Requirements:**
- Explain session creation
- Explain role-based redirects
- Explain password verification

**1.3 Security Measures:**
- Use `password_hash()` with PASSWORD_BCRYPT
- Use `password_verify()` for checking
- Sanitize all inputs with `trim()` and `htmlspecialchars()`
- Validate email format
- Require strong passwords (8+ chars, uppercase, lowercase, number)

---

### Feature 2: Property Management (Admin)

#### Files to Create:
1. `models/Property.php` - Property CRUD operations
2. `controllers/PropertyController.php` - Handle property requests
3. `views/admin/properties/index.php` - List all properties
4. `views/admin/properties/create.php` - Add property form
5. `views/admin/properties/edit.php` - Edit property form
6. `views/admin/properties/view.php` - View property details

#### Detailed Requirements:

**2.1 Add Property:**
- Form with all property fields
- Image upload (validate type and size)
- Store image in `uploads/properties/`
- Rename image with unique name (timestamp + random string)
- Insert property data into database
- Show success message

**Comment Requirements:**
- Explain image validation logic
- Explain why we rename files
- Explain each form field's purpose

**2.2 Edit Property:**
- Load existing property data
- Pre-fill form fields
- Allow image replacement
- Delete old image if new one uploaded
- Update database record
- Show success message

**2.3 Delete Property:**
- Confirm deletion (use JavaScript alert)
- Delete property images from server
- Delete database record (CASCADE will delete related bookings)
- Show success message

---

### Feature 3: Property Search and Filtering (Client)

#### Files to Create:
1. `controllers/SearchController.php` - Handle search logic
2. `views/client/properties/search.php` - Search interface
3. `public/js/search.js` - AJAX search functionality

#### Detailed Requirements:

**3.1 Search Criteria:**
- Search by city
- Filter by property type
- Filter by listing type (rent/sale)
- Filter by price range (min-max)
- Filter by bedrooms
- Filter by status (available only)

**3.2 Search Implementation:**
- Build dynamic SQL query based on filters
- Use prepared statements with named parameters
- Show results in grid layout with Bootstrap cards
- Show "No results found" if empty
- Make it responsive

**Comment Requirements:**
- Explain how dynamic query building works
- Explain the filter logic
- Explain AJAX if implemented

---

### Feature 4: Booking System

#### Files to Create:
1. `models/Booking.php` - Booking CRUD operations
2. `controllers/BookingController.php` - Handle booking requests
3. `views/client/bookings/create.php` - Booking form
4. `views/client/bookings/index.php` - Client's bookings
5. `views/admin/bookings/index.php` - All bookings (admin)

#### Detailed Requirements:

**4.1 Create Booking:**
- Client selects property
- Client fills booking form (dates, notes)
- Validate dates (start date >= today)
- Calculate total amount based on property price
- Insert booking record
- Update property status to 'booked'
- Show confirmation message
- Send notification (optional)

**Comment Requirements:**
- Explain date validation
- Explain amount calculation
- Explain status update logic
- Explain transaction handling

**4.2 View Bookings:**
- Clients see only their bookings
- Admins see all bookings
- Display booking details, property info, payment status
- Show status badges (pending, confirmed, cancelled)

---

### Feature 5: Payment Recording

#### Files to Create:
1. `models/Payment.php` - Payment operations
2. `controllers/PaymentController.php` - Handle payment requests
3. `views/admin/payments/record.php` - Payment recording form
4. `views/admin/payments/receipt.php` - Generate receipt
5. `views/client/payments/index.php` - Client payment history

#### Detailed Requirements:

**5.1 Record Payment:**
- Admin selects booking
- Admin enters payment details (amount, method, reference)
- Validate amount (not more than booking amount)
- Insert payment record
- Update booking payment_status
- If fully paid, update to 'completed'
- Generate receipt

**Comment Requirements:**
- Explain payment validation
- Explain status update logic
- Explain receipt generation

---

### Feature 6: Reports and Dashboard

#### Files to Create:
1. `models/Report.php` - Report generation logic
2. `controllers/ReportController.php` - Handle report requests
3. `views/admin/dashboard.php` - Admin dashboard with charts
4. `views/admin/reports/properties.php` - Property reports
5. `views/admin/reports/revenue.php` - Revenue reports
6. `public/js/charts.js` - Chart.js configurations

#### Detailed Requirements:

**6.1 Dashboard Statistics:**
- Total properties count
- Total bookings count
- Total revenue (sum of all payments)
- Available properties count
- Booked properties count
- Pending bookings count

**6.2 Charts (using Chart.js):**
- Pie chart: Properties by type
- Bar chart: Properties by status
- Line chart: Bookings over time (last 6 months)
- Doughnut chart: Revenue by property type

**Comment Requirements:**
- Explain each statistic calculation
- Explain chart data preparation
- Explain Chart.js configuration options

---

## 🎨 UI/UX REQUIREMENTS

### General Design Guidelines:
1. **Responsive Design:**
   - Use Bootstrap 5 grid system
   - Mobile-first approach
   - Test on mobile, tablet, desktop

2. **Color Scheme:**
   - Primary: #007bff (Bootstrap blue)
   - Success: #28a745 (green)
   - Warning: #ffc107 (yellow)
   - Danger: #dc3545 (red)
   - Dark: #343a40 (dark gray)

3. **Typography:**
   - Use Bootstrap default fonts
   - Headers: font-weight: 600
   - Body: font-size: 16px

4. **Components:**
   - Use Bootstrap cards for property listings
   - Use Bootstrap tables for data display
   - Use Bootstrap forms with validation
   - Use Bootstrap alerts for messages

### Specific Page Requirements:

**1. Login/Register Pages:**
- Centered form
- Background gradient or image
- Form validation with error messages
- "Remember me" checkbox (optional)
- Link to forgot password (optional)

**2. Admin Dashboard:**
- Sidebar navigation
- Top header with user info and logout
- Statistics cards in grid
- Charts section
- Recent bookings table

**3. Property Listing:**
- Grid layout (3 columns on desktop, 2 on tablet, 1 on mobile)
- Property cards with image, title, price, location
- Status badge (Available, Booked, etc.)
- "View Details" button
- Pagination

**4. Property Details:**
- Large image gallery (main + thumbnails)
- Property specifications in table
- Description section
- Location on map (optional)
- "Book Now" button (for clients)

---

## 🔒 SECURITY IMPLEMENTATION CHECKLIST

### Input Validation:
- [ ] Validate all form inputs on server-side
- [ ] Use `filter_input()` for filtering
- [ ] Use `htmlspecialchars()` for output
- [ ] Trim whitespace from inputs
- [ ] Validate email format
- [ ] Validate phone format
- [ ] Validate date formats

### SQL Injection Prevention:
- [ ] Use PDO prepared statements for ALL queries
- [ ] Never concatenate user input into SQL
- [ ] Use named or positional parameters
- [ ] Bind parameters with correct data types

### Password Security:
- [ ] Hash passwords with `password_hash()`
- [ ] Use PASSWORD_BCRYPT algorithm
- [ ] Never store plain text passwords
- [ ] Verify with `password_verify()`
- [ ] Require strong passwords

### Session Security:
- [ ] Use `session_regenerate_id()` after login
- [ ] Check user authentication on protected pages
- [ ] Set session timeout
- [ ] Use secure session cookies
- [ ] Destroy session on logout

### File Upload Security:
- [ ] Validate file type (check extension AND MIME type)
- [ ] Limit file size
- [ ] Rename uploaded files
- [ ] Store outside public directory (or with .htaccess)
- [ ] Validate image dimensions
- [ ] Never execute uploaded files

### Access Control:
- [ ] Check user role on every admin page
- [ ] Prevent clients from accessing admin functions
- [ ] Use CSRF tokens for forms (optional enhancement)
- [ ] Log suspicious activities (optional)

---

## 📖 DOCUMENTATION REQUIREMENTS

### 1. Inline Code Comments

**Every file must have:**
- File header comment (purpose, author, version)
- Class/function comments (what it does, parameters, return values)
- Inline comments for complex logic
- Comments in simple English for non-technical readers

**Example Structure:**
````php
/**
 * ================================================================
 * [FILE NAME]
 * ================================================================
 * 
 * PURPOSE: [What this file does]
 * 
 * USAGE: [How to use this file]
 * 
 * AUTHOR: [Your name]
 * VERSION: 1.0
 * ================================================================
 */

class ClassName {
    
    /**
     * ================================================================
     * [METHOD NAME]
     * ================================================================
     * 
     * WHAT IT DOES: [Explanation]
     * 
     * HOW IT WORKS:
     * 1. [Step 1]
     * 2. [Step 2]
     * 3. [Step 3]
     * 
     * @param type $param Description
     * @return type Description
     * ================================================================
     */
    public function methodName($param) {
        // Implementation with inline comments
    }
}
````

### 2. README.md

**Must include these sections:**
````markdown
# Real Estate Management System

## 📖 Table of Contents
- Project Overview
- Features
- Technologies Used
- System Requirements
- Installation Guide
- Database Setup
- Usage Guide
- User Roles
- Security Features
- Project Structure
- Screenshots
- Contributing
- License
- Contact

## 🎯 Project Overview
[Detailed description]

## ✨ Features
[List of all features]

## 💻 Technologies Used
[Complete tech stack]

## 📋 System Requirements
- PHP 8.0+
- MySQL 8.0+
- XAMPP
- Web Browser

## 🚀 Installation Guide

### Step 1: Download XAMPP
[Instructions]

### Step 2: Extract Project
[Instructions]

### Step 3: Database Setup
[Instructions]

### Step 4: Run Application
[Instructions]

## 📊 Database Setup

### Using phpMyAdmin
1. [Step by step]

### Using SQL File
1. [Step by step]

## 👥 User Roles

### Admin
- [Permissions list]

### Client
- [Permissions list]

## 🔒 Security Features
[List of security measures]

## 📁 Project Structure
[Directory tree with explanations]

## 📸 Screenshots
[Add screenshots of key pages]

## 🤝 Contributing
[How to contribute]

## 📄 License
[License information]

## 📞 Contact
[Contact information]
````

### 3. API_DOCUMENTATION.md

**Document all endpoints:**
````markdown
# API Documentation

## Authentication Endpoints

### POST /controllers/AuthController.php?action=login
**Purpose:** Authenticate user and create session

**Parameters:**
- `email` (string, required): User email
- `password` (string, required): User password

**Response:**
- Success: Redirect to dashboard
- Error: Display error message

**Example:**
```php
// Request
$_POST = [
    'email' => 'user@example.com',
    'password' => 'password123'
];

// Response (success)
$_SESSION['user_id'] = 1;
$_SESSION['role'] = 'client';
// Redirect to dashboard
```

[Continue for all endpoints...]
````

### 4. DATABASE_SCHEMA.md

**Explain database structure:**
````markdown
# Database Schema Documentation

## Tables Overview

### users
**Purpose:** Stores user accounts

**Columns:**
- `id`: Primary key, auto-increment
- `full_name`: User's full name
- `email`: Login email (unique)
- `password`: Hashed password
- `role`: admin or client
- ...

**Relationships:**
- One user can have many properties (if admin)
- One user can have many bookings (if client)
- One user can record many payments (if admin)

[Continue for all tables...]
````

### 5. USER_GUIDE.md

**Step-by-step user manual:**
````markdown
# User Guide

## For Clients

### How to Register
1. Navigate to registration page
2. Fill in your details
3. Click "Register"
4. You'll be redirected to login

### How to Search Properties
1. [Step by step]

### How to Book a Property
1. [Step by step]

## For Administrators

### How to Add a Property
1. [Step by step]

### How to Record Payment
1. [Step by step]

[Continue for all features...]
````

---

## ✅ TESTING REQUIREMENTS

### Manual Testing Checklist:

**Authentication:**
- [ ] Register with valid data
- [ ] Register with existing email (should fail)
- [ ] Register with weak password (should fail)
- [ ] Login with correct credentials
- [ ] Login with wrong password (should fail)
- [ ] Logout successfully

**Property Management:**
- [ ] Add property with image
- [ ] Add property without image
- [ ] Edit property
- [ ] Delete property
- [ ] View property details

**Search:**
- [ ] Search by city
- [ ] Filter by property type
- [ ] Filter by price range
- [ ] Multiple filters combined
- [ ] No results scenario

**Booking:**
- [ ] Create booking
- [ ] View bookings (client)
- [ ] View bookings (admin)
- [ ] Cancel booking

**Payments:**
- [ ] Record payment
- [ ] Generate receipt
- [ ] View payment history

**Security:**
- [ ] Access admin page without login (should redirect)
- [ ] Access admin page as client (should deny)
- [ ] SQL injection attempts (should be prevented)
- [ ] XSS attempts (should be escaped)

---

## 📦 DELIVERABLES

### Final Package Must Include:

1. **Complete Source Code**
   - All files properly organized
   - Extensive comments throughout
   - No placeholder/dummy code

2. **Database SQL File**
   - Complete schema
   - Sample data for testing
   - Clear table relationships

3. **Documentation**
   - README.md
   - API_DOCUMENTATION.md
   - DATABASE_SCHEMA.md
   - USER_GUIDE.md
   - DEVELOPER_GUIDE.md

4. **Screenshots**
   - All major pages
   - Both admin and client views
   - Reports and charts

5. **Installation Guide**
   - Step-by-step XAMPP setup
   - Database import instructions
   - Configuration steps
   - Troubleshooting section

---

## 🎯 CODE QUALITY STANDARDS

### Naming Conventions:
- **Classes**: PascalCase (e.g., `PropertyController`)
- **Methods**: camelCase (e.g., `createBooking()`)
- **Variables**: snake_case (e.g., `$user_id`)
- **Constants**: UPPER_SNAKE_CASE (e.g., `MAX_FILE_SIZE`)
- **Database tables**: lowercase with underscores (e.g., `properties`)
- **Database columns**: lowercase with underscores (e.g., `property_type`)

### Code Structure:
- Maximum 80 characters per line
- 4 spaces for indentation (no tabs)
- Opening brace on same line for functions/classes
- One blank line between methods
- Group related code with blank lines

### Comments:
- Every file must have a header comment
- Every class must have a description comment
- Every method must have a purpose comment
- Complex logic must have inline comments
- Comments must be in simple English

### Error Handling:
- Use try-catch blocks for database operations
- Display user-friendly error messages
- Log errors (optional)
- Never expose sensitive information in errors

---

## 🚨 CRITICAL REQUIREMENTS SUMMARY

### MUST HAVE:
✅ Raw PHP (no frameworks)  
✅ Object-Oriented Programming  
✅ PDO with prepared statements  
✅ Two user roles (admin, client)  
✅ Complete authentication system  
✅ All CRUD operations  
✅ Search and filter  
✅ Booking system  
✅ Payment recording  
✅ Reports with charts  
✅ Responsive design with Bootstrap 5  
✅ Extensive documentation  
✅ Simple English comments  
✅ Security best practices  
✅ Professional README  

### NICE TO HAVE (Optional Enhancements):
- Email notifications
- Password reset functionality
- User profile editing
- Advanced search with map
- Export reports to PDF
- Real-time notifications
- Property comparison feature
- Wishlist functionality

---

## 📝 STEP-BY-STEP BUILD ORDER

### Phase 1: Foundation (Day 1)
1. Create folder structure
2. Set up database schema
3. Create Database.php connection class
4. Create config.php settings
5. Test database connection

### Phase 2: Authentication (Day 2)
1. Create User model
2. Create Auth helper
3. Create AuthController
4. Create login/register views
5. Test authentication flow

### Phase 3: Admin Property Management (Day 3-4)
1. Create Property model
2. Create PropertyController
3. Create property views (list, add, edit, view)
4. Implement image upload
5. Test CRUD operations

### Phase 4: Client Property Browsing (Day 5)
1. Create SearchController
2. Create public property views
3. Implement search and filters
4. Test search functionality

### Phase 5: Booking System (Day 6)
1. Create Booking model
2. Create BookingController
3. Create booking views
4. Implement booking logic
5. Test booking flow

### Phase 6: Payment System (Day 7)
1. Create Payment model
2. Create PaymentController
3. Create payment views
4. Implement receipt generation
5. Test payment recording

### Phase 7: Reports & Dashboard (Day 8-9)
1. Create Report model
2. Create ReportController
3. Create dashboard views
4. Implement Chart.js
5. Test all reports

### Phase 8: UI Polish (Day 10)
1. Apply consistent styling
2. Ensure responsiveness
3. Add loading indicators
4. Improve user feedback
5. Cross-browser testing

### Phase 9: Documentation (Day 11-12)
1. Add inline comments to all files
2. Create README.md
3. Create API documentation
4. Create user guide
5. Take screenshots

### Phase 10: Testing & Deployment (Day 13-14)
1. Complete testing checklist
2. Fix bugs
3. Security audit
4. Performance optimization
5. Final package preparation

---

## 🎓 ACADEMIC PRESENTATION TIPS

### For Project Defense:
1. **Start with a demo** - Show the system working
2. **Explain the architecture** - Show folder structure and explain MVC
3. **Highlight security features** - Prepared statements, password hashing
4. **Show code quality** - Point out comments and documentation
5. **Explain challenges** - Discuss problems you solved
6. **Demonstrate responsiveness** - Resize browser window
7. **Show database schema** - Explain table relationships
8. **Run through user flows** - Admin and client journeys

### Key Points to Emphasize:
- ✅ "No frameworks used, everything built from scratch"
- ✅ "Object-oriented approach for maintainability"
- ✅ "PDO prepared statements for security"
- ✅ "Role-based access control"
- ✅ "Extensive documentation for clarity"
- ✅ "Responsive design for all devices"
- ✅ "Real-world applicability"

---

## 📞 SUPPORT AND MAINTENANCE

### Common Issues and Solutions:

**Issue: Database connection failed**
- Solution: Check XAMPP is running, verify credentials in Database.php

**Issue: Images not uploading**
- Solution: Check folder permissions, verify upload directory exists

**Issue: Session not persisting**
- Solution: Check if session_start() is called, verify session configuration

**Issue: Styles not loading**
- Solution: Check file paths, verify BASE_URL in config.php

---

## 🏁 COMPLETION CHECKLIST

Before submitting, verify:

### Code:
- [ ] All files have header comments
- [ ] All methods have purpose comments
- [ ] Complex logic has inline comments
- [ ] No placeholder/TODO comments left
- [ ] Consistent naming conventions
- [ ] Proper indentation
- [ ] No debug/console statements

### Functionality:
- [ ] Authentication works
- [ ] Property CRUD works
- [ ] Search and filter work
- [ ] Booking system works
- [ ] Payment recording works
- [ ] Reports generate correctly
- [ ] Charts display properly

### Security:
- [ ] All queries use prepared statements
- [ ] Passwords are hashed
- [ ] Inputs are validated and sanitized
- [ ] File uploads are secured
- [ ] Session security implemented
- [ ] Role-based access works

### Documentation:
- [ ] README.md complete
- [ ] API documentation complete
- [ ] Database schema documented
- [ ] User guide complete
- [ ] Screenshots included

### Testing:
- [ ] All features tested
- [ ] Responsive on mobile
- [ ] Works in different browsers
- [ ] Error handling tested
- [ ] Security tested

---

## 🎯 FINAL OUTPUT

When complete, you should have:

1. **A fully functional system** that can be demo'd
2. **Clean, well-commented code** that's easy to understand
3. **Comprehensive documentation** for academic submission
4. **Professional presentation** suitable for defense
5. **A portfolio piece** you can showcase

---

## 📄 END OF SPECIFICATION

This specification provides everything needed to build a complete, professional Real Estate Management System suitable for a final year project. Follow each section carefully, ensure all requirements are met, and maintain high code quality throughout development.

**Remember:** The goal is not just to make it work, but to make it work well, look professional, and be easy to understand for non-technical evaluators.

