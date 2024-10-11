<?php
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['verification_code'])) {
    echo json_encode(['success' => false, 'message' => 'No verification code found.']);
    exit(0);
}

if (isset($_POST['verification_code'])) {
    $input_code = $_POST['verification_code'];

    if ($input_code == $_SESSION['verification_code']) {
        unset($_SESSION['verification_code']); // Clear the verification code
        unset($_SESSION['verification_required']); // Clear the verification requirement

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid verification code.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Verification code not submitted.']);
}
