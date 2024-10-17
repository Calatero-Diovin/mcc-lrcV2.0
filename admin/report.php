<?php 
require_once('authentication.php');
include('includes/header.php'); 
include('./includes/sidebar.php'); 
?>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css">

<main id="main" class="main" data-aos="fade-down">
    <div class="pagetitle">
        <h1>Report</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=".">Home</a></li>
                <li class="breadcrumb-item active">Report</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link <?= ($page == 'report' || $page == 'report_faculty') ? 'active' : '' ?>" href="report">All Transaction</a>
                            </li>
                            <li class="nav-item border border-info border-start-0 rounded-end">
                                <a class="nav-link <?= ($page == 'report_penalty') ? 'active' : '' ?>" href="report_penalty">Penalty Report</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="nav-item">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#student-tab-pane">Students</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#faculty-tab-pane">Faculty Staff</button>
                                </li>
                            </ul>
                            <div class="tab-content mt-3" id="myTabContent">
                                <div class="tab-pane fade show active" id="student-tab-pane">
                                    <table id="example" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Book Title</th>
                                                <th>Task</th>
                                                <th>Person In Charge</th>
                                                <th>Date Transaction</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stmt = $con->prepare("SELECT * FROM report 
                                                LEFT JOIN book ON report.book_id = book.book_id 
                                                LEFT JOIN user ON report.user_id = user.user_id 
                                                WHERE report.user_id IS NOT NULL 
                                                ORDER BY report.report_id DESC");
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            
                                            while ($row = $result->fetch_assoc()) {
                                                $user_name = $row['firstname'] . " " . $row['lastname'];
                                            ?>
                                            <tr>
                                                <td><?= htmlspecialchars($user_name); ?></td>
                                                <td><?= htmlspecialchars($row['title']); ?></td>
                                                <td><?= htmlspecialchars($row['detail_action']); ?></td>
                                                <td><?= htmlspecialchars($row['admin_name']); ?></td>
                                                <td><?= date("M d, Y h:i:s a", strtotime($row['date_transaction'])); ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="faculty-tab-pane">
                                    <table id="example2" class="display" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Book Title</th>
                                                <th>Task</th>
                                                <th>Person In Charge</th>
                                                <th>Date Transaction</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stmt = $con->prepare("SELECT * FROM report 
                                                LEFT JOIN book ON report.book_id = book.book_id 
                                                LEFT JOIN faculty ON report.faculty_id = faculty.faculty_id 
                                                WHERE report.faculty_id IS NOT NULL 
                                                ORDER BY report.report_id DESC");
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            
                                            while ($row = $result->fetch_assoc()) {
                                                $faculty_name = $row['firstname'] . " " . $row['lastname'];
                                            ?>
                                            <tr>
                                                <td><?= htmlspecialchars($faculty_name); ?></td>
                                                <td><?= htmlspecialchars($row['title']); ?></td>
                                                <td><?= htmlspecialchars($row['detail_action']); ?></td>
                                                <td><?= htmlspecialchars($row['admin_name']); ?></td>
                                                <td><?= date("M d, Y h:i:s a", strtotime($row['date_transaction'])); ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script>
    const initDataTable = (selector) => {
        new DataTable(selector, {
            order: [[4, 'asc']],
            layout: {
                topStart: {
                    buttons: [
                        { extend: 'print' },
                        { extend: 'excelHtml5', autoFilter: true, sheetName: 'Exported data' },
                        { extend: 'pdfHtml5' },
                        { extend: 'copyHtml5' },
                        { extend: 'pageLength' } 
                    ]
                }
            },
            language: {
                buttons: {
                    copyTitle: 'Added to clipboard',
                    copyKeys: 'Press <i>ctrl</i> or <i>\u2318</i> + <i>C</i> to copy the table data to your clipboard. <br><br>To cancel, click this message or press Esc.',
                    copySuccess: {
                        _: '%d rows copied',
                        1: '1 row copied'
                    }
                }
            }
        });
    };

    initDataTable('#example');
    initDataTable('#example2');
</script>

<?php 
include('./includes/footer.php');
include('./includes/script.php');
include('../message.php');   
?>