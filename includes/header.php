<?php

include('includes/session.php');

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dynamically inject meta charset
            var metaCharset = document.createElement('meta');
            metaCharset.setAttribute('charset', 'utf-8');
            document.head.appendChild(metaCharset);

            // Dynamically inject meta viewport
            var metaViewport = document.createElement('meta');
            metaViewport.setAttribute('name', 'viewport');
            metaViewport.setAttribute('content', 'width=device-width, initial-scale=1');
            document.head.appendChild(metaViewport);

            // Dynamically inject favicon
            var linkIcon = document.createElement('link');
            linkIcon.setAttribute('rel', 'icon');
            linkIcon.setAttribute('href', './images/mcc-lrc.png');
            document.head.appendChild(linkIcon);

            // Dynamically inject title
            var titleTag = document.createElement('title');
            titleTag.innerText = 'MCC Learning Resource Center';
            document.head.appendChild(titleTag);

            // Dynamically inject Bootstrap CSS
            var bootstrapCss = document.createElement('link');
            bootstrapCss.setAttribute('rel', 'stylesheet');
            bootstrapCss.setAttribute('href', 'assets/css/bootstrap5.min.css');
            document.head.appendChild(bootstrapCss);

            // Dynamically inject Bootstrap Icons CSS
            var bootstrapIconsCss = document.createElement('link');
            bootstrapIconsCss.setAttribute('rel', 'stylesheet');
            bootstrapIconsCss.setAttribute('href', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css');
            document.head.appendChild(bootstrapIconsCss);

            // Dynamically inject custom CSS
            var customCss = document.createElement('link');
            customCss.setAttribute('rel', 'stylesheet');
            customCss.setAttribute('href', 'assets/css/style.css');
            document.head.appendChild(customCss);

            // Dynamically inject jQuery UI CSS
            var jqueryUiCss = document.createElement('link');
            jqueryUiCss.setAttribute('rel', 'stylesheet');
            jqueryUiCss.setAttribute('href', 'https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css');
            document.head.appendChild(jqueryUiCss);

            // Dynamically inject SweetAlert2 CSS
            var sweetAlert2Css = document.createElement('link');
            sweetAlert2Css.setAttribute('rel', 'stylesheet');
            sweetAlert2Css.setAttribute('href', 'https://cdn.jsdelivr.net/npm/sweetalert2@11.0.0/dist/sweetalert2.min.css');
            document.head.appendChild(sweetAlert2Css);

            // Dynamically inject Alertify CSS
            var alertifyCss = document.createElement('link');
            alertifyCss.setAttribute('rel', 'stylesheet');
            alertifyCss.setAttribute('href', 'assets/css/alertify.min.css');
            document.head.appendChild(alertifyCss);

            var alertifyBootstrapCss = document.createElement('link');
            alertifyBootstrapCss.setAttribute('rel', 'stylesheet');
            alertifyBootstrapCss.setAttribute('href', 'assets/css/alertify.bootstraptheme.min.css');
            document.head.appendChild(alertifyBootstrapCss);

            // Dynamically inject Animation CSS
            var aosCss = document.createElement('link');
            aosCss.setAttribute('rel', 'stylesheet');
            aosCss.setAttribute('href', 'assets/css/aos.css');
            document.head.appendChild(aosCss);
        });
    </script>
</head>

<body>