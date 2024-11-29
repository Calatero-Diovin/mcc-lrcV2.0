<?php
include('admin_login_head.php');
?>
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
                            document.addEventListener('DOMContentLoaded', function() {
                                // Disable form fields if lockout is active
                                const formInputs = document.querySelectorAll('#admin_type, #email, #password');
                                const loginButton = document.getElementById('admin_login_btn');
                                
                                formInputs.forEach(input => input.disabled = true);
                                loginButton.disabled = true;
                            });
                        </script>
                    <?php endif; ?>

                    <form action="admin_login_code.php" method="POST" class="needs-validation" novalidate>
                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="admin_type" name="admin_type" required <?php if (isset($lockout_time_remaining)) echo 'disabled'; ?>>
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
                                <input type="email" id="email" class="form-control" name="email" placeholder="Email" autocomplete="off" required <?php if (isset($lockout_time_remaining)) echo 'disabled'; ?>>
                                <label for="email">Email</label>
                                <div id="validationServerEmailFeedback" class="invalid-feedback">
                                    Please enter your email
                                </div>
                            </div>
                            <div class="form-floating mb-3 position-relative">
                                <input type="password" id="password" class="form-control" name="password" placeholder="Password" required <?php if (isset($lockout_time_remaining)) echo 'disabled'; ?>>
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
                            <button type="submit" name="admin_login_btn" id="admin_login_btn" class="btn btn-primary text-light font-weight-bolder btn-lg" <?php if (isset($lockout_time_remaining)) echo 'disabled'; ?>>Login</button>
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
            // Check if lockout is active, if not, proceed with enabling the form
            <?php if (!isset($lockout_time_remaining) || time() >= $_SESSION['lockout_time']): ?>
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
                            Swal.fire({
                                title: 'Permission Denied',
                                text: "Please allow location access to use this login page.",
                                icon: 'warning',
                                showConfirmButton: false, // Hide the confirm button
                                didOpen: () => {
                                    // Show a loading spinner
                                    Swal.showLoading();
                                }
                            }).then(() => {
                                setTimeout(function() {
                                    window.location.reload(); // Reload page after 1 second
                                }, 1000);
                            });
                        }

                        // If location access is lost, disable the form inputs and login button again
                        if (error.code === error.POSITION_UNAVAILABLE || error.code === error.TIMEOUT) {
                            Swal.fire({
                                title: 'Location Lost',
                                text: "Location access was lost. The form will reload.",
                                icon: 'error',
                                showConfirmButton: false, // Hide the confirm button
                                didOpen: () => {
                                    // Show a loading spinner
                                    Swal.showLoading();
                                }
                            }).then(() => {
                                setTimeout(function() {
                                    window.location.reload(); // Reload page after 1 second
                                }, 1000);
                            });
                        }
                    }
                );
            <?php endif; ?>
        } else {
            Swal.fire({
                title: 'Geolocation Not Supported',
                text: "Geolocation is not supported by this browser.",
                icon: 'error',
                showConfirmButton: false, // Hide the confirm button
                didOpen: () => {
                    // Show a loading spinner for immediate redirection or handling
                    Swal.showLoading();
                }
            }).then(() => {
                setTimeout(function() {
                    window.location.reload(); // Reload page after 1 second
                }, 1000);
            });
        }
    }

    // Call the function to request location access on page load
    document.addEventListener('DOMContentLoaded', function () {
        requestLocation();
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            <?php if (isset($_SESSION['login_success']) && $_SESSION['login_success']): ?>
                <?php unset($_SESSION['login_success']); // Clear session variable ?>
                Swal.fire({
                    title: 'Logging in...',
                    html: '<div class="progress" style="width: 100%; height: 20px;"><div id="progress-bar" class="progress-bar" role="progressbar" style="width: 0%;"></div></div>',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        // Custom progress bar logic
                        let progressBar = document.getElementById('progress-bar');
                        let width = 0;
                        let interval = setInterval(() => {
                            if (width >= 100) {
                                clearInterval(interval);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Login Successful',
                                    showConfirmButton: false, // No confirm button
                                    timer: 1500, // Auto-close the alert after 1.5 seconds
                                }).then(() => {
                                    window.location.href = 'admin/.'; // Redirect after showing SweetAlert
                                });
                            } else {
                                width++;
                                progressBar.style.width = width + '%';
                            }
                        }, 30);
                    }
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
