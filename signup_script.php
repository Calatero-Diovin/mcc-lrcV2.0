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

$code = $_GET['code'];

// Query to get the stored hash from the database
$code_query = "SELECT username, verification_code FROM ms_account WHERE verification_code IS NOT NULL";
$code_stmt = $con->prepare($code_query);
$code_stmt->execute();
$code_result = $code_stmt->get_result();

// Check if the code exists in the database
$code_found = false;
while ($code_row = $code_result->fetch_assoc()) {
    // Verify the code with password_verify
    if (password_verify($code, $code_row['verification_code'])) {
        $code_found = true;
        $username = $code_row['username'];
        break;  // Exit loop as we found the matching code
    }
}

$code_stmt->close();

if (!$code_found) {
    
    header("HTTP/1.0 404 Not Found");
    exit;
}

?>
