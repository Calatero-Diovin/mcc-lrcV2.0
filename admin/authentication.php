<?php
ini_set('session.cookie_httponly', 1);
session_start();
include('config/dbcon.php');

if(!isset($_SESSION['auth']))
{
  $_SESSION['status'] = "Login to Access Dashboard";
  $_SESSION['status_code'] = "error";
  header("Location:../admin_login.php");
  exit(0);
}
else
{
  if($_SESSION['auth_role'] != "Admin" && $_SESSION['auth_role'] != "Staff")
  {
    $_SESSION['status'] = "You are not authorized to access this page";
    $_SESSION['status_code'] = "error";
    header("Location:../admin_login.php");
    exit(0);
  }
}
?>
