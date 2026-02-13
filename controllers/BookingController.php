<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Booking.php';
require_once __DIR__ . '/../core/Helper.php';
require_once __DIR__ . '/../core/Auth.php';

/**
 * BookingController
 * 
 * Handles booking requests and management.
 */

class BookingController {
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
}

if (isset($_GET['action'])) {
    $controller = new BookingController();
    $action = $_GET['action'];
    if (method_exists($controller, $action)) {
        $controller->$action();
    }
}
?>
