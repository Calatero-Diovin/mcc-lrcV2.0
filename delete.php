<?php 
ini_set('session.cookie_httponly', 1);
session_start();
include('./admin/config/dbcon.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon" href="./assets/img/mcc-logo.png">
     <title>MS 365 Verification</title>
     
        <!-- Alertify JS link -->
        <link rel="stylesheet" href="assets/css/alertify.min.css" />
     <link rel="stylesheet" href="assets/css/alertify.bootstraptheme.min.css" />
     <link rel="stylesheet" href="assets/css/bootstrap-icons.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">

     <!-- Iconscout cdn link -->
     <link rel="stylesheet" href="assets/css/line.css">
     <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
     
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="assets/css/bootstrap5.min.css" />

     <!-- Bootstrap Icon -->
     <link rel="stylesheet" href="assets/font/bootstrap-icons.css">

     <!-- Custom CSS Styling -->
     <link rel="stylesheet" href="assets/css/login.css">

     
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

     <style>
          .back{
               position: fixed;
               left:20px;
               top:10px;
               font-size: 30px;
               color: black;
          }
          .back:hover{
               color: gray;
          }
     </style>
</head>

<body>

<main id="main" class="main">
     <div class="pagetitle">
          <h1>Admin</h1>
          <nav>
               <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href=".">Home</a></li>
                    <li class="breadcrumb-item active">Admin</li>
               </ol>
          </nav>
     </div>
     <section class="section">
          <div class="row">
               <div class="col-lg-12">
                    <div class="card">
                         <div class="card-header d-flex justify-content-end">
                              <a href="admin_add" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Add
                                   Admin</a>
                         </div>
                         <div class="card-body">
                              <div class="table-responsive mt-3">
                                   <table id="myDataTable" class="table table-bordered table-striped table-sm">
                                        <thead>
                                             <tr>
                                                  <th>ID</th>
                                                  <th>Image</th>
                                                  <th>Full Name</th>
                                                  <th>Phone Number</th>
                                                  <th>Email</th>
                                                  <th>Address</th>
                                                  <th>Action</th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                             <?php
                                             $query = "SELECT * FROM admin";
                                             $query_run = mysqli_query($con, $query);
                                             
                                             if(mysqli_num_rows($query_run))
                                             {
                                                  foreach($query_run as $admin)
                                                  {
                                                       ?>
                                             <tr>
                                             <td class="auto-id" style="text-align: center;"></td>
                                                  <td>
                                                       <center>
                                                            <?php if($admin['admin_image'] != ""): ?>
                                                            <img src="../uploads/admin_profile/<?php echo $admin['admin_image']; ?>"
                                                                 alt="" width="60px" height="60px"
                                                                 class="rounded-circle">
                                                            <?php else: ?>
                                                            <img src="../uploads/admin_profile/girl.png" alt=""
                                                                 class="rounded-circle" width="60px" height="60px">
                                                            <?php endif; ?>
                                                       </center>
                                                  </td>
                                                  <td>
                                                       <?=$admin['firstname'].' '.$admin['middlename'].' '.$admin['lastname'];?>
                                                  </td>
                                                  <td><?=$admin['phone_number'];?></td>
                                                  <td><?=$admin['email'];?></td>
                                                  <td><?=$admin['address'];?></td>
                                                  <td class=" justify-content-center">
                                                       <div class="btn-group" style="background: #DFF6FF;  ">
                                                            <!-- View Admin Action-->
                                                            <a href="admin_view?id=<?=$admin['admin_id']; ?>"
                                                                 name="view_admin"
                                                                 class="viewAdminBtn btn btn-sm  border text-primary"
                                                                 data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                 title="View Admin">
                                                                 <i class="bi bi-eye-fill"></i>
                                                            </a>
                                                            <!-- Edit Admin Action-->
                                                            <a href="admin_edit?id=<?= $admin['admin_id']; ?>"
                                                                 name="update_admin"
                                                                 class="btn btn-sm  border text-success"
                                                                 data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                 title="Edit Admin">
                                                                 <i class="bi bi-pencil-fill"></i>
                                                            </a>
                                                            <!-- Delete Admin Action-->
                                                            <button type="button" class="btn btn-sm border text-danger"
                                                                 data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                 title="Delete Admin" onclick="confirmDelete(<?=$admin['admin_id'];?>)">
                                                                 <i class="bi bi-trash-fill"></i>
                                                            </button>
                                                       </div>
                                                  </td>
                                             </tr>

                                             <?php
                                                  }
                                             }
                                             else
                                             {
                                                  echo "No records found";
                                             }                                           
                                             ?>
                                        </tbody>
                                   </table>
                                   <form id="delete-form" action="admin_code.php" method="POST" style="display: none;">
                                        <input type="hidden" name="delete_admin" id="delete-admin-id">
                                   </form>
                              </div>
                         </div>
                         <div class="card-footer"></div>
                    </div>
               </div>
          </div>
     </section>
</main>
<?php 
include('includes/script.php');
?>

<script>
function confirmDelete(adminId) {
    Swal.fire({
        title: 'Are you sure to delete this?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-admin-id').value = adminId;
            document.getElementById('delete-form').submit();
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
     // Add auto-increment ID to Books Table
     let booksTable = document.querySelector('#myDataTable tbody');
     let bookRows = booksTable.querySelectorAll('tr');
     bookRows.forEach((row, index) => {
          row.querySelector('.auto-id').textContent = index + 1;
     });

     // Add auto-increment ID to Ebooks Table
     let ebooksTable = document.querySelector('#myDataTable2 tbody');
     let ebookRows = ebooksTable.querySelectorAll('tr');
     ebookRows.forEach((row, index) => {
          row.querySelector('.auto-id').textContent = index + 1;
     });
});
</script>
