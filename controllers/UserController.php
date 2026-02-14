<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/Validator.php';
require_once __DIR__ . '/../core/Helper.php';

class UserController {
    
    public function updateProfile() {
        Auth::requireLogin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = Auth::id();
            $userModel = new User();
            
            $data = [
                'full_name' => $_POST['full_name'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'password' => $_POST['password'],
                'confirm_password' => $_POST['confirm_password']
            ];

            $validator = new Validator();
            $rules = [
                'full_name' => 'required|min:3',
                'email' => 'required|email',
                'phone' => 'required'
            ];
            
            // If password is being changed
            if (!empty($data['password'])) {
                $rules['password'] = 'min:6';
            }

            if ($validator->validate($data, $rules)) {
                // Check if passwords match
                if (!empty($data['password']) && $data['password'] !== $data['confirm_password']) {
                    Helper::flash('error', 'New passwords do not match.');
                    Helper::redirect('views/client/profile.php');
                }

                // Check email uniqueness
                if ($userModel->emailExistsForOther($data['email'], $user_id)) {
                    Helper::flash('error', 'Email is already taken by another user.');
                    Helper::redirect('views/client/profile.php');
                }

                if ($userModel->update($user_id, $data)) {
                    // Update Session Data
                    $_SESSION['user_name'] = $data['full_name'];
                    $_SESSION['user_email'] = $data['email'];

                    Helper::flash('success', 'Profile updated successfully.');
                    Helper::redirect('views/client/profile.php');
                } else {
                    Helper::flash('error', 'Failed to update profile.');
                }

            } else {
                $_SESSION['errors'] = $validator->getErrors();
                Helper::flash('error', 'Please correct the errors.');
                Helper::redirect('views/client/profile.php');
            }
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
