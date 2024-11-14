<?php 
ini_set('session.cookie_httponly', 1);
session_start();
include('./admin/config/dbcon.php');

// Check if 'code' is present in the URL
if (!isset($_GET['code']) || empty($_GET['code'])) {
    // Redirect to a 404 error page
    header("HTTP/1.0 404 Not Found");
    exit; // Ensure no further code is executed
}

$code = password_verify($_GET['code']);

$code_query = "SELECT username FROM ms_account WHERE verification_code = ?";
$code_stmt = $con->prepare($code_query);
$code_stmt->bind_param("s", $code);
$code_stmt->execute();
$code_result = $code_stmt->get_result();
$code_row = $code_result->fetch_assoc();
?>