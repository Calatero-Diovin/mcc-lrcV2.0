<?php 
include('signup_script_update.php');

$request = $_SERVER['REQUEST_URI'];

if (strpos($request, '.php') !== false) {
    // Redirect to remove .php extension
    $new_url = str_replace('.php', '', $request);
    header("Location: $new_url", true, 301);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/mcc-lrc.png">
    <title>MCC Learning Resource Center</title>
    <style>
        #year_levelField {
            display: none;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #777;
        }

        .toggle-password-icon {
            font-size: 16px;
        }

        .toggle-password:hover .toggle-password-icon {
            color: #333;
        }

        .invalid-feedback {
            color: red;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        .is-invalid {
            border: 1px solid red;
        }

        .field {
            margin-bottom: 15px;
            position: relative;
        }

        .invalid-feedback {
            position: absolute;
            bottom: -20px;
            left: 0;
            display: none;
        }
        #warning_message {
            font-size: 12px;
            margin-top: -30px;
            margin-bottom: -10px;
            display: none;
            color: red;
        }
        #warning_messages {
            font-size: 12px;
            margin-top: -30px;
            margin-bottom: -10px;
            display: none;
            color: red;
        }

         /* Modal styles */
         .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow-y: auto;
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 1% auto; /* 5% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
            max-width: 600px;
        }

        #confirmSignupBtn {
            padding: 10px;
            background-color: dodgerblue;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }
        #confirmSignupBtn:hover,
        #confirmSignupBtn:focus {
            background-color: black;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 16px;
            margin: 16px 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .card img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .containers {
            display: flex;
            flex-wrap: wrap;
        }

        .containers .card {
            flex: 1 1 100%;
            max-width: 100%;
        }

        @media(min-width: 600px) {
            .containers .card {
                flex: 1 1 45%;
            }
            .modal-title {
                font-size: 10px;
            }
        }

        @media(min-width: 900px) {
            .containers .card {
                flex: 1 1 30%;
            }
        }

        /* Modal background */
.modal1 {
  display: none; /* Hidden by default */
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
}

/* Modal content box */
.modal-dialog1 {
  width: 80%;
  max-width: 600px;
  margin: 100px auto;
}

.modal-content1 {
  background-color: #fff;
  border-radius: 10px;
  padding: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  overflow: hidden;
}

/* Modal header */
.modal-header1 {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.modal-title1 {
  font-size: 24px;
  font-weight: bold;
  margin: 0;
}

/* Close button */
.close-btn1 {
  font-size: 30px;
  font-weight: bold;
  color: #aaa;
  border: none;
  background: transparent;
  cursor: pointer;
}

.close-btn1:hover,
.close-btn1:focus {
  color: #000;
  text-decoration: none;
}

/* Modal body */
.modal-body1 {
  max-height: 400px;
  overflow-y: auto; /* Enable scrolling if content overflows */
  padding: 20px;
}

/* Modal footer */
.modal-footer11 {
  text-align: right;
}

.btn-close1 {
    padding: 8px;
    padding-left: 15px;
    padding-right:15px;
    margin-top: 10px;
    background-color: #dc3545;
    border-radius: 5px;
    border: none;
    color: white;
}

.btn-close1:hover {
    background-color: #bb2d3b;
}

.modal-footer1 .close-btn1 {
  background-color: #dc3545;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.modal-footer1 .close-btn1:hover {
  background-color: #c82333;
}

.modals {
        display: none; /* Hidden by default */
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-contents {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 600px;
    }

    .closes {
        color: #aaa;
        float: right;
        font-size: 30px;
        font-weight: bold;
        border: none;
        background: transparent;
        cursor: pointer;
    }

    .closes:hover,
    .closes:focus {
        color: #000;
  text-decoration: none;
        cursor: pointer;
    }

    </style>
</head>

<!-- Alertify JS link -->
<link rel="stylesheet" href="assets/css/alertify.min.css" />
<link rel="stylesheet" href="assets/css/alertify.bootstraptheme.min.css" />

<!-- Custom CSS links -->
<link rel="stylesheet" href="assets/css/signup.css">

<body>
    <div class="container">
        <header>
            <h5>SIGN<span>UP</span></h5>
        </header>
        <!-- Multi Step Form start -->
        <div class="progress-bar">
            <div class="step">
                <p>Personal</p>
                <div class="bullet">
                    <span>1</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
            <div class="step hide">
                <p>Birth</p>
                <div class="bullet">
                    <span>2</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
            <div class="step">
                <p>Contact</p>
                <div class="bullet">
                    <span>3</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
            <div class="step hide">
                <p>Contact</p>
                <div class="bullet">
                    <span>4</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
            <div class="step">
                <p>Accounts</p>
                <div class="bullet">
                    <span>5</span>
                </div>
                <div class="check fas fa-check"></div>
            </div>
        </div>

        <!-- Multi Step Form end -->
        <div class="form-outer">
            <form action="signupcode_update.php" method="POST" enctype="multipart/form-data">
                <!-- First Slide Page start-->
                <div class="page slide-page">
                    <div class="title">Personal Details:</div>

                    <div class="field">
                        <div class="label">Last Name</div>
                        <input type="text" name="lastname" id="lastname" value="<?= $code_row['lastname']; ?>" required/>
                    </div>

                    <div class="field">
                        <div class="label">First Name</div>
                        <input type="text" name="firstname" id="firstname" value="<?= $code_row['firstname']; ?>" required/>
                    </div>

                    <div class="field">
                        <div class="label">Middle Name <span style="font-weight:200;color:gray;font-size:13px;">(optional)</span></div>
                        <input type="text" name="middlename" id="middlename" value="<?= $code_row['middlename']; ?>"/>
                    </div>

                    <div class="field option">
                        <button class="firstNext next">Next</button>
                        <p>Already have an account? <a href="login">Login</a></p>
                    </div>
                </div>
                <!-- First Slide Page end-->

                <!-- Second Slide Page start-->
                <div class="page">
                    <div class="field">
                        <div class="label" for="role">User Type</div>
                        <select name="role" id="role" required>
                            <option value="" selected disabled>--Select Role--</option>
                            <option value="student">Student</option>
                            <option value="faculty">Faculty</option>
                            <option value="staff">Staff</option>
                        </select>
                    </div>

                    <div class="field">
                        <div class="label">Birthdate</div>
                        <input type="date" name="birthdate" id="birthdate" value="<?php echo htmlspecialchars($code_row['birthdate']); ?>" required/>
                    </div>

                    <div class="field">
                        <div class="label">Address</div>
                        <input type="text" name="address" id="address" value="<?php echo htmlspecialchars($code_row['address']); ?>" required/>
                    </div>

                    <div class="field">
                        <div class="label">
                            Profile Image
                            <a href="#" id="imageModalLink" style="margin-left:30px;text-decoration:none" data-bs-toggle="modal" data-bs-target="#imageModal">Sample Profile Image</a>
                        </div>
                        <input type="file" id="profile_image" name="profile_image" accept="image/*" required>
                    </div>

                    <!-- Modal -->
                    <div id="imageModal" class="modals">
                        <div class="modal-contents">
                            <button type="button"  class="closes" data-bs-dismiss="modal" id="closeImageModal">&times;</button>
                            <img id="modalImage" src="images/valid.jpg" alt="Profile Image" style="width: 100%; max-width: 500px;">
                        </div>
                    </div>


                    <div class="field btns">
                        <button class="prev-1 prev">Previous</button>
                        <button class="next-1 next">Next</button>
                    </div>
                </div>
                <!-- Second Slide Page end-->

                <!-- Third Slide Page start-->
                <div class="page">
                    <div class="field">
                        <div class="label" for="gender">Gender</div>
                        <select name="gender" id="gender" required>
                            <option value="Male" <?php echo ($code_row['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                            <option value="Female" <?php echo ($code_row['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                        </select>
                    </div>

                    <div class="field" id="year_levelField">
                        <div class="label" for="year_level">Year Level</div>
                        <select name="year_level" id="year_level">
                            <option value="4th year" <?php echo ($code_row['year_level'] == '4th year') ? 'selected' : ''; ?>>4th year</option>
                            <option value="3rd year" <?php echo ($code_row['year_level'] == '3rd year') ? 'selected' : ''; ?>>3rd year</option>
                            <option value="2nd year" <?php echo ($code_row['year_level'] == '2nd year') ? 'selected' : ''; ?>>2nd year</option>
                            <option value="1st year" <?php echo ($code_row['year_level'] == '1st year') ? 'selected' : ''; ?>>1st year</option>
                        </select>
                    </div>

                    <div class="field" id="courseField">
                        <div class="label" for="course" id="courseLabel">Course</div>
                        <select name="course" id="course">
                            <option value="" id="optionLabel" disabled selected>--Select Course--</option>
                            <option value="BSIT" <?php echo ($code_row['course'] == 'BSIT') ? 'selected' : ''; ?>>BSIT</option>
                            <option value="BSED" <?php echo ($code_row['course'] == 'BSED') ? 'selected' : ''; ?>>BSED</option>
                            <option value="BEED" <?php echo ($code_row['course'] == 'BEED') ? 'selected' : ''; ?>>BEED</option>
                            <option value="BSBA" <?php echo ($code_row['course'] == 'BSBA') ? 'selected' : ''; ?>>BSBA</option>
                            <option value="BSHM" <?php echo ($code_row['course'] == 'BSHM') ? 'selected' : ''; ?>>BSHM</option>
                            <option value="GENERAL EDUCATION" <?php echo ($code_row['course'] == 'GENERAL EDUCATION') ? 'selected' : ''; ?>>GENERAL EDUCATION</option>
                        </select>
                    </div>

                    <div class="field btns">
                        <button class="prev-2 prev">Previous</button>
                        <button class="next-2 next">Next</button>
                    </div>
                </div>
                <!-- Third Slide Page end-->

                <!-- Fourth Slide Page start-->
                <div class="page">
                    <div class="title hides">Contact Info</div>

                    <div class="field" style="margin-top:-2px;">
                        <div class="label">Email</div>
                        <input type="email" placeholder="MS 365 Email" name="email" value="<?php echo htmlspecialchars($code_row['email']); ?>" readonly required/>
                    </div>

                    <div class="field">
                        <div class="label">Cellphone No.</div>
                        <input type="tel" id="cell_no" name="cell_no" value="<?php echo htmlspecialchars($code_row['cell_no']); ?>" class="format_number" maxlength="11" placeholder="09xxxxxxxxx" oninput="validateCellphone(this)" required>
                    </div>
                    <div id="warning_message">Invalid phone number. It should start with 09 and contain 11 digits.</div>

                    <div class="field">
                        <div class="label">Contact Person</div>
                        <input type="text" id="contact_person" name="contact_person" value="<?php echo htmlspecialchars($code_row['contact_person']); ?>" required>
                    </div>

                    <div class="field">
                        <div class="label">Contact Person Cellphone No.</div>
                        <input type="tel" name="person_cell_no" value="<?php echo htmlspecialchars($code_row['person_cell_no']); ?>" class="format_number" maxlength="11" placeholder="09xxxxxxxxx" required oninput="validateNumber(this)">
                    </div>
                    <div id="warning_messages">Invalid phone number. It should start with 09 and contain 11 digits.</div>

                    <div class="field btns">
                        <button class="prev-3 prev">Previous</button>
                        <button class="next-3 next">Next</button>
                    </div>
                </div>
                <!-- Fourth Slide Page end-->

                <!-- Fifth Slide Page start-->
                <div class="page">
                    <div class="title">Login Details:</div>

                    <div class="field">
                        <div class="label" id="stud_idLabel">Student ID No.</div>
                        <input type="text" name="student_id_no" value="<?php echo htmlspecialchars($code_row['student_id_no']); ?>" id="student_id_no" oninput="formatStudentID()" required>
                    </div>

                    <div class="field btns">
                        <button class="prev-4 prev">Previous</button>
                        <button type="button" class="next-4 next" id="reviewBtn">Next</button>
                    </div>
                </div>
                <!-- Fifth Slide Page end-->

                <div id="reviewModal" class="modal">
                    <div class="modal-content">
                        <span class="close" id="closeModal">&times;</span>
                        <h2>Review Your Details</h2>
                        <div id="reviewContent"></div>
                        <button type="submit" id="confirmSignupBtn" name="register_btn">Signup</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Format Number  -->
    <script src="assets/js/format_number.js"></script>

    <!-- Font Awesome Link -->
    <script src="assets/js/kit.fontawesome.js"></script>

    <!-- Alertify JS link -->
    <script src="assets/js/alertify.min.js"></script>

    <script src="assets/js/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.0/dist/sweetalert2.all.min.js"></script>

<script>
const slidePage = document.querySelector(".slide-page");
const nextBtnFirst = document.querySelector(".firstNext");
const prevBtnSec = document.querySelector(".prev-1");
const nextBtnSec = document.querySelector(".next-1");

const prevBtnThird = document.querySelector(".prev-2");
const nextBtnThird = document.querySelector(".next-2");

const prevBtnFourth = document.querySelector(".prev-3");
const nextBtnFourth = document.querySelector(".next-3");

const prevBtnFifth = document.querySelector(".prev-4");
const reviewBtn = document.getElementById('reviewBtn');
const reviewModal = document.getElementById('reviewModal');
const confirmSignupBtn = document.getElementById('confirmSignupBtn');
const closeModal = document.querySelector('.close');

const progressText = document.querySelectorAll(".step p");
const progressCheck = document.querySelectorAll(".step .check");
const bullet = document.querySelectorAll(".step .bullet");
let current = 1;

// nextBtnFirst Start
nextBtnFirst.addEventListener("click", function (event) {
    event.preventDefault();

    const lastname = document.getElementById('lastname').value;
    const firstname = document.getElementById('firstname').value;
    const middlename = document.getElementById('middlename').value;

    // Regular expression to check for alphabetic characters only
    const nameRegex = /^[A-Za-zñÑ.\s-]+$/;

    // Check if the fields contain only letters and spaces and no leading or only spaces
    const isValidName = (name) => {
        return name.trim() !== "" && nameRegex.test(name) && !/^\s/.test(name); // checks for leading spaces
    };

    if (!lastname || !isValidName(lastname)) {
        Swal.fire({
            title: "Please fill lastname field with letters only, no space first or space only",
            icon: "error",
            confirmButtonText: "OK"
        });
        return;
    }
    if (!firstname || !isValidName(firstname)) {
        Swal.fire({
            title: "Please fill firstname field with letters only, no space first or space only",
            icon: "error",
            confirmButtonText: "OK"
        });
        return;
    }
    if (middlename && !isValidName(middlename)) {
        Swal.fire({
            title: "Please fill middlename field with letters only, no space first or space only",
            icon: "error",
            confirmButtonText: "OK"
        });
        return;
    }

    document.getElementById('firstname').value = firstname;
    document.getElementById('lastname').value = lastname;
    document.getElementById('middlename').value = middlename;

    slidePage.style.marginLeft = "-25%";
    bullet[current - 1].classList.add("active");
    progressCheck[current - 1].classList.add("active");
    progressText[current - 1].classList.add("active");
    current += 1;
});
// nextBtnFirst End

// nextBtnSec Start
nextBtnSec.addEventListener("click", function (event) {
    event.preventDefault();

    const role = document.getElementById('role').value;
    const birthdate = document.querySelector('input[name="birthdate"]').value;
    const address = document.querySelector('input[name="address"]').value;
    const profileImageInput = document.getElementById('profile_image');
    const profileImage = profileImageInput.files[0];

    const addressPattern = /^[a-zA-ZñÑ\s-]+,\s[a-zA-ZñÑ\s]+,\s[a-zA-ZñÑ\s]+$/;

    if (!role) {
        Swal.fire({
            title: "Please select user type.",
            icon: "error",
            confirmButtonText: "OK"
        });
        return;
    }

    if (!birthdate) {
        Swal.fire({
            title: "Please select or type your birthdate.",
            icon: "error",
            confirmButtonText: "OK"
        });
        return;
    }

    if (!address) {
        Swal.fire({
            title: "Please fill your address.",
            icon: "error",
            confirmButtonText: "OK"
        });
        return;
    }

    if (!addressPattern.test(address)) {
        Swal.fire({
            title: "Address must be in the format: Brgy, Municipality, Province.",
            icon: "error",
            confirmButtonText: "OK"
        });
        return;
    }

    if (!profileImage) {
        Swal.fire({
            title: "Please fill your image.",
            icon: "error",
            confirmButtonText: "OK"
        });
        return;
    }

    if (profileImage) {
        const allowedExtensions = ['jpg', 'jpeg', 'png'];
        const fileExtension = profileImage.name.split('.').pop().toLowerCase();

        if (!allowedExtensions.includes(fileExtension)) {
            Swal.fire({
                title: "Profile image must be in JPG, JPEG, or PNG format.",
                icon: "error",
                confirmButtonText: "OK"
            });
            return;
        }
    }

    slidePage.style.marginLeft = "-50%";
    bullet[current - 1].classList.add("active");
    progressCheck[current - 1].classList.add("active");
    progressText[current - 1].classList.add("active");
    current += 1;
});
// nextBtnSec End

// nextBtnThird Start
nextBtnThird.addEventListener("click", async function (event) {
    event.preventDefault();
    
    const role = document.getElementById('role').value;
    const gender = document.getElementById('gender').value;
    const yearLevel = document.getElementById('year_level').value;
    const course = document.getElementById('course').value;

    if (!gender) {
        Swal.fire({
        title: "Please select gender.",
        icon: "error",
        confirmButtonText: "OK"
        });
        return;
    }

    if (role === 'student') {
        if (!yearLevel) {
            Swal.fire({
            title: "Please select year level.",
            icon: "error",
            confirmButtonText: "OK"
            });
            return;
        }
        if (!course) {
            Swal.fire({
            title: "Please select course.",
            icon: "error",
            confirmButtonText: "OK"
            });
            return;
        }
    } else if (role === 'faculty') {
        if (!course) {
            Swal.fire({
            title: "Please select department.",
            icon: "error",
            confirmButtonText: "OK"
            });
            return;
        }
    }

    slidePage.style.marginLeft = "-75%";
    bullet[current - 1].classList.add("active");
    progressCheck[current - 1].classList.add("active");
    progressText[current - 1].classList.add("active");
    current += 1;
});
// nextBtnThird End

// nextBtnFourth Start
document.getElementById('cell_no').addEventListener('input', function (event) {
  this.value = this.value.replace(/\D/g, '');
});

document.querySelector('input[name="person_cell_no"]').addEventListener('input', function (event) {
  this.value = this.value.replace(/\D/g, '');
});

nextBtnFourth.addEventListener("click", async function (event) {
  event.preventDefault();

  const cellphone = document.getElementById('cell_no').value;
  const contactPerson = document.getElementById('contact_person').value;
  const personCellNo = document.querySelector('input[name="person_cell_no"]').value;
  const email = document.querySelector('input[name="email"]').value;

  const phonePattern = /^09\d{9}$/;
  const namePattern = /^[A-Za-zñÑ.\s-]+$/;

  const isValidName = (name) => {
    return name.trim() !== "" && namePattern.test(name) && name.trim().length > 0 && !/^\s/.test(name);
  };

  if (!cellphone || !contactPerson || !personCellNo || !email) {
    Swal.fire({
      title: "Please fill all the fields.",
      icon: "error",
      confirmButtonText: "OK"
    });
    return;
  }

  if (!email) {
    Swal.fire({
      title: "Please fill in the email.",
      icon: "error",
      confirmButtonText: "OK"
    });
    return;
  }

  if (!isValidName(contactPerson)) {
    Swal.fire({
      title: "Contact Person's name must contain only letters and spaces, and must not start with a space.",
      icon: "error",
      confirmButtonText: "OK"
    });
    return;
  }

  if (!phonePattern.test(cellphone)) {
    Swal.fire({
      title: "Please enter a valid cellphone number starting with 09 and up to 11 digits.",
      icon: "error",
      confirmButtonText: "OK"
    });
    return;
  }

  if (!phonePattern.test(personCellNo)) {
    Swal.fire({
      title: "Please enter a valid contact person's cellphone number starting with 09 and up to 11 digits.",
      icon: "error",
      confirmButtonText: "OK"
    });
    return;
  }

  slidePage.style.marginLeft = "-100%";
  bullet[current - 1].classList.add("active");
  progressCheck[current - 1].classList.add("active");
  progressText[current - 1].classList.add("active");
  current += 1;
});
// nextBtnFourth End

// submitBtn Start
document.getElementById('reviewBtn').addEventListener('click', function(event) {
    event.preventDefault();
    
    const studentId = document.getElementById('student_id_no').value;
    const role = document.getElementById('role').value; // Get the role value

    const studentIdPattern = /^\d{4}-\d{4}$/; // Pattern for student ID
    const xssPattern = /<[^>]*>/; // XSS tag pattern

    if (!studentId) {
        Swal.fire({
            title: "Please fill all fields.",
            icon: "error",
            confirmButtonText: "OK"
        });
        return;
    }

    if (role === 'student') {
        // Validate student ID only if role is 'student'
        if (!studentIdPattern.test(studentId)) {
            Swal.fire({
                title: "Please enter a valid student ID in the format 1234-5678.",
                icon: "error",
                confirmButtonText: "OK"
            });
            return;
        }
    } else if (role === 'faculty' || role === 'staff') {
        // Check for XSS tags in studentId for faculty and staff roles
        if (xssPattern.test(studentId)) {
            Swal.fire({
                title: "HTML tags not allowed!",
                icon: "error",
                confirmButtonText: "OK"
            });
            return;
        }
    }

    // If all validations pass, show the review modal
    showReviewModal();
});

function showReviewModal() {
    // Gather form data
    const lastname = document.getElementById('lastname').value;
    const firstname = document.getElementById('firstname').value;
    const middlename = document.getElementById('middlename').value;
    const role = document.getElementById('role').value; // Get the role value
    const birthdate = document.getElementById('birthdate').value;
    const address = document.getElementById('address').value;
    const profileImageFile = document.getElementById('profile_image').files[0];
    const profileImage = profileImageFile ? URL.createObjectURL(profileImageFile) : 'uploads/profile_images/default-image.jpg';
    const gender = document.getElementById('gender').value;
    const yearLevel = document.getElementById('year_level').value || 'N/A';
    const course = document.getElementById('course').value || 'N/A';
    const cellphone = document.getElementById('cell_no').value;
    const contactPerson = document.getElementById('contact_person').value;
    const personCellNo = document.querySelector('input[name="person_cell_no"]').value;
    const email = document.querySelector('input[name="email"]').value;
    const studentId = document.getElementById('student_id_no').value;

    // Define the fields based on the role
    let roleSpecificContent = '';
    let yearLevelContent = '';
    let studentIdContent = '';

    if (role === 'student') {
        yearLevelContent = `<p><strong>Year Level:</strong> ${yearLevel}</p>`;
        studentIdContent = `<p><strong>Student ID No.:</strong> ${studentId}</p>`;
        roleSpecificContent = `<p><strong>Course:</strong> ${course}</p>`;
    } else if (role === 'staff' || role === 'faculty') {
        yearLevelContent = `<p style="display: none;">Year Level: ${yearLevel}</p>`; // Hide year level for staff and faculty
        studentIdContent = `<p><strong>Username:</strong> ${studentId}</p>`;
        roleSpecificContent = `<p><strong>Department:</strong> ${course}</p>`; // Assuming `course` is used for department
    }

    // Populate review content
    document.getElementById('reviewContent').innerHTML = `
        <div class="containers">
            <div class="card">
                <h3>Profile Image</h3>
                <img src="${profileImage}" alt="Profile Image">
            </div>

            <div class="card">
                <h3>Personal Information</h3>
                <p><strong>First Name:</strong> ${firstname}</p>
                <p><strong>Middle Name:</strong> ${middlename}</p>
                <p><strong>Last Name:</strong> ${lastname}</p>
                <p><strong>Role:</strong> ${role}</p>
                ${roleSpecificContent}
                ${studentIdContent}
                ${yearLevelContent}
                <p><strong>Email:</strong> ${email}</p>
                <p><strong>Cellphone:</strong> ${cellphone}</p>
                <p><strong>Contact Person:</strong> ${contactPerson}</p>
                <p><strong>Contact Person Cellphone:</strong> ${personCellNo}</p>
                <p><strong>Birthdate:</strong> ${birthdate}</p>
                <p><strong>Address:</strong> ${address}</p>
            </div>
        </div>
    `;

    // Display modal
    document.getElementById('reviewModal').style.display = 'block';
}

// Function to close the modal
function closeModalFunction() {
    document.getElementById('reviewModal').style.display = 'none';
}

// Event listener for closing the modal
document.getElementById('closeModal').addEventListener('click', function() {
    closeModalFunction();
});

// Close modal if user clicks outside of the modal
window.addEventListener('click', function(event) {
    if (event.target === document.getElementById('reviewModal')) {
        closeModalFunction();
    }
});

// Event listener for confirming signup
document.getElementById('confirmSignupBtn').addEventListener('click', function() {
    // Submit the form programmatically
    document.querySelector('form').submit();
});

prevBtnSec.addEventListener("click", function (event) {
  event.preventDefault();
  slidePage.style.marginLeft = "0%";
  bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
});
prevBtnThird.addEventListener("click", function (event) {
  event.preventDefault();
  slidePage.style.marginLeft = "-25%";
  bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
});
prevBtnFourth.addEventListener("click", function (event) {
  event.preventDefault();
  slidePage.style.marginLeft = "-50%";
  bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
});
prevBtnFifth.addEventListener("click", function (event) {
  event.preventDefault();
  slidePage.style.marginLeft = "-75%";
  bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
});




        function togglePasswordVisibility(id) {
            const passwordInput = document.getElementById(id);
            const passwordIcon = passwordInput.nextElementSibling.querySelector('.toggle-password-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }
        
        function handleStudentIDInput(event) {
                const studentIDInput = document.getElementById('student_id_no');
                const roleSelect = document.getElementById('role');
                const selectedRole = roleSelect.value;

                if (selectedRole === 'student') {
                    // Get the raw input value
                    let value = studentIDInput.value;

                    // Allow only digits and a single dash
                    if (/[^0-9-]/.test(value)) {
                        studentIDInput.value = value.replace(/[^0-9-]/g, '');
                        return;
                    }

                    // If a dash is already present, ensure it is in the correct place
                    const dashIndex = value.indexOf('-');
                    if (dashIndex > -1 && dashIndex !== 4) {
                        // Remove dash if it's in an incorrect place
                        studentIDInput.value = value.replace(/-/, '');
                    } else if (value.length > 9) {
                        studentIDInput.value = value.slice(0, 9);
                    }
                }
            }

            // Attach the function to the input event of the student ID field
            document.getElementById('student_id_no').addEventListener('input', handleStudentIDInput);

            // Optional: Handle keydown event to block unwanted key inputs
            document.getElementById('student_id_no').addEventListener('keydown', function(event) {
                const key = event.key;
                // Allow backspace, delete, and arrow keys
                if (['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight'].includes(key)) {
                    return;
                }
                // Prevent typing a dash if it's not in the correct place
                if (key === '-' && (this.value.length < 4 || this.value.includes('-'))) {
                    event.preventDefault();
                }
            });

        document.getElementById('role').addEventListener('change', function () {
            const yearLevelField = document.getElementById('year_levelField');
            const courseField = document.getElementById('courseField');
            const stud_idLabel = document.getElementById('stud_idLabel');
            const studentIDInput = document.getElementById('student_id_no');
            const courseLabel = document.getElementById('courseLabel');
            const optionLabel = document.getElementById('optionLabel');
            const selectedRole = this.value;

            if (selectedRole === 'student') {
                yearLevelField.style.display = 'block';
                courseField.style.display = 'block';
                stud_idLabel.textContent = 'Student ID No.';
                courseLabel.textContent = 'Course';
                optionLabel.textContent = '--Select Course--';
                studentIDInput.value = '';
            } else if(selectedRole === 'faculty') {
                yearLevelField.style.display = 'none';
                stud_idLabel.textContent = 'Username';
                courseLabel.textContent = 'Department';
                optionLabel.textContent = '--Select Department--';
                studentIDInput.value = '';
            } else {
                courseField.style.display = 'none';
                yearLevelField.style.display = 'none';
                stud_idLabel.textContent = 'Username';
                courseLabel.textContent = 'Department';
                optionLabel.textContent = '--Select Department--';
                studentIDInput.value = '';
            }
        });


        // Access the modal and the close button
    const modal = document.getElementById("myModal");
    const openModalLink = document.getElementById("openModalLink");
    const closeModalBtn = document.getElementById("closeModalBtn");
    const closeModalBtnFooter = document.getElementById("closeModalBtnFooter");

    // Add event listener for the close button in the header
    closeModalBtn.addEventListener("click", function() {
        modal.style.display = "none"; // Hide the modal
    });

    // Add event listener for the close button in the footer
    closeModalBtnFooter.addEventListener("click", function() {
        modal.style.display = "none"; // Hide the modal
    });

    openModalLink.addEventListener("click", function(){
        modal.style.display = "block";
    });

    // Access the modal and the close button
    const imageModal = document.getElementById("imageModal");
        const imageModalLink = document.getElementById("imageModalLink");
        const closeImageModal = document.getElementById("closeImageModal");

        // Add event listener for the close button in the header
        closeImageModal.addEventListener("click", function() {
            imageModal.style.display = "none"; // Hide the modal
        });

        imageModalLink.addEventListener("click", function(){
            imageModal.style.display = "block";
        });
    </script>

    <?php
    include('message.php'); 
    include('includes/script.php');
    ?>
</body>

</html>