<?php
include('authentication.php');
include('includes/header.php');
include('includes/sidebar.php');

if (isset($_SESSION['auth_admin']['admin_id']))
{
     $id_session=$_SESSION['auth_admin']['admin_id'];

}
?>

<main id="main" class="main">
     <div class="pagetitle">
          <h1>Profile</h1>
          <nav>
               <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href=".">Home</a></li>
                    <li class="breadcrumb-item"><a href="admin.php">Admin</a></li>
                    <li class="breadcrumb-item active">Profile</li>
               </ol>
          </nav>
     </div>
     <section class="section profile">
          <div class="row">
               <div class="col-xl-4">
                    <?php
               $query = "SELECT * FROM admin WHERE admin_id = '$id_session'";
               $query_run = mysqli_query($con, $query);
               $row = mysqli_fetch_array($query_run);
                
               ?>
                    <div class="card">
                         <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                              <?php if($row['admin_image'] != ""): ?>
                              <img src="../uploads/admin_profile/<?php echo $row['admin_image']; ?>" alt=""
                                   class="rounded-circle">
                              <?php else: ?>
                              <img src="../assets/admin_profile/admin.png" alt="" class="rounded-circle">
                              <?php endif; ?>
                              <h2><?= $_SESSION['auth_admin']['admin_name']; ?></h2>
                              <h3>Admin</h3>

                         </div>
                    </div>
               </div>
               <div class="col-xl-8">
                    <div class="card">
                         <div class="card-body pt-3">
                              <ul class="nav nav-tabs nav-tabs-bordered  ">

                                   <li class="nav-item"> <button class="nav-link active " data-bs-toggle="tab"
                                             data-bs-target="#profile-edit">Edit
                                             Profile</button></li>
                              </ul>
                              <div class="tab-content pt-2">

                                   <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
                                        <?php
                                             $query = "SELECT * FROM admin WHERE admin_id = '$id_session' ";
                                             $query_run = mysqli_query($con, $query);
                                             
                                             if(mysqli_num_rows($query_run))
                                             {
                                                  foreach($query_run as $admin)
                                                  {
                                                       ?>
                                        <form action="account_settings_code.php" method="POST"
                                             enctype="multipart/form-data">
                                             <div class="row mb-3">
                                                  <label for="profileImage"
                                                       class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                                  <div class="col-md-8 col-lg-9">
                                                       <!-- <img src="assets/img/profile-img.jpg" alt="Profile"> -->

                                                       <div class="pt-2">
                                                            <input type="hidden" name="old_admin_image"
                                                                 value="<?=$admin['admin_image'];?>">
                                                            <input type="file" name="admin_image" class="form-control"
                                                                 autocomplete="off">

                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="row mb-3">
                                                  <label for="firstname"
                                                       class="col-md-4 col-lg-3 col-form-label">Firstname</label>
                                                  <div class="col-md-8 col-lg-9"> <input name="firstname" type="text"
                                                            class="form-control" id="firstname"
                                                            value="<?=$admin['firstname']?>"></div>
                                             </div>

                                             <div class="row mb-3">
                                                  <label for="middlename"
                                                       class="col-md-4 col-lg-3 col-form-label">Middlename</label>
                                                  <div class="col-md-8 col-lg-9"> <input name="middlename" type="text"
                                                            class="form-control" id="middlename" value="<?=$admin['middlename']?>">
                                                  </div>
                                             </div>
                                             <div class="row mb-3">
                                                  <label for="lastname"
                                                       class="col-md-4 col-lg-3 col-form-label">Lastname</label>
                                                  <div class="col-md-8 col-lg-9"> <input name="lastname" type="text"
                                                            class="form-control" id="lastname"
                                                            value="<?=$admin['lastname']?>">
                                                  </div>
                                             </div>

                                             <div class="row mb-3">
                                                  <label for="Address"
                                                       class="col-md-4 col-lg-3 col-form-label">Address</label>
                                                  <div class="col-md-8 col-lg-9"> <input name="address" type="text"
                                                            class="form-control" id="Address" value="<?=$admin['address']?>"></div>
                                             </div>
                                             <div class="row mb-3">
                                                  <label for="Phone"
                                                       class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                                  <div class="col-md-8 col-lg-9"> <input name="phone" type="tel"
                                                            class="form-control" id="Phone"
                                                            maxlength="11"
                                                            value="<?=$admin['phone_number']?>">
                                                       </div>
                                             </div>
                                             <div class="row mb-3">
                                                  <label for="Email"
                                                       class="col-md-4 col-lg-3 col-form-label">Email</label>
                                                  <div class="col-md-8 col-lg-9"> <input name="email" type="email"
                                                            class="form-control" id="Email"
                                                            value="<?=$admin['email']?>" readonly></div>
                                             </div>
                                             <?php
                                                  }
                                             }
                                             else
                                             {
                                                  echo "No records found";
                                             }                                           
                                             ?>

                                             <div class="text-center"> <button type="submit" name="save_changes"
                                                       class="btn btn-primary">Save Changes</button></div>
                                        </form>
                                   </div>
                              </div>
                         </div>
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

     document.getElementById('Address').addEventListener('input', function () {
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

     document.getElementById('Phone').addEventListener('input', function () {
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
</script>

<?php
include('includes/footer.php');
include('./includes/script.php');
include('message.php');
?>
