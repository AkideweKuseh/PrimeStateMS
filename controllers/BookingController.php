<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Booking.php';
require_once __DIR__ . '/../core/Helper.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/Payment.php';

/**
 * BookingController
 * 
 * Handles booking requests and management.
 */

class BookingController {
    public function index() {
        Auth::requireAdmin();
        
        $filters = [
            'status' => $_GET['status'] ?? '',
            'start_date' => $_GET['start_date'] ?? '',
            'end_date' => $_GET['end_date'] ?? ''
        ];

        $bookingModel = new Booking();
        $bookings = $bookingModel->readAll($filters);
        
        require_once __DIR__ . '/../views/admin/bookings/index.php';
    }

    public function book() {
        Auth::requireLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $booking = new Booking();
            
            // Check for existing booking
            if ($booking->isBookedByUser($_POST['property_id'], Auth::id())) {
                Helper::setFlash('error', 'You have already booked this property.');
                Helper::redirect('views/public/property-details.php?id=' . $_POST['property_id']);
                return;
            }

            $booking->property_id = $_POST['property_id'];
            $booking->client_id = Auth::id();
            $booking->start_date = $_POST['start_date'];
            $booking->end_date = $_POST['end_date']; // Can be null for sales
            $booking->total_amount = $_POST['total_amount'];
            $booking->notes = $_POST['notes'];

            if ($booking->create()) {
                // Notify Admins
                require_once __DIR__ . '/../models/Notification.php';
                $notification = new Notification();
                $notification->notifyAdmins(
                    "New Booking Request",
                    "New booking for Property #{$booking->property_id} by User #" . Auth::id(),
                    "info",
                    "controllers/BookingController.php?action=index"
                );

                // Notify Client
                $notification->create(
                    Auth::id(),
                    "Booking Submitted",
                    "Your booking request for Property #{$booking->property_id} is pending confirmation.",
                    "info",
                    "views/client/bookings.php"
                );

                Helper::setFlash('success', 'Booking request submitted successfully.');
                Helper::redirect('views/client/dashboard.php');
            } else {
                Helper::setFlash('error', 'Booking failed.');
                Helper::redirect('views/public/property-details.php?id=' . $_POST['property_id']);
            }
        }
    }
    public function confirm() {
        Auth::requireAdmin();
        if (isset($_GET['id'])) {
            $booking = new Booking();
            if ($booking->confirm($_GET['id'])) {
                Helper::setFlash('success', 'Booking confirmed successfully.');
            } else {
                Helper::setFlash('error', 'Failed to confirm booking.');
            }
        }
        Helper::redirect('views/admin/bookings/index.php');
    }

    public function details() {
        Auth::requireAdmin();
        if (isset($_GET['id'])) {
            $bookingModel = new Booking();
            $booking = $bookingModel->readOne($_GET['id']);
            
            if ($booking) {
                require_once __DIR__ . '/../views/admin/bookings/details.php';
            } else {
                Helper::setFlash('error', 'Booking not found.');
                Helper::redirect('views/admin/bookings/index.php');
            }
        } else {
            Helper::redirect('views/admin/bookings/index.php');
        }
    }

    public function delete() {
        Auth::requireLogin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $booking = new Booking();
            if ($booking->delete($_POST['id'], Auth::id())) {
                Helper::setFlash('success', 'Booking deleted successfully.');
            } else {
                Helper::setFlash('error', 'Failed to delete booking. It may be confirmed or not found.');
            }
        }
        Helper::redirect('views/client/bookings.php'); // Redirect back to client bookings
    }

    public function payment() {
        Auth::requireLogin();
        if (isset($_GET['booking_id'])) {
            require_once __DIR__ . '/../views/client/payment.php';
        } else {
            Helper::redirect('views/client/bookings.php');
        }
    }

    public function processPayment() {
        Auth::requireLogin();
        
        $isJsonRequest = (
            (!empty($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false) ||
            (!empty($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false)
        );

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking_id'])) {
            $bookingId = $_POST['booking_id'];
            $userId = Auth::id();
            
            $bookingModel = new Booking();
            $booking = $bookingModel->readOne($bookingId);

            if ($booking && $booking['client_id'] == $userId && $booking['booking_status'] == 'pending') {
                $paymentModel = new Payment();
                $paymentData = [
                    'booking_id' => $bookingId,
                    'amount' => $booking['total_amount'],
                    'payment_method' => $_POST['payment_method'] ?? 'Mock Gateway',
                    'transaction_id' => 'TXN-' . strtoupper(uniqid()),
                    'status' => 'completed',
                    'user_id' => $userId, // Used for recorded_by
                    'notes' => 'Payment via Mock Gateway'
                ];

                if ($paymentModel->create($paymentData)) {
                    // Update booking status to confirmed
                    if ($bookingModel->confirm($bookingId)) {
                        
                        // Notifications
                        require_once __DIR__ . '/../models/Notification.php';
                        $notification = new Notification();
                        $amountFormatted = Helper::formatCurrency($booking['total_amount']);

                        // Notify Client
                        $notification->create(
                            $userId,
                            "Payment Successful",
                            "Your payment of {$amountFormatted} for Booking #{$bookingId} was successful and your booking is confirmed.",
                            "success",
                            "views/client/bookings.php"
                        );

                        // Notify Admins
                        $notification->notifyAdmins(
                            "Payment Received",
                            "Client {$booking['client_name']} paid {$amountFormatted} for Booking #{$bookingId}.",
                            "success",
                            "controllers/PaymentController.php?action=index"
                        );

                        if ($isJsonRequest) {
                            header('Content-Type: application/json');
                            echo json_encode(['success' => true, 'message' => 'Payment successful']);
                            exit;
                        }
                        Helper::setFlash('success', 'Payment successful! Booking confirmed.');
                    } else {
                        if ($isJsonRequest) {
                            header('Content-Type: application/json');
                            echo json_encode(['success' => false, 'message' => 'Booking confirmation failed']);
                            exit;
                        }
                        Helper::setFlash('warning', 'Payment recorded but booking status update failed.');
                    }
                } else {
                    if ($isJsonRequest) {
                        header('Content-Type: application/json');
                        echo json_encode(['success' => false, 'message' => 'Payment creation failed']);
                        exit;
                    }
                    Helper::setFlash('error', 'Payment processing failed.');
                }
            } else {
                if ($isJsonRequest) {
                    header('Content-Type: application/json');
                    echo json_encode(['success' => false, 'message' => 'Invalid booking or payment not allowed']);
                    exit;
                }
                Helper::setFlash('error', 'Invalid booking or payment not allowed.');
            }
        }
        
        if ($isJsonRequest) {
             header('Content-Type: application/json');
             echo json_encode(['success' => false, 'message' => 'Invalid request']);
             exit;
        }
        Helper::redirect('views/client/bookings.php');
    }
}

if (isset($_GET['action'])) {
    $controller = new BookingController();
    $action = $_GET['action'];
    if (method_exists($controller, $action)) {
        $controller->$action();
    }
}
?>
