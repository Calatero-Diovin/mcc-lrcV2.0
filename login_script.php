<!-- Alertify JS link -->
<script src="assets/js/alertify.min.js"></script>

<!-- Custom JS link -->
<script src="assets/js/script.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
const roleSelect = document.getElementById('role_as');
const studentIdLabel = document.getElementById('student_id_label');
const studentIdInput = document.getElementById('student_id');

// Function to setup the input field based on role
function setupInputField() {
   if (roleSelect.value === 'faculty' || roleSelect.value === 'staff') {
       studentIdLabel.textContent = 'Username';
       studentIdInput.placeholder = 'Enter your username';
       studentIdInput.removeAttribute('maxlength'); // No limit for username
       studentIdInput.removeEventListener('input', formatStudentID); // No formatting
   } else {
       studentIdLabel.textContent = 'Student ID No.';
       studentIdInput.placeholder = 'Enter your Student ID No. (e.g., 2021-1055)';
       studentIdInput.setAttribute('maxlength', '9'); // Limit for student ID
       studentIdInput.addEventListener('input', formatStudentID); // Add formatting
   }
}

// Event listener for role select change
roleSelect.addEventListener('change', setupInputField);

// Initial setup based on default role selection
setupInputField();

function formatStudentID(event) {
   let value = studentIdInput.value;

   // Allow only digits and a single dash
   if (/[^0-9-]/.test(value)) {
       studentIdInput.value = value.replace(/[^0-9-]/g, '');
   }
}
});
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            <?php if (isset($_SESSION['login_successes']) && $_SESSION['login_successes']): ?>
                <?php unset($_SESSION['login_successes']); // Clear session variable ?>
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
                                    window.location.href = 'index.php'; // Redirect after showing SweetAlert
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
// Include scripts and message handling here
include('includes/script.php');
include('message.php'); 
?>
</body>
</html>