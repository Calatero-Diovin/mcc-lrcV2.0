<?php 
ini_set('session.cookie_httponly', 1);
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon" href="images/mcc-lrc.png">
     <title>Reset Password</title>
     
     <!-- Alertify JS link -->
     <link rel="stylesheet" href="assets/css/alertify.min.css" />
     <link rel="stylesheet" href="assets/css/alertify.bootstraptheme.min.css" />
     <link rel="stylesheet" href="assets/css/bootstrap-icons.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">

     <!-- Iconscout cdn link -->
     <link rel="stylesheet" href="assets/css/line.css">
     <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
     
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="assets/css/bootstrap5.min.css" />

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
          .form-container {
               margin-top: 60px;
          }
     </style>
</head>

<body>
     <section class="d-flex mt-1 flex-column justify-content-center align-items-center">
          <div class="container">
               <div class="row justify-content-center">
                    <a href="login" class="back">
                         <i class="bi bi-arrow-left-circle-fill m-3"></i>
                    </a>
                    <div class="col-md-6 col-lg-4 form-container">
                         <div class="text-center">
                              <img src="images/mcc-lrc.png" alt="logo" class="img-fluid d-none d-md-block" />
                              <h4 class="m-0">Reset Your Password</h4>
                              <p class="fs-4 fw-semibold text-primary">Enter your email to reset your password</p>
                         </div>
                         <form action="password-reset-code.php" method="POST" class="needs-validation" novalidate>
                              <div class="form-floating mb-3">
                                   <input type="email" id="email" class="form-control" name="email" placeholder="Email" required>
                                   <label for="email">Email</label>
                                   <div class="invalid-feedback">Please enter your email.</div>
                              </div>
                              <div class="d-grid gap-2">
                                   <button type="submit" name="password_reset_link" class="btn btn-primary text-light font-weight-bolder btn-lg">Send Password Reset Link</button>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </section>

     <script>
          (function() {
               'use strict';
               var forms = document.querySelectorAll('.needs-validation');
               Array.prototype.slice.call(forms).forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                         if (!form.checkValidity()) {
                              event.preventDefault();
                              event.stopPropagation();
                         }
                         form.classList.add('was-validated');
                    }, false);
               });
          })();
     </script>
     <?php include('includes/script.php'); ?>
</body>

</html>
