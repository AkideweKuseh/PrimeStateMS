<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Booking.php';
require_once __DIR__ . '/../core/Helper.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/Payment.php';
require_once __DIR__ . '/../models/Property.php';

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

                // Notify Client/Tenant
                $bookingsPage = ($_SESSION['user_role'] ?? '') === 'tenant' ? 'views/tenant/bookings.php' : 'views/client/bookings.php';
                $notification->create(
                    Auth::id(),
                    "Booking Submitted",
                    "Your booking request for Property #{$booking->property_id} is pending confirmation.",
                    "info",
                    $bookingsPage
                );

                Helper::setFlash('success', 'Booking request submitted successfully.');
                $dashboardPage = ($_SESSION['user_role'] ?? '') === 'tenant' ? 'views/tenant/dashboard.php' : 'views/client/dashboard.php';
                Helper::redirect($dashboardPage);
            } else {
                Helper::setFlash('error', 'Booking failed.');
                Helper::redirect('views/public/property-details.php?id=' . $_POST['property_id']);
            }
        }
    }
    public function confirm() {
        Auth::requireRole('admin', 'manager');
        if (isset($_GET['id'])) {
            $bookingModel = new Booking();
            $booking = $bookingModel->readOne($_GET['id']);
            
            if ($booking) {
                // Check if payment has been completed before confirming
                if ($booking['payment_status'] !== 'completed') {
                    Helper::setFlash('error', 'Cannot confirm booking — payment has not been completed by the client.');
                    Helper::redirect('controllers/BookingController.php?action=index');
                    return;
                }

                if ($bookingModel->confirm($_GET['id'])) {
                    
                    // If it's a rental property, convert client to tenant
                    $propertyModel = new Property();
                    $propertyModel->id = $booking['property_id'];
                    $propData = $propertyModel->readOne();
                    
                    if ($propData['listing_type'] === 'rent') {
                        // 1. Create Tenant record
                        require_once __DIR__ . '/../models/Tenant.php';
                        $tenantModel = new Tenant();
                        $tenantData = [
                            'user_id' => $booking['client_id'],
                            'property_id' => $booking['property_id'],
                            'contact_info' => $booking['client_phone'],
                            'lease_start' => $booking['start_date'],
                            'lease_end' => $booking['end_date'] ?? date('Y-m-d', strtotime('+1 year', strtotime($booking['start_date'])))
                        ];
                        $tenantId = $tenantModel->create($tenantData);
                        
                        if ($tenantId) {
                            // Automatically create initial rent record for the tenant
                            require_once __DIR__ . '/../models/Rent.php';
                            $rentModel = new Rent();
                            $rentData = [
                                'tenant_id' => $tenantId,
                                'property_id' => $booking['property_id'],
                                'amount' => $booking['total_amount'],
                                'balance' => 0.00,
                                'status' => 'paid'
                            ];
                            $rentId = $rentModel->create($rentData);
                            if ($rentId) {
                                // Record the payment date as of today
                                $rentModel->updatePayment($rentId, [
                                    'payment_date' => date('Y-m-d'),
                                    'balance' => 0.00,
                                    'status' => 'paid'
                                ]);
                            } else {
                                error_log("BookingController::confirm - Failed to create rent record for tenant_id=$tenantId, booking_id=" . $_GET['id']);
                            }
                        } else {
                            error_log("BookingController::confirm - Failed to create tenant record for user_id={$booking['client_id']}, booking_id=" . $_GET['id']);
                            Helper::setFlash('warning', 'Booking confirmed but tenant record creation failed. Please create the tenant manually.');
                        }
                        
                        // 2. Update Property status to occupied
                        $propertyModel->title = $propData['title'];
                        $propertyModel->description = $propData['description'];
                        $propertyModel->property_type = $propData['property_type'];
                        $propertyModel->listing_type = $propData['listing_type'];
                        $propertyModel->price = $propData['price'];
                        $propertyModel->address = $propData['address'];
                        $propertyModel->city = $propData['city'];
                        $propertyModel->state = $propData['state'];
                        $propertyModel->zip_code = $propData['zip_code'];
                        $propertyModel->bedrooms = $propData['bedrooms'];
                        $propertyModel->bathrooms = $propData['bathrooms'];
                        $propertyModel->area_sqft = $propData['area_sqft'];
                        $propertyModel->is_featured = $propData['is_featured'];
                        $propertyModel->main_image = $propData['main_image'];
                        $propertyModel->status = 'occupied';
                        $propertyModel->update();
                        
                        // 3. Update User role to tenant
                        require_once __DIR__ . '/../models/User.php';
                        $userModel = new User();
                        $userData = $userModel->readOne($booking['client_id']);
                        $userModel->update($booking['client_id'], [
                            'full_name' => $userData['full_name'],
                            'email' => $userData['email'],
                            'phone' => $userData['phone'],
                            'role' => 'tenant'
                        ]);
                        
                        // Sync session if the currently-logged-in user is the one being upgraded
                        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $booking['client_id']) {
                            $_SESSION['user_role'] = 'tenant';
                        }
                    } else {
                        // For sale listings, update property status to sold
                        $propertyModel->title = $propData['title'];
                        $propertyModel->description = $propData['description'];
                        $propertyModel->property_type = $propData['property_type'];
                        $propertyModel->listing_type = $propData['listing_type'];
                        $propertyModel->price = $propData['price'];
                        $propertyModel->address = $propData['address'];
                        $propertyModel->city = $propData['city'];
                        $propertyModel->state = $propData['state'];
                        $propertyModel->zip_code = $propData['zip_code'];
                        $propertyModel->bedrooms = $propData['bedrooms'];
                        $propertyModel->bathrooms = $propData['bathrooms'];
                        $propertyModel->area_sqft = $propData['area_sqft'];
                        $propertyModel->is_featured = $propData['is_featured'];
                        $propertyModel->main_image = $propData['main_image'];
                        $propertyModel->status = 'sold';
                        $propertyModel->update();
                    }
                    
                    Helper::setFlash('success', 'Booking confirmed and tenant created.');
                } else {
                    Helper::setFlash('error', 'Failed to confirm booking.');
                }
            } else {
                Helper::setFlash('error', 'Booking not found.');
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
        $redirect = ($_SESSION['user_role'] ?? '') === 'tenant' ? 'views/tenant/bookings.php' : 'views/client/bookings.php';
        Helper::redirect($redirect);
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
                    'payment_method' => $_POST['payment_method'] ?? 'mobile_money',
                    'transaction_id' => 'TXN-' . strtoupper(uniqid()),
                    'status' => 'verified',
                    'user_id' => $userId, // Used for recorded_by
                    'notes' => 'Payment via Mock Gateway'
                ];

                if ($paymentModel->create($paymentData)) {
                    // Update booking payment_status to completed (but keep booking_status as pending for admin to confirm)
                    $bookingModel->updatePaymentStatus($bookingId, 'completed');
                        
                    // Notifications
                    require_once __DIR__ . '/../models/Notification.php';
                    $notification = new Notification();
                    $amountFormatted = Helper::formatCurrency($booking['total_amount']);

                    // Notify Client
                    $notification->create(
                        $userId,
                        "Payment Successful",
                        "Your payment of {$amountFormatted} for Booking #{$bookingId} was successful. Awaiting admin confirmation.",
                        "success",
                        "views/client/bookings.php"
                    );

                    // Notify Admins
                    $notification->notifyAdmins(
                        "Payment Received — Awaiting Confirmation",
                        "Client {$booking['client_name']} paid {$amountFormatted} for Booking #{$bookingId}. Please review and confirm.",
                        "success",
                        "controllers/BookingController.php?action=index"
                    );

                    if ($isJsonRequest) {
                        header('Content-Type: application/json');
                        echo json_encode(['success' => true, 'message' => 'Payment successful! Awaiting admin confirmation.']);
                        exit;
                    }
                    Helper::setFlash('success', 'Payment successful! Your booking is awaiting admin confirmation.');
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
        $redirect = ($_SESSION['user_role'] ?? '') === 'tenant' ? 'views/tenant/bookings.php' : 'views/client/bookings.php';
        Helper::redirect($redirect);
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
