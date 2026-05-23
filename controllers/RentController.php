<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Rent.php';
require_once __DIR__ . '/../models/Activity.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/Helper.php';

class RentController {
    private $rentModel;

    public function __construct() {
        $this->rentModel = new Rent();
    }

    // Record a rent payment
    public function record() {
        Auth::requireRole('admin', 'manager');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'tenant_id' => $_POST['tenant_id'],
                'property_id' => $_POST['property_id'],
                'amount' => $_POST['amount'],
                'balance' => $_POST['balance'] ?? 0,
                'status' => $_POST['status'] ?? 'pending'
            ];

            if ($this->rentModel->create($data)) {
                $activity = new Activity();
                $activity->log($_SESSION['user_id'], "Recorded rent for tenant ID {$data['tenant_id']}.", "rent");

                Helper::setFlash('success', 'Rent record created.');
                Helper::redirect('views/manager/rent.php');
            } else {
                Helper::setFlash('error', 'Failed to record rent.');
                Helper::redirect('views/manager/record-rent.php');
            }
        }
    }

    // Update rent payment (e.g. mark as paid)
    public function update() {
        Auth::requireRole('admin', 'manager');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $data = [
                'payment_date' => $_POST['payment_date'],
                'balance' => $_POST['balance'],
                'status' => $_POST['status']
            ];

            if ($this->rentModel->updatePayment($id, $data)) {
                Helper::setFlash('success', 'Rent record updated.');
                Helper::redirect('views/manager/rent.php');
            } else {
                Helper::setFlash('error', 'Failed to update rent record.');
                Helper::redirect("views/manager/edit-rent.php?id=$id");
            }
        }
    }
}

// Router
if (isset($_GET['action'])) {
    $controller = new RentController();
    $action = $_GET['action'];
    if (method_exists($controller, $action)) {
        $controller->$action();
    }
}
?>
