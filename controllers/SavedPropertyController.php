<?php
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/Helper.php';
require_once __DIR__ . '/../models/SavedProperty.php';

class SavedPropertyController {
    
    public function toggle() {
        Auth::requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Helper::redirect('views/public/properties.php');
        }

        $user_id = Auth::user()['id'];
        $property_id = $_POST['property_id'] ?? null;
        
        if (!$property_id) {
            $this->sendResponse(false, 'Invalid Property ID');
            return;
        }

        $savedProperty = new SavedProperty();
        $isSaved = $savedProperty->isSaved($user_id, $property_id);
        
        if ($isSaved) {
            $result = $savedProperty->delete($user_id, $property_id);
            $message = 'Property removed from saved items';
            $newStatus = 'unsaved';
        } else {
            $result = $savedProperty->create($user_id, $property_id);
            $message = 'Property saved successfully';
            $newStatus = 'saved';
        }

        if ($this->isAjax()) {
            echo json_encode(['success' => $result, 'status' => $newStatus, 'message' => $message]);
        } else {
            if ($result) {
                Helper::flash('success', $message);
            } else {
                Helper::flash('error', 'Action failed');
            }
            // Redirect back to previous page
            $redirect = $_SERVER['HTTP_REFERER'] ?? BASE_URL . 'views/public/properties.php';
            header("Location: " . $redirect);
            exit();
        }
    }

    private function isAjax() {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

    private function sendResponse($success, $message, $data = []) {
        echo json_encode(array_merge(['success' => $success, 'message' => $message], $data));
        exit();
    }
}

// Route Handling
if (isset($_GET['action'])) {
    $controller = new SavedPropertyController();
    $action = $_GET['action'];
    
    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        echo "Action not found";
    }
}
?>
