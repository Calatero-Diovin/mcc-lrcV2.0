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
                    $_SESSION['status'] = "Account updated successfully!";
                    $_SESSION['status_code'] = "success";
                } else {
                    $_SESSION['status'] = "Error updating account: " . $stmt->error;
                    $_SESSION['status_code'] = "danger";
                }
                $stmt->close();
            } else {
                $_SESSION['status'] = "Error preparing statement: " . $con->error;
                $_SESSION['status_code'] = "danger";
            }
        } else {
            $_SESSION['status'] = "All fields are required.";
            $_SESSION['status_code'] = "warning";
        }

        // Redirect back to main page
        header('Location: ms_account.php');
        exit();
    } elseif (isset($_POST['add_account'])) {
        // Add account logic
        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']);
        $username = trim($_POST['username']);

        if (!empty($firstname) && !empty($lastname) && !empty($username)) {
            // Check if username already exists
            $check_query = "SELECT COUNT(*) FROM ms_account WHERE username = ?";
            if ($check_stmt = $con->prepare($check_query)) {
                $check_stmt->bind_param('s', $username);
                $check_stmt->execute();
                $check_stmt->bind_result($username_exists);
                $check_stmt->fetch();
                $check_stmt->close();

                if ($username_exists > 0) {
                    $_SESSION['status'] = "Username is already taken. Please choose another one.";
                    $_SESSION['status_code'] = "warning";
                } else {
                    // Proceed with adding the account
                    $query = "INSERT INTO ms_account (firstname, lastname, username) VALUES (?, ?, ?)";
                    if ($stmt = $con->prepare($query)) {
                        $stmt->bind_param('sss', $firstname, $lastname, $username);

                        if ($stmt->execute()) {
                            $_SESSION['status'] = "Account added successfully!";
                            $_SESSION['status_code'] = "success";
                        } else {
                            $_SESSION['status'] = "Error adding account: " . $stmt->error;
                            $_SESSION['status_code'] = "danger";
                        }
                        $stmt->close();
                    } else {
                        $_SESSION['status'] = "Error preparing statement: " . $con->error;
                        $_SESSION['status_code'] = "danger";
                    }
                }
            } else {
                $_SESSION['status'] = "Error preparing statement to check username: " . $con->error;
                $_SESSION['status_code'] = "danger";
            }
        } else {
            $_SESSION['status'] = "All fields are required.";
            $_SESSION['status_code'] = "warning";
        }

        header('Location: ms_account.php');
        exit();
    }
} else {
    header('Location: ms_account.php');
    exit();
}
?>
