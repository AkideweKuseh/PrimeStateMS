<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/Property.php';
require_once __DIR__ . '/../models/Booking.php';
require_once __DIR__ . '/../models/Payment.php';

class ReportController {
    public function index() {
        Auth::requireAdmin();
        
        $propertyModel = new Property();
        $bookingModel = new Booking();
        $paymentModel = new Payment();
        
        // Fetch Report Data
        
        // 1. Property Status Report
        $properties = $propertyModel->read(); // All properties
        $propertyStats = [
            'total' => 0,
            'available' => 0,
            'sold' => 0,
            'rented' => 0
        ];
        $propertyList = [];
        
        while($prop = $properties->fetch(PDO::FETCH_ASSOC)) {
            $propertyStats['total']++;
            $status = strtolower($prop['status']);
            if(isset($propertyStats[$status])) {
                $propertyStats[$status]++;
            } else {
                // simple fallback if status is different
                $propertyStats['available']++; 
            }
            $propertyList[] = $prop;
        }
        
        // 2. Booking Report (Last 30 Days)
        // We can reuse readAll with filters if implemented, or just fetch all and filter in PHP for this simple report
        $bookings = $bookingModel->readAll(); // Fetch all
        $bookingList = [];
        while($b = $bookings->fetch(PDO::FETCH_ASSOC)) {
            $bookingList[] = $b;
        }

        // 3. Payment/Revenue Report
        $payments = $paymentModel->readAll();
        $paymentList = [];
        $totalRevenue = 0;
        
        while($p = $payments->fetch(PDO::FETCH_ASSOC)) {
            $paymentList[] = $p;
            if ($p['payment_status'] == 'completed') {
                $totalRevenue += $p['amount'];
            }
        }
        
        require_once __DIR__ . '/../views/admin/reports/index.php';
    }
}

if (isset($_GET['action'])) {
    $controller = new ReportController();
    $action = $_GET['action'];
    if (method_exists($controller, $action)) {
        $controller->$action();
    }
}
?>
