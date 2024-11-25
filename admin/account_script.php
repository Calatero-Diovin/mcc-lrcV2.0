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

        // Replace any non-alphabetical characters (including spaces) with an empty string
        const validatedValue = currentValue.replace(/[^A-Za-z]/g, '');

        // Update the input field with the validated value
        inputElement.value = validatedValue;
    }
</script>