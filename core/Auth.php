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

    // Require admin (redirect if not)
    public static function requireAdmin() {
        if (!self::isAdmin()) {
            Helper::redirect('views/errors/403.php');
        }
    }
}
?>
