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
        $currencySymbol = self::getSetting('currency_symbol', '₵');
        $currencyCode = self::getSetting('currency_code', 'GHS');
        
        return $currencyCode . ' ' . $currencySymbol . ' ' . number_format($amount, 2);
    }
    
    // Format date
    public static function formatDate($date) {
        return date('d M Y', strtotime($date));
    }
    
    // Format relative time (e.g., "2 hours ago")
    public static function timeAgo($timestamp) {
        $time = strtotime($timestamp);
        $current = time();
        $diff = $current - $time;
        
        $seconds = $diff;
        $minutes = round($diff / 60);
        $hours = round($diff / 3600);
        $days = round($diff / 86400);
        $weeks = round($diff / 604800);
        $months = round($diff / 2600640);
        $years = round($diff / 31207680);
        
        if ($seconds <= 60) return "Just now";
        if ($minutes <= 60) return "$minutes mins ago";
        if ($hours <= 24) return "$hours hours ago";
        if ($days <= 7) return "$days days ago";
        if ($weeks <= 4.3) return "$weeks weeks ago";
        if ($months <= 12) return "$months months ago";
        return "$years years ago";
    }
    // Get Setting with default fallback
    public static function getSetting($key, $default = '') {
        // Optimization: In a real app, we might handle caching here.
        // For now, we instantiate the model. This might be heavy if called many times in a loop,
        // so ideally, we'd fetch all settings once and store in a static property or session.
        
        static $settingsCache = null;

        if ($settingsCache === null) {
            if (file_exists(__DIR__ . '/../models/Setting.php')) {
                require_once __DIR__ . '/../models/Setting.php';
                $settingModel = new Setting();
                $settingsCache = $settingModel->getAllAsArray();
            } else {
                return $default;
            }
        }

        return $settingsCache[$key] ?? $default;
    }
}
?>
