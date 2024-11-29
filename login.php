<?php
include('login_head.php');
?>
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
                                        document.addEventListener('DOMContentLoaded', function() {
                                             // Disable form fields if lockout is active
                                             const formInputs = document.querySelectorAll('#role_as, #student_id, #password');
                                             const loginButton = document.getElementById('user_login_btn');
                                             
                                             // Disable the form elements
                                             formInputs.forEach(input => input.disabled = true);
                                             loginButton.disabled = true;

                                             // Show SweetAlert with loader
                                             Swal.fire({
                                                  title: 'Account Locked',
                                                  text: "Your account is locked. Please wait " + <?php echo $minutes_remaining; ?> + " minute(s) before trying again.",
                                                  icon: 'warning',
                                                  showConfirmButton: false,  // No confirm button
                                                  allowOutsideClick: false,  // Prevent clicking outside the modal
                                                  allowEscapeKey: false,     // Prevent closing with the Escape key
                                                  didOpen: () => {
                                                       // Show the loading spinner
                                                       Swal.showLoading();
                                                  }
                                             }).then(() => {
                                                  setTimeout(function() {
                                                       // Reload page after a short delay if needed
                                                       window.location.reload(); // Optionally reload the page to reset the session or other necessary actions
                                                  }, 1000);
                                             });
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
                                             <span class="password-show-toggle js-password-show-toggle"><span class="uil"></span></span>
                                             <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
                                             <label for="password">Password</label>
                                             <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                                  Please enter your password.
                                             </div>
                                        </div>
                                        <div class="mb-3">
                                             <div class="h-captcha" data-sitekey="026a7b60-39a2-4eba-86d8-cc6e29a254fe"></div>
                                             <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                                  Please complete the CAPTCHA.
                                             </div>
                                        </div>
                                   </div>
                                   <div class="d-grid gap-2 md-3">
                                        <button type="submit" id="user_login_btn" name="login_btn" class="btn btn-primary text-light font-weight-bolder btn-lg">Login</button>
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
<?php
include('login_script.php');
?>