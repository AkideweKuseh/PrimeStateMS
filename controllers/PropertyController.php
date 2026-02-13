<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Property.php';
require_once __DIR__ . '/../core/Helper.php';
require_once __DIR__ . '/../core/Auth.php';

/**
 * PropertyController
 * 
 * Handles property management (create, read, update, delete).
 */

class PropertyController {
    
    public function store() {
        Auth::requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $property = new Property();
            
            // Handle File Upload
            $main_image = "";
            if (isset($_FILES['main_image']) && $_FILES['main_image']['error'] == 0) {
                $target_dir = UPLOAD_DIR;
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                
                $file_extension = pathinfo($_FILES["main_image"]["name"], PATHINFO_EXTENSION);
                $new_filename = uniqid() . '.' . $file_extension;
                $target_file = $target_dir . $new_filename;
                
                if (in_array(strtolower($file_extension), ALLOWED_EXTENSIONS)) {
                    if (move_uploaded_file($_FILES["main_image"]["tmp_name"], $target_file)) {
                        $main_image = $new_filename;
                    }
                }
            }

            $property->title = $_POST['title'];
            $property->description = $_POST['description'];
            $property->property_type = $_POST['property_type'];
            $property->listing_type = $_POST['listing_type'];
            $property->price = $_POST['price'];
            $property->address = $_POST['address'];
            $property->city = $_POST['city'];
            $property->state = $_POST['state'];
            $property->zip_code = $_POST['zip_code'];
            $property->bedrooms = $_POST['bedrooms'];
            $property->bathrooms = $_POST['bathrooms'];
            $property->area_sqft = $_POST['area_sqft'];
            $property->status = 'available';
            $property->is_featured = isset($_POST['is_featured']) ? 1 : 0;
            $property->main_image = $main_image;
            $property->added_by = Auth::id();

            if ($property->create()) {
                Helper::setFlash('success', 'Property added successfully.');
                Helper::redirect('views/admin/properties/index.php'); // Redirect to properties list
            } else {
                Helper::setFlash('error', 'Failed to add property.');
                Helper::redirect('views/admin/properties/create.php');
            }
        }
    }

    public function edit() {
        Auth::requireAdmin();
        if (isset($_GET['id'])) {
            $property = new Property();
            $property->id = $_GET['id'];
            $data = $property->readOne();
            
            if ($data) {
                // $data is an array (PDO::FETCH_ASSOC) based on readOne implementation
                // But view usually expects $property as an array or object. 
                // Let's pass $property_data to view
                $property_data = $data; 
                require_once __DIR__ . '/../views/admin/properties/edit.php';
            } else {
                Helper::setFlash('error', 'Property not found.');
                Helper::redirect('views/admin/properties/index.php');
            }
        } else {
            Helper::redirect('views/admin/properties/index.php');
        }
    }

    public function update() {
        Auth::requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $property = new Property();
            $property->id = $_POST['id'];
            
            // Get existing property to get old image
            $currentData = $property->readOne();
            $main_image = $currentData['main_image'];

            // Handle File Upload
            if (isset($_FILES['main_image']) && $_FILES['main_image']['error'] == 0) {
                $target_dir = UPLOAD_DIR;
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                
                $file_extension = pathinfo($_FILES["main_image"]["name"], PATHINFO_EXTENSION);
                $new_filename = uniqid() . '.' . $file_extension;
                $target_file = $target_dir . $new_filename;
                
                if (in_array(strtolower($file_extension), ALLOWED_EXTENSIONS)) {
                    if (move_uploaded_file($_FILES["main_image"]["tmp_name"], $target_file)) {
                        // Delete old image if it exists and is not default?
                        // For now, just overwrite variable
                        $main_image = $new_filename;
                    }
                }
            }

            $property->title = $_POST['title'];
            $property->description = $_POST['description'];
            $property->property_type = $_POST['property_type'];
            $property->listing_type = $_POST['listing_type'];
            $property->price = $_POST['price'];
            $property->address = $_POST['address'];
            $property->city = $_POST['city'];
            $property->state = $_POST['state'];
            $property->zip_code = $_POST['zip_code'];
            $property->bedrooms = $_POST['bedrooms'];
            $property->bathrooms = $_POST['bathrooms'];
            $property->area_sqft = $_POST['area_sqft'];
            $property->status = $_POST['status'] ?? 'available'; // Default or from form? Form doesn't have status yet, stick to available or existing?
            // Actually, keep existing status if not in form, or add status field to edit form. 
            // The create form sets it to 'available'. The update should probably keep it or allow change. 
            // Let's assume we might add status to edit form, or default to what it was. 
            // For now, let's allow it to be updated if passed, otherwise keep it?
            // Simplified: The model update() expects a value. 
            // Let's fetch existing status if not passed.
            $property->status = $_POST['status'] ?? $currentData['status'];
            
            $property->is_featured = isset($_POST['is_featured']) ? 1 : 0;
            $property->main_image = $main_image;
            // added_by doesn't change

            if ($property->update()) {
                Helper::setFlash('success', 'Property updated successfully.');
                Helper::redirect('views/admin/properties/index.php'); // Redirect to properties list
            } else {
                Helper::setFlash('error', 'Failed to update property.');
                Helper::redirect('controllers/PropertyController.php?action=edit&id=' . $property->id);
            }
        }
    }
}

// Simple Router
if (isset($_GET['action'])) {
    $controller = new PropertyController();
    $action = $_GET['action'];
    if (method_exists($controller, $action)) {
        $controller->$action();
    }
}
?>
