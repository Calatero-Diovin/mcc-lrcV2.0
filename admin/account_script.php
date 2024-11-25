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

    document.getElementById('firstName').addEventListener('input', function () {
     var firstNameInput = this.value.trim();

     // Check if the name is not empty and doesn't consist of only spaces
     if (/^[A-Za-z]+([ A-Za-z]*)$/.test(firstNameInput) && firstNameInput !== '') {
          this.setCustomValidity('');
     } else {
          this.setCustomValidity('Please enter a valid name. Spaces alone are not allowed.');
     }
     
     // Determine if the input is valid
     var isValid = /^[A-Za-z]+([ A-Za-z]*)$/.test(firstNameInput) && firstNameInput !== '';
     this.classList.toggle('is-invalid', !isValid);
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
                    Swal.fire({
                    icon: 'error',
                    title: 'Please enter a valid name. Spaces alone are not allowed.',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    });
                    inputElement.focus(); // Focus back on the input field for correction
                    inputElement.value = ''; // Clear the input if only spaces were entered
          }
    }

    function validateAddressFormat(inputId) {
        const inputElement = document.getElementById(inputId);
        const currentValue = inputElement.value.trim(); // Removes leading/trailing spaces

        // Define the regex pattern for the address format "Patao, Bantayan, Cebu"
        const addressPattern = /^[A-Za-z]+(?:, [A-Za-z]+){2}$/;

        // If the address does not match the format, show a SweetAlert error
        if (!addressPattern.test(currentValue)) {
            Swal.fire({
               icon: 'error',
               title: 'Please enter the address in the format: "Barangay, Municipality, Province".',
               showConfirmButton: false,
               timer: 3000,
               timerProgressBar: true,
            });

            inputElement.focus(); // Focus back on the input field for correction
            inputElement.value = ''; // Clear the input if invalid
        }
    }
</script>