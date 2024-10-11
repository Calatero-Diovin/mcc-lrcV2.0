<?php
ini_set('session.cookie_httponly', 1);
session_start();
include('./admin/config/dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/vendor/phpmailer/phpmailer/src/Exception.php';
require 'phpmailer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'phpmailer/vendor/phpmailer/phpmailer/src/SMTP.php';

// Initialize session variables if not already set
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
    $_SESSION['lockout_time'] = null;
}

// Check if user is locked out
if ($_SESSION['lockout_time'] && time() < $_SESSION['lockout_time']) {
    $lockout_time_remaining = $_SESSION['lockout_time'] - time();
    $minutes_remaining = ceil($lockout_time_remaining / 60);
    $_SESSION['status'] = "Too many failed attempts. Please try again in $minutes_remaining minute(s).";
    $_SESSION['status_code'] = "error";
    header("Location: admin_login");
    exit(0);
}

if (isset($_POST['admin_login_btn'])) {
    // Verify reCAPTCHA
    $recaptcha_secret = '6LfNJ1wqAAAAALAbZ2w54n0o33b0iQc3AHJx_bZ3';
    $recaptcha_response = $_POST['g-recaptcha-response'];

    // Make a POST request to Google's reCAPTCHA server
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$recaptcha_response");
    $response_keys = json_decode($response, true);

    if (intval($response_keys["success"]) !== 1) {
        $_SESSION['status'] = "Please complete the reCAPTCHA.";
        $_SESSION['status_code'] = "error";
        header("Location: admin_login");
        exit(0);
    }

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
                // Reset login attempts on successful login
                $_SESSION['login_attempts'] = 0;
                $_SESSION['lockout_time'] = null;

                // Generate a random verification code
                $verification_code = rand(100000, 999999); // 6-digit code
                $_SESSION['verification_code'] = $verification_code;

                // Send verification code email
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
                    $mail->SMTPAuth = true;
                    $mail->Username = 'mcclearningresourcecenter@gmail.com'; // SMTP username
                    $mail->Password = 'qxbi jqnf hgfn lkih'; // SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    $mail->setFrom('mcclearningresourcecenter@gmail.com', 'MCC Learning Resource Center');
                    $mail->addAddress($email); // User's email

                    $mail->isHTML(true);
                    $mail->Subject = 'Your Verification Code';
                    $mail->Body = "Your verification code is: <strong>$verification_code</strong>";

                    $mail->send();
                } catch (Exception $e) {
                    $_SESSION['status'] = "Could not send email. Mailer Error: {$mail->ErrorInfo}";
                    $_SESSION['status_code'] = "error";
                    header("Location: admin_login");
                    exit(0);
                }

                $_SESSION['auth'] = true;
                $_SESSION['auth_role'] = $admin_type;
                $_SESSION['auth_admin'] = [
                    'admin_id' => $data['admin_id'],
                    'admin_name' => $data['firstname'] . ' ' . $data['lastname'],
                    'email' => $data['email'],
                ];

                $_SESSION['login_success'] = true; // Indicate a successful login
                header("Location: admin_login");
                exit(0);
            } else {
                // Increment login attempts on failure
                $_SESSION['login_attempts']++;
                if ($_SESSION['login_attempts'] >= 3) {
                    $_SESSION['lockout_time'] = time() + 300; // Lock out for 5 minutes
                    $_SESSION['status'] = "Too many failed attempts. You are locked out for 5 minutes.";
                } else {
                    $_SESSION['status'] = "Invalid email, password, or admin type.";
                }
                $_SESSION['status_code'] = "error";
                header("Location: admin_login");
                exit(0);
            }
        } else {
            // Increment login attempts on failure
            $_SESSION['login_attempts']++;
            if ($_SESSION['login_attempts'] >= 3) {
                $_SESSION['lockout_time'] = time() + 300; // Lock out for 5 minutes
                $_SESSION['status'] = "Too many failed attempts. You are locked out for 5 minutes.";
            } else {
                $_SESSION['status'] = "Invalid email, password, or admin type.";
            }
            $_SESSION['status_code'] = "error";
            header("Location: admin_login");
            exit(0);
        }

        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['status'] = "Something went wrong.";
        $_SESSION['status_code'] = "error";
        header("Location: admin_login");
        exit(0);
    }
}
?>
