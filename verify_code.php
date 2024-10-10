<?php
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $code = $input['code'];
    $expectedCode = $_SESSION['verification_code'] ?? null;

    if ($code == $expectedCode) {
        echo json_encode(['success' => true]);
        unset($_SESSION['verification_code']); // Clear the code from session
    } else {
        echo json_encode(['success' => false]);
    }
}
?>
