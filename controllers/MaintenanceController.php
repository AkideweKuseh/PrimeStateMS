<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Maintenance.php';
require_once __DIR__ . '/../models/Activity.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/Helper.php';

class MaintenanceController {
    private $maintenanceModel;

    public function __construct() {
        $this->maintenanceModel = new Maintenance();
    }

    // Submit a new maintenance request (Tenant)
    public function submit() {
        Auth::requireRole('tenant');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'tenant_id' => $_POST['tenant_id'],
                'property_id' => $_POST['property_id'],
                'issue_description' => $_POST['issue_description'],
                'request_date' => date('Y-m-d'),
                'status' => 'pending'
            ];

            if ($this->maintenanceModel->create($data)) {
                $activity = new Activity();
                $activity->log($_SESSION['user_id'], "Submitted maintenance request.", "maintenance");

                Helper::setFlash('success', 'Maintenance request submitted.');
                Helper::redirect('views/tenant/maintenance.php');
            } else {
                Helper::setFlash('error', 'Failed to submit request.');
                Helper::redirect('views/tenant/submit-maintenance.php');
            }
        }
    }

    // Update request status (Manager/Admin)
    public function updateStatus() {
        Auth::requireRole('admin', 'manager');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $status = $_POST['status'];

            if ($this->maintenanceModel->updateStatus($id, $status)) {
                Helper::setFlash('success', 'Request status updated.');
                Helper::redirect('views/manager/maintenance.php');
            } else {
                Helper::setFlash('error', 'Failed to update status.');
                Helper::redirect("views/manager/view-maintenance.php?id=$id");
            }
        }
    }
}

// Router
if (isset($_GET['action'])) {
    $controller = new MaintenanceController();
    $action = $_GET['action'];
    if (method_exists($controller, $action)) {
        $controller->$action();
    }
}
?>
