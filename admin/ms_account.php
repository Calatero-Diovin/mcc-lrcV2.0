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
                                        <div class="row d-flex justify-content-end align-items-center mt-4">
                                             <div class="text-start">
                                                  <form action="import.php" method="post" enctype="multipart/form-data">
                                                       <input type="file" name="file" required>
                                                       <button type="submit" name="save_excel_data" class="btn btn-primary">
                                                             <b>Import</b>
                                                       </button>
                                                  </form>
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
                                                                           <th>Lastname</th>
                                                                           <th>Email</th>
                                                                           <th>Used</th>
                                                                           <th>Action</th>
                                                                      </tr>
                                                                 </thead>
                                                                 <tbody>
                                                                      <?php
                                                                      $query = "SELECT * FROM ms_account WHERE username='jeanne.escala@mcclawis.edu.ph'";
                                                                      if ($stmt = $con->prepare($query)) {
                                                                           $stmt->execute();
                                                                           $result = $stmt->get_result();
                                                                           while ($row = $result->fetch_assoc()) {
                                                                                echo "<tr>
                                                                                     <td>{$row['firstname']}</td>
                                                                                     <td>{$row['lastname']}</td>
                                                                                     <td>{$row['username']}</td>
                                                                                     <td>{$row['used']}</td>
                                                                                     <td>
                                                                                         <button class='btn btn-sm btn-primary edit-btn' data-username='{$row['username']}' data-used='{$row['used']}'>Edit</button>
                                                                                     </td>
                                                                                </tr>";
                                                                           }
                                                                           $stmt->close();
                                                                      } else {
                                                                           echo "<tr><td colspan='5'>Error retrieving data</td></tr>";
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

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Used Value</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <form action="update_used.php" method="POST">
                    <div class="modal-body">
                         <input type="hidden" name="username" id="edit-username">
                         <div class="mb-3">
                              <label for="edit-used" class="form-label">Used</label>
                              <input type="number" class="form-control" id="edit-used" name="used" required>
                         </div>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                         <button type="submit" class="btn btn-primary">Save Changes</button>
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

     // Handle Edit Button Click
     document.querySelectorAll('.edit-btn').forEach(button => {
          button.addEventListener('click', function () {
               const username = this.dataset.username;
               const used = this.dataset.used;
               document.getElementById('edit-username').value = username;
               document.getElementById('edit-used').value = used;
               new bootstrap.Modal(document.getElementById('editModal')).show();
          });
     });
});
</script>
