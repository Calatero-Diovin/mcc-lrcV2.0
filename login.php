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
     <link rel="icon" href="./images/mcc-lrc.png">
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

     <style>
          .back {
               font-size: 30px;
               color: black;
          }
          .back:hover {
               color: gray;
          }
          
          @media (max-width: 900px) {
               #admin {
                    display: none;
               }
          }
     </style>
</head>

<body>
     <section class="d-flex mt-1 flex-column justify-content-center align-items-center">
          <div class="container-xl">
               <div class="col mx-auto rounded shadow bg-white">
                    <div class="row">
                    <a href="." class="back">
                              <i class="bi bi-arrow-left-circle-fill m-3"></i>
                         </a>
                         <div class="col-md-6 ">
                              <div class="">
                                   <img src="images/mcc-lrc.png" alt="logo"
                                        class="img-fluid d-none d-md-block  p-5" />
                              </div>
                         </div>
                         <div class="col-sm-12 col-md-6 px-5 ">
                              <div class="mb-4">
                                   <center>
                                        <h1 class="m-0"><strong>MCC</strong></h1>
                                        <p class="fs-4 fw-semibold text-info">Learning Resource Center</p>
                                        <p class="m-0 fw-semibold">Login Form</p>
                                   </center>
                              </div>

                              <?php if (isset($_SESSION['lockout_times']) && time() < $_SESSION['lockout_times']): ?>
                                   <?php
                                   $lockout_time_remaining = $_SESSION['lockout_times'] - time();
                                   $minutes_remaining = ceil($lockout_time_remaining / 60);
                                   ?>
                                   <script>
                                        // Lockout detected, disable form elements
                                        document.addEventListener('DOMContentLoaded', function() {
                                             document.getElementById('role_as').disabled = true;
                                             document.getElementById('student_id').disabled = true;
                                             document.getElementById('password').disabled = true;
                                             document.querySelector('button[type="submit"]').disabled = true;
                                        });
                                   </script>
                              <?php endif; ?>
                              <form action="logincode.php" method="POST" class="needs-validation" novalidate>
                                   <div class="col-md-12 mb-3">
                                        <label for="role_as" class="form-label">Login As:</label>
                                        <select class="form-select" id="role_as" name="role_as" required>
                                             <option value="" disabled selected>Select Role</option>
                                             <option value="student">Student</option>
                                             <option value="faculty">Faculty</option>
                                             <option value="staff">Staff</option>
                                        </select>
                                        <div class="invalid-feedback">Please select your role.</div>
                                   </div>
                                   <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                             <input type="text" id="student_id" class="form-control" name="student_id" placeholder="Student ID No" autocomplete="off" required maxlength="9">
                                             <label id="student_id_label" for="student_id">Student ID No.</label>
                                             <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                                  Please enter your Student ID No.
                                             </div>
                                        </div>
                                        <div class="form-floating mb-3">
    <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
    <label for="password">Password</label>
    <div id="validationServerUsernameFeedback" class="invalid-feedback">
        Please enter your password.
    </div>
    <span class="position-absolute end-0 top-50 translate-middle-y me-3" style="cursor: pointer;">
        <i class="fa fa-eye" id="togglePassword"></i>
    </span>
</div>
                                        <div class="mb-3">
                                             <div class="h-captcha" data-sitekey="efeaffaa-08fc-4c18-9b88-9d44d18c8a48"></div>
                                        </div>
                                   </div>
                                   <div class="d-grid gap-2 md-3">
                                        <button type="submit" name="login_btn" class="btn btn-primary text-light font-weight-bolder btn-lg">Login</button>
                                        <div class="text-center mb-3">
                                             <p>
                                                  Don't have an account?
                                                  <a href="./ms_verify.php" class="text-primary text-decoration-none fw-semibold">Signup</a>
                                             </p>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                        <p>
                                                  <a href="password-reset.php" class="text-primary text-decoration-none fw-semibold">Forgot Password?</a>
                                             </p>
                                             <p id="admin">
                                                  <a href="admin_login.php" class="text-primary text-decoration-none fw-semibold">Admin Login</a>
                                             </p>
                                        </div>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
     </section>

     <!-- Alertify JS link -->
     <script src="assets/js/alertify.min.js"></script>

     <!-- Custom JS link -->
     <script src="assets/js/script.js"></script>

     <script>
    const togglePassword = document.getElementById("togglePassword");
    const password = document.getElementById("password");

    togglePassword.addEventListener("click", function () {
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);

        // Toggle the eye icon
        this.classList.toggle("fa-eye");
        this.classList.toggle("fa-eye-slash");
    });
</script>

     <script>
     document.addEventListener('DOMContentLoaded', function() {
    const roleSelect = document.getElementById('role_as');
    const studentIdLabel = document.getElementById('student_id_label');
    const studentIdInput = document.getElementById('student_id');

    // Function to setup the input field based on role
    function setupInputField() {
        if (roleSelect.value === 'faculty' || roleSelect.value === 'staff') {
            studentIdLabel.textContent = 'Username';
            studentIdInput.placeholder = 'Enter your username';
            studentIdInput.removeAttribute('maxlength'); // No limit for username
            studentIdInput.removeEventListener('input', formatStudentID); // No formatting
        } else {
            studentIdLabel.textContent = 'Student ID No.';
            studentIdInput.placeholder = 'Enter your Student ID No. (e.g., 2021-1055)';
            studentIdInput.setAttribute('maxlength', '9'); // Limit for student ID
            studentIdInput.addEventListener('input', formatStudentID); // Add formatting
        }
    }

    // Event listener for role select change
    roleSelect.addEventListener('change', setupInputField);

    // Initial setup based on default role selection
    setupInputField();

    function formatStudentID(event) {
        let value = studentIdInput.value;

        // Allow only digits and a single dash
        if (/[^0-9-]/.test(value)) {
            studentIdInput.value = value.replace(/[^0-9-]/g, '');
        }
    }
});
     </script>

     <?php
     // Include scripts and message handling here
     include('includes/script.php');
     include('message.php'); 
     ?>
</body>

</html>
