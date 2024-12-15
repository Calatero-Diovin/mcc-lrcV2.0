<?php
// process_chat.php

// Set headers to allow AJAX requests
header('Content-Type: application/json');

// Simulate a response from the server
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['message'])) {
        $response = [
            'status' => 'success',
            'reply' => 'Thank you for your message: "' . htmlspecialchars($data['message']) . '"'
        ];
    } else {
        $response = ['status' => 'error', 'message' => 'Invalid message'];
    }

    echo json_encode($response);
}
?>
