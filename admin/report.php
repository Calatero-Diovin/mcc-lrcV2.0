<?php 
require_once('authentication.php');
include('includes/header.php'); 
include('./includes/sidebar.php'); 
?>
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
                                <a class="nav-link <?= $page == 'report' || $page == 'report_faculty' ? 'active' : '' ?>" href="report">All Transaction</a>
                            </li>
                            <li class="nav-item border border-info border-start-0 rounded-end">
                                <a class="nav-link <?= $page == 'report_penalty' ? 'active' : '' ?>" href="report_penalty">Penalty Report</a>
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
                                    <div class="text-start mt-4">
                                        <button id="printButton">Print</button>
                                        <button id="csvButton">Export CSV</button>
                                        <button id="excelButton">Export Excel</button>
                                        <button id="copyButton">Copy</button>
                                        <button id="pdfButton">Generate PDF</button>
                                    </div>
                                    <br><br>
                                    <h5 class="dated">Date: <?php echo date('F d, Y'); ?></h5>
                                    <h1 class="sname">MCC Learning Resource Center</h1>
                                    <h2 class="tname">Student Report</h2>
                                    <table id="myDataTable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Book Title</th>
                                                <th>Task</th>
                                                <th>Person In Charge</th>
                                                <th>Date Transaction</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $result = mysqli_query($con, "SELECT * from report 
                                            LEFT JOIN book ON report.book_id = book.book_id 
                                            LEFT JOIN user ON report.user_id = user.user_id
                                            ORDER BY report.report_id DESC ");
                                            while ($row = mysqli_fetch_array($result)) {
                                                if (isset($row['user_id'])) {
                                                    echo "<tr>
                                                        <td class='auto-id' style='text-align: center;'></td>
                                                        <td>{$row['firstname']} {$row['lastname']}</td>
                                                        <td>{$row['title']}</td>
                                                        <td>{$row['detail_action']}</td>
                                                        <td>{$row['admin_name']}</td>
                                                        <td>" . date("M d, Y h:i:s a", strtotime($row['date_transaction'])) . "</td>
                                                    </tr>";
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="faculty-tab-pane">
                                    <div class="text-start mt-4">
                                        <button id="printButton">Print</button>
                                        <button id="csvButton">Export CSV</button>
                                        <button id="excelButton">Export Excel</button>
                                        <button id="copyButton">Copy</button>
                                        <button id="pdfButton">Generate PDF</button>
                                    </div>
                                    <br><br>
                                    <h5 class="dated">Date: <?php echo date('F d, Y'); ?></h5>
                                    <h1 class="sname">MCC Learning Resource Center</h1>
                                    <h2 class="tname">Faculty Report</h2>
                                    <table id="myDataTable2" class="table table-striped table-bordered">
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
                                            $result = mysqli_query($con, "SELECT * from report 
                                            LEFT JOIN book ON report.book_id = book.book_id 
                                            LEFT JOIN faculty ON report.faculty_id = faculty.faculty_id
                                            ORDER BY report.report_id DESC ");
                                            while ($row = mysqli_fetch_array($result)) {
                                                if (isset($row['faculty_id'])) {
                                                    echo "<tr>
                                                        <td>{$row['firstname']} {$row['lastname']}</td>
                                                        <td>{$row['title']}</td>
                                                        <td>{$row['detail_action']}</td>
                                                        <td>{$row['admin_name']}</td>
                                                        <td>" . date("M d, Y h:i:s a", strtotime($row['date_transaction'])) . "</td>
                                                    </tr>";
                                                }
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
    </section>
</main>

<script>
    async function exportToPDF(tableId, reportType) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        doc.autoTable({
            html: '#' + tableId,
            styles: { fontSize: 8 },
            headStyles: { fillColor: [0, 0, 0] },
            startY: 20
        });

        const fileName = reportType === 'student' ? 'student_report.pdf' : 'faculty_report.pdf';
        doc.save(fileName);
    }

    function exportToExcel(tableId, reportType) {
        var wb = XLSX.utils.book_new();
        var ws_data = [
            ['ID', 'Name', 'Book Title', 'Task', 'Person In Charge', 'Date Transaction']
        ];

        var table = document.getElementById(tableId);
        var rows = table.querySelectorAll('tbody tr');

        rows.forEach(function(row) {
            var cells = row.querySelectorAll('td');
            var row_data = [];
            cells.forEach(function(cell) {
                row_data.push(cell.innerText);
            });
            ws_data.push(row_data);
        });

        var ws = XLSX.utils.aoa_to_sheet(ws_data);
        XLSX.utils.book_append_sheet(wb, ws, "Sheet1");

        const fileName = reportType === 'student' ? 'student_report.xlsx' : 'faculty_report.xlsx';
        XLSX.writeFile(wb, fileName);
    }

    function copyToClipboard(tableId) {
        const table = document.getElementById(tableId);
        const range = document.createRange();
        range.selectNode(table);
        window.getSelection().removeAllRanges(); // Clear current selection
        window.getSelection().addRange(range); // Select the table
        document.execCommand('copy');
        window.getSelection().removeAllRanges(); // Deselect
        alert('Table copied to clipboard!');
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Add auto-increment ID to Books Table
        let tables = ['#myDataTable tbody', '#myDataTable2 tbody'];
        tables.forEach(tableSelector => {
            let table = document.querySelector(tableSelector);
            let rows = table.querySelectorAll('tr');
            rows.forEach((row, index) => {
                row.querySelector('.auto-id').textContent = index + 1;
            });
        });
    });
</script>

<?php 
include('./includes/footer.php');
include('./includes/script.php');
include('../message.php');   
?>
