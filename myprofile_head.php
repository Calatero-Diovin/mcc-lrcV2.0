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
