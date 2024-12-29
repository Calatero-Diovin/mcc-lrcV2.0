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
                                </div>
                                <br>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="data_table">
                                                <table id="example" class="display nowrap" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th class="d-none">MS ID</th>
                                                            <th>Firstname</th>
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
                                                                    <td class='d-none'>{$row['ms_id']}</td>
                                                                    <td>{$row['firstname']}</td>
                                                                    <td>{$row['lastname']}</td>
                                                                    <td>{$row['username']}</td>
                                                                    <td>
                                                                        <button 
                                                                            class='btn btn-warning btn-sm edit-btn' 
                                                                            data-id='{$row['ms_id']}' 
                                                                            data-username='{$row['username']}'>
                                                                            <i class='bi bi-pencil'></i> Edit
                                                                        </button>
                                                                        <form action='delete_account.php' method='post' class='delete-form d-inline'>
                                                                            <input type='hidden' name='ms_id' value='{$row['ms_id']}'>
                                                                            <button type='submit' class='btn btn-danger btn-sm delete-btn'>
                                                                                <i class='bi bi-trash'></i> Delete
                                                                            </button>
                                                                        </form>
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
            <form action="edit_account.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Username</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="ms_id" id="edit-ms-id">
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

    // Event delegation for dynamically generated edit buttons
    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('edit-btn')) {
            const button = e.target; // The clicked button
            const msId = button.getAttribute('data-id');
            const username = button.getAttribute('data-username');
            
            // Populate the modal inputs with data
            document.getElementById('edit-ms-id').value = msId;
            document.getElementById('edit-username').value = username;

            // Show the modal
            const modal = new bootstrap.Modal(document.getElementById('editModal'));
            modal.show();
        }
    });

    // SweetAlert2 Confirmation for Delete
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent form submission
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // Submit the form if confirmed
                }
            });
        });
    });
});
</script>
