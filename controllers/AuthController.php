<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Activity.php';
require_once __DIR__ . '/../core/Validator.php';
require_once __DIR__ . '/../core/Helper.php';

/**
 * AuthController
 * 
 * Handles user authentication (register, login, logout).
 */

class AuthController {
    public function register() {
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $validator = new Validator();
            $data = [
                'full_name' => $_POST['full_name'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'password' => $_POST['password'],
                'confirm_password' => $_POST['confirm_password'],
                'role' => $_POST['role'] ?? 'client'
            ];

            $rules = [
                'full_name' => 'required|min:3',
                'email' => 'required|email',
                'password' => 'required|min:6',
                'role' => 'required'
            ];

            if ($validator->validate($data, $rules)) {
                if ($data['password'] !== $data['confirm_password']) {
                    Helper::setFlash('error', 'Passwords do not match.');
                    Helper::redirect('views/auth/register.php');
                }

                $user = new User();
                if ($user->emailExists($data['email'])) {
                    Helper::setFlash('error', 'Email already exists.');
                     Helper::redirect('views/auth/register.php');
                }

                $user->full_name = $data['full_name'];
                $user->email = $data['email'];
                $user->phone = $data['phone'];
                $user->password = $data['password'];
                $user->role = $data['role'];

                if ($user->register()) {
                    Helper::setFlash('success', 'Registration successful. Please login.');
                    Helper::redirect('views/auth/login.php');
                } else {
                    Helper::setFlash('error', 'Registration failed. Try again.');
                }
            } else {
                $_SESSION['errors'] = $validator->getErrors();
            }
         }
         Helper::redirect('views/auth/register.php');
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User();
            $activity = new Activity();
            
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            // Store email in session to preserve input
            $_SESSION['old_email'] = $email;

            if ($user->login($email, $password)) {
                if (session_status() === PHP_SESSION_NONE) session_start();
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user_name'] = $user->full_name;
                $_SESSION['user_email'] = $user->email;
                $_SESSION['user_role'] = $user->role;

                // Clear old input on success
                unset($_SESSION['old_email']);

                // Log Activity
                $activity->log($user->id, "Logged in to the system.", "auth");

                if ($user->role === 'admin') {
                    Helper::redirect('views/admin/dashboard.php');
                } elseif ($user->role === 'manager') {
                    Helper::redirect('views/manager/dashboard.php');
                } elseif ($user->role === 'tenant') {
                    Helper::redirect('views/tenant/dashboard.php');
                } else {
                    Helper::redirect('views/client/dashboard.php');
                }
            } else {
                Helper::setFlash('error', 'Invalid email or password.');
                Helper::redirect('views/auth/login.php');
            }
        }
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        session_destroy();
        Helper::redirect('views/auth/login.php');
    }
}

// Simple router for Auth actions
if (isset($_GET['action'])) {
    $auth = new AuthController();
    $action = $_GET['action'];
    if (method_exists($auth, $action)) {
        $auth->$action();
    }
}
?>
