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
                    },
                    // Error callback
                    function (error) {
                        if (error.code === error.PERMISSION_DENIED) {
                            alert("Please allow location access to use this login page.");
                            setTimeout(function() {
                                window.location.reload(); // Reload page if denied
                            }, 1000);
                        }
                        // If location access is lost, disable the form inputs and login button again
                        if (error.code === error.POSITION_UNAVAILABLE || error.code === error.TIMEOUT) {
                            formInputs.forEach(input => input.disabled = true);
                            alert("Location access was lost. The form will reload.");
                            setTimeout(function() {
                                window.location.reload(); // Reload page if location is lost
                            }, 1000);
                        }
                    }
                );
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