<div class="col-12 col-md-4 mt-5">
    <div class="card">
        <div class="card-header text-dark fw-semibold">
            Allowed Books <span class="text-muted small">(per faculty/staff)</span>
        </div>
        <div class="card-body">
            <table class="table table-striped mt-3">
                <tbody>
                    <?php
                    $allowed_book_query3 = mysqli_query($con, "SELECT * FROM allowed_book WHERE allowed_book_id = 2 ");
                    while ($row12 = mysqli_fetch_array($allowed_book_query3)) {
                        $id1 = $row12['allowed_book_id'];
                    ?>
                        <tr>
                            <td><?php echo $row12['qntty_books']; ?>&nbsp;book/s</td>

                            <td style="width: 10px;">
                                <!-- Modal Button Trigger -->
                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Book/s">
                                    <a href="#book_qntty1<?php echo $id1; ?>" type="button" class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#book_qntty1<?php echo $id1; ?>">
                                        <i class="bi bi-pencil-square "></i>
                                    </a>
                                </span>
                            </td>
                            <!-- Modal -->
                            <div class="modal fade" id="book_qntty1<?php echo $id1; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                Allowed Books
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                            $query1 = mysqli_query($con, "SELECT * FROM allowed_book WHERE allowed_book_id='$id1'");
                                            $row22 = mysqli_fetch_array($query1);
                                            ?>
                                            <form method="post" enctype="multipart/form-data" class="form-horizontal">
                                                <div class="form-group d-flex align-items-center" style="margin-left:170px;">
                                                    <div class="col-md-3">
                                                        <input type="number" min="0" max="100" step="1" name="qntty_books" value="<?php echo $row22['qntty_books']; ?>" id="first-name2" class="form-control">
                                                    </div>
                                                    <label class="control-label col-md-4 px-2" for="first-name">Book/s</label>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" name="student_update_book_qntty1" class="btn btn-primary">Update Book/s</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <?php
                            if (isset($_POST['student_update_book_qntty1'])) {
                                $qntty_book = $_POST['qntty_books'];
                                mysqli_query($con, "UPDATE allowed_book SET qntty_books='$qntty_book' WHERE allowed_book_id = '$id1'");
                                echo "<script>alert('Book Quantity Updated Successfully');window.location='circulation_setting.php'</script>";
                            }
                            ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
        </div>
    </div>
</div>