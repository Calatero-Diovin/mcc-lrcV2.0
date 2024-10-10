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
                                   $admin_id = $_GET['id'];

                                   $query = "SELECT * FROM admin WHERE admin_id = ?";
                                   $stmt = $con->prepare($query);
                                   $stmt->bind_param("s", $admin_id);
                                   $stmt->execute();
                                   $query_run = $stmt->get_result();

                                   if ($query_run->num_rows > 0) 
                                   {
                                        $admin = $query_run->fetch_array(MYSQLI_ASSOC);
                                        ?>
                              <form action="admin_code.php" method="POST" enctype="multipart/form-data" onsubmit="return validatePhoneNumber()">

                                   <div class="row d-flex justify-content-center mt-5">
                                        <input type="hidden" name="admin_id" value="<?=$admin['admin_id']?>">

                                        <div class="col-12 col-md-3">
                                             <div class="mb-3 mt-2">
                                                  <label for="">Firstname</label>
                                                  <input type="text" value="<?=$admin['firstname'];?>" name="firstname"
                                                       class="form-control" autocomplete="off" onblur="sanitizeInput(this)">
                                             </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                             <div class="mb-3 mt-2">
                                                  <label for="">Middlename</label>
                                                  <input type="text" value="<?=$admin['middlename'];?>"
                                                       name="middlename" class="form-control" autocomplete="off" onblur="sanitizeInput(this)">
                                             </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                             <div class="mb-3 mt-2">
                                                  <label for="">Lastname</label>
                                                  <input type="text" value="<?=$admin['lastname'];?>" name="lastname"
                                                       class="form-control" autocomplete="off" onblur="sanitizeInput(this)">
                                             </div>
                                        </div>

                                   </div>

                                   <div class="row d-flex justify-content-center">

                                        <div class="col-12 col-md-5">
                                             <div class="mb-3 mt-2">
                                                  <label for="">Address</label>
                                                  <input type="text" value="<?=$admin['address'];?>" name="address"
                                                       class="form-control" autocomplete="off" onblur="sanitizeInput(this)">
                                             </div>
                                        </div>

                                        <div class="col-12 col-md-4">
                                             <div class="mb-3 mt-2">
                                                  <label for="">Phone Number</label>
                                                  <input type="tel"
                                                       value="<?=$admin['phone_number'];?>" name="phone_number"
                                                       placeholder="09xxxxxxxxx" id="phone_number"
                                                       class="form-control format_number" autocomplete="off"
                                                       maxlength="11" pattern="09[0-9]{9}" onblur="sanitizeInput(this)">
                                             </div>
                                        </div>

                                   </div>

                                   <div class="row d-flex justify-content-center">

                                        <div class="col-12 col-md-5">
                                             <div class="mb-3 mt-2">
                                                  <label for="">Email</label>
                                                  <input type="email" value="<?=$admin['email'];?>" name="email"
                                                       class="form-control" autocomplete="off" onblur="sanitizeInput(this)">
                                             </div>
                                        </div>

                                        <div class="col-12 col-md-4">
                                             <div class="mb-3 mt-2">
                                                  <label for="">Profile Image</label>
                                                  <input type="hidden" name="old_admin_image" value="<?=$admin['admin_image'];?>">
                                                  <input type="file" name="admin_image" class="form-control" id="admin_image_input" autocomplete="off">
                                                  <small class="text-muted" id="file_error" style="display: none; color: red;">Only JPG, JPEG, and PNG files are allowed.</small>
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
                             } else {
                              // Handle case where no admin is found
                              $_SESSION['status'] = 'Admin not found';
                              $_SESSION['status_code'] = "error";
                              header("Location: admin_edit");
                              exit(0);
                          }
                      }
                         ?>

                    </div>
               </div>
          </div>
     </section>
</main>
<script>
function sanitizeInput(input) {
    const tempDiv = document.createElement('div');
    tempDiv.textContent = input;
    return tempDiv.innerHTML; // Converts any HTML to plain text
}

function validateForm() {
    const inputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="tel"]');
    
    inputs.forEach(input => {
        input.value = sanitizeInput(input.value); // Sanitize input value
    });

    const phoneInput = document.getElementById('phone_number');
    const phoneNumber = phoneInput.value;
    const phonePattern = /^09\d{9}$/;

    if (!phonePattern.test(phoneNumber)) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid Phone Number',
            text: 'Please ensure it starts with 09 and is 11 digits long.'
        });
        return false;
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
include('./includes/script.php');
include('../message.php');
?>
