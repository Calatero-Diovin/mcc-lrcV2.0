<?php 
ini_set('session.cookie_httponly', 1);
session_start();

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
     </style>
</head>

<body>
     <section class="d-flex mt-1 flex-column justify-content-center align-items-center">
          <div class="container">
               <div class="col mx-auto rounded shadow bg-white">
                    <div class="row">
                         <div class="col-md-6 ">
                              <div class="">
                                   <img src="images/mcc-lrc.png" alt="logo"
                                        class="img-fluid d-none d-md-block  p-5" />
                              </div>
                         </div>
                         <div class="col-sm-12 col-md-6 px-5 " style="margin-top: 60px;">
                              <div class="mt-3 mb-4">
                                   <center>
                                        <h4 class="m-0">
                                             Reset Your Password
                                        </h4>
                                        <p class="fs-4 fw-semibold text-primary">Enter your email to reset your password</p>
                                   </center>
                              </div>
                              <form action="admin-forgot-code.php" method="POST" class="needs-validation" novalidate
                              style="margin-top:30px;">
                                   <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                             <input type="email" id="email" class="form-control"
                                                  name="email" placeholder="Email" required>
                                             <label for="email">Email</label>
                                             <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                                  Please enter your email.
                                             </div>
                                        </div>
                                   </div>
                                   <div class="d-grid gap-2 md-3">
                                        <button type="submit" name="password_reset_link"
                                             class="btn btn-primary text-light font-weight-bolder btn-lg">Send Password Reset Link</button>
                                   </div>
                                   <div class="text-end mt-5 fw-bold">
                                        <p>
                                             <a href="admin_login" class="text-primary text-decoration-none fw-semibold">Admin Login</a>
                                        </p>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
     </section>

     <script>
          // Function to validate the form
          (function() {
               'use strict';

               // Fetch all the forms we want to apply custom Bootstrap validation styles to
               var forms = document.querySelectorAll('.needs-validation');

               // Loop over them and prevent submission
               Array.prototype.slice.call(forms)
                    .forEach(function(form) {
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
