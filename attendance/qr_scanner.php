<?php
session_start();
include('../admin/config/dbcon.php');

$request = $_SERVER['REQUEST_URI'];

if (strpos($request, '.php') !== false) {
    // Redirect to remove .php extension
    $new_url = str_replace('.php', '', $request);
    header("Location: $new_url", true, 301);
    exit();
}

// Set the timezone to the Philippines
date_default_timezone_set('Asia/Manila');

if (isset($_POST['text'])) {
    $qr_code = $_POST['text'];

    // Query to select student based on student_id_no
    $student_query = "SELECT * FROM user WHERE student_id_no = ? AND status = 'approved'";
    $student_query_stmt = $con->prepare($student_query);
    $student_query_stmt->bind_param("s", $qr_code);
    $student_query_stmt->execute();
    $student_query_result = $student_query_stmt->get_result();

    // Query to select faculty based on username
    $faculty_query = "SELECT * FROM faculty WHERE username = ? AND status = 'approved'";
    $faculty_query_stmt = $con->prepare($faculty_query);
    $faculty_query_stmt->bind_param("s", $qr_code);
    $faculty_query_stmt->execute();
    $faculty_query_result = $faculty_query_stmt->get_result();

    $date_log = date("Y-m-d");
    $current_time = date("Y-m-d H:i:s");

    if (mysqli_num_rows($student_query_result) > 0) {
        $user = mysqli_fetch_assoc($student_query_result);

        // Check for existing log entry for today
        $student_id = $user['student_id_no'];
        $log_check_query = "SELECT * FROM user_log WHERE student_id = ? AND date_log = ? AND time_out = ''";
        $log_check_stmt = $con->prepare($log_check_query);
        $log_check_stmt->bind_param("ss", $student_id, $date_log);
        $log_check_stmt->execute();
        $log_check_result = $log_check_stmt->get_result();

        if (mysqli_num_rows($log_check_result) > 0) {
            // Update the existing log with time_out
            $log_update_query = "UPDATE user_log SET time_out = ? WHERE student_id = ? AND date_log = ? AND time_out = ''";
            $log_update_stmt = $con->prepare($log_update_query);
            $log_update_stmt->bind_param("sss", $current_time, $student_id, $date_log);
            $log_update_stmt->execute();

            if ($log_update_stmt->affected_rows > 0) {
                header("Location:.");
                exit();
            } else {
                header("Location:qr_scanner.php");
                exit("Failed to update time out for student.");
            }
        } else {
            // Insert student log into user_log table
            $firstname = $user['firstname'];
            $middlename = $user['middlename'];
            $lastname = $user['lastname'];
            $course = $user['course'];
            $year_level = $user['year_level'];

            $log_insert_query = "INSERT INTO user_log (student_id, firstname, middlename, lastname, time_log, date_log, time_out, course, year_level, role) 
                                 VALUES (?, ?, ?, ?, ?, ?, '', ?, ?, 'student')";
            $log_insert_stmt = $con->prepare($log_insert_query);
            $log_insert_stmt->bind_param("ssssssss", $student_id, $firstname, $middlename, $lastname, $current_time, $date_log, $course, $year_level);
            $log_insert_stmt->execute();

            if ($log_insert_stmt->affected_rows > 0) {
                header("Location:index.php");
                exit();
            } else {
                header("Location:qr_scanner.php");
                exit("Failed to insert log for student.");
            }
        }
    } elseif (mysqli_num_rows($faculty_query_result) > 0) {
        $user = mysqli_fetch_assoc($faculty_query_result);

        // Check for existing log entry for today
        $username = $user['username'];
        $log_check_query = "SELECT * FROM user_log WHERE student_id = ? AND date_log = ? AND time_out = ''";
        $log_check_stmt = $con->prepare($log_check_query);
        $log_check_stmt->bind_param("ss", $username, $date_log);
        $log_check_stmt->execute();
        $log_check_result = $log_check_stmt->get_result();

        if (mysqli_num_rows($log_check_result) > 0) {
            // Update the existing log with time_out
            $log_update_query = "UPDATE user_log SET time_out = ? WHERE student_id = ? AND date_log = ? AND time_out = ''";
            $log_update_stmt = $con->prepare($log_update_query);
            $log_update_stmt->bind_param("sss", $current_time, $username, $date_log);
            $log_update_stmt->execute();

            if ($log_update_stmt->affected_rows > 0) {
                header("Location:index.php");
                exit();
            } else {
                header("Location:qr_scanner.php");
                exit("Failed to update time out for faculty.");
            }
        } else {
            // Insert faculty log into user_log table
            $firstname = $user['firstname'];
            $middlename = $user['middlename'];
            $lastname = $user['lastname'];
            $course = $user['course'];

            $log_insert_query = "INSERT INTO user_log (student_id, firstname, middlename, lastname, time_log, date_log, time_out, course, role) 
                                 VALUES (?, ?, ?, ?, ?, ?, '', ?, 'faculty')";
            $log_insert_stmt = $con->prepare($log_insert_query);
            $log_insert_stmt->bind_param("sssssss", $username, $firstname, $middlename, $lastname, $current_time, $date_log, $course);
            $log_insert_stmt->execute();

            if ($log_insert_stmt->affected_rows > 0) {
                header("Location:index.php");
                exit();
            } else {
                header("Location:qr_scanner.php");
                exit("Failed to insert log for faculty.");
            }
        }
    } else {
        exit("User not found");
    }
} else {
    exit("No QR code provided");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="noindex, nofollow" />
    <link rel="icon" href="../images/mcc-lrc.png">
    <title>MCC Learning Resource Center - QR Scanner</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/boxicons.min.css" rel="stylesheet" />
    <link href="assets/css/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/alertify.min.css" />
    <link rel="stylesheet" href="assets/css/alertify.bootstraptheme.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <script type="text/javascript" src="js/instascan.min.js"></script>
    <script type="text/javascript" src="js/vue.min.js"></script>
    <script type="text/javascript" src="js/adapter.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script>
        function updateClock() {
            var now = new Date();
            var hours = now.getHours();
            var minutes = now.getMinutes().toString().padStart(2, '0');
            var seconds = now.getSeconds().toString().padStart(2, '0');
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            var timeString = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
            document.getElementById('time').innerText = timeString;
        }
        setInterval(updateClock, 1000);
    </script>
    <style>
        #time {
            font-size: 3.5rem;
            font-weight: bold;
            color: black;
        }
    </style>
</head>

<body onload="updateClock()">
    <header id="header" class="header fixed-top d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a href="#" class="logo d-flex align-items-center">
                <img src="../images/mcc-lrc.png" alt="logo" class=" mx-2" />
                <span class="d-none d-lg-block mx-2">MCC <span class="text-info d-block fs-6">Learning Resource Center</span></span>
            </a>
        </div>
        <div class="d-flex align-items-center">
            <span id="time" class="mx-2 text-black"></span>
        </div>
        <div class="d-flex align-items-center">
            <a href="index.php" class="btn btn-primary position-relative mx-5">
                Back
            </a>
        </div>
    </header>

    <main id="main" class="main">
        <section class="section dashboard">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <video id="preview" width="100%"></video>
                    </div>
                    <div class="col-md-6">
                        <form action="qr_scanner.php" method="post" class="form-horizontal">
                            <label>SCAN QR CODE</label>
                            <input type="text" name="text" id="text" readonly="" placeholder="scan qrcode" class="form-control">
                        </form>
                        <br>
                        <?php if ($user['role'] == 'student'): ?>
                            <img src="uploads/profile_images/<?= htmlspecialchars($user['profile_image']) ?>" alt="user image" width="50%" height="50%">
                            <p><?= htmlspecialchars($user['firstname']) . ' ' . htmlspecialchars($user['lastname']) ?></p>
                            <p><?= htmlspecialchars($user['course']) ?></p>
                            <p><?= htmlspecialchars($user['year_level']) ?></p>
                        <?php elseif ($user['role'] == 'faculty'): ?>
                            <img src="uploads/profile_images/<?= htmlspecialchars($user['profile_image']) ?>" alt="user image" width="50%" height="50%">
                            <p><?= htmlspecialchars($user['firstname']) . ' ' . htmlspecialchars($user['lastname']) ?></p>
                            <p><?= htmlspecialchars($user['course']) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer id="footer" class="footer">
        <div class="copyright">
            <strong><span>MCC</span></strong>. Learning Resource Center 2.0
        </div>
    </footer>

    <script>
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
        Instascan.Camera.getCameras().then(function(cameras){
            if(cameras.length > 0 ){
                scanner.start(cameras[0]);
            } else{
                alert('No cameras found');
            }
        }).catch(function(e) {
            console.error(e);
        });

        scanner.addListener('scan', function(c) {
            console.log(c); // Log the QR code value
            document.getElementById('text').value = c;
            document.forms[0].submit();
        });

    </script>
</body>

</html>
