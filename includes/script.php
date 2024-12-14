<!-- Login Validation -->
<script src="assets/js/validation.js"></script>



<!-- Show and hide Password -->
<script src="assets/js/show-hide-password.js"></script>

<!-- Format Number  -->
<script src="assets/js/format_number.js"></script>
<!-- Dissable Future Date -->
<!-- <script src="assets/js/disable_future_date.js"></script> -->

<!-- Bootstrap Bundle js -->
<script src="assets/js/bootstrap5.bundle.min.js"></script>

<script src="assets/js/tooltip.js"></script>

<script src="assets/js/login.js"></script>

<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/jquery-ui.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<!-- Alertify JS CDN Link -->
<script src="assets/js/alertify.min.js"></script>

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

<!-- Loading animation -->
<script src="assets/js/aos.js"></script>

<script>
AOS.init();
</script>

<!-- JS & CSS Includes -->
<script async>
    "use strict";
    !function() {
        var t = window.driftt = window.drift = window.driftt || [];
        if (t.init) {
            if (t.invoked) return void (window.console && console.error && console.error("Drift snippet included twice."));
            t.invoked = !0;
            t.methods = ["identify", "config", "track", "reset", "debug", "show", "ping", "page", "hide", "off", "on"];
            t.factory = function(e) {
                return function() {
                    var n = Array.prototype.slice.call(arguments);
                    n.unshift(e), t.push(n), t;
                };
            };
            t.methods.forEach(function(e) {
                t[e] = t.factory(e);
            });
            t.load = function(t) {
                var e = 3e5, n = Math.ceil(new Date() / e) * e, o = document.createElement("script");
                o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous", o.src = "https://js.driftt.com/include/" + n + "/" + t + ".js";
                var i = document.getElementsByTagName("script")[0];
                i.parentNode.insertBefore(o, i);
            };
        }
    }();
    drift.SNIPPET_VERSION = '0.3.1';
    drift.load('shzmapfycb4e');
</script>

</body>

</html>