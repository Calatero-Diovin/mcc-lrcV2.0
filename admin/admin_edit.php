<?php 
include('authentication.php');
include('includes/header.php'); 
include('./includes/sidebar.php'); 
?>
<main id="main" class="main">
     <div class="pagetitle">
          <h1>Edit Admin</h1>
          <nav>
               <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href=".">Home</a></li>
                    <li class="breadcrumb-item"><a href="admin.php">Admin</a></li>
                    <li class="breadcrumb-item active">Edit Admin</li>
               </ol>
          </nav>
     </div>
     <section class="section">
          <div class="row">
               <div class="col-lg-12">
                    <div class="card">
                         <div class="card-header d-flex justify-content-end">
                              <a href="admin.php" class="btn btn-primary">Back</a>
                         </div>
                         <div class="card-body">
                              <?php
                              if(isset($_GET['e']))
                              {
                                   $admin_id = filter_var(encryptor('decrypt',$_GET['e']), FILTER_VALIDATE_INT);

                                   $query = "SELECT * FROM admin WHERE admin_id ='$admin_id'"; 
                                   $query_run = mysqli_query($con, $query);

                                   if(mysqli_num_rows($query_run) > 0)
                                   {
                                       $admin = mysqli_fetch_array($query_run);
                                        ?>
                              <form action="admin_code.php" method="POST" enctype="multipart/form-data">

                                   <div class="row d-flex justify-content-center mt-5">
                                        <input type="hidden" name="admin_id" value="<?=$admin['admin_id']?>">

                                        <div class="col-12 col-md-3">
                                             <div class="mb-3 mt-2">
                                                  <label for="firstname">Firstname</label>
                                                  <input type="text" id="firstname" value="<?=$admin['firstname'];?>" name="firstname" class="form-control" autocomplete="off" required>
                                             </div>
                                             </div>

                                             <div class="col-12 col-md-3">
                                             <div class="mb-3 mt-2">
                                                  <label for="middlename">Middlename</label>
                                                  <input type="text" id="middlename" value="<?=$admin['middlename'];?>" name="middlename" class="form-control" autocomplete="off" required>
                                             </div>
                                             </div>

                                             <div class="col-12 col-md-3">
                                             <div class="mb-3 mt-2">
                                                  <label for="lastname">Lastname</label>
                                                  <input type="text" id="lastname" value="<?=$admin['lastname'];?>" name="lastname" class="form-control" autocomplete="off" required>
                                             </div>
                                        </div>
                                   </div>

                                   <div class="row d-flex justify-content-center">

                                        <div class="col-12 col-md-5">
                                             <div class="mb-3 mt-2">
                                                  <label for="">Address</label>
                                                  <input type="text" id="address" value="<?=$admin['address'];?>" name="address"
                                                       class="form-control" autocomplete="off">
                                             </div>
                                        </div>

                                        <div class="col-12 col-md-4">
                                             <div class="mb-3 mt-2">
                                                  <label for="">Phone Number</label>
                                                  <input type="tel"
                                                       value="<?=$admin['phone_number'];?>" id="phone_number" name="phone_number"
                                                       placeholder="09xxxxxxxxx" id="phone_number"
                                                       class="form-control format_number" autocomplete="off"
                                                       maxlength="11">
                                             </div>
                                        </div>

                                   </div>

                                   <div class="row d-flex justify-content-center">

                                        <div class="col-12 col-md-5">
                                             <div class="mb-3 mt-2">
                                                  <label for="">Email</label>
                                                  <input type="email" value="<?=$admin['email'];?>" name="email"
                                                       class="form-control" autocomplete="off" id="email" readonly>
                                             </div>
                                        </div>

                                        <div class="col-12 col-md-4">
                                             <div class="mb-3 mt-2">
                                                  <label for="">Profile Image</label>
                                                  <input type="hidden" name="old_admin_image"
                                                       value="<?=$admin['admin_image'];?>">
                                                  <input type="file" name="admin_image" class="form-control"
                                                       autocomplete="off" id="admin_image" accept=".jpg,.jpeg,.png">
                                             </div>
                                        </div>
                                   </div>

                                   <div class="row d-flex justify-content-center">
                                        <div class="col-12 col-md-5">
                                             <div class="mb-3 mt-2">
                                                  <label for="admin_type">Admin Type</label>
                                                  <select id="admin_type" name="admin_type" class="form-control" required>
                                                       <option value="" disabled>--Select Type--</option>
                                                       <option value="Admin" <?= $admin['admin_type'] == 'Admin' ? 'selected' : '' ?>>Admin</option>
                                                       <option value="Staff" <?= $admin['admin_type'] == 'Staff' ? 'selected' : '' ?>>Staff</option>
                                                  </select>
                                             </div>
                                        </div>
                                   </div>

                         </div>
                         <div class="card-footer d-flex justify-content-end">
                              <div>
                                   <a href="admin.php" class="btn btn-secondary">Cancel</a>
                                   <button type="submit" name="edit_admin" class="btn btn-primary">Update</button>
                              </div>
                         </div>
                         </form>
                         <?php
                              }
                              else
                              {
                                   echo "No such ID found";
                              }

                         }  
                         ?>

                    </div>
               </div>
          </div>
     </section>
</main>
<script>
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
    </script>

<script>
    $(document).ready(function() {
        <?php if (isset($_SESSION['status']) && $_SESSION['status_code'] == 'info') { ?>
            // Show SweetAlert OTP input when session is set with 'info'
            Swal.fire({
                title: 'Enter OTP',
                html: `
                    <input type="text" id="otp_input" class="swal2-input" placeholder="Enter OTP">
                `,
                confirmButtonText: 'Verify OTP',
                focusConfirm: false,
                preConfirm: () => {
                    const otp = document.getElementById('otp_input').value;
                    if (!otp) {
                        Swal.showValidationMessage('Please enter OTP');
                    } else {
                        return otp;
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // If OTP is confirmed, proceed with verifying it via AJAX
                    const otp = result.value;
                    const admin_id = "<?php echo encryptor('encrypt', $admin_id); ?>"; // Encrypted admin_id

                    $.ajax({
                        url: 'admin_code.php',
                        method: 'POST',
                        data: {
                            otp: otp,
                            admin_id: admin_id
                        },
                        success: function(response) {
                            const data = JSON.parse(response);
                            if (data.status == 'success') {
                                Swal.fire('OTP Verified', 'You can now update your admin profile.', 'success').then(() => {
                                    // Redirect to the admin edit page after OTP verification
                                    location.href = 'admin_edit.php?e=<?php echo encryptor('encrypt', $admin_id); ?>';
                                });
                            } else {
                                Swal.fire('Invalid OTP', 'Please try again.', 'error');
                            }
                        }
                    });
                }
            });
        <?php } ?>
    });
    </script>
<?php 
include('includes/footer.php');
include('includes/script.php');
include('message.php');
?>
