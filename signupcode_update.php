<?php 
ini_set('session.cookie_httponly', 1);
session_start();
include('./admin/config/dbcon.php');
require_once('./qrcode/qrlib.php');

if (isset($_POST['register_btn'])) {
    // Fetch and sanitize input
    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($con, $_POST['middlename']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $birthdate = mysqli_real_escape_string($con, $_POST['birthdate']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $cell_no = mysqli_real_escape_string($con, $_POST['cell_no']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $year_level = mysqli_real_escape_string($con, $_POST['year_level']);
    $course = mysqli_real_escape_string($con, $_POST['course']);
    $student_id_no = mysqli_real_escape_string($con, $_POST['student_id_no']);
    $role_as = mysqli_real_escape_string($con, $_POST['role']);
    $profile_image = isset($_FILES['profile_image']) ? $_FILES['profile_image'] : null;
    $contact_person = mysqli_real_escape_string($con, $_POST['contact_person']);
    $person_cell_no = mysqli_real_escape_string($con, $_POST['person_cell_no']);

    // Validate mandatory fields
    $mandatory_fields = [$lastname, $firstname, $gender, $birthdate, $address, $cell_no, $email, $student_id_no, $role_as, $profile_image, $contact_person, $person_cell_no];
    foreach ($mandatory_fields as $field) {
        if (empty($field)) {
            $_SESSION['status'] = "Please fill up all fields";
            $_SESSION['status_code'] = "warning";
            header("Location: login.php");
            exit(0);
        }
    }

    // Check if the email exists for the correct role (student or faculty)
    $check_query = "";
    if ($role_as == 'student') {
        $check_query = "SELECT student_id_no FROM user WHERE email = ?";
        $stmt_check = mysqli_prepare($con, $check_query);
        mysqli_stmt_bind_param($stmt_check, 's', $email);  // Only bind the email parameter
        mysqli_stmt_execute($stmt_check);
        mysqli_stmt_store_result($stmt_check);

        if (mysqli_stmt_num_rows($stmt_check) == 0) {
            $_SESSION['status'] = "Student ID No. does not match with the provided email";
            $_SESSION['status_code'] = "warning";
            header("Location: login.php");
            exit(0);
        }
    } elseif (in_array($role_as, ['faculty', 'staff'])) {
        $check_query = "SELECT username FROM faculty WHERE email = ?";
        $stmt_check = mysqli_prepare($con, $check_query);
        mysqli_stmt_bind_param($stmt_check, 's', $email);  // Only bind the email parameter
        mysqli_stmt_execute($stmt_check);
        mysqli_stmt_store_result($stmt_check);

        if (mysqli_stmt_num_rows($stmt_check) == 0) {
            $_SESSION['status'] = "Username does not match with the provided email";
            $_SESSION['status_code'] = "warning";
            header("Location: login.php");
            exit(0);
        }
    }

    // Handle image upload
    $image_path = "";
    if ($profile_image && $profile_image['error'] == 0) {
        $target_dir = "./uploads/profile_images/";
        $image_name = basename($profile_image['name']);
        $target_file = $target_dir . $image_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validate the image
        $check = getimagesize($profile_image['tmp_name']);
        if ($check !== false) {
            if ($profile_image["size"] <= 50997152) { // Max 50MB
                if (in_array($imageFileType, ["jpg", "jpeg", "png"])) {
                    if (move_uploaded_file($profile_image["tmp_name"], $target_file)) {
                        $image_path = $image_name;
                    } else {
                        $_SESSION['status'] = "Error uploading file.";
                        $_SESSION['status_code'] = "error";
                        header("Location: login.php");
                        exit(0);
                    }
                } else {
                    $_SESSION['status'] = "Only JPG, JPEG, and PNG files are allowed.";
                    $_SESSION['status_code'] = "error";
                    header("Location: login.php");
                    exit(0);
                }
            } else {
                $_SESSION['status'] = "File is too large (Max 50MB).";
                $_SESSION['status_code'] = "error";
                header("Location: login.php");
                exit(0);
            }
        } else {
            $_SESSION['status'] = "File is not an image.";
            $_SESSION['status_code'] = "error";
            header("Location: login.php");
            exit(0);
        }
    }

    // Prepare and execute the UPDATE query
    $update_query = "";
    if ($role_as == 'student') {
        $update_query = "UPDATE user SET lastname = ?, firstname = ?, middlename = ?, gender = ?, course = ?, address = ?, cell_no = ?, birthdate = ?, year_level = ?, role_as = ?, status = 'pending', user_updated = NOW(), profile_image = ?, contact_person = ?, person_cell_no = ? WHERE email = ?";
    } elseif (in_array($role_as, ['faculty', 'staff'])) {
        $update_query = "UPDATE faculty SET lastname = ?, firstname = ?, middlename = ?, gender = ?, course = ?, address = ?, cell_no = ?, birthdate = ?, role_as = ?, status = 'pending', faculty_updated = NOW(), profile_image = ?, contact_person = ?, person_cell_no = ? WHERE email = ?";
    }

    $stmt_update = mysqli_prepare($con, $update_query);
    if ($role_as == 'student') {
        mysqli_stmt_bind_param($stmt_update, 'ssssssssssssss', $lastname, $firstname, $middlename, $gender, $course, $address, $cell_no, $birthdate, $year_level, $role_as, $image_path, $contact_person, $person_cell_no, $email);
    } elseif (in_array($role_as, ['faculty', 'staff'])) {
        mysqli_stmt_bind_param($stmt_update, 'sssssssssssss', $lastname, $firstname, $middlename, $gender, $course, $address, $cell_no, $birthdate, $role_as, $image_path, $contact_person, $person_cell_no, $email);
    }

    // Execute and check update success
    if (mysqli_stmt_execute($stmt_update)) {
        $_SESSION['status'] = "Update successful, wait for approval.";
        $_SESSION['status_code'] = "success";
        header("Location: login.php");
        exit(0);
    } else {
        $_SESSION['status'] = "Failed to update user information.";
        $_SESSION['status_code'] = "error";
        header("Location: login.php");
        exit(0);
    }
} else {
    $_SESSION['status'] = "Please fill up all the fields";
    $_SESSION['status_code'] = "warning";
    header("Location: login.php");
    exit(0);
}
?>
