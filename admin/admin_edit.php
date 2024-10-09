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
                    <li class="breadcrumb-item"><a href="admin">Admin</a></li>
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
                              if(isset($_GET['id']))
                              {
                                   $admin_id = mysqli_real_escape_string($con, $_GET['id']);

                                   $query = "SELECT * FROM admin WHERE admin_id ='$admin_id'"; 
                                   $query_run = mysqli_query($con, $query);

                                   if(mysqli_num_rows($query_run) > 0)
                                   {
                                       $admin = mysqli_fetch_array($query_run);
                                        ?>
                              <form action="admin_code.php" method="POST" enctype="multipart/form-data" onsubmit="return validatePhoneNumber()">

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
                                                       value="<?=$admin['phone_number'];?>" name="phone_number"
                                                       placeholder="09xxxxxxxxx" id="phone_number"
                                                       class="form-control format_number" autocomplete="off"
                                                       maxlength="11" pattern="09[0-9]{9}">
                                             </div>
                                        </div>

                                   </div>

                                   <div class="row d-flex justify-content-center">

                                        <div class="col-12 col-md-5">
                                             <div class="mb-3 mt-2">
                                                  <label for="">Email</label>
                                                  <input type="email" value="<?=$admin['email'];?>" name="email"
                                                       class="form-control" autocomplete="off">
                                             </div>
                                        </div>

                                        <div class="col-12 col-md-4">
                                             <div class="mb-3 mt-2">
                                                  <label for="">Profile Image</label>
                                                  <input type="hidden" name="old_admin_image"
                                                       value="<?=$admin['admin_image'];?>">
                                                  <input type="file" name="admin_image" class="form-control"
                                                       autocomplete="off">
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
                                   <a href="admin" class="btn btn-secondary">Cancel</a>
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
 function validateNameInput(inputField) {
        const value = inputField.value;
        const xssPattern = /<[^>]*>/; // Regex pattern to detect HTML tags

        // Check for XSS tags
        if (xssPattern.test(value)) {
            Swal.fire({
                title: 'Invalid Input!',
                text: 'Your name cannot contain HTML tags.',
                icon: 'error',
                confirmButtonText: 'Okay'
            });
            inputField.value = ''; // Clear the input field
            inputField.focus(); // Refocus on the input field
        }
    }

    // Attach event listeners to the input fields
    document.getElementById('firstname').addEventListener('input', function() {
        validateNameInput(this);
    });
    document.getElementById('middlename').addEventListener('input', function() {
        validateNameInput(this);
    });
    document.getElementById('lastname').addEventListener('input', function() {
        validateNameInput(this);
    });

function validatePhoneNumber() {
    const phoneInput = document.getElementById('phone_number');
    const phoneNumber = phoneInput.value;
    const phonePattern = /^09\d{9}$/;

    if (!phonePattern.test(phoneNumber)) {
        alert('Invalid phone number. Please ensure it starts with 09 and is 11 digits long.');
        return false;
    }
    return true;
}

function validateAddress() {
        const addressInput = document.getElementById('address').value;
        const addressPattern = /^[A-Za-z\s]+,\s*[A-Za-z\s]+,\s*[A-Za-z\s]+$/; // Regex for "City, Municipality, Province"

        if (!addressPattern.test(addressInput)) {
            Swal.fire({
                title: 'Invalid Address Format!',
                text: 'Please enter the address in the format: "Patao, Bantayan, Cebu".',
                icon: 'error',
                confirmButtonText: 'Okay'
            }).then(() => {
                document.getElementById('address').value = ''; // Clear the input
            });
        }
        // No success message for valid addresses
    }

    // Attach event listener to the address input field for the blur event
    document.getElementById('address').addEventListener('blur', validateAddress);
</script>
<?php 
include('./includes/footer.php');
include('./includes/script.php');
include('../message.php');
?>
