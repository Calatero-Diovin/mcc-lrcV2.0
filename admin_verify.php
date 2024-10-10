<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enteredOtp = $_POST['otp'];
    if (isset($_SESSION['otp'])) {
        echo "Session OTP: " . $_SESSION['otp'] . " | Entered OTP: " . $enteredOtp; // For debugging
    }
    if (isset($_SESSION['otp']) && $enteredOtp == $_SESSION['otp']) {
        unset($_SESSION['otp']);
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>