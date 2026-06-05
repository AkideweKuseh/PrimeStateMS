<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/Validator.php';
require_once __DIR__ . '/../core/Helper.php';

class UserController {
    
    public function updateProfile() {
        Auth::requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = Auth::id();
            $userModel = new User();
            
            $data = [
                'full_name' => $_POST['full_name'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone']
            ];

            // Handle password update if provided
            if (!empty($_POST['password'])) {
                if ($_POST['password'] !== $_POST['confirm_password']) {
                    Helper::setFlash('error', 'Passwords do not match.');
                    Helper::redirect('views/client/profile.php');
                    return;
                }
                if (strlen($_POST['password']) < 6) {
                    Helper::setFlash('error', 'Password must be at least 6 characters.');
                    Helper::redirect('views/client/profile.php');
                    return;
                }
                $data['password'] = $_POST['password'];
            }

            if ($userModel->update($id, $data)) {
                $_SESSION['user_name'] = $data['full_name'];
                $_SESSION['user_email'] = $data['email'];
                Helper::setFlash('success', 'Profile updated successfully.');
            } else {
                Helper::setFlash('error', 'Failed to update profile.');
            }
            Helper::redirect('views/client/profile.php');
        }
    }

    public function update() {
        Auth::requireRole('admin', 'manager');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $userModel = new User();
            
            $data = [
                'full_name' => $_POST['full_name'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'role' => $_POST['role']
            ];

            if ($userModel->update($id, $data)) {
                // If the user being updated is the current user, update session
                if ($id == Auth::id()) {
                    $_SESSION['user_name'] = $data['full_name'];
                    $_SESSION['user_email'] = $data['email'];
                    $_SESSION['user_role'] = $data['role'];
                }
                Helper::setFlash('success', 'User updated successfully.');
            } else {
                Helper::setFlash('error', 'Failed to update user.');
            }
            Helper::redirect('views/admin/users/index.php');
        }
    }
}

// Router
if (isset($_GET['action'])) {
    $controller = new UserController();
    $action = $_GET['action'];
    if (method_exists($controller, $action)) {
        $controller->$action();
    }
}
?>
