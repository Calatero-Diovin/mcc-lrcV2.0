<?php
session_start();
include('config/dbcon.php'); // Include your database connection

// Assume you have a function to send the verification code
// and a variable to hold the correct code for simplicity.
// In a real application, you'd retrieve this from a database or a session.
$expected_code = $_SESSION['verification_code'] ?? null; // The code that was sent to the user

// Get the input from the request
$data = json_decode(file_get_contents("php://input"), true);
$input_code = $data['code'] ?? null;

// Check if the input code matches the expected code
if ($expected_code && $input_code === $expected_code) {
    // Verification successful
    echo json_encode(['success' => true]);
} else {
    // Verification failed
    echo json_encode(['success' => false]);
}
?>
