<?php
// Get the 'portal' query parameter
$portal = isset($_GET['portal']) ? $_GET['portal'] : '.'; // Default to 'home'

// Define a list of valid pages
$validPages = ['.', 'about', 'contact'];

// Check if the requested page is valid
if (in_array($portal, $validPages)) {
    // Include the corresponding PHP file
    include $portal;
} else {
    // If the page is not valid, show a 404 error
    include '404.php'; // Create a simple 404.php file for not found pages
}
?>
