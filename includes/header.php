<?php
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');
header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');

session_set_cookie_params([
     'lifetime' => 0,           // Session cookie, expires when the browser closes
     'path' => '/',             // Available within the entire domain
     'domain' => '',            // Default domain
     'secure' => true,          // Only sent over HTTPS
     'httponly' => true,        // Not accessible via JavaScript
     'samesite' => 'Lax'        // CSRF protection
 ]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="utf-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1" />
     <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self'; object-src 'none'; base-uri 'self';">
     <link rel="icon" href="./assets/img/mcc-logo.png">
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