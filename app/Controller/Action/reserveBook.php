<?php

require_once '../../../vendor/autoload.php';

use MyApp\Config\DbConnection;
use MyApp\Controller\ReservationController;
use MyApp\Model\Reservation;

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: http://localhost:63342/MVC_Library/View/auth/login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["book_id"])) {
    $dbConnection = DbConnection::getInstance()->getConnection();
    $reservationController = new ReservationController(new Reservation($dbConnection));

    $bookId = $_POST["book_id"];
    $userId = $_SESSION["user_id"];
    $reservationDate = date("Y-m-d");
    $returnDate = date("Y-m-d", strtotime("+1 week"));

    $success = $reservationController->reserveBook($bookId, $userId, $reservationDate, $returnDate);

    if ($success) {
        // Redirect back to the books page after a successful reservation
        header("Location: http://localhost:63342/file/View/User/books.php");
        exit;
    } else {
        echo "Error: Unable to reserve the book.";
    }
} else {
    header("HTTP/1.1 400 Bad Request");
    exit;
}
