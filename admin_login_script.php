<script>
    document.getElementById('togglePassword').addEventListener('click', function (e) {
        const password = document.getElementById('password');
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });

    const formInputs = document.querySelectorAll('#admin_type, #email, #password');
    const loginButton = document.querySelector('[name="admin_login_btn"]');

    function requestLocation() {
        Swal.fire({
            title: 'Allow Location Access?',
            text: 'To proceed with login, location access is required. Do you want to allow location access?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Allow',
            cancelButtonText: 'Block',
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {
                // User clicked 'Allow'
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function (position) {
                            console.log('Location access granted');
                            formInputs.forEach(input => input.disabled = false);
                            loginButton.disabled = false;
                        },
                        function (error) {
                            // Handle different error cases (permission denied, position unavailable, timeout)
                            if (error.code === error.PERMISSION_DENIED) {
                                Swal.fire({
                                    title: 'Permission Denied',
                                    text: "Please allow location access to use this login page.",
                                    icon: 'warning',
                                    showConfirmButton: true,
                                    allowOutsideClick: false
                                });
                            }

                            if (error.code === error.POSITION_UNAVAILABLE || error.code === error.TIMEOUT) {
                                Swal.fire({
                                    title: 'Location Lost',
                                    text: "Location access was lost. The form will reload.",
                                    icon: 'error',
                                    showConfirmButton: false,
                                    allowOutsideClick: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                }).then(() => {
                                    setTimeout(function() {
                                        window.location.reload();
                                    }, 1000);
                                });
                            }
                        }
                    );
                } else {
                    Swal.fire({
                        title: 'Geolocation Not Supported',
                        text: "Geolocation is not supported by this browser.",
                        icon: 'error',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    }).then(() => {
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    });
                }
            } else {
                // User clicked 'Block'
                Swal.fire({
                    title: 'Location Blocked',
                    text: "You have blocked location access. You will not be able to proceed with login.",
                    icon: 'error',
                    showConfirmButton: true,
                    allowOutsideClick: false
                });
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        requestLocation();
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            <?php if (isset($_SESSION['login_success']) && $_SESSION['login_success']): ?>
                <?php unset($_SESSION['login_success']); ?>
                Swal.fire({
                    title: 'Logging in...',
                    html: '<div class="progress" style="width: 100%; height: 20px;"><div id="progress-bar" class="progress-bar" role="progressbar" style="width: 0%;"></div></div>',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        let progressBar = document.getElementById('progress-bar');
                        let width = 0;
                        let interval = setInterval(() => {
                            if (width >= 100) {
                                clearInterval(interval);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Login Successful',
                                    showConfirmButton: false,
                                    allowOutsideClick: false,
                                    timer: 1500, 
                                }).then(() => {
                                    window.location.href = 'admin/.'; 
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