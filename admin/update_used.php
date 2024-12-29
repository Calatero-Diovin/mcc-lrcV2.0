<?php
include('authentication.php');

if (isset($_POST['username']) && isset($_POST['used'])) {
    $username = $_POST['username'];
    $used = intval($_POST['used']);

    $query = "UPDATE ms_account SET used = ? WHERE username = ?";
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param('is', $used, $username);
        if ($stmt->execute()) {
            $_SESSION['message'] = "Used value updated successfully.";
            $_SESSION['msg_type'] = "success";
        } else {
            $_SESSION['message'] = "Error updating used value.";
            $_SESSION['msg_type'] = "danger";
        }
        $stmt->close();
    }
    header("Location: ms_365_account.php");
    exit();
}
?>
