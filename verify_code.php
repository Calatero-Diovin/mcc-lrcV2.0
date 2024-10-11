<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/vendor/phpmailer/phpmailer/src/Exception.php';
require 'phpmailer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'phpmailer/vendor/phpmailer/phpmailer/src/SMTP.php';

// After the login process, generate and send a verification code
if (isset($_POST['admin_email'])) {
    $email = $_POST['admin_email'];
    $verification_code = rand(100000, 999999); // Generate a random 6-digit code

    // Save the verification code in session for later verification
    $_SESSION['verification_code'] = $verification_code;
    $_SESSION['verification_email'] = $email;

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';                   // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                               // Enable SMTP authentication
        $mail->Username   = 'mcclearningresourcecenter@gmail.com';           // SMTP username
        $mail->Password   = 'qxbi jqnf hgfn lkih';                    // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;     // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                  // TCP port to connect to

        // Recipients
        $mail->setFrom('mcclearningresourcecenter@gmail.com', 'MCC Learning Resource Center');
        $mail->addAddress($email);     // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Your Verification Code';
        $mail->Body    = "Your verification code is: <strong>$verification_code</strong>";

        // Send the email
        $mail->send();

        // Redirect or show a success message
        header("Location: admin_login");
        exit();
    } catch (Exception $e) {
        $_SESSION['status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        $_SESSION['status_code'] = "error";
        header("Location: admin_login"); // Redirect back to login
        exit();
    }
}

// Verify the entered code
if (isset($_POST['verification_code'])) {
    $entered_code = $_POST['verification_code'];

    if ($entered_code == $_SESSION['verification_code']) {
        // Successful verification
        $_SESSION['auth'] = true; // Continue the session
        unset($_SESSION['verification_code']); // Clear the code from the session

        header("Location: ./admin/."); // Redirect to the dashboard or home
        exit();
    } else {
        $_SESSION['status'] = "Invalid verification code.";
        $_SESSION['status_code'] = "error";
        header("Location: admin_login"); // Redirect back to login
        exit();
    }
}
?>
