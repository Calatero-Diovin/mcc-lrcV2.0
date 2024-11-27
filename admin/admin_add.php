<?php 
include('authentication.php');
include('includes/header.php'); 
include('./includes/sidebar.php'); 
?>

<style>
    .progress {
        background-color: #e9ecef;
    }
    .progress-bar {
        transition: width 0.4s ease;
    }
</style>

<main id="main" class="main">
     <div class="pagetitle">
          <h1>Add Admin</h1>
          <nav>
               <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href=".">Home</a></li>
                    <li class="breadcrumb-item"><a href="admin.php">Admin</a></li>
                    <li class="breadcrumb-item active">Add Admin</li>
               </ol>
          </nav>
     </div>
     <section class="section">
          <div class="row">
               <div class="col-lg-12">
                    <div class="card">
                         <div class="card-header d-flex justify-content-end">

                         </div>
                         <div class="card-body">

                              <form action="admin_code.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">

                                   <div class="row d-flex justify-content-center mt-5">

                                        <div class="col-12 col-md-3">
                                             <div class="mb-3 mt-2">
                                                  <label for="">First Name</label>
                                                  <input type="text" id="firstname" placeholder="Diovin" name="firstname" class="form-control" required>
                                             </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                             <div class="mb-3 mt-2">
                                                  <div class="d-flex justify-content-between">
                                                       <label for="">Middle Name</label>
                                                       <span class=" text-muted"><small>(Optional)</small></span>
                                                  </div>
                                                  <input type="text" id="middlename" placeholder="Pasicaran" name="middlename" class="form-control">
                                             </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                             <div class="mb-3 mt-2">
                                                  <label for="">Last Name</label>
                                                  <input type="text" id="lastname" placeholder="Calatero" name="lastname" class="form-control" required>
                                             </div>
                                        </div>

                                   </div>

                                   <div class="row d-flex justify-content-center">

                                        <div class="col-12 col-md-5">
                                             <div class="mb-3 mt-2">
                                                  <label for="">Email</label>
                                                  <input type="email" id="email" placeholder="diovin.calatero@mcclawis.edu.ph" name="email" class="form-control" required>
                                             </div>
                                        </div>

                                        <div class="col-12 col-md-4">
                                             <div class="mb-3 mt-2">
                                                  <label for="">Phone Number</label>
                                                  <input type="tel" id="phone_number" name="phone_number"
                                                       placeholder="09xxxxxxxxx" class="form-control format_number" maxlength="11" oninput="validatePhoneNumber()" required>
                                                  <small id="phone_warning" class="text-danger"></small>
                                             </div>
                                        </div>

                                   </div>

                                   <div class="row d-flex justify-content-center">

                                        <div class="col-12 col-md-5">
                                             <div class="mb-3 mt-2">
                                                  <label for="">Address</label>
                                                  <input type="text" id="address" placeholder="Patao, Bantayan, Cebu" name="address" class="form-control" required>
                                             </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                             <div class="mb-3 mt-2">
                                                  <div class="d-flex justify-content-between">
                                                       <label for="">Profile Image</label>
                                                       <span class=" text-muted"><small>(Optional)</small></span>
                                                  </div>
                                                  <input type="file" id="admin_image" name="admin_image" class="form-control" accept=".jpg,.jpeg,.png">
                                             </div>
                                        </div>

                                   </div>

                                   <div class="row d-flex justify-content-center">
                                        <div class="col-12 col-md-5">
                                            <div class="mb-3 mt-2">
                                                <label for="password">Password</label>
                                                <input type="password" id="password" name="password" class="form-control" style="margin-bottom: 5px;" minlength="10" required oninput="checkPasswordStrength()">
                                                
                                                <input type="checkbox" class="form-check-input" id="showPassword" onclick="togglePassword()">
                                                <label class="form-check-label" for="showPassword">Show Password</label>

                                                <div id="passwordStrengthMessage" class="mt-2"></div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                             <div class="mb-3 mt-2">
                                                  <label for="admin_type">Admin Type</label>
                                                  <select id="admin_type" name="admin_type" class="form-control" required>
                                                  <option value="" id="optionLabel" disabled selected>--Select Type--</option>
                                                       <option value="Admin">Admin</option>
                                                       <option value="Staff">Staff</option>
                                                  </select>
                                             </div>
                                        </div>
                                   </div>
                         </div>
                         <div class="card-footer d-flex justify-content-end">
                              <div>
                                   <a href="admin.php" class="btn btn-secondary">Cancel</a>
                                   <button type="submit" name="add_admin" class="btn btn-primary">Add Admin</button>
                              </div>
                         </div>
                         </form>

                    </div>
               </div>
          </div>
     </section>
</main>
<script>
function togglePassword() {
    var passwordField = document.getElementById("password");
    if (passwordField.type === "password") {
        passwordField.type = "text";
    } else {
        passwordField.type = "password";
    }
}

document.getElementById('firstname').addEventListener('input', function () {
          var nameInput = this.value.trim(); // Remove any leading or trailing spaces
          
          var alphabetPattern = /^[A-Za-z\s]+$/; // Pattern for alphabet and spaces only
          
          // Check if input starts with a space
          if (this.value !== nameInput) {
               this.setCustomValidity('Name cannot start with a space.');
          } else if (alphabetPattern.test(nameInput)) {
               this.setCustomValidity(''); // If valid, clear any previous error message
          } else {
               this.setCustomValidity('Please enter a valid name with only letters and no leading/trailing spaces.');
          }
          
          // Check validity and toggle the invalid class
          var isValid = alphabetPattern.test(nameInput) && this.value === nameInput; // Ensure no leading spaces
          this.classList.toggle('is-invalid', !isValid);
     });

     document.getElementById('middlename').addEventListener('input', function () {
          var mnInput = this.value.trim(); // Remove any leading or trailing spaces
          
          var alphabetPattern = /^[A-Za-z\s]+$/; // Pattern for alphabet and spaces only
          
          // Check if input starts with a space
          if (this.value !== mnInput) {
               this.setCustomValidity('Name cannot start with a space.');
          } else if (alphabetPattern.test(mnInput)) {
               this.setCustomValidity(''); // If valid, clear any previous error message
          } else {
               this.setCustomValidity('Please enter a valid name with only letters and no leading/trailing spaces.');
          }
          
          // Check validity and toggle the invalid class
          var isValid = alphabetPattern.test(mnInput) && this.value === mnInput; // Ensure no leading spaces
          this.classList.toggle('is-invalid', !isValid);
     });

     document.getElementById('lastname').addEventListener('input', function () {
          var lnInput = this.value.trim(); // Remove any leading or trailing spaces
          
          var alphabetPattern = /^[A-Za-z\s]+$/; // Pattern for alphabet and spaces only
          
          // Check if input starts with a space
          if (this.value !== lnInput) {
               this.setCustomValidity('Name cannot start with a space.');
          } else if (alphabetPattern.test(lnInput)) {
               this.setCustomValidity(''); // If valid, clear any previous error message
          } else {
               this.setCustomValidity('Please enter a valid name with only letters and no leading/trailing spaces.');
          }
          
          // Check validity and toggle the invalid class
          var isValid = alphabetPattern.test(lnInput) && this.value === lnInput; // Ensure no leading spaces
          this.classList.toggle('is-invalid', !isValid);
     });

     document.getElementById('email').addEventListener('input', function () {
     var emailInput = this.value.trim();
     
     var emailPattern = /^[A-Za-z0-9._%+-]+@mcclawis\.edu\.ph$/;

     if (emailPattern.test(emailInput)) {
          this.setCustomValidity('');
     } else {
          this.setCustomValidity('Please enter a valid email with the domain @mcclawis.edu.ph');
     }

     var isValid = emailPattern.test(emailInput);
     this.classList.toggle('is-invalid', !isValid);
     });

     document.getElementById('phone_number').addEventListener('input', function () {
     var phoneInput = this.value.trim();
     
     var phonePattern = /^09\d{9}$/;

     if (phonePattern.test(phoneInput)) {
          this.setCustomValidity('');
     } else {
          this.setCustomValidity('Please enter a valid phone number starting with 09 and exactly 11 digits.');
     }

     var isValid = phonePattern.test(phoneInput);
     this.classList.toggle('is-invalid', !isValid);
     });

     document.getElementById('address').addEventListener('input', function () {
     var addressInput = this.value.trim();
     
     var addressPattern = /^[A-Za-z\s]+,\s[A-Za-z\s]+,\s[A-Za-z\s]+$/;

     if (addressPattern.test(addressInput)) {
          this.setCustomValidity('');
     } else {
          this.setCustomValidity('Please enter a valid address in the format: Barangay, Municipality, Province');
     }
     
     var isValid = addressPattern.test(addressInput);
     this.classList.toggle('is-invalid', !isValid);
     });

     document.getElementById('admin_image').addEventListener('change', function () {
        var file = this.files[0];
        var isValid = true; // Assume the file is valid initially

        if (file) {
            var allowedExtensions = ['image/jpeg', 'image/png'];
            // If the file type is not valid, set isValid to false
            if (!allowedExtensions.includes(file.type)) {
                isValid = false;
                // Optionally, set a custom validation message
                this.setCustomValidity('Please upload a valid image file (JPEG, PNG).');
            } else {
                // Clear any custom validation message if the file is valid
                this.setCustomValidity('');
            }
        }

        // Toggle the 'is-invalid' class based on isValid status
        this.classList.toggle('is-invalid', !isValid);
    });

    // Function to check the strength of the password
    function checkPasswordStrength() {
        var password = document.getElementById('password').value;
        var strengthMessage = document.getElementById('passwordStrengthMessage');
        var isValid = true; // Assume the password is valid initially
        
        // Regular expression to check for the required password conditions:
        var uppercasePattern = /[A-Z]/g;
        var lowercasePattern = /[a-z]/g;
        var numberPattern = /\d/g;
        var specialCharPattern = /[^A-Za-z0-9]/g;
        
        var uppercaseCount = (password.match(uppercasePattern) || []).length;
        var lowercaseCount = (password.match(lowercasePattern) || []).length;
        var numberCount = (password.match(numberPattern) || []).length;
        var specialCharCount = (password.match(specialCharPattern) || []).length;
        
        // Validate the password based on the new criteria
        if (uppercaseCount >= 2 && lowercaseCount >= 2 && numberCount >= 3 && specialCharCount >= 1 && password.length >= 10) {
            strengthMessage.textContent = "Strong password!";
            strengthMessage.style.color = "green";
        } else {
            isValid = false;
            if (password.length < 8) {
                strengthMessage.textContent = "Password should be at least 10 characters long.";
            } else if (uppercaseCount < 2) {
                strengthMessage.textContent = "Password must have at least 2 uppercase letters.";
            } else if (lowercaseCount < 2) {
                strengthMessage.textContent = "Password must have at least 2 lowercase letters.";
            } else if (numberCount < 3) {
                strengthMessage.textContent = "Password must have at least 3 numbers.";
            } else if (specialCharCount < 3) {
                strengthMessage.textContent = "Password must have at least 3 special character.";
            }
            strengthMessage.style.color = "red";
        }
        
        // Toggle the 'is-invalid' class based on isValid status
        document.getElementById('password').classList.toggle('is-invalid', !isValid);
    }
</script>
<?php 
include('./includes/footer.php');
include('includes/script.php');
include('message.php');
?>
