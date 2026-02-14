<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/Setting.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/Helper.php';
require_once __DIR__ . '/../core/Validator.php';

class SettingController {

    public function index() {
        Auth::requireAdmin();
        
        $settingModel = new Setting();
        $userModel = new User();
        
        // Fetch all settings
        $settings = $settingModel->getAllAsArray();
        
        // Fetch all admins
        $admins = $userModel->readAllAdmins(); // We need to add this method to User model
        
        require_once __DIR__ . '/../views/admin/settings/index.php';
    }

    public function updateSettings() {
        Auth::requireAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $settingModel = new Setting();
            
            // Text Settings
            $fields = ['site_name', 'site_email', 'currency_code', 'currency_symbol'];
            foreach ($fields as $field) {
                if (isset($_POST[$field])) {
                    $settingModel->update($field, trim($_POST[$field]));
                }
            }
            
            // Logo Upload
            if (isset($_FILES['site_logo']) && $_FILES['site_logo']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../uploads/settings/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
                
                $fileName = 'logo_' . time() . '.' . pathinfo($_FILES['site_logo']['name'], PATHINFO_EXTENSION);
                $targetPath = $uploadDir . $fileName;
                
                if (move_uploaded_file($_FILES['site_logo']['tmp_name'], $targetPath)) {
                    $settingModel->update('site_logo', $fileName);
                }
            }
            
            Helper::setFlash('success', 'Settings updated successfully.');
            Helper::redirect('controllers/SettingController.php?action=index');
        }
    }

    public function createAdmin() {
        Auth::requireAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new User();
            $validator = new Validator();
            
            $data = [
                'full_name' => $_POST['full_name'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'role' => 'admin'
            ];
            
            $rules = [
                'full_name' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6'
            ];
            
            // Check uniqueness manually since Validator might not have DB access implies
            if ($userModel->emailExists($data['email'])) {
                 Helper::setFlash('error', 'Email already exists.');
                 Helper::redirect('controllers/SettingController.php?action=index'); // Back to settings
                 return;
            }

            if ($userModel->create($data)) {
                Helper::setFlash('success', 'New Administrator created successfully.');
            } else {
                Helper::setFlash('error', 'Failed to create Administrator.');
            }
            
            Helper::redirect('controllers/SettingController.php?action=index');
        }
    }
}

if (isset($_GET['action'])) {
    $controller = new SettingController();
    $action = $_GET['action'];
    if (method_exists($controller, $action)) {
        $controller->$action();
    }
}
?>
