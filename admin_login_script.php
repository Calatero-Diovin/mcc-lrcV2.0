<script>
    document.getElementById('togglePassword').addEventListener('click', function (e) {
            const password = document.getElementById('password');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });

        // Function to enable/disable form fields based on location permission
        function handleLocationPermission() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    // Location is allowed, enable the form fields
                    enableFormFields();
                }, function(error) {
                    // Location is denied, disable the form fields
                    disableFormFields();
                });
            } else {
                // Geolocation is not supported, disable the form fields
                disableFormFields();
            }
        }

        // Enable the form fields
        function enableFormFields() {
            document.getElementById('admin_type').disabled = false;
            document.getElementById('email').disabled = false;
            document.getElementById('password').disabled = false;
            document.getElementById('admin_login_btn').disabled = false;
        }

        // Disable the form fields
        function disableFormFields() {
            document.getElementById('admin_type').disabled = true;
            document.getElementById('email').disabled = true;
            document.getElementById('password').disabled = true;
            document.getElementById('admin_login_btn').disabled = true;
        }

        // Check the location permission as soon as the page loads
        window.onload = function() {
            handleLocationPermission();
        };
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