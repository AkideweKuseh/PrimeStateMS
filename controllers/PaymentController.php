<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Payment.php';
require_once __DIR__ . '/../models/Booking.php';
require_once __DIR__ . '/../models/Activity.php';
require_once __DIR__ . '/../models/Notification.php';
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
            $booking = new Booking();
            $activity = new Activity();
            $notification = new Notification();

            $data = [
                'booking_id' => $_POST['booking_id'],
                'amount' => $_POST['amount'],
                'payment_method' => $_POST['payment_method'],
                'transaction_reference' => $_POST['transaction_reference'],
                'payment_status' => 'verified',
                'recorded_by' => Auth::id()
            ];

            if ($payment->create($data)) {
                // Log Admin Activity
                $activity->log(Auth::id(), "Recorded payment for Booking #{$data['booking_id']}", "payment");

                // Notify Client
                $bookingDetails = $booking->readOne($data['booking_id']);
                if ($bookingDetails && isset($bookingDetails['client_id'])) {
                    $clientId = $bookingDetails['client_id'];
                    $amountFormatted = Helper::formatCurrency($data['amount']);
                    
                    // Log Client Activity
                    $activity->log($clientId, "Payment of {$amountFormatted} verified for Booking #{$data['booking_id']}", "payment");

                    // Send Notification
                    $notification->create(
                        $clientId, 
                        "Payment Receipt", 
                        "Your payment of {$amountFormatted} has been verified.", 
                        "success", 
                        "views/client/payments.php"
                    );
                }

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
