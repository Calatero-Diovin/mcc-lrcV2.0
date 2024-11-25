<script>
     document.getElementById('Phone').addEventListener('input', function () {
        var phoneInput = this.value.trim();
        
        phoneInput = phoneInput.replace(/\D/g, '');
        
        if (/^09\d{9}$/.test(phoneInput)) {
            this.setCustomValidity('');
        } else {
            this.setCustomValidity('Phone number must start with "09" and be exactly 11 digits long.');
        }
        
        var isValid = /^09\d{9}$/.test(phoneInput);
        this.classList.toggle('is-invalid', !isValid);
        
        if (phoneInput.startsWith('09')) {
            this.setCustomValidity('');
            this.classList.remove('is-invalid');
        }
    });

    function validateNameInput(inputId) {
        const inputElement = document.getElementById(inputId);
        const currentValue = inputElement.value;

        // Remove any non-alphabetical characters except spaces (to allow names with spaces)
        const validatedValue = currentValue.replace(/[^A-Za-z ]/g, '');

        // Update the input field with the validated value
        inputElement.value = validatedValue;
    }

    function checkInputOnBlur(inputId) {
        const inputElement = document.getElementById(inputId);
        const currentValue = inputElement.value.trim(); // Removes leading/trailing spaces

        // If the input is empty or only contains spaces, show an error or prevent form submission
        if (currentValue === '') {
            alert('Please enter a valid name.');
            inputElement.focus(); // Focus back on the input field for correction
            inputElement.value = ''; // Clear the input if only spaces were entered
        }
    }
</script>