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
$code_query = "SELECT * FROM user WHERE email = ?";
$code_stmt = $con->prepare($code_query);
$code_stmt->bind_param("s", $code);
$code_stmt->execute();
$code_result = $code_stmt->get_result();

if ($code_result->num_rows > 0) {
    $code_row = $code_result->fetch_assoc();
} else {
    header("Location: 404.php");
    exit;
}

$code_stmt->close();
?>
