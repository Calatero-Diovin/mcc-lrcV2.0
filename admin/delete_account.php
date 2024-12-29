<?php
include('authentication.php');

if (isset($_POST['ms_id'])) {
    $ms_id = $_POST['ms_id'];

    $query = "DELETE FROM ms_account WHERE ms_id = ?";
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param("i", $ms_id);
        if ($stmt->execute()) {
            $_SESSION['status'] = "Account deleted successfully.";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "Error deleting account.";
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
