<?php
session_start();
$request = $_SERVER['REQUEST_URI'];

// Redirect if '.php' is part of the URL to remove it
if (strpos($request, '.php') !== false) {
    $new_url = str_replace('.php', '', $request);
    header("Location: $new_url", true, 301);
    exit();
}

include('../admin/config/dbcon.php'); // Including database connection

// Check if 'code' is provided in the URL
if (!isset($_GET['a']) || empty($_GET['a'])) {
    header("Location: 404.php");
    exit;
}
$id = $_GET['a'];

// Prepare query to fetch the verification code and its creation time
$code_query = "SELECT * FROM user WHERE student_id_no = ?";
$code_stmt = $con->prepare($code_query);
$code_stmt->bind_param("s", $id);
$code_stmt->execute();
$code_result = $code_stmt->get_result();

if ($code_result->num_rows > 0) {
    $row = $code_result->fetch_assoc();
} else {
    header("Location: 404.php");
    exit;
}

$code_stmt->close();
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
</head>

<body>
    <header id="header" class="header fixed-top d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <a href="#" class="logo d-flex align-items-center">
                <img src="../images/mcc-lrc.png" alt="logo" class="mx-2" />
                <span class="d-none d-lg-block mx-2">MCC <span class="text-info d-block fs-6">Learning Resource Center</span></span>
            </a>
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
                        <center>
                                <img src="../uploads/profile_images/<?= htmlspecialchars($row['profile_image']) ?>" class="rounded-circle" alt="user image" width="50%" height="50%">
                                <p><?= htmlspecialchars($row['firstname']) . ' ' . htmlspecialchars($row['lastname']) ?></p>
                                <p><?= htmlspecialchars($row['course']) ?></p>
                                <p><?= htmlspecialchars($row['year_level']) ?></p>
                                </center>
                </div>
            </div>
        </section>
    </main>

    <footer id="footer" class="footer">
        <div class="copyright">
            <strong><span>MCC</span></strong>. Learning Resource Center 2.0
        </div>
    </footer>
</body>
</html>
