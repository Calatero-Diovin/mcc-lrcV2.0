<?php

$request = $_SERVER['REQUEST_URI'];

if (strpos($request, '.php') !== false) {
    // Redirect to remove .php extension
    $new_url = str_replace('.php', '', $request);
    header("Location: $new_url", true, 301);
    exit();
}

// In your header or a central initialization file
if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
     header("Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
     exit();
 }

function isValidUrl($url) {
     return preg_match('/^https?:\/\/(www\.)?mcc-lrc\.com/', $url);
}
 
 // Example usage of the function
 $link = "https://mcc-lrc.com";
 if (isValidUrl($link)) {
     
 } else {
     echo "Invalid URL.";
 }

if (basename($_SERVER['PHP_SELF']) == 'header.php') {
     header("HTTP/1.1 403 Forbidden");
     exit("Access denied.");
 }

 // Add CSP header
 header("Content-Security-Policy: default-src 'self'; script-src 'self' https://mcc-lrc.com;");

?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="utf-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1" />
     <meta name="probely-verification" content='3caf94ea-51ea-413a-a15e-ea7a28f12033' />
     <link rel="icon" href="./images/mcc-lrc.png">
     <title>MCC Learning Resource Center</title>

     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="assets/css/bootstrap5.min.css" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" />
     <link rel="stylesheet" href="assets/css/bootstrap-icons.min.css">

     <!-- Bootstrap Icon -->
     <link rel="stylesheet" href="assets/font/bootstrap-icons.css">

     <!-- Iconscout cdn link -->
     <link rel="stylesheet" href="assets/css/line.css">
     <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

     <!-- Custom CSS Styling -->
     <link rel="stylesheet" href="assets/css/style.css">
     <link rel="stylesheet" href="assets/css/jquery-ui.css">
     <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.0/dist/sweetalert2.min.css">
     <link href="assets/css/sweetalert2.min.css" rel="stylesheet" />

     <!-- Alertify JS cdn link -->
     <link rel="stylesheet" href="assets/css/alertify.min.css" />
     <link rel="stylesheet" href="assets/css/alertify.bootstraptheme.min.css" />

     <!-- Animation -->
     <link rel="stylesheet" href="assets/css/aos.css" />
</head>

<body>