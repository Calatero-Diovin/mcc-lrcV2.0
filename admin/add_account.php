<?php
include('authentication.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit_account'])) {
        // Edit account logic
        $ms_id = intval($_POST['ms_id']);
        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']);
        $username = trim($_POST['username']);

        if (!empty($ms_id) && !empty($firstname) && !empty($lastname) && !empty($username)) {
            // Prepare SQL query for update
            $query = "UPDATE ms_account SET firstname = ?, lastname = ?, username = ? WHERE ms_id = ?";
            if ($stmt = $con->prepare($query)) {
                // Bind parameters
                $stmt->bind_param('sssi', $firstname, $lastname, $username, $ms_id);

                // Execute query
                if ($stmt->execute()) {
                    $_SESSION['message'] = "Account updated successfully!";
                    $_SESSION['message_type'] = "success";
                } else {
                    $_SESSION['message'] = "Error updating account: " . $stmt->error;
                    $_SESSION['message_type'] = "danger";
                }
                $stmt->close();
            } else {
                $_SESSION['message'] = "Error preparing statement: " . $con->error;
                $_SESSION['message_type'] = "danger";
            }
        } else {
            $_SESSION['message'] = "All fields are required.";
            $_SESSION['message_type'] = "warning";
        }

        // Redirect back to main page
        header('Location: ms365_account.php');
        exit();
    } elseif (isset($_POST['add_account'])) {
        // Add account logic
        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']);
        $username = trim($_POST['username']);

        if (!empty($firstname) && !empty($lastname) && !empty($username)) {
            $query = "INSERT INTO ms_account (firstname, lastname, username) VALUES (?, ?, ?)";
            if ($stmt = $con->prepare($query)) {
                $stmt->bind_param('sss', $firstname, $lastname, $username);

                if ($stmt->execute()) {
                    $_SESSION['message'] = "Account added successfully!";
                    $_SESSION['message_type'] = "success";
                } else {
                    $_SESSION['message'] = "Error adding account: " . $stmt->error;
                    $_SESSION['message_type'] = "danger";
                }
                $stmt->close();
            } else {
                $_SESSION['message'] = "Error preparing statement: " . $con->error;
                $_SESSION['message_type'] = "danger";
            }
        } else {
            $_SESSION['message'] = "All fields are required.";
            $_SESSION['message_type'] = "warning";
        }

        header('Location: ms365_account.php');
        exit();
    }
} else {
    header('Location: ms365_account.php');
    exit();
}
?>
