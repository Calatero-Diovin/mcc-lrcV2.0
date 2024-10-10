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
