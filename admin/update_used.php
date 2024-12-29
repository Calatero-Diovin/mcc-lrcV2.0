<?php
include('authentication.php');

if (isset($_POST['ms_id']) && isset($_POST['used'])) {
    $ms_id = intval($_POST['ms_id']);
    $used = intval($_POST['used']);

    $query = "UPDATE ms_account SET used = ? WHERE ms_id = ?";
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param('ii', $used, $ms_id);
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
