<?php
$request = $_SERVER['REQUEST_URI'];

if (strpos($request, '.php') !== false) {
    // Redirect to remove .php extension
    $new_url = str_replace('.php', '', $request);
    header("Location: $new_url", true, 301);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="noindex, nofollow" />
    <link rel="icon" href="../images/mcc-lrc.png">
    <title>MCC Learning Resource Center - QR Scanner</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/boxicons.min.css" rel="stylesheet" />
    <link href="assets/css/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/alertify.min.css" />
    <link rel="stylesheet" href="assets/css/alertify.bootstraptheme.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <script type="text/javascript" src="js/instascan.min.js"></script>
    <script type="text/javascript" src="js/vue.min.js"></script>
    <script type="text/javascript" src="js/adapter.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script>
        function updateClock() {
            var now = new Date();
            var hours = now.getHours();
            var minutes = now.getMinutes().toString().padStart(2, '0');
            var seconds = now.getSeconds().toString().padStart(2, '0');
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            var timeString = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
            document.getElementById('time').innerText = timeString;
        }
        setInterval(updateClock, 1000);
    </script>
    <style>
        #time {
            font-size: 3.5rem;
            font-weight: bold;
            color: black;
        }
    </style>
</head>

<body onload="updateClock()">
    <header id="header" class="header fixed-top d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a href="#" class="logo d-flex align-items-center">
                <img src="../images/mcc-lrc.png" alt="logo" class=" mx-2" />
                <span class="d-none d-lg-block mx-2">MCC <span class="text-info d-block fs-6">Learning Resource Center</span></span>
            </a>
        </div>
        <div class="d-flex align-items-center">
            <span id="time" class="mx-2 text-black"></span>
        </div>
        <div class="d-flex align-items-center">
            <a href="index.php" class="btn btn-primary position-relative mx-5">
                Back
            </a>
        </div>
    </header>

    <main id="main" class="main">
        <section class="section dashboard">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <video id="preview" width="100%"></video>
                    </div>
                    <div class="col-md-6">
                        <form action="qr_scanner.php" method="post" class="form-horizontal">
                            <label>SCAN QR CODE</label>
                            <input type="text" name="text" id="text" readonly="" placeholder="scan qrcode" class="form-control">
                        </form>
                        <br>
                        <?php if ($user['role'] == 'student'): ?>
                            <img src="uploads/profile_images/<?= htmlspecialchars($user['profile_image']) ?>" alt="user image" width="50%" height="50%">
                            <p><?= htmlspecialchars($user['firstname']) . ' ' . htmlspecialchars($user['lastname']) ?></p>
                            <p><?= htmlspecialchars($user['course']) ?></p>
                            <p><?= htmlspecialchars($user['year_level']) ?></p>
                        <?php elseif ($user['role'] == 'faculty'): ?>
                            <img src="uploads/profile_images/<?= htmlspecialchars($user['profile_image']) ?>" alt="user image" width="50%" height="50%">
                            <p><?= htmlspecialchars($user['firstname']) . ' ' . htmlspecialchars($user['lastname']) ?></p>
                            <p><?= htmlspecialchars($user['course']) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer id="footer" class="footer">
        <div class="copyright">
            <strong><span>MCC</span></strong>. Learning Resource Center 2.0
        </div>
    </footer>

    <script>
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
        Instascan.Camera.getCameras().then(function(cameras){
            if(cameras.length > 0 ){
                scanner.start(cameras[0]);
            } else{
                alert('No cameras found');
            }
        }).catch(function(e) {
            console.error(e);
        });

        scanner.addListener('scan', function(c){
            document.getElementById('text').value=c;
            document.forms[0].submit();
        });
    </script>
</body>

</html>
