<?php
include('authentication.php');

// Check if all required parameters are set
if (isset($_GET['title'], $_GET['copyright_date'], $_GET['author'], $_GET['isbn'])) {
    // Sanitize input
    $title = mysqli_real_escape_string($con, urldecode($_GET['title']));
    $copyright_date = mysqli_real_escape_string($con, urldecode($_GET['copyright_date']));
    $author = mysqli_real_escape_string($con, urldecode($_GET['author']));
    $isbn = mysqli_real_escape_string($con, urldecode($_GET['isbn']));

    // Prepare the delete query
    $query = "DELETE FROM book WHERE title = '$title' AND copyright_date = '$copyright_date' AND author = '$author' AND isbn = '$isbn'";

    // Execute the query
    if (mysqli_query($con, $query)) {
        // Redirect with success message
        header("Location: book?message=Book deleted successfully");
        exit();
    } else {
        // Redirect with error message
        header("Location: books?error=Error deleting book: " . mysqli_error($con));
        exit();
    }
} else {
    // Redirect if parameters are missing
    header("Location: books?error=Missing parameters");
    exit();
}

?>
