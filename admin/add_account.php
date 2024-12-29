<?php
include('authentication.php');
include('config.php'); // Include your database configuration file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $username = trim($_POST['username']);

    // Validate inputs
    if (!empty($firstname) && !empty($lastname) && !empty($username)) {
        // Prepare SQL query
        $query = "INSERT INTO ms_account (firstname, lastname, username) VALUES (?, ?, ?)";
        if ($stmt = $con->prepare($query)) {
            // Bind parameters
            $stmt->bind_param('sss', $firstname, $lastname, $username);

            // Execute query
            if ($stmt->execute()) {
                // Redirect with success status
                $_SESSION['status'] = "Account added successfully!";
                $_SESSION['status_code'] = "success";
            } else {
                // Redirect with error status
                $_SESSION['status'] = "Error adding account: " . $stmt->error;
                $_SESSION['status_code'] = "danger";
            }
            $stmt->close();
        } else {
            // Redirect with error status
            $_SESSION['status'] = "Error preparing statement: " . $con->error;
            $_SESSION['status_code'] = "danger";
        }
    } else {
        // Redirect with validation error status
        $_SESSION['status'] = "All fields are required.";
        $_SESSION['status_code'] = "warning";
    }

    // Redirect back to main page
    header('Location: ms_account.php');
    exit();
} else {
    // Redirect if accessed without POST method
    header('Location: ms_account.php');
    exit();
}
?>
