<?php
ini_set('session.cookie_httponly', 1);
session_start();
include('./admin/config/dbcon.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon" href="./images/mcc-lrc.png">
     <title>MS 365 Verification</title>

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
          <div class="container-xl">
               <div class="col mx-auto rounded shadow bg-white">
                    <div class="row">
                    <a href="login" class="back">
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
                                        <h1 class="m-0"><strong>MS 365 Account Verification</strong></h1>
                                        <p class="fs-4 fw-semibold text-info">Enter your MS 365 Username account to receive a registration link.</p>
                                   </center>
                              </div>
                              <form action="ms_verify_code.php" method="POST" class="needs-validation" novalidate>
                                   <div class="col-md-12">
                                        <div class="form-floating mb-3">
                                             <input type="email" id="email" class="form-control" name="email" placeholder="MS 365 Email" required>
                                             <label id="student_id_label" for="student_id">Student ID No.</label>
                                             <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                                  Please enter your MS 365 Email.
                                             </div>
                                        </div>
                                   </div>
                                   <div class="d-grid gap-2 md-3">
                                        <button type="submit" name="registration_link" class="btn btn-primary text-light font-weight-bolder btn-lg">Send Registration Link</button>
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

     <?php
     // Include scripts and message handling here
     include('includes/script.php');
     include('message.php'); 
     ?>
</body>

</html>
