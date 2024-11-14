<?php 
ini_set('session.cookie_httponly', 1);
session_start();
include('./admin/config/dbcon.php');

// Check if 'code' is present in the URL
if (!isset($_GET['code']) || empty($_GET['code'])) {
    header("HTTP/1.0 404 Not Found");
    exit;
}

$code = $_GET['code'];
$username = '';  // Default username value

// Query to get the username based on verification code
$code_query = "SELECT username FROM ms_account WHERE verification_code = ?";
$code_stmt = $con->prepare($code_query);
$code_stmt->bind_param("s", $code);
$code_stmt->execute();
$code_result = $code_stmt->get_result();

// Check if the query returns a result (i.e., code exists in the database)
if ($code_result->num_rows == 0) {
    // Redirect to a 404 error page if the code is not found in the database
    header("HTTP/1.0 404 Not Found");
    exit; // Ensure no further code is executed
} else {
    // The code exists in the database, so you can proceed with the logic
    $code_row = $code_result->fetch_assoc();
    $username = $code_row['username'];
}

?>