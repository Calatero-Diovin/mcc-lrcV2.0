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
     <title>Choose to Reset Password</title>
     
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
          .reset-option:hover {
            color: #0056b3;
        }

        .form-floating:hover {
            background-color: #e9ecef;
            cursor: pointer;
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
                                             Choose to Reset Your Password
                                        </h4>
                                   </center>
                              </div>
                              <div class="col-md-12">
                                <a href="password-reset-otp.php" class="form-floating mb-3 p-3" style="text-decoration: none; border: 2px solid #ddd; border-radius: 20px; background-color: #f9f9f9; display: flex; align-items: center; justify-content: space-between; transition: background-color 0.3s;">
                                    <span><i class="bi bi-envelope" style="font-size: 2rem; color: #007bff;"></i></span>
                                    <p class="reset-option" style="font-size: 1.2rem; color: #007bff; font-weight: bold; transition: color 0.3s;">Reset via Email OTP<br><small>Receive a code via email</small></button></p>
                                </a>
                                <a href="password-reset.php" class="form-floating mb-3 p-3" style="text-decoration: none; border: 2px solid #ddd; border-radius: 20px; background-color: #f9f9f9; display: flex; align-items: center; justify-content: space-between; transition: background-color 0.3s;">
                                    <span><i class="bi bi-link-45deg" style="font-size: 2rem; color: #007bff;"></i></span>
                                    <p class="reset-option" style="text-decoration: none; font-size: 1.2rem; color: #007bff; font-weight: bold; transition: color 0.3s;">Reset via Email Link<br><small>Receive a code via email</small></p>
                                </a>
                              </div>
                                   <div class="text-end mt-5 fw-bold">
                                        <p>
                                             <a href="login" class="text-primary text-decoration-none fw-semibold">User Login</a>
                                        </p>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
     </section>
<?php include('includes/script.php'); ?>
</body>
</html>
