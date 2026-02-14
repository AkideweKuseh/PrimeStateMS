<?php
class Helper {
    // Redirect to a specific URL
    public static function redirect($path) {
        header("Location: " . BASE_URL . $path);
        exit();
    }

    // Sanitize input
    public static function sanitize($input) {
        return htmlspecialchars(strip_tags(trim($input)));
    }

    // Set flash message
    public static function setFlash($type, $message) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['flash'] = [
            'type' => $type, // success, error, warning, info
            'message' => $message
        ];
    }
    
    public static function flash($type, $message) {
        self::setFlash($type, $message);
    }

    // Get and clear flash message
    public static function getFlash() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $flash;
        }
        return null;
    }

    // Format currency
    public static function formatCurrency($amount) {
        return 'GH₵ ' . number_format($amount, 2);
    }
    
    // Format date
    public static function formatDate($date) {
        return date('d M Y', strtotime($date));
    }
}
?>
