<?php 
ini_set('session.cookie_httponly', 1);
session_start();
include('./admin/config/dbcon.php');
include('includes/url.php');

// Check if 'a' parameter is provided in the URL
if (!isset($_GET['a']) || empty($_GET['a'])) {
    header("Location: 404.php");
    exit;
}

$code = encryptor('decrypt', $_GET['a']); // Decrypt the code from the URL

// Check if the email exists in the faculty table
$faculty_query = "SELECT *, faculty_added FROM faculty WHERE email = ? AND status = 'archived'";
$faculty_stmt = $con->prepare($faculty_query);
$faculty_stmt->bind_param("s", $code); // Bind the decrypted email
$faculty_stmt->execute();
$faculty_result = $faculty_stmt->get_result();

// If email is found in the faculty table
if ($faculty_result->num_rows > 0) {
    $faculty_row = $faculty_result->fetch_assoc();
    $faculty_added = new DateTime($faculty_row['faculty_added']); // Creation time of the verification code
    $current_time = new DateTime(); // Current time

    // Check if the difference is greater than 1 hour
    $created_at_timestamp = $faculty_added->getTimestamp();
    $current_time_timestamp = $current_time->getTimestamp();

    if (($current_time_timestamp - $created_at_timestamp) > 3600) { // 3600 seconds = 1 hour
        header("Location: 404.php");
        exit;
    }
} else {
    // If email is not found in the faculty table, check the user table
    $user_query = "SELECT * FROM user WHERE email = ? AND status = 'archived'";
    $user_stmt = $con->prepare($user_query);
    $user_stmt->bind_param("s", $code); // Bind the decrypted email
    $user_stmt->execute();
    $user_result = $user_stmt->get_result();

    // If email is found in the user table
    if ($user_result->num_rows > 0) {
        $user_row = $user_result->fetch_assoc();
        $user_added = new DateTime($user_row['user_added']); // Creation time of the verification code
        $current_time = new DateTime(); // Current time

        // Check if the difference is greater than 1 hour
        $created_at_timestamp = $user_added->getTimestamp();
        $current_time_timestamp = $current_time->getTimestamp();

        if (($current_time_timestamp - $created_at_timestamp) > 3600) { // 3600 seconds = 1 hour
            header("Location: 404.php");
            exit;
        }
    } else {
        // If the email is not found in either table, show a 404 page
        header("Location: 404.php");
        exit;
    }
}

$faculty_stmt->close();
$user_stmt->close();
?>
