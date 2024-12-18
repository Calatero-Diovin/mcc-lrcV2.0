<?php 
ini_set('session.cookie_httponly', 1);
session_start();
include('./admin/config/dbcon.php');
include('includes/url.php');

// Check if 'code' is provided in the URL
if (!isset($_GET['a']) || empty($_GET['a'])) {
    header("Location: 404.php");
    exit;
}

$code = encryptor('decrypt', $_GET['a']);

// Prepare query to fetch the verification code and its creation time
$code_query = "SELECT * FROM user WHERE email = ? AND status = 'archived'";
$code_stmt = $con->prepare($code_query);
$code_stmt->bind_param("s", $code);
$code_stmt->execute();
$code_result = $code_stmt->get_result();

$faculty_query = "SELECT * FROM faculty WHERE email = ? AND status = 'archived'";
$faculty_stmt = $con->prepare($faculty_query);
$faculty_stmt->bind_param("s", $code);
$faculty_stmt->execute();
$faculty_result = $faculty_stmt->get_result();

if ($code_result->num_rows > 0) {
    $code_row = $code_result->fetch_assoc();
    // $user_added = new DateTime($code_row['user_added']); // Creation time of the verification code
    // $current_time = new DateTime(); // Current time

    // // Check if the difference is greater than 1 hour
    // $created_at_timestamp = $user_added->getTimestamp();
    // $current_time_timestamp = $current_time->getTimestamp();

    // if (($current_time_timestamp - $created_at_timestamp) > 3600) { // 3600 seconds = 1 hour
    //     header("Location: 404.php");
    //     exit;
    // }
} elseif ($faculty_result->num_rows > 0) {
    $faculty_row = $faculty_result->fetch_assoc();
    // $faculty_added = new DateTime($faculty_row['faculty_added']); // Creation time of the verification code
    // $current_time = new DateTime(); // Current time

    // // Check if the difference is greater than 1 hour
    // $created_at_timestamp = $faculty_added->getTimestamp();
    // $current_time_timestamp = $current_time->getTimestamp();

    // if (($current_time_timestamp - $created_at_timestamp) > 3600) { // 3600 seconds = 1 hour
    //     header("Location: 404.php");
    //     exit;
    // }
} else {
    header("Location: 404.php");
    exit;
}

$code_stmt->close();
$faculty_stmt->close();
?>
