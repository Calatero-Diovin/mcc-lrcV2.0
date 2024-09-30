<?php
session_start();
include('./admin/config/dbcon.php');

if (isset($_POST['admin_login_btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $admin_type = $_POST['admin_type'];

    $admin_login_query = "SELECT * FROM admin WHERE email = ? AND admin_type = ?";

    if ($stmt = mysqli_prepare($con, $admin_login_query)) {
        mysqli_stmt_bind_param($stmt, 'ss', $email, $admin_type);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_array($result);
            if (password_verify($password, $data['password'])) {
                $admin_id = $data['admin_id'];
                $admin_name = $data['firstname'] . ' ' . $data['lastname'];
                $admin_email = $data['email'];
                $admin_type = $data['admin_type'];

                $_SESSION['auth'] = true;
                $_SESSION['auth_role'] = "$admin_type";
                $_SESSION['auth_admin'] = [
                    'admin_id' => $admin_id,
                    'admin_name' => $admin_name,
                    'email' => $admin_email,
                ];

                $_SESSION['login_success'] = true;
                header("Location: admin_login");
                exit(0);
            } else {
                $_SESSION['status'] = "Invalid email, password, or admin type";
                $_SESSION['status_code'] = "error";
                header("Location: admin_login");
                exit(0);
            }
        } else {
            $_SESSION['status'] = "Invalid email, password, or admin type";
            $_SESSION['status_code'] = "error";
            header("Location: admin_login");
            exit(0);
        }

        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['status'] = "Something went wrong";
        $_SESSION['status_code'] = "error";
        header("Location: admin_login");
        exit(0);
    }
}
?>
