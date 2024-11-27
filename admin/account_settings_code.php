<?php
include('authentication.php');

if (isset($_SESSION['auth_admin']['admin_id'])) {
    $id_session = $_SESSION['auth_admin']['admin_id'];
}

if (isset($_POST['save_changes'])) {
    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($con, $_POST['middlename']);
    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);

    $old_admin_filename = $_POST['old_admin_image'];
    $admin_image = $_FILES['admin_image']['name'];
    $update_admin_filename = "";

    if ($admin_image != NULL) {
        // Rename the Image
        $admin_extension = pathinfo($admin_image, PATHINFO_EXTENSION);
        $admin_filename = time() . '.' . $admin_extension;
        $update_admin_filename = $admin_filename;
    } else {
        $update_admin_filename = $old_admin_filename;
    }

    $query = "UPDATE admin SET admin_image = ?, firstname = ?, middlename = ?, lastname = ?, address = ?, phone_number = ?, email = ? WHERE admin_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ssssssss", $update_admin_filename, $firstname, $middlename, $lastname, $address, $phone, $email, $id_session);
    $query_run = $stmt->execute();

    if ($query_run) {
        if ($admin_image != NULL) {
            if (file_exists('../uploads/admin_profile/' . $old_admin_filename)) {
                unlink("../uploads/admin_profile/" . $old_admin_filename);
            }
            move_uploaded_file($_FILES['admin_image']['tmp_name'], '../uploads/admin_profile/' . $admin_filename);
        }
        $_SESSION['status'] = 'Updated Successfully';
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = 'Not Updated';
        $_SESSION['status_code'] = "error";
    }
    header("Location: account_settings.php");
    exit(0);
}
?>
