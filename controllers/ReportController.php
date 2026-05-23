<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/Property.php';
require_once __DIR__ . '/../models/Booking.php';
require_once __DIR__ . '/../models/Payment.php';
require_once __DIR__ . '/../models/Rent.php';
require_once __DIR__ . '/../models/Maintenance.php';

class ReportController {
    public function index() {
        Auth::requireRole('admin', 'manager');
        
        $propertyModel = new Property();
        $bookingModel = new Booking();
        $paymentModel = new Payment();
        $rentModel = new Rent();
        $maintenanceModel = new Maintenance();
        
        // Fetch Report Data
        
        // 1. Property Status Report
        $properties = $propertyModel->read();
        $propertyStats = ['total' => 0, 'available' => 0, 'sold' => 0, 'rented' => 0, 'occupied' => 0];
        $propertyList = [];
        while($prop = $properties->fetch(PDO::FETCH_ASSOC)) {
            $propertyStats['total']++;
            $status = strtolower($prop['status']);
            if(isset($propertyStats[$status])) $propertyStats[$status]++;
            $propertyList[] = $prop;
        }
        
        // 2. Booking Report
        $bookings = $bookingModel->readAll();
        $bookingList = [];
        while($b = $bookings->fetch(PDO::FETCH_ASSOC)) $bookingList[] = $b;

        // 3. Financial Report
        $payments = $paymentModel->readAll();
        $paymentList = [];
        $totalRevenue = 0;
        while($p = $payments->fetch(PDO::FETCH_ASSOC)) {
            $paymentList[] = $p;
            if ($p['payment_status'] == 'completed' || $p['payment_status'] == 'verified') $totalRevenue += $p['amount'];
        }

        // 4. Rent Report (V2.0)
        $rentRecords = $rentModel->readAll();
        $rentList = [];
        $totalRentCollected = 0;
        $totalRentBalance = 0;
        while($r = $rentRecords->fetch(PDO::FETCH_ASSOC)) {
            $rentList[] = $r;
            if ($r['status'] == 'paid') $totalRentCollected += $r['amount'];
            $totalRentBalance += $r['balance'];
        }

        // 5. Maintenance Report (V2.0)
        $maintenanceRecords = $maintenanceModel->readAll();
        $maintenanceList = [];
        $maintenanceStats = ['total' => 0, 'pending' => 0, 'in_progress' => 0, 'completed' => 0];
        while($m = $maintenanceRecords->fetch(PDO::FETCH_ASSOC)) {
            $maintenanceList[] = $m;
            $maintenanceStats['total']++;
            if(isset($maintenanceStats[$m['status']])) $maintenanceStats[$m['status']]++;
        }
        
        require_once __DIR__ . '/../views/admin/reports/index.php';
    }

    public function export() {
        Auth::requireRole('admin', 'manager');
        $type = $_GET['type'] ?? 'properties';
        $filename = "report_{$type}_" . date('Y-m-d') . ".csv";

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');

        if ($type === 'all') {
            // Properties Section
            fputcsv($output, ['--- PROPERTY INVENTORY REPORT ---']);
            fputcsv($output, ['Title', 'Type', 'Price', 'Location', 'Status']);
            $propModel = new Property();
            $props = $propModel->read();
            while($row = $props->fetch(PDO::FETCH_ASSOC)) {
                fputcsv($output, [$row['title'], $row['property_type'], $row['price'], $row['city'], $row['status']]);
            }
            fputcsv($output, []);

            // Bookings Section
            fputcsv($output, ['--- BOOKING HISTORY REPORT ---']);
            fputcsv($output, ['Ref ID', 'Client', 'Property', 'Start Date', 'End Date', 'Status']);
            $bookingModel = new Booking();
            $bookings = $bookingModel->readAll();
            while($row = $bookings->fetch(PDO::FETCH_ASSOC)) {
                fputcsv($output, [$row['id'], $row['client_name'], $row['title'], $row['start_date'], $row['end_date'], $row['booking_status']]);
            }
            fputcsv($output, []);

            // Rent Section
            fputcsv($output, ['--- RENT COLLECTION REPORT ---']);
            fputcsv($output, ['Tenant', 'Property', 'Amount', 'Balance', 'Status']);
            $rentModel = new Rent();
            $rents = $rentModel->readAll();
            while($row = $rents->fetch(PDO::FETCH_ASSOC)) {
                fputcsv($output, [$row['tenant_name'], $row['property_title'], $row['amount'], $row['balance'], $row['status']]);
            }
            fputcsv($output, []);

            // Maintenance Section
            fputcsv($output, ['--- MAINTENANCE & REPAIRS REPORT ---']);
            fputcsv($output, ['Property', 'Tenant', 'Issue', 'Date', 'Status']);
            $maintModel = new Maintenance();
            $maints = $maintModel->readAll();
            while($row = $maints->fetch(PDO::FETCH_ASSOC)) {
                fputcsv($output, [$row['property_title'], $row['tenant_name'], $row['issue_description'], $row['request_date'], $row['status']]);
            }
        } elseif ($type === 'rent') {
            fputcsv($output, ['Tenant', 'Property', 'Amount', 'Balance', 'Status', 'Date']);
            $rentModel = new Rent();
            $stmt = $rentModel->readAll();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                fputcsv($output, [$row['tenant_name'], $row['property_title'], $row['amount'], $row['balance'], $row['status'], $row['created_at']]);
            }
        } elseif ($type === 'maintenance') {
            fputcsv($output, ['Property', 'Tenant', 'Description', 'Date', 'Status']);
            $maintenanceModel = new Maintenance();
            $stmt = $maintenanceModel->readAll();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                fputcsv($output, [$row['property_title'], $row['tenant_name'], $row['issue_description'], $row['request_date'], $row['status']]);
            }
        }
        // Add more types if needed
        fclose($output);
        exit;
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
