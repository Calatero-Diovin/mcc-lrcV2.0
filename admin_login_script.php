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