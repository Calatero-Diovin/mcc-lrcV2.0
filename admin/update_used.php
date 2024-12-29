<?php
include('authentication.php');

if (isset($_POST['id']) && isset($_POST['used'])) {
    $id = intval($_POST['id']);
    $used = intval($_POST['used']);

    $query = "UPDATE ms_account SET used = ? WHERE ms_id = ?";
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param('ii', $used, $id);
        if ($stmt->execute()) {
            $_SESSION['status'] = "Used value updated successfully.";
            $_SESSION['status_code'] = "success";
        } else {
            $_SESSION['status'] = "Error updating used value.";
            $_SESSION['status_code'] = "danger";
        }
        $stmt->close();
    }
    header("Location: ms_account.php");
    exit();
}
?>
