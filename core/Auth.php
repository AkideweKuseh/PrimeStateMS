<?php
class Auth {
    // Check if user is logged in
    public static function check() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['user_id']);
    }

    // Check if user is admin
    public static function isAdmin() {
        return self::check() && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
    }

    // Check if user is manager
    public static function isManager() {
        return self::check() && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'manager';
    }

    // Check if user is tenant
    public static function isTenant() {
        return self::check() && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'tenant';
    }

    // Check if user is client
    public static function isClient() {
        return self::check() && isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'client';
    }

    // Get current user ID
    public static function id() {
        return self::check() ? $_SESSION['user_id'] : null;
    }

    // Get current user data
    public static function user() {
        if (!self::check()) return null;
        return [
            'id' => $_SESSION['user_id'],
            'name' => $_SESSION['user_name'],
            'email' => $_SESSION['user_email'],
            'role' => $_SESSION['user_role']
        ];
    }

    // Require login (redirect if not)
    public static function requireLogin() {
        if (!self::check()) {
            Helper::redirect('views/auth/login.php');
        }
    }

    // Require specific role(s)
    public static function requireRole(...$roles) {
        self::requireLogin();
        if (!isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], $roles)) {
            Helper::redirect('index.php'); // Or a 403 page if exists
        }
    }

    // Require admin (redirect if not)
    public static function requireAdmin() {
        self::requireRole('admin');
    }
}
?>
