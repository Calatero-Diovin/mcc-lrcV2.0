<?php
ini_set('session.cookie_httponly', 1);
session_start();
include('./admin/config/dbcon.php');
include('includes/url.php');

// Get the current request URL
$request = $_SERVER['REQUEST_URI'];

// Redirect to remove .php extension
if (strpos($request, '.php') !== false) {
    $new_url = str_replace('.php', '', $request);
    header("Location: $new_url", true, 301);
    exit();
}

// Check if the email is stored in the session (after OTP verification)
if (!isset($_SESSION['email_for_reset'])) {
    header("Location: 404.php"); // Redirect if the user didn't verify OTP
    exit(0);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/mcc-lrc.png">
    <title>New Password</title>

    <!-- Alertify JS link -->
    <link rel="stylesheet" href="assets/css/alertify.min.css" />
    <link rel="stylesheet" href="assets/css/alertify.bootstraptheme.min.css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

    <!-- Iconscout CDN link -->
    <link rel="stylesheet" href="assets/css/line.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap5.min.css" />

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="assets/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">

    <!-- Custom CSS Styling -->
    <link rel="stylesheet" href="assets/css/login.css">

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

    <!-- SweetAlert JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <style>
        .back {
            position: fixed;
            left: 20px;
            top: 10px;
            font-size: 30px;
            color: black;
        }
        .back:hover {
            color: gray;
        }
    </style>
</head>

<body>
    <section class="d-flex mt-1 flex-column justify-content-center align-items-center">
        <div class="container-xl">
            <div class="col mx-auto rounded shadow bg-white">
                <div class="row">
                    <div class="col-md-6">
                        <div class="">
                            <img src="images/mcc-lrc.png" alt="logo" class="img-fluid d-none d-md-block p-5" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 px-5" style="margin-top: 50px;">
                        <div class="mt-3 mb-4">
                            <center>
                                <h4 class="m-0">Set New Password</h4>
                                <p class="fs-4 fw-semibold text-primary">Enter new password.</p>
                            </center>
                        </div>
                        <form action="password-reset-otp-code.php" method="POST" class="needs-validation" novalidate style="margin-top:30px;" onsubmit="return validatePassword()">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="password" id="passwordInput" class="form-control" name="new_password" placeholder="New Password" required>
                                    <label for="password">New Password</label>
                                    <div id="passwordLengthFeedback" class="invalid-feedback">
                                        Password must be at least 8 characters long.
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" id="confirmPasswordInput" class="form-control" name="cpassword" placeholder="Confirm New Password" required>
                                    <label for="cpassword">Confirm Password</label>
                                    <div id="passwordMatchFeedback" class="invalid-feedback">
                                        Passwords do not match.
                                    </div>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="showPasswordCheckbox" onclick="togglePasswordVisibility()">
                                    <label class="form-check-label" for="showPasswordCheckbox">Show Password</label>
                                </div>
                            </div>
                            <div class="d-grid gap-2 md-3">
                                <button type="submit" name="password-change" class="btn btn-primary text-light font-weight-bolder btn-lg">Submit</button>
                            </div>
                            <div class="text-end mt-5 fw-bold">
                                        <!-- <p>
                                             <a href="login" class="text-primary text-decoration-none fw-semibold">User Login</a>
                                        </p> -->
                                   </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function validatePassword() {
            var password = document.getElementById("passwordInput").value;
            var cpassword = document.getElementById("confirmPasswordInput").value;
            var isValid = true;

            // Check for XSS in password fields
            var xssPattern = /<[^>]*>/; // Simple pattern to detect HTML tags
            if (xssPattern.test(password) || xssPattern.test(cpassword)) {
                swal("Invalid Input", "I got your IP Address.", "error");
                isValid = false;
            }

            return isValid;
        }

        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('passwordInput');
            const confirmPasswordInput = document.getElementById('confirmPasswordInput');
            const showPasswordCheckbox = document.getElementById('showPasswordCheckbox');

            if (showPasswordCheckbox.checked) {
                passwordInput.type = 'text';
                confirmPasswordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
                confirmPasswordInput.type = 'password';
            }
        }
    </script>
</body>

</html>
