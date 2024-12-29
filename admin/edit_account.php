<?php
include('authentication.php');

if (isset($_POST['edit_account'])) {
    $ms_id = $_POST['ms_id'];
    $username = $_POST['username'];

    $query = "UPDATE ms_account SET username = ? WHERE ms_id = ?";
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param("si", $username, $ms_id);
        if ($stmt->execute()) {
            $_SESSION['status'] = "Username updated successfully.";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "Error updating username.";
            $_SESSION['status_code'] = "danger";
        }
        $stmt->close();
    } else {
        $_SESSION['status'] = "Error preparing statement.";
        $_SESSION['status_code'] = "danger";
    }

    header("Location: ms_account.php");
    exit();
} else {
    $_SESSION['status'] = "Invalid request.";
    $_SESSION['status_code'] = "danger";
    header("Location: ms_account.php");
    exit();
}
?>
