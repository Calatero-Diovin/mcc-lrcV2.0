<?php
include('../admin/config/dbcon.php');

// Set the timezone to the Philippines
date_default_timezone_set('Asia/Manila');

if (isset($_POST['text'])) {
    $qr_code = $_POST['text'];

    // Query to select student based on student_id_no
    $student_query = "SELECT * FROM user WHERE student_id_no = '$qr_code' AND status = 'approved'";
    $student_query_run = mysqli_query($con, $student_query);

    // Query to select faculty based on username
    $faculty_query = "SELECT * FROM faculty WHERE username = '$qr_code' AND status = 'approved'";
    $faculty_query_run = mysqli_query($con, $faculty_query);

    $date_log = date("Y-m-d");
    $current_time = date("Y-m-d H:i:s");

    // Check if the QR code belongs to a student
    if (mysqli_num_rows($student_query_run) > 0) {
        $user = mysqli_fetch_assoc($student_query_run);

        // Check for existing log entry for today
        $student_id = $user['student_id_no'];
        $log_check_query = "SELECT * FROM user_log WHERE student_id = '$student_id' AND date_log = '$date_log' AND time_out = ''";
        $log_check_query_run = mysqli_query($con, $log_check_query);

        if (mysqli_num_rows($log_check_query_run) > 0) {
            // Update the existing log with time_out
            $log_update_query = "UPDATE user_log SET time_out = '$current_time' WHERE student_id = '$student_id' AND date_log = '$date_log' AND time_out = ''";
            $log_update_query_run = mysqli_query($con, $log_update_query);

            if ($log_update_query_run) {
                echo json_encode(['status' => 'success', 'message' => 'Time-out recorded successfully for student']);
                exit();
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update time-out for student']);
                exit();
            }
        } else {
            // Insert student log into the user_log table
            $student_id = $user['student_id_no'];
            $firstname = $user['firstname'];
            $middlename = $user['middlename'];
            $lastname = $user['lastname'];
            $course = $user['course'];
            $year_level = $user['year_level'];
            $profile_image = $user['profile_image'];

            $log_insert_query = "INSERT INTO user_log (student_id, firstname, middlename, lastname, time_log, date_log, time_out, course, year_level, role) 
                                 VALUES ('$student_id', '$firstname', '$middlename', '$lastname', '$current_time', '$date_log', '', '$course', '$year_level', 'student')";
            $log_insert_query_run = mysqli_query($con, $log_insert_query);

            if ($log_insert_query_run) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Successfully logged student in.',
                    'user' => [
                        'student_id_no' => $student_id,
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'profile_image' => $profile_image,
                        'course' => $course,
                        'year_level' => $year_level
                    ]
                ]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to log student in.']);
            }
        }
    } elseif (mysqli_num_rows($faculty_query_run) > 0) {
        $user = mysqli_fetch_assoc($faculty_query_run);

        // Check for existing log entry for today
        $username = $user['username'];
        $log_check_query = "SELECT * FROM user_log WHERE student_id = '$username' AND date_log = '$date_log' AND time_out = ''";
        $log_check_query_run = mysqli_query($con, $log_check_query);

        if (mysqli_num_rows($log_check_query_run) > 0) {
            // Update the existing log with time_out
            $log_update_query = "UPDATE user_log SET time_out = '$current_time' WHERE student_id = '$username' AND date_log = '$date_log' AND time_out = ''";
            $log_update_query_run = mysqli_query($con, $log_update_query);

            if ($log_update_query_run) {
                echo json_encode(['status' => 'success', 'message' => 'Time-out recorded successfully for faculty']);
                exit();
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update time-out for faculty']);
                exit();
            }
        } else {
            // Insert faculty log into the user_log table
            $username = $user['username'];
            $firstname = $user['firstname'];
            $middlename = $user['middlename'];
            $lastname = $user['lastname'];
            $course = $user['course'];
            $profile_image = $user['profile_image'];

            $log_insert_query = "INSERT INTO user_log (student_id, firstname, middlename, lastname, time_log, date_log, time_out, course, role) 
                                 VALUES ('$username', '$firstname', '$middlename', '$lastname', '$current_time', '$date_log', '', '$course', 'faculty')";
            $log_insert_query_run = mysqli_query($con, $log_insert_query);

            if ($log_insert_query_run) {
                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Successfully logged faculty in.',
                    'user' => [
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'course' => $course,
                    'profile_image' => $profile_image
                ]
                ]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to log faculty in.']);
            }
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User not found']);
        exit();
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No QR code provided']);
    exit();
}
?>
