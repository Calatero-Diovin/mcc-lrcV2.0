<?php 
ini_set('session.cookie_httponly', 1);
include('includes/header.php');
include('includes/navbar.php');
include('admin/config/dbcon.php');

if (!isset($_SESSION['auth'])) {
     header('Location: .');
     exit(0);
 }

if($_SESSION['auth_role'] != "student" && $_SESSION['auth_role'] != "faculty" && $_SESSION['auth_role'] != "staff")
{
  header("Location:index.php");
  exit(0);
}

if (isset($_SESSION['auth_stud']['stud_id']))
{
     $id_session = $_SESSION['auth_stud']['stud_id'];
}

$name_session = $_SESSION['auth_stud']['stud_name']; 

$table = $_SESSION['auth_role'] == "student" ? "user" : "faculty";
?>

<style>
.password-container {
     position: relative;
}

.password-toggle {
     position: absolute;
     top: 50%;
     right: 50px;
     transform: translateY(-50%);
     cursor: pointer;
}
</style>

<!-- Include SweetAlert CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<div class="container">
     <div class="row">
          <div class="col-md-12">
               <div class="card mt-4" data-aos="fade-up">
                    <div class="card-header">
                         <h4 class="text-muted">My Profile</h4>
                    </div>
                    <div class="card-body">
                         <div class="row">
                              <div class="col-xl-4">
                                   <?php
                                   $query = "SELECT * FROM $table WHERE ".($table == 'user' ? 'user_id' : 'faculty_id')." = '$id_session'";
                                   $query_run = mysqli_query($con, $query);
                                   $row = mysqli_fetch_array($query_run);
                                   ?>
                                   <div class="card">
                                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                             <center>
                                                  <?php if($row['profile_image'] != ""): ?>
                                                            <img src="uploads/profile_images/<?php echo $row['profile_image']; ?>" alt="Image" style="border-radius: 5px;" width="200px" height="200px">
                                                  <?php else: ?>
                                                       <img src="uploads/books_img/book_image.jpg" alt="Book Image" width="200px" height="250px">
                                                  <?php endif; ?>
                                             </center>
                                             <br>
                                             <h4><?= strtoupper($row['student_id_no']); ?></h4>
                                             <h3><?= strtoupper($row['role_as']); ?></h3>
                                        </div>
                                   </div>
                                   <div class="card">
                                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                             <center>
                                                  <?php if($row['qr_code'] != ""): ?>
                                                            <img src="qrcodes/<?php echo $row['qr_code']; ?>" alt="QR Code" style="border-radius: 5px;" width="200px" height="200px">
                                                            <br>
                                                            <a href="qrcodes/<?php echo $row['qr_code']; ?>" download="QR_Code_<?php echo $row['student_id_no']; ?>.png" class="btn btn-primary mt-2">Download QR Code</a>
                                                  <?php else: ?>
                                                       <img src="uploads/books_img/book_image.jpg" alt="No QR Code" width="200px" height="250px">
                                                  <?php endif; ?>
                                             </center>
                                             <br>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-xl-8">
                                   <div class="card">
                                        <div class="card-body pt-3">
                                             <ul class="nav nav-tabs nav-tabs-bordered">
                                                  <li class="nav-item">
                                                       <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                                                  </li>
                                             </ul>
                                             <div class="tab-content pt-2">
                                                  <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
                                                       <?php
                                                       if(mysqli_num_rows($query_run))
                                                       {
                                                            foreach($query_run as $user)
                                                            {
                                                       ?>
                                                       <form action="allcode.php" method="POST" enctype="multipart/form-data">
                                                            <div class="row mb-3">
                                                                 <label for="firstname" class="col-md-4 col-lg-3 col-form-label">Firstname</label>
                                                                 <div class="col-md-8 col-lg-9">
                                                                      <input name="firstname" type="text" class="form-control" id="firstname" value="<?=$user['firstname']?>" required>
                                                                      <div class="invalid-feedback">
                                                                           First name must start with a capital letter.
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                 <label for="middlename" class="col-md-4 col-lg-3 col-form-label">Middlename</label>
                                                                 <div class="col-md-8 col-lg-9">
                                                                      <input name="middlename" type="text" id="middlename" class="form-control" value="<?=$user['middlename']?>">
                                                                      <div class="invalid-feedback">
                                                                           Middle name must start with a capital letter.
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                 <label for="lastname" class="col-md-4 col-lg-3 col-form-label">Lastname</label>
                                                                 <div class="col-md-8 col-lg-9">
                                                                      <input name="lastname" type="text" class="form-control" id="lastname" value="<?=$user['lastname']?>" required>
                                                                      <div class="invalid-feedback">
                                                                           Last name must start with a capital letter.
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                 <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                                                 <div class="col-md-8 col-lg-9">
                                                                      <input 
                                                                           name="address" 
                                                                           type="text" 
                                                                           class="form-control" 
                                                                           id="Address" 
                                                                           value="<?=$user['address']?>" 
                                                                           required
                                                                           pattern="^[A-Za-z]+, [A-Za-z]+, [A-Za-z]+$"
                                                                           title="Please enter the address in the format: City, Municipality, Province"
                                                                           oninput="validateAddress(this)"
                                                                      >
                                                                      <small id="addressError" class="form-text text-danger" style="display: none;">Please enter the address in the format: City, Municipality, Province</small>
                                                                 </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                 <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                                                 <div class="col-md-8 col-lg-9">
                                                                      <input type="text" class="form-control format_number" name="phone" id="Phone" placeholder="09xxxxxxxxx" maxlength="11" value="<?=$user['cell_no']?>" required>
                                                                      <div class="invalid-feedback">
                                                                           Phone number must start with "09" and be exactly 11 digits long.
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                 <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                                                 <div class="col-md-8 col-lg-9">
                                                                      <input name="email" type="email" class="form-control" id="Email" value="<?=$user['email']?>" readonly required>
                                                                 </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                 <label for="contact_person" class="col-md-4 col-lg-3 col-form-label">Contact Person</label>
                                                                 <div class="col-md-8 col-lg-9">
                                                                      <input name="contact_person" type="text" class="form-control" id="contact_person" value="<?=$user['contact_person']?>" required>
                                                                 </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                 <label for="contact_person_cell" class="col-md-4 col-lg-3 col-form-label">Contact Person Cellphone Number</label>
                                                                 <div class="col-md-8 col-lg-9">
                                                                      <input type="text" class="form-control format_number" name="contact_person_cell" id="contact_person_cell" placeholder="09xxxxxxxxx" maxlength="11" value="<?=$user['person_cell_no']?>" required>
                                                                      <div class="invalid-feedback">
                                                                           Contact Person's phone number must start with "09" and be exactly 11 digits long.
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                            <div class="text-center">
                                                                 <button type="submit" name="save_changes" class="btn btn-primary">Save Changes</button>
                                                            </div>
                                                       </form>
                                                       <?php
                                                            }
                                                       }
                                                       else
                                                       {
                                                            echo "No records found";
                                                       }                                           
                                                       ?>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<script>
     const firstnameInput = document.getElementById('firstname');
     // Function to handle input validation
     firstnameInput.addEventListener('input', function() {
     // Remove leading and trailing spaces
     let value = firstnameInput.value.trim();

     // Replace multiple consecutive spaces with a single space
     value = value.replace(/\s+/g, ' ');

     // Ensure the input does not start with a space
     if (value.startsWith(' ')) {
          firstnameInput.value = '';
          return;  // exit if input starts with space
     }

     // Capitalize first letter of each word, and make other letters lowercase
     value = value.replace(/\b\w/g, char => char.toUpperCase())
                    .replace(/\B\w/g, char => char.toLowerCase());

     // Set the processed value back to the input field
     firstnameInput.value = value;

     // If input is empty or contains only spaces after trimming, mark as invalid
     if (!value || value.trim().length === 0) {
          firstnameInput.setCustomValidity('Please enter a valid first name.');
     } else {
          firstnameInput.setCustomValidity('');
     }
     });
</script>

<?php
include('includes/footer.php');
include('includes/script.php');
include('message.php'); 
?>
