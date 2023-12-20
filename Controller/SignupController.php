<?php
require_once '../Model/User.php';

class SignupController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function registerUser($formData) {
        session_start();

        $errors = $this->validateFormData($formData);

        if (empty($errors)) {
            if ($this->userModel->emailExists($formData['email'])) {
                $errors['email'] = 'This email is already registered. Please use a different email.';
            } else {
                $this->createNewUser($formData, $errors);
            }
        }

        $_SESSION['errors'] = $errors;
        $_SESSION['form_data'] = $formData;
        header("Location: http://localhost:63342/MVC_Library/View/auth/signup.php");
        exit;
    }

    private function validateFormData($data): array {
        $errors = [];
        foreach (['fullname', 'last_name', 'email', 'password', 'phone'] as $field) {
            if (empty($data[$field])) {
                $errors[$field] = ucfirst($field) . ' is required.';
            }
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email format.';
        }

        return $errors;
    }

    private function createNewUser($formData, &$errors) {
        try {
            $userId = $this->userModel->createUserWithDefaultRole(
                $formData['fullname'],
                $formData['last_name'],
                $formData['email'],
                $formData['password'],
                $formData['phone']
            );
            $_SESSION['user_id'] = $userId;
            header("Location: http://localhost:63342/MVC_Library/View/login.php");
            exit;
        } catch (Exception $e) {
            $errors['general'] = 'An error occurred during registration. Please try again.';
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $signupController = new SignupController();
    $signupController->registerUser($_POST);
}
