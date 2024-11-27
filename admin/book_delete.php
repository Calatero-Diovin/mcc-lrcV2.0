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
        $_SESSION['status'] = 'Book deleted successfully';
        $_SESSION['status_code'] = "success";
        header("Location: books.php");
        exit(0);
    } else {
        // Redirect with error message
        $_SESSION['status'] = 'Error deleting book: ' . mysqli_error($con);
        $_SESSION['status_code'] = "error";
        header("Location: books.php");
        exit(0);
    }
} else {
    // Redirect if parameters are missing
    $_SESSION['status'] = 'Missing parameters';
    $_SESSION['status_code'] = "error";
    header("Location: books.php");
    exit(0);
}
?>
