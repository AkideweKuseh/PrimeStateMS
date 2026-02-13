<?php
// Base URL
define('BASE_URL', 'http://localhost/PrimeStateMS/');

// Database credential constants (optional, if not using class properties directly)
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'real_estate_db');

// Session config
define('SESSION_LIFETIME', 7200); // 2 hours

// Uploads
define('UPLOAD_DIR', __DIR__ . '/../uploads/properties/');
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'webp']);

// Start Session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
