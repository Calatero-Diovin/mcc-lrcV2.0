<?php
// Set the session expiration time to 30 minutes
$session_lifetime = 30 * 60;  // 30 minutes in seconds

// Set the session cookie lifetime (same as session lifetime)
session_set_cookie_params([
    'lifetime' => $session_lifetime,  // Cookie expires after 30 minutes
    'path' => '/',  // Path for the cookie
    'domain' => '',  // Domain (leave empty for current domain)
    'secure' => isset($_SERVER['HTTPS']),  // Set to true if using https
    'httponly' => true,  // Prevents JavaScript from accessing the cookie
    'samesite' => 'Strict'  // Optional: Adds extra security to the cookie
]);

// Set the maximum lifetime of the session on the server side (garbage collection)
ini_set('session.gc_maxlifetime', $session_lifetime);

// If the session is expired or has been idle for too long, destroy it
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $session_lifetime) {
    // Session has expired
    session_unset();     // Unset session variables
    session_destroy();   // Destroy the session
}
$_SESSION['last_activity'] = time();  // Update the last activity timestamp
?>