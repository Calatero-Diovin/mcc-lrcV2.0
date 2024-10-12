<!-- JQuery JS -->
<script src="assets/js/jquery-3.6.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<!-- Bootstrap JS -->
<script src="assets/js/bootstrap.bundle.min.js"></script>

<!-- JQuery Datatables -->
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap5.min.js"></script>
<script src="assets/js/pdfmake.min.js"></script>
<script src="assets/js/vfs_fonts.js"></script>
<script src="assets/js/datatables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.print.min.js"></script>

<!-- Chart.js -->
<script src="assets/js/chart.min.js"></script>

<!-- Dselect JS -->
<script src="assets/js/dselect.js"></script>

<!-- Alertify JS -->
<script src="assets/js/alertify.min.js"></script>

<!-- Custom JS -->
<script src="assets/js/format_number.js"></script>
<script src="assets/js/disable_future_date.js"></script>
<script src="assets/js/validation.js"></script>
<script src="assets/js/aos.js"></script>
<script src="assets/js/bootstrap-datepicker.min.js"></script>
<script src="assets/js/tooltip.js"></script>
<script src="assets/js/jspdf.umd.min.js"></script>
<script src="assets/js/jspdf.plugin.autotable.min.js"></script>
<script src="assets/js/xlsx.full.min.js"></script>
<script src="assets/js/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.0/dist/sweetalert2.all.min.js"></script>

<?php
if(isset($_SESSION['status']) && $_SESSION['status'] !='')
{
    ?>
    <script>
        Swal.fire({
            title: "<?php echo $_SESSION['status']; ?>",
            icon: "<?php echo $_SESSION['status_code']; ?>",
            confirmButtonText: "OK"
        });
    </script>
    <?php
    unset($_SESSION['status']);
}
?>

<script>
    // Initialize AOS (Animate On Scroll)
    AOS.init();

</script>
