<?php
include('authentication.php');

// Edit Student
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit_student_id'])) {
        $studentId = mysqli_real_escape_string($con, $_POST['edit_student_id']);
        $lName = mysqli_real_escape_string($con, $_POST['edit_last_name']);
        $fName = mysqli_real_escape_string($con, $_POST['edit_first_name']);
        $email = mysqli_real_escape_string($con, $_POST['edit_email']);

        $sql = "UPDATE ms_account SET firstname='$fName', lastname='$lName', username='$email' WHERE ms_id='$studentId'";
        if (mysqli_query($con, $sql)) {
            $_SESSION['status'] = "Updated MS Account successfully.";
            $_SESSION['status_code'] = "success";
            header('Location: ms_account.php');
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($con);
        }
    }
}

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $sql = "SELECT * FROM ms_account WHERE ms_id = '$userId'";
    $result = mysqli_query($con, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'Student MS Account not found']);
    }
}
?>
