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

     const nameRegex = /^(?! )[A-Za-z]+(?: [A-Za-z]+)*$/;

     function validateNameInput(inputId) {
     const input = document.getElementById(inputId).value;
          
          if (input && !nameRegex.test(input)) {
               const validInput = input.replace(/[^A-Za-z ]/g, '').trim();
               
               if (validInput !== input) {
                    document.getElementById(inputId).value = validInput;
                    Swal.fire({
                         icon: 'error',
                         title: 'Invalid Format',
                         showConfirmButton: false, // Hide the confirm button
                         timer: 2000, // Set the timer to 3 seconds (3000 milliseconds)
                         didOpen: () => {
                         Swal.showLoading();
                         const timer = Swal.getPopup().querySelector("b");
                         timerInterval = setInterval(() => {
                              timer.textContent = `${Swal.getTimerLeft()}`;
                         }, 100);
                         },
                         willClose: () => {
                         clearInterval(timerInterval);
                         }
                    });
               }
          }
     }
</script>