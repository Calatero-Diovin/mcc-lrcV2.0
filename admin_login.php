<?php
ini_set('session.cookie_httponly', 1);
session_start();
include('./admin/config/dbcon.php');
include('includes/session.php');
include('includes/security_headers.php');

$request = $_SERVER['REQUEST_URI'];

if (strpos($request, '.php') !== false) {
    // Redirect to remove .php extension
    $new_url = str_replace('.php', '', $request);
    header("Location: $new_url", true, 301);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon" href="images/mcc-lrc.png">
     <title>MCC Learning Resource Center</title>
     <script src="https://hcaptcha.com/1/api.js" async defer></script>

     <!-- Alertify JS link -->
     <link rel="stylesheet" href="assets/css/alertify.min.css" />
     <link rel="stylesheet" href="assets/css/alertify.bootstraptheme.min.css" />
     <link rel="stylesheet" href="assets/css/bootstrap-icons.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

     <!-- Iconscout cdn link -->
     <link rel="stylesheet" href="assets/css/line.css">
     <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
     
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="assets/css/bootstrap5.min.css" />

     <!-- Bootstrap Icon -->
     <link rel="stylesheet" href="assets/font/bootstrap-icons.css">

     <!-- Custom CSS Styling -->
     <link rel="stylesheet" href="assets/css/login.css">


</head>

<body>
    <section class="d-flex mt-4 flex-column justify-content-center align-items-center">
        <div class="container-xl">
            <div class="col mx-auto rounded shadow bg-white">
                <div class="row">
                    <div class="col-md-6">
                        <div class="">
                            <img src="images/mcc-lrc.png" alt="logo" class="img-fluid d-none d-md-block p-5" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 px-5">
                        <div class="mt-4 mb-4">
                            <center>
                                <h1 class="m-0"><strong>MCC</strong></h1>
                                <p class="fs-4 fw-semibold text-info">Learning Resource Center</p>
                                <p class="m-0 fw-semibold">Admin Login</p>
                            </center>
                        </div>

                        <?php if (isset($_SESSION['lockout_time']) && time() < $_SESSION['lockout_time']): ?>
                            <?php
                            $lockout_time_remaining = $_SESSION['lockout_time'] - time();
                            $minutes_remaining = ceil($lockout_time_remaining / 60);
                            ?>
                            <script>
                                // Start countdown timer for lockout
                                let lockoutTimeRemaining = <?php echo $lockout_time_remaining; ?>;

                                // Disable form inputs and login button during lockout
                                const formInputs = document.querySelectorAll('#admin_type, #email, #password');
                                const loginButton = document.querySelector('[name="admin_login_btn"]');
                                formInputs.forEach(input => input.disabled = true);
                                loginButton.disabled = true;

                                // Function to update the timer every second
                                function updateLockoutTimer() {
                                    if (lockoutTimeRemaining <= 0) {
                                        document.getElementById('lockout-message').style.display = 'none';

                                        // Enable the form inputs and login button once lockout is over
                                        formInputs.forEach(input => input.disabled = false);
                                        loginButton.disabled = false;
                                    } else {
                                        let minutes = Math.floor(lockoutTimeRemaining / 60);
                                        let seconds = lockoutTimeRemaining % 60;
                                        document.getElementById('lockout-timer').textContent = `${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
                                        lockoutTimeRemaining--;
                                    }
                                }

                                // Update every second
                                setInterval(updateLockoutTimer, 1000);
                            </script>
                        <?php endif; ?>

                        <form action="admin_login_code.php" method="POST" class="needs-validation" novalidate>
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="admin_type" name="admin_type" required disabled>
                                        <option value="" selected disabled>Select Admin Type</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Staff">Staff</option>
                                    </select>
                                    <label for="admin_type">Admin Type</label>
                                    <div class="invalid-feedback">
                                        Please select an admin type.
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" id="email" class="form-control" name="email" placeholder="Email" autocomplete="off" required disabled>
                                    <label for="email">Email</label>
                                    <div id="validationServerEmailFeedback" class="invalid-feedback">
                                        Please enter your email
                                    </div>
                                </div>
                                <div class="form-floating mb-3 position-relative">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="Password" required disabled>
                                    <label for="password">Password</label>
                                    <span class="password-show-toggle js-password-show-toggle">
                                        <i class="bi bi-eye-slash" id="togglePassword"></i>
                                    </span>
                                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                        Please enter your password.
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <div class="h-captcha" data-sitekey="026a7b60-39a2-4eba-86d8-cc6e29a254fe"></div>
                                    <div class="invalid-feedback">Please complete the CAPTCHA.</div>
                                </div>
                            </div>
                            <div class="d-grid gap-2 md-3 mb-3">
                                <button type="submit" name="admin_login_btn" class="btn btn-primary text-light font-weight-bolder btn-lg" disabled <?php echo (isset($_SESSION['lockout_time']) && time() < $_SESSION['lockout_time']) ? 'disabled' : ''; ?>>Login</button>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                            <p>
                                    <a href="admin-forgot-pass.php" class="text-primary text-decoration-none fw-semibold">Forgot Password?</a>
                                </p>
                                <p>
                                    <a href="login.php" class="text-primary text-decoration-none fw-semibold">User Login</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function (e) {
            const password = document.getElementById('password');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });

        // Select form input elements to disable initially
        const formInputs = document.querySelectorAll('#admin_type, #email, #password');
        const loginButton = document.querySelector('[name="admin_login_btn"]');

        // Function to request and check location permissions
        function requestLocation() {
            if (navigator.geolocation) {
                // Watch for location changes
                const watchId = navigator.geolocation.watchPosition(
                    // Success callback
                    function (position) {
                        console.log('Location access granted');
                        // Enable form inputs and button when location is granted
                        formInputs.forEach(input => input.disabled = false);
                        loginButton.disabled = false;
                    },
                    // Error callback
                    function (error) {
                        if (error.code === error.PERMISSION_DENIED) {
                            alert("Please allow location access to use this login page.");
                            setTimeout(function() {
                                window.location.reload(); // Reload page after 5 seconds if denied
                            }, 1000);
                        }
                        // If location access is lost, disable the form inputs and login button again
                        if (error.code === error.POSITION_UNAVAILABLE || error.code === error.TIMEOUT) {
                            formInputs.forEach(input => input.disabled = true);
                            loginButton.disabled = true;
                            alert("Location access was lost. The form will reload.");
                            setTimeout(function() {
                                window.location.reload(); // Reload page after 5 seconds if location is lost
                            }, 1000);
                        }
                    }
                );

                // Optionally, you can stop watching the location after successful login or another event
                // navigator.geolocation.clearWatch(watchId);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        // Call the function to request location access on page load
        document.addEventListener('DOMContentLoaded', function () {
            requestLocation();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            <?php if (isset($_SESSION['login_success']) && $_SESSION['login_success']): ?>
                <?php unset($_SESSION['login_success']); // Clear session variable ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Login Successful',
                    showConfirmButton: false, // Hide the confirm button
                    timer: 3000, // Set the timer to 3 seconds (3000 milliseconds)
                    timerProgressBar: true, // Optional: Show the timer progress bar
                }).then(() => {
                    window.location.href = './admin/.'; // Redirect after the timer completes
                });
            <?php endif; ?>
        });
    </script>

<?php 
include('includes/script.php'); 
include('message.php'); 
?>
</body>
</html>
