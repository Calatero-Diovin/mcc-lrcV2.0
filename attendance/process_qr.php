<?php
include('../admin/config/dbcon.php');

// Set timezone
date_default_timezone_set('Asia/Manila');

if (isset($_POST['text'])) {
    $qr_code = $_POST['text'];

    // Prepare statements to prevent SQL injection
    $student_stmt = $con->prepare("SELECT * FROM user WHERE student_id_no = ?");
    $student_stmt->bind_param("s", $qr_code);
    $student_stmt->execute();
    $student_query_run = $student_stmt->get_result();

    $faculty_stmt = $con->prepare("SELECT * FROM faculty WHERE username = ?");
    $faculty_stmt->bind_param("s", $qr_code);
    $faculty_stmt->execute();
    $faculty_query_run = $faculty_stmt->get_result();

    $date_log = date("Y-m-d");

    if ($student_query_run->num_rows > 0) {
        $user = $student_query_run->fetch_assoc();
        $student_id = $user['student_id_no'];

        // Check for existing log entry for today
        $log_check_stmt = $con->prepare("SELECT * FROM user_log WHERE student_id = ? AND date_log = ? AND time_out = ''");
        $log_check_stmt->bind_param("ss", $student_id, $date_log);
        $log_check_stmt->execute();
        $log_check_query_run = $log_check_stmt->get_result();

        if ($log_check_query_run->num_rows > 0) {
            // Update the existing log with time_out
            $log_update_stmt = $con->prepare("UPDATE user_log SET time_out = NOW() WHERE student_id = ? AND date_log = ? AND time_out = ''");
            $log_update_stmt->bind_param("ss", $student_id, $date_log);
            if ($log_update_stmt->execute()) {
                header("Location: index.php");
                exit();
            } else {
                exit("Failed to update time out for student.");
            }
        } else {
            // Insert student log into user_log table
            $log_insert_stmt = $con->prepare("INSERT INTO user_log (student_id, firstname, middlename, lastname, time_log, date_log, time_out, course, year_level, role) VALUES (?, ?, ?, ?, NOW(), ?, '', ?, ?, 'student')");
            $log_insert_stmt->bind_param("ssssss", $student_id, $user['firstname'], $user['middlename'], $user['lastname'], $date_log, $user['course']);
            if ($log_insert_stmt->execute()) {
                header("Location: index.php");
                exit();
            } else {
                exit("Failed to insert log for student.");
            }
        }
    } elseif ($faculty_query_run->num_rows > 0) {
        $user = $faculty_query_run->fetch_assoc();
        $username = $user['username'];

        // Check for existing log entry for today
        $log_check_stmt = $con->prepare("SELECT * FROM user_log WHERE student_id = ? AND date_log = ? AND time_out = ''");
        $log_check_stmt->bind_param("ss", $username, $date_log);
        $log_check_stmt->execute();
        $log_check_query_run = $log_check_stmt->get_result();

        if ($log_check_query_run->num_rows > 0) {
            // Update the existing log with time_out
            $log_update_stmt = $con->prepare("UPDATE user_log SET time_out = NOW() WHERE student_id = ? AND date_log = ? AND time_out = ''");
            $log_update_stmt->bind_param("ss", $username, $date_log);
            if ($log_update_stmt->execute()) {
                header("Location: index.php");
                exit();
            } else {
                exit("Failed to update time out for faculty.");
            }
        } else {
            // Insert faculty log into user_log table
            $log_insert_stmt = $con->prepare("INSERT INTO user_log (student_id, firstname, middlename, lastname, time_log, date_log, time_out, course, year_level, role) VALUES (?, ?, ?, ?, NOW(), ?, '', ?, 'faculty')");
            $log_insert_stmt->bind_param("ssssss", $username, $user['firstname'], $user['middlename'], $user['lastname'], $date_log, $user['course']);
            if ($log_insert_stmt->execute()) {
                header("Location: index.php");
                exit();
            } else {
                exit("Failed to insert log for faculty.");
            }
        }
    } else {
        exit("User  not found");
    }
} else {
    exit("Invalid request. No QR code provided.");
}
?>