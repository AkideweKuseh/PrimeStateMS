<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Payment.php';
require_once __DIR__ . '/../core/Helper.php';
require_once __DIR__ . '/../core/Auth.php';

/**
 * PaymentController
 * 
 * Handles payment recording and verification.
 */

class PaymentController {
    public function record() {
        Auth::requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $payment = new Payment();
            $data = [
                'booking_id' => $_POST['booking_id'],
                'amount' => $_POST['amount'],
                'payment_method' => $_POST['payment_method'],
                'transaction_reference' => $_POST['transaction_reference'],
                'payment_status' => 'verified',
                'recorded_by' => Auth::id()
            ];

            if ($payment->create($data)) {
                Helper::setFlash('success', 'Payment recorded successfully.');
                Helper::redirect('views/admin/dashboard.php');
            } else {
                Helper::setFlash('error', 'Payment recording failed.');
                Helper::redirect('views/admin/dashboard.php');
            }
        }
    }

    public function index() {
        Auth::requireAdmin();
        $payment = new Payment();
        $payments = $payment->readAll();
        require_once __DIR__ . '/../views/admin/payments/index.php';
    }
}

if (isset($_GET['action'])) {
    $controller = new PaymentController();
    $action = $_GET['action'];
    if (method_exists($controller, $action)) {
        $controller->$action();
    }
}
?>
