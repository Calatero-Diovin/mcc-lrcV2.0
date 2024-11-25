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

    document.getElementById('firstname').addEventListener('input', function () {
     var firstNameInput = this.value.trim();

     // Check if the name is not empty and doesn't consist of only spaces
     if (/^[A-Za-z]+([ A-Za-z]*)$/.test(firstNameInput)) {
          this.setCustomValidity('');
     } else {
          this.setCustomValidity('Please enter a valid name. Spaces alone are not allowed.');
     }
     
     // Determine if the input is valid
     var isValid = /^[A-Za-z]+([ A-Za-z]*)$/.test(firstNameInput);
     this.classList.toggle('is-invalid', !isValid);
     });

     document.getElementById('middlename').addEventListener('input', function () {
     var middleNameInput = this.value.trim();

     // Check if the name is not empty and doesn't consist of only spaces
     if (/^[A-Za-z]+([ A-Za-z]*)$/.test(middleNameInput)) {
          this.setCustomValidity('');
     } else {
          this.setCustomValidity('Please enter a valid name. Spaces alone are not allowed.');
     }
     
     // Determine if the input is valid
     var isValid = /^[A-Za-z]+([ A-Za-z]*)$/.test(middleNameInput);
     this.classList.toggle('is-invalid', !isValid);
     });

     document.getElementById('lastname').addEventListener('input', function () {
     var lastNameInput = this.value.trim();

     // Check if the name is not empty and doesn't consist of only spaces
     if (/^[A-Za-z]+([ A-Za-z]*)$/.test(lastNameInput)) {
          this.setCustomValidity('');
     } else {
          this.setCustomValidity('Please enter a valid name. Spaces alone are not allowed.');
     }
     
     // Determine if the input is valid
     var isValid = /^[A-Za-z]+([ A-Za-z]*)$/.test(lastNameInput);
     this.classList.toggle('is-invalid', !isValid);
     });

     document.getElementById('Address').addEventListener('input', function () {
     var addressInput = this.value.trim();

     // Check if the name is not empty and doesn't consist of only spaces
     if (/^[A-Za-z]+(?:, [A-Za-z]+){2}$/.test(addressInput)) {
          this.setCustomValidity('');
     } else {
          this.setCustomValidity('Please enter the address in the format: "Barangay, Municipality, Province".');
     }
     
     // Determine if the input is valid
     var isValid = /^[A-Za-z]+(?:, [A-Za-z]+){2}$/.test(addressInput);
     this.classList.toggle('is-invalid', !isValid);
     });

     document.getElementById('ImageUpload').addEventListener('change', function () {
     var file = this.files[0]; // Get the selected file
     var fileName = file ? file.name : '';
     var fileExtension = fileName.split('.').pop().toLowerCase();

     // Check if the file extension is one of the allowed types: png, jpg, jpeg
     if (['png', 'jpg', 'jpeg'].includes(fileExtension)) {
          this.setCustomValidity('');
     } else {
          this.setCustomValidity('Only PNG, JPG, and JPEG image formats are allowed.');
     }

     // Toggle the invalid class based on the validity of the file type
     this.classList.toggle('is-invalid', !['png', 'jpg', 'jpeg'].includes(fileExtension));
     });

</script>