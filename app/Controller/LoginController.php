<?php

namespace MyApp\Controller;
require_once '../../vendor/autoload.php';

use MyApp\Model\User;



class LoginController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function loginUser(array $formData)
    {
        session_start();

        $errors = $this->validateFormData($formData);

        if (empty($errors)) {
            $user = $this->userModel->verifyLogin($formData['email'], $formData['password']);
            if ($user) {
                $this->initializeUserSession($user);
                $this->redirectBasedOnRole($user['role_id']);
            } else {
                $errors['login'] = 'Invalid email or password.';
                $this->setSessionErrorsAndRedirect($errors);
            }
        } else {
            $this->setSessionErrorsAndRedirect($errors);
        }
    }

    private function validateFormData(array $data): array
    {
        $errors = [];
        if (empty($data['email'])) {
            $errors['email'] = 'Email is required.';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email format.';
        }

        if (empty($data['password'])) {
            $errors['password'] = 'Password is required.';
        }
        return $errors;
    }

    private function initializeUserSession($user)
    {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['role_id'];
        $_SESSION['loggedin'] = true;
    }

    private function redirectBasedOnRole($roleId)
    {
        if ($roleId == 1) {
            header("Location: http://localhost:63342/MVC_Library/View/admin/AdminDashboard.php");
        } else {
            header("Location: http://localhost:63342/MVC_Library/View/User/books.php");
        }
        exit;
    }

    private function setSessionErrorsAndRedirect(array $errors)
    {
        $_SESSION['errors'] = $errors;
        header("Location: http://localhost:63342/MVC_Library/View/auth/login.php");
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginController = new LoginController();
    $loginController->loginUser($_POST);
}
