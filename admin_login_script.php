<script>
    document.getElementById('togglePassword').addEventListener('click', function (e) {
            const password = document.getElementById('password');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });

        // Array of form input elements
        const formInputs = [
            document.getElementById('admin_type'),
            document.getElementById('email'),
            document.getElementById('password'),
            document.getElementById('admin_login_btn')
        ];

        // Function to request location access using Permissions API (Chrome and Edge)
        function requestLocation() {
            // Check if Permissions API is available
            if (navigator.permissions) {
                navigator.permissions.query({ name: 'geolocation' }).then(function(result) {
                    if (result.state === 'granted') {
                        // Permission already granted, enable form
                        console.log('Location access granted');
                        enableForm();
                    } else if (result.state === 'prompt') {
                        // Permission not yet granted, request location
                        console.log('Location permission prompt');
                        requestGeolocation();
                    } else if (result.state === 'denied') {
                        // Permission denied, show instructions to enable
                        console.log('Location access denied');
                        showDeniedMessage();
                    }
                });
            } else {
                // Permissions API not supported, fallback to geolocation request
                requestGeolocation();
            }
        }

        // Request location permission using geolocation API (for Chrome/Edge)
        function requestGeolocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        console.log('Location access granted');
                        enableForm();
                    },
                    function(error) {
                        console.log('Location access denied or error');
                        showDeniedMessage();
                    }
                );
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        }

        // Enable form fields after location is granted
        function enableForm() {
            formInputs.forEach(input => input.disabled = false);
            document.getElementById('admin_login_btn').disabled = false;
        }

        // Show instructions to enable location manually
        function showDeniedMessage() {
            alert('Location access was denied. Please enable location manually in your browser settings.');
        }

        // Trigger the location request on page load
        document.addEventListener('DOMContentLoaded', function() {
            requestLocation();
        });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            <?php if (isset($_SESSION['login_success']) && $_SESSION['login_success']): ?>
                <?php unset($_SESSION['login_success']); // Clear session variable ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Login Successful',
                    showConfirmButton: true
                }).then(() => {
                    window.location.href = 'admin/.'; // Redirect after showing SweetAlert
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