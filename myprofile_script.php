<script>
     document.getElementById('contact_person_cell').addEventListener('input', function () {
    var phoneInput = this.value.trim();

    // Sanitize input: remove any HTML tags
    phoneInput = phoneInput.replace(/<\/?[^>]+(>|$)/g, "");

    // Remove non-numeric characters
    phoneInput = phoneInput.replace(/\D/g, '');

    // Check if the number starts with "09" and is exactly 11 digits long
    if (/^09\d{9}$/.test(phoneInput)) {
        this.setCustomValidity('');
    } else {
        this.setCustomValidity('Contact Person\'s phone number must start with "09" and be exactly 11 digits long.');
    }

    // Show or hide the validation message
    var isValid = /^09\d{9}$/.test(phoneInput);
    this.classList.toggle('is-invalid', !isValid);

    // Clear error message if "09" is typed again
    if (phoneInput.startsWith('09')) {
        this.setCustomValidity('');
        this.classList.remove('is-invalid');
    }
});

document.getElementById('Phone').addEventListener('input', function () {
    var phoneInput = this.value.trim();

    // Sanitize input: remove any HTML tags
    phoneInput = phoneInput.replace(/<\/?[^>]+(>|$)/g, "");

    // Remove non-numeric characters
    phoneInput = phoneInput.replace(/\D/g, '');

    // Check if the number starts with "09" and is exactly 11 digits long
    if (/^09\d{9}$/.test(phoneInput)) {
        this.setCustomValidity('');
    } else {
        this.setCustomValidity('Phone number must start with "09" and be exactly 11 digits long.');
    }

    // Show or hide the validation message
    var isValid = /^09\d{9}$/.test(phoneInput);
    this.classList.toggle('is-invalid', !isValid);

    // Clear error message if "09" is typed again
    if (phoneInput.startsWith('09')) {
        this.setCustomValidity('');
        this.classList.remove('is-invalid');
    }
});

    // Function to validate first name, middle name, and last name
function validateNameInput(inputId) {
    var input = document.getElementById(inputId);
    var value = input.value.trim();

    // Sanitize input: remove any HTML tags
    value = value.replace(/<\/?[^>]+(>|$)/g, "");

    // Check if first character is uppercase or lowercase
    if (/^[A-Za-z]/.test(value)) {
        input.setCustomValidity('');
    } else {
        input.setCustomValidity(input.placeholder + ' must start with a letter.');
    }

    // Show or hide the validation message
    var isValid = /^[A-Za-z]/.test(value);
    input.classList.toggle('is-invalid', !isValid);
}

// Add event listeners to validate on input for first name, middle name, and last name
document.getElementById('firstname').addEventListener('input', function () {
    validateNameInput('firstname');
});

document.getElementById('lastname').addEventListener('input', function () {
    validateNameInput('lastname');
});

document.getElementById('middlename').addEventListener('input', function () {
    validateNameInput('middlename');
});

// Add event listeners to clear validation when input is empty
document.getElementById('firstname').addEventListener('blur', function () {
    if (this.value.trim() === '') {
        this.setCustomValidity('');
        this.classList.remove('is-invalid');
    }
});

document.getElementById('lastname').addEventListener('blur', function () {
    if (this.value.trim() === '') {
        this.setCustomValidity('');
        this.classList.remove('is-invalid');
    }
});

document.getElementById('middlename').addEventListener('blur', function () {
    if (this.value.trim() === '') {
        this.setCustomValidity('');
        this.classList.remove('is-invalid');
    }
});

document.getElementById('toggleCurrentPassword').addEventListener('click', function() {
    togglePasswordVisibility('currentPassword', 'toggleCurrentPassword');
});

document.getElementById('toggleNewPassword').addEventListener('click', function() {
    togglePasswordVisibility('newPassword', 'toggleNewPassword');
});

document.getElementById('toggleRenewPassword').addEventListener('click', function() {
    togglePasswordVisibility('renewPassword', 'toggleRenewPassword');
});

function togglePasswordVisibility(passwordId, toggleIconId) {
    const passwordInput = document.getElementById(passwordId);
    const toggleIcon = document.getElementById(toggleIconId);

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('bi-eye-fill');
        toggleIcon.classList.add('bi-eye-slash-fill');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('bi-eye-slash-fill');
        toggleIcon.classList.add('bi-eye-fill');
    }
}

function validatePasswords() {
    const newPassword = sanitizeInput(document.getElementById('newPassword').value);
    const renewPassword = sanitizeInput(document.getElementById('renewPassword').value);

    let valid = true;

    // Validate password length
    if (newPassword.length < 8) {
        document.getElementById('newPasswordWarning').style.display = 'block';
        valid = false;
    } else {
        document.getElementById('newPasswordWarning').style.display = 'none';
    }

    // Check for uppercase, lowercase, number, and special character
    const hasUppercase = /[A-Z]/.test(newPassword);
    const hasLowercase = /[a-z]/.test(newPassword);
    const hasNumber = /[0-9]/.test(newPassword);
    const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(newPassword);

    if (!hasUppercase || !hasLowercase || !hasNumber || !hasSpecialChar) {
        Swal.fire({
            icon: 'warning',
            title: 'Password Requirements',
            text: 'Your password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        });
        valid = false;
    }

    // Validate renew password length
    if (renewPassword.length < 8) {
        document.getElementById('renewPasswordWarning').style.display = 'block';
        valid = false;
    } else {
        document.getElementById('renewPasswordWarning').style.display = 'none';
    }

    return valid;
}

// Sanitize input: remove any HTML tags
function sanitizeInput(input) {
    return input.replace(/<\/?[^>]+(>|$)/g, "");
}

// Add event listeners to validate passwords on input
document.getElementById('newPassword').addEventListener('input', function () {
    const sanitizedValue = sanitizeInput(this.value);
    this.value = sanitizedValue; // Update the input value with sanitized version
    if (sanitizedValue.length >= 8) {
        document.getElementById('newPasswordWarning').style.display = 'none';
    } else {
        document.getElementById('newPasswordWarning').style.display = 'block';
    }
});

document.getElementById('renewPassword').addEventListener('input', function () {
    const sanitizedValue = sanitizeInput(this.value);
    this.value = sanitizedValue; // Update the input value with sanitized version
    if (sanitizedValue.length >= 8) {
        document.getElementById('renewPasswordWarning').style.display = 'none';
    } else {
        document.getElementById('renewPasswordWarning').style.display = 'block';
    }
});

function validateAddress(input) {
    // Sanitize input: remove any HTML tags
    const sanitizedInput = sanitizeInput(input.value);
    
    // Address pattern: City, Municipality, Province
    const addressPattern = /^[A-Za-z]+, [A-Za-z]+, [A-Za-z]+$/;
    const errorElement = document.getElementById('addressError');

    if (addressPattern.test(sanitizedInput)) {
        errorElement.style.display = 'none'; // Hide error message
        input.setCustomValidity(''); // Clear any previous custom validation message
    } else {
        errorElement.style.display = 'block'; // Show error message
        input.setCustomValidity('Please enter the address in the format: Barangay, Municipality, Province');
    }
}

// Sanitize input: remove any HTML tags
function sanitizeInput(input) {
    return input.replace(/<\/?[^>]+(>|$)/g, "");
}

// Optional: Add event listeners for form submission to ensure validation
document.querySelector('form').addEventListener('submit', function(event) {
    const addressInput = document.getElementById('Address');
    // Sanitize the value before validating
    addressInput.value = sanitizeInput(addressInput.value);
    
    if (!addressInput.checkValidity()) {
        validateAddress(addressInput);
        event.preventDefault(); // Prevent form submission if invalid
    }
});

// Add input event listener to validate on input
document.getElementById('Address').addEventListener('input', function() {
    validateAddress(this);
});

</script>

<?php
include('includes/footer.php');
include('includes/script.php');
include('message.php'); 
?>