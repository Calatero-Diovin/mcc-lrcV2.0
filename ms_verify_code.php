<?php
ob_start();
session_start();
include('./admin/config/dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    
    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['status'] = "Invalid email format.";
        $_SESSION['status_code'] = "error";
        header("Location: ms_verify");
        exit(0);
    }

    // Check email domain
    $domain = substr(strrchr($email, "@"), 1);
    if ($domain !== 'mcclawis.edu.ph') {
        $_SESSION['status'] = "Invalid Domain: Please enter an email address with the mcclawis.edu.ph domain.";
        $_SESSION['status_code'] = "error";
        header("Location: ms_verify");
        exit(0);
    }

    // Check if the email exists in the database
    $stmt = $con->prepare("SELECT used FROM ms_account WHERE username = ?");
    if (!$stmt) {
        error_log("MySQL prepare error: " . $con->error);
        $_SESSION['status'] = "Database error. Please try again later.";
        $_SESSION['status_code'] = "error";
        header("Location: ms_verify");
        exit(0);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($used);
    $stmt->fetch();
    $stmt->close();

    if ($used === null) {
        $_SESSION['status'] = "Email not found. Please visit the BSIT office to get MS365 Account.";
        $_SESSION['status_code'] = "error";
        header("Location: ms_verify");
        exit(0);
    }

    if ($used == 1) {
        $_SESSION['status'] = "This email has already been used.";
        $_SESSION['status_code'] = "error";
        header("Location: ms_verify");
        exit(0);
    }

    if (!getenv('EMAIL_USERNAME') || !getenv('EMAIL_PASSWORD')) {
        error_log("Environment variables not set.");
        exit("Error: Email credentials not configured.");
    }

    // Create the verification code
    $verification_code = bin2hex(random_bytes(16)); // Generate a random verification code
    $_SESSION['verification_code'] = $verification_code; // Store the code in session for later verification
    $_SESSION['email'] = $email; // Store email in session for later use

    // Update the verification code in the database
    $stmt = $con->prepare("UPDATE ms_account SET verification_code = ?, created_at = NOW() WHERE username = ?");
    if (!$stmt) {
        error_log("MySQL prepare error: " . $con->error);
        $_SESSION['status'] = "Database error. Please try again later.";
        $_SESSION['status_code'] = "error";
        header("Location: ms_verify");
        exit(0);
    }

    $stmt->bind_param("ss", $verification_code, $email);
    if (!$stmt->execute()) {
        error_log("MySQL execute error: " . $stmt->error);
        $_SESSION['status'] = "Database error. Please try again later.";
        $_SESSION['status_code'] = "error";
        header("Location: ms_verify");
        exit(0);
    }
    $stmt->close();

    // Send the email using PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->SMTPDebug = 2; // Set to 2 for more verbose output

        $mail->isSMTP();
        $mail->Host       = 'smtp.office365.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'mcc-lrc@mcclawis.edu.ph'; // Your Office 365 email
        $mail->Password   = 'mann1234!?'; // Your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom('mcc-lrc@mcclawis.edu.ph', 'MCC LEARNING RESOURCE CENTER'); // Your email and name
        $mail->addAddress($email); // Add recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'MS 365 Account Verification';
        $mail->Body    = 'Click the following link to verify your account: <a href="https://mcc-lrc.com/signup?code=' . $verification_code . '">Verify Account</a>';
        $mail->AltBody = 'Click the following link to verify your account: https://mcc-lrc.com/signup?code=' . $verification_code;

        $mail->send();
        $_SESSION['status'] = "Verification link has been sent to your email.";
        $_SESSION['status_code'] = "success";
        header("Location: ms_verify");
    } catch (Exception $e) {
        $_SESSION['status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        $_SESSION['status_code'] = "error";
        header("Location: ms_verify");
    }
} else {
    $_SESSION['status'] = "Invalid request method.";
    $_SESSION['status_code'] = "error";
    header("Location: ms_verify");
}

ob_end_flush();
?>
