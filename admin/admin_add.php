<?php 
include('authentication.php');
include('includes/header.php'); 
include('./includes/sidebar.php'); 
?>
<main id="main" class="main">
     <div class="pagetitle">
          <h1>Add Admin</h1>
          <nav>
               <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href=".">Home</a></li>
                    <li class="breadcrumb-item"><a href="admin">Admin</a></li>
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
                                                  <input type="text" name="firstname" class="form-control" required onblur="sanitizeInput(this)">
                                             </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                             <div class="mb-3 mt-2">
                                                  <div class="d-flex justify-content-between">
                                                       <label for="">Middle Name</label>
                                                       <span class=" text-muted"><small>(Optional)</small></span>
                                                  </div>
                                                  <input type="text" name="middlename" class="form-control" onblur="sanitizeInput(this)">
                                             </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                             <div class="mb-3 mt-2">
                                                  <label for="">Last Name</label>
                                                  <input type="text" name="lastname" class="form-control" required onblur="sanitizeInput(this)">
                                             </div>
                                        </div>

                                   </div>

                                   <div class="row d-flex justify-content-center">

                                        <div class="col-12 col-md-5">
                                             <div class="mb-3 mt-2">
                                                  <label for="">Email</label>
                                                  <input type="email" name="email" class="form-control" required>
                                             </div>
                                        </div>

                                        <div class="col-12 col-md-4">
                                             <div class="mb-3 mt-2">
                                                  <label for="">Phone Number</label>
                                                  <input type="tel" id="phone_number" name="phone_number"
                                                       placeholder="09xxxxxxxxx" class="form-control format_number" maxlength="11" oninput="validatePhoneNumber()" required onblur="sanitizeInput(this)">
                                                  <small id="phone_warning" class="text-danger"></small>
                                             </div>
                                        </div>

                                   </div>

                                   <div class="row d-flex justify-content-center">

                                        <div class="col-12 col-md-5">
                                             <div class="mb-3 mt-2">
                                                  <label for="">Address</label>
                                                  <input type="text" name="address" class="form-control" required>
                                             </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                             <div class="mb-3 mt-2">
                                                  <div class="d-flex justify-content-between">
                                                       <label for="">Profile Image</label>
                                                       <span class="text-muted"><small>(Optional)</small></span>
                                                  </div>
                                                  <input type="file" name="admin_image" class="form-control" id="admin_image_input">
                                                  <small class="text-muted" id="file_error" style="display: none; color: red;">Only JPG, JPEG, and PNG files are allowed.</small>
                                             </div>
                                        </div>

                                   </div>

                                   <div class="row d-flex justify-content-center">
                                        <div class="col-12 col-md-5">
                                             <div class="mb-3 mt-2">
                                                  <label for="password">Password</label>
                                                  <input type="password" id="password" name="password" class="form-control" style="margin-bottom: 5px;" minlength="8" required>
                                                  <input type="checkbox" class="form-check-input" id="showPassword" onclick="togglePassword()">
                                                  <label class="form-check-label" for="showPassword">Show Password</label>
                                                  <small id="password_warning" class="text-danger"></small>
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

function validatePhoneNumber() {
    var phoneNumber = document.getElementById("phone_number").value;
    var warning = document.getElementById("phone_warning");
    var phonePattern = /^09\d{0,9}$/;

    if (!phonePattern.test(phoneNumber)) {
        warning.textContent = "Phone number must start with 09 and contain only numbers.";
    } else {
        warning.textContent = "";
    }
}

function validateForm() {
    var phoneNumber = document.getElementById("phone_number").value;
    var warning = document.getElementById("phone_warning");
    var phonePattern = /^09\d{9}$/;

    if (!phonePattern.test(phoneNumber)) {
        warning.textContent = "Phone number must start with 09 and be 11 digits long.";
        return false;
    } else {
        warning.textContent = "";
    }

    var password = document.getElementById("password").value;
    var passwordWarning = document.getElementById("password_warning");
    if (password.length < 8) {
        passwordWarning.textContent = "Password must be at least 8 characters long.";
        return false;
    } else {
        passwordWarning.textContent = "";
    }
    
    return true;
}

document.getElementById('admin_image_input').addEventListener('change', function() {
    const file = this.files[0];
    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    const errorMessage = document.getElementById('file_error');
    
    if (file) {
        if (!allowedTypes.includes(file.type)) {
            errorMessage.style.display = 'block'; // Show error message
            this.value = ''; // Clear the input
        } else {
            errorMessage.style.display = 'none'; // Hide error message
        }
    }
});

function sanitizeInput(element) {
    const sanitizedValue = element.value.replace(/<\/?[^>]+(>|$)/g, "");
    element.value = sanitizedValue;
}
</script>
<?php 
include('./includes/footer.php');
include('includes/script.php');
include('../message.php');
?>
