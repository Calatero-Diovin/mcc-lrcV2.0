<!-- closed.php -->

<?php
$request = $_SERVER['REQUEST_URI'];

if (strpos($request, '.php') !== false) {
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
    <title>Page Closed</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container text-center" style="margin-top: 10%;">
        <h1 style="font-size: 100px;">404</h1>
        <h1>Sorry, the page is closed.</h1>
        <br>
        <br>
        <h3>Our service is available from <b>Monday to Saturday</b> , <b>8:00 AM to 5:00 PM.</b></h3>
    </div>
</body>
</html>
