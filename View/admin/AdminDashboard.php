<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['user_role'] !== 'Admin') {
    header("Location: http://localhost:63342/MVC_Library/View/auth/login.php");
    exit;
}
echo 'admin dashboard';