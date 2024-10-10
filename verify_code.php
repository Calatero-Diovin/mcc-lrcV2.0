<?php
session_start();

header('Content-Type: application/json');

// Initialize verification attempts if not set
if (!isset($_SESSION['verification_attempts'])) {
    $_SESSION['verification_attempts'] = 0;
    $_SESSION['verification_time'] = time();
}

// Rate limiting: Check if the user is locked out
if ($_SESSION['verification_attempts'] >= 3 && (time() - $_SESSION['verification_time'] < 300)) {
    echo json_encode(['success' => false, 'message' => 'Too many attempts. Please try again later.']);
    exit;
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $code = isset($input['code']) ? strip_tags(trim($input['code'])) : ''; // Sanitize input
    $expectedCode = $_SESSION['verification_code'] ?? null;

    // Check if the verification code has expired
    if (time() - ($_SESSION['verification_code_time'] ?? 0) > 600) { // 10 minutes expiration
        echo json_encode(['success' => false, 'message' => 'Verification code expired.']);
        exit;
    }

    // Validate the verification code
    if ($code === $expectedCode) {
        echo json_encode(['success' => true]);
        unset($_SESSION['verification_code'], $_SESSION['verification_code_time']); // Clear the code from session
    } else {
        $_SESSION['verification_attempts']++; // Increment attempt count
        echo json_encode(['success' => false, 'message' => 'Invalid verification code.']);
    }
}
?>
