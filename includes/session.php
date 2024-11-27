<?php
// Example of setting a cookie with SameSite=None and Secure
setcookie('cookie_name', 'cookie_value', [
    'expires' => time() + 3600, // Cookie expiration time
    'path' => '/',
    'domain' => 'mcc-lrc.com', // Replace with your domain
    'secure' => true,          // Ensure the cookie is sent over HTTPS
    'httponly' => true,        // Prevent access by JavaScript (for security)
    'samesite' => 'None'       // Allow cross-site cookies
]);
?>