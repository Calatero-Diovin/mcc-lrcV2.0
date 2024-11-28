<?php
include('authentication.php');
include('includes/url.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/vendor/phpmailer/phpmailer/src/Exception.php';
require 'phpmailer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'phpmailer/vendor/phpmailer/phpmailer/src/SMTP.php';


if(isset($_POST['delete_admin']))
{
     $admin_id = mysqli_real_escape_string($con, $_POST['delete_admin']);

     $check_img_query = "SELECT * FROM admin WHERE admin_id ='$admin_id'";
     $img_result = mysqli_query($con, $check_img_query);
     $result_data = mysqli_fetch_array($img_result);

     $admin_image = $result_data['admin_image'];

     $query = "DELETE FROM admin WHERE admin_id ='$admin_id'";
     $query_run = mysqli_query($con, $query);

     if($query_run)
     {
          if(file_exists('../uploads/admin_profile/'.$admin_image))
          {
               unlink("../uploads/admin_profile/".$admin_image);
          }

          $_SESSION['status'] = 'Admin Deleted Successfully';
          $_SESSION['status_code'] = "success";
          header("Location: admin.php");
          exit(0);
     }
     else
     {
          $_SESSION['status'] = 'Admin Not Deleted';
          $_SESSION['status_code'] = "error";
          header("Location: admin.php");
          exit(0);
     }
}


// Update Admin
if (isset($_POST['edit_admin'])) {
    $admin_id = mysqli_real_escape_string($con, $_POST['admin_id']);

    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($con, $_POST['middlename']);
    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $phone_number = mysqli_real_escape_string($con, $_POST['phone_number']);
    $admin_type = mysqli_real_escape_string($con, $_POST['admin_type']);
    
    $old_admin_filename = $_POST['old_admin_image'];
    $admin_image = $_FILES['admin_image']['name'];
    $update_admin_filename = $old_admin_filename;

    // Allowed file extensions
    $allowedExtensions = ['jpg', 'jpeg', 'png'];
    $admin_extension = pathinfo($admin_image, PATHINFO_EXTENSION);

    // Check if the uploaded file is of valid type
    if ($admin_image != NULL && !in_array(strtolower($admin_extension), $allowedExtensions)) {
        $_SESSION['status'] = 'Invalid file format! Only JPG, JPEG, and PNG are allowed.';
        $_SESSION['status_code'] = "error";
        header("Location: admin_edit.php?e=" . encryptor('encrypt',$admin_id));
        exit(0);
    }

    if ($admin_image != NULL) {
        // Rename the Image
        $admin_filename = time() . '.' . $admin_extension;
        $update_admin_filename = $admin_filename;
    }

    // Generate a random OTP consisting of numbers and alphabets
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';  // Letters (both upper and lowercase) and digits
    $otp_length = 8;  // Define the length of the OTP (you can change this as needed)
    $otp = '';

    // Generate a random OTP
    for ($i = 0; $i < $otp_length; $i++) {
        $otp .= $characters[random_int(0, strlen($characters) - 1)];  // Pick a random character from $characters
    }

    $_SESSION['otp'] = $otp;

    $mail = new PHPMailer(true);

    try {
        // SMTP server configuration
        $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // Outlook/Microsoft 365 SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'mcclearningresourcecenter2.0@gmail.com'; // Your Outlook/Microsoft 365 email address
            $mail->Password   = 'mbuq bvbh wtst tnsr'; // Your email account password or app password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use TLS encryption
            $mail->Port       = 587; // Port for TLS

            //Recipients
            $mail->setFrom('mcclearningresourcecenter2.0@gmail.com', 'MCC Learning Resource Center');
            $mail->addAddress($email); // Recipient's email address

        // Email content settings
        $mail->isHTML(true);
        $mail->Subject = 'Verify Your Email - OTP for Update';
        $mail->Body = "
        <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                        margin: 0;
                        padding: 0;
                    }
                    .container {
                        width: 80%;
                        margin: 20px auto;
                        padding: 20px;
                        background-color: #fff;
                        border-radius: 8px;
                        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                    }
                    .header {
                        text-align: center;
                        padding-bottom: 20px;
                        border-bottom: 1px solid #ddd;
                    }
                    .logo {
                        max-width: 150px;
                        height: auto;
                    }
                    .content {
                        padding: 20px 0;
                    }
                    .button {
                        display: inline-block;
                        padding: 10px 20px;
                        background-color: #007bff;
                        text-decoration: none;
                        color: white;
                        border-radius: 4px;
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        <img src='https://mcc-lrc.com/images/mcc-lrc.png' alt='Logo'>
                    </div>
                    <div class='content'>
                        <p>Hello,</p>
                        <p>Please use the following OTP to verify your identity and proceed with updating your profile:</p>
                        <h1 style='color:#198754;text-align:center;'><b>$otp</b></h1>
                        <p>If you did not updating your profile. Ignore this.</p>
                    </div>
                </div>
            </body>
        </html>
        ";

        $mail->send();

        echo json_encode([
            'status' => 'success',
            'message' => 'OTP has been sent to your email. Please verify to proceed.'
        ]);
        exit;
    } catch (Exception $e) {
        $_SESSION['status'] = "Mailer Error: {$mail->ErrorInfo}";
        $_SESSION['status_code'] = "error";
        header("Location: admin_edit.php?e=" . encryptor('encrypt', $admin_id));
        exit(0);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the posted OTP and admin_id
    $entered_otp = mysqli_real_escape_string($con, $_POST['otp']);
    $admin_id = mysqli_real_escape_string($con, encryptor('decrypt', $_POST['admin_id'])); // Decrypt admin ID

    // Check if the OTP matches the one stored in the session
    if ($entered_otp == $_SESSION['otp']) {
        // OTP is correct
        echo json_encode(['status' => 'success']);
    } else {
        // OTP is incorrect
        echo json_encode(['status' => 'error']);
    }
}


// Add Admin
if (isset($_POST['add_admin'])) {
    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($con, $_POST['middlename']);
    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $phone_number = mysqli_real_escape_string($con, $_POST['phone_number']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_ARGON2I);
    $admin_type = mysqli_real_escape_string($con, $_POST['admin_type']);
    $admin_image = $_FILES['admin_image']['name'];

    // Check if the email is from @mcclawis.edu.ph domain
    if (strpos($email, '@mcclawis.edu.ph') === false) {
        $_SESSION['status'] = 'Email must be from @mcclawis.edu.ph domain';
        $_SESSION['status_code'] = "error";
        header("Location: admin_add");
        exit(0);
    }

    // Check if the email exists in ms_account table
    $email_check_query = "SELECT * FROM ms_account WHERE username = '$email'";
    $email_check_result = mysqli_query($con, $email_check_query);

    if (mysqli_num_rows($email_check_result) == 0) {
        $_SESSION['status'] = 'Email not found. Please visit the BSIT office to get registered.';
        $_SESSION['status_code'] = "error";
        header("Location: admin_add.php");
        exit(0);
    }

    // Check if the email already exists in admin table
    $email_check_query_admin = "SELECT * FROM admin WHERE email = '$email'";
    $email_check_result_admin = mysqli_query($con, $email_check_query_admin);

    if (mysqli_num_rows($email_check_result_admin) > 0) {
        $_SESSION['status'] = 'Email already exists.';
        $_SESSION['status_code'] = "error";
        header("Location: admin_add.php");
        exit(0);
    }

    // Check if the admin image is provided
    if (empty($admin_image)) {
        $_SESSION['status'] = 'Image is required. Please upload an image in JPG, JPEG, or PNG format.';
        $_SESSION['status_code'] = "error";
        header("Location: admin_add.php");
        exit(0);
    }

    // Check the file extension
    $allowedExtensions = ['jpg', 'jpeg', 'png'];
    $admin_extension = pathinfo($admin_image, PATHINFO_EXTENSION);
    
    if (!in_array(strtolower($admin_extension), $allowedExtensions)) {
        $_SESSION['status'] = 'Invalid file format! Only JPG, JPEG, and PNG are allowed.';
        $_SESSION['status_code'] = "error";
        header("Location: admin_add.php");
        exit(0);
    }

    // Rename the Image
    $admin_filename = time() . '.' . $admin_extension;

    // Insert into admin table
    $query = "INSERT INTO admin (firstname, middlename, lastname, email, address, phone_number, password, admin_image, admin_type, admin_added) 
              VALUES ('$firstname', '$middlename', '$lastname', '$email', '$address', '$phone_number', '$hashed_password', '$admin_filename', '$admin_type', NOW())";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        move_uploaded_file($_FILES['admin_image']['tmp_name'], '../uploads/admin_profile/' . $admin_filename);
        $_SESSION['status'] = 'Admin Added successfully';
        $_SESSION['status_code'] = "success";
        header("Location: admin.php");
        exit(0);
    } else {
        $_SESSION['status'] = 'Admin not Added';
        $_SESSION['status_code'] = "error";
        header("Location: admin.php");
        exit(0);
    }
}

?>