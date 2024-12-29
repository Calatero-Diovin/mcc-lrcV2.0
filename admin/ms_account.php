<?php 
include('authentication.php');
include('includes/header.php'); 
include('./includes/sidebar.php'); 
?>

<main id="main" class="main">
     <div class="pagetitle" data-aos="fade-down">
          <h1>MS 365 Account</h1>
          <nav>
               <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href=".">Home</a></li>
                    <li class="breadcrumb-item active">MS 365 Account</li>
               </ol>
          </nav>
     </div>
     <section class="section dashboard">
          <div class="row">
               <div class="col-lg-12">
                    <div class="row">
                         <div data-aos="fade-down" class="col-12">
                              <div class="card recent-sales overflow-auto border-3 border-top border-info">
                                   <div class="card-body">
                                        <div class="row d-flex justify-content-between align-items-center mt-4">
                                             <div class="text-start">
                                                  <form action="import.php" method="post" enctype="multipart/form-data">
                                                       <input type="file" name="file" required>
                                                       <button type="submit" name="save_excel_data" class="btn btn-primary">
                                                             <b>Import</b>
                                                       </button>
                                                  </form>
                                             </div>
                                             <div class="text-end">
                                                  <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addAccountModal">
                                                       <b>Add New Account</b>
                                                  </button>
                                             </div>
                                        </div>
                                        <br>
                                        <div class="container">
                                             <div class="row">
                                                  <div class="col-12">
                                                       <div class="data_table">
                                                       <table id="example" class="display nowrap" style="width:100%">
                                                                 <br>
                                                                 <thead>
                                                                      <tr>
                                                                           <th>Firstname</th>
                                                                           <th class="hidden"></th>
                                                                           <th>Lastname</th>
                                                                           <th>Email</th>
                                                                           <th>Actions</th>
                                                                      </tr>
                                                                 </thead>
                                                                 <tbody>
                                                                      <?php
                                                                      $query = "SELECT * FROM ms_account";
                                                                      if ($stmt = $con->prepare($query)) {
                                                                           $stmt->execute();
                                                                           $result = $stmt->get_result();
                                                                           while ($row = $result->fetch_assoc()) {
                                                                                echo "<tr>
                                                                                     <td>{$row['firstname']}</td>
                                                                                     <td class='hidden'>{$row['ms_id']}</td>
                                                                                     <td>{$row['lastname']}</td>
                                                                                     <td>{$row['username']}</td>
                                                                                     <td>
                                                                                          <button class='btn btn-warning btn-sm' 
                                                                                                  data-bs-toggle='modal' 
                                                                                                  data-bs-target='#editAccountModal' 
                                                                                                  data-id='{$row['ms_id']}' 
                                                                                                  data-firstname='{$row['firstname']}' 
                                                                                                  data-lastname='{$row['lastname']}' 
                                                                                                  data-username='{$row['username']}'>
                                                                                              Edit
                                                                                          </button>
                                                                                     </td>
                                                                                </tr>";
                                                                           }
                                                                           $stmt->close();
                                                                      } else {
                                                                           echo "<tr><td colspan='4'>Error retrieving data</td></tr>";
                                                                      }
                                                                      ?>
                                                                 </tbody>
                                                            </table>
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
     </section>
</main>

<!-- Add Account Modal -->
<div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="addAccountModalLabel">Add New MS 365 Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <form action="add_account.php" method="post">
                    <div class="modal-body">
                         <div class="mb-3">
                              <label for="firstname" class="form-label">Firstname</label>
                              <input type="text" class="form-control" id="firstname" name="firstname" required>
                         </div>
                         <div class="mb-3">
                              <label for="lastname" class="form-label">Lastname</label>
                              <input type="text" class="form-control" id="lastname" name="lastname" required>
                         </div>
                         <div class="mb-3">
                              <label for="username" class="form-label">Email</label>
                              <input type="email" class="form-control" id="username" name="username" required>
                         </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                         <button type="submit" name="add_account" class="btn btn-primary">Save</button>
                    </div>
               </form>
          </div>
     </div>
</div>

<!-- Edit Account Modal -->
<div class="modal fade" id="editAccountModal" tabindex="-1" aria-labelledby="editAccountModalLabel" aria-hidden="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="editAccountModalLabel">Edit MS 365 Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <form action="add_account.php" method="post">
                    <div class="modal-body">
                         <input type="hidden" name="ms_id" id="edit-ms_id">
                         <div class="mb-3">
                              <label for="edit-firstname" class="form-label">Firstname</label>
                              <input type="text" class="form-control" id="edit-firstname" name="firstname" required>
                         </div>
                         <div class="mb-3">
                              <label for="edit-lastname" class="form-label">Lastname</label>
                              <input type="text" class="form-control" id="edit-lastname" name="lastname" required>
                         </div>
                         <div class="mb-3">
                              <label for="edit-username" class="form-label">Email</label>
                              <input type="email" class="form-control" id="edit-username" name="username" required>
                         </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                         <button type="submit" name="edit_account" class="btn btn-primary">Save Changes</button>
                    </div>
               </form>
          </div>
     </div>
</div>

<?php 
include('./includes/footer.php');
include('./includes/script.php');
include('../message.php');
?>

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    new DataTable('#example', {
        responsive: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        }
    });

    const editModal = document.getElementById('editAccountModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const ms_id = button.getAttribute('data-id');
        const firstname = button.getAttribute('data-firstname');
        const lastname = button.getAttribute('data-lastname');
        const username = button.getAttribute('data-username');

        document.getElementById('edit-ms_id').value = ms_id;
        document.getElementById('edit-firstname').value = firstname;
        document.getElementById('edit-lastname').value = lastname;
        document.getElementById('edit-username').value = username;
    });
});
</script>
