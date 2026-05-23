<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Tenant.php';
require_once __DIR__ . '/../models/Property.php';
require_once __DIR__ . '/../models/Activity.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/Helper.php';

class TenantController {
    private $tenantModel;

    public function __construct() {
        $this->tenantModel = new Tenant();
    }

    // Assign a user as a tenant to a property
    public function assign() {
        Auth::requireRole('admin', 'manager');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'user_id' => $_POST['user_id'],
                'property_id' => $_POST['property_id'],
                'contact_info' => $_POST['contact_info'],
                'lease_start' => $_POST['lease_start'],
                'lease_end' => $_POST['lease_end']
            ];

            if ($this->tenantModel->create($data)) {
                // Update property status to occupied
                $property = new Property();
                $property->id = $data['property_id'];
                $propData = $property->readOne();
                $property->title = $propData['title'];
                $property->description = $propData['description'];
                $property->property_type = $propData['property_type'];
                $property->listing_type = $propData['listing_type'];
                $property->price = $propData['price'];
                $property->address = $propData['address'];
                $property->city = $propData['city'];
                $property->state = $propData['state'];
                $property->zip_code = $propData['zip_code'];
                $property->bedrooms = $propData['bedrooms'];
                $property->bathrooms = $propData['bathrooms'];
                $property->area_sqft = $propData['area_sqft'];
                $property->is_featured = $propData['is_featured'];
                $property->main_image = $propData['main_image'];
                $property->status = 'occupied';
                $property->update();

                // Log Activity
                $activity = new Activity();
                $activity->log($_SESSION['user_id'], "Assigned user ID {$data['user_id']} as tenant to property ID {$data['property_id']}.", "tenant");

                Helper::setFlash('success', 'Tenant assigned successfully.');
                Helper::redirect('views/manager/tenants.php');
            } else {
                Helper::setFlash('error', 'Failed to assign tenant.');
                Helper::redirect('views/manager/assign-tenant.php');
            }
        }
    }

    // Delete a tenant record
    public function delete() {
        Auth::requireRole('admin', 'manager');
        $id = $_GET['id'] ?? null;
        if ($id && $this->tenantModel->delete($id)) {
            Helper::setFlash('success', 'Tenant record removed.');
        } else {
            Helper::setFlash('error', 'Failed to remove tenant record.');
        }
        Helper::redirect('views/manager/tenants.php');
    }
}

// Router
if (isset($_GET['action'])) {
    $controller = new TenantController();
    $action = $_GET['action'];
    if (method_exists($controller, $action)) {
        $controller->$action();
    }
}
?>
