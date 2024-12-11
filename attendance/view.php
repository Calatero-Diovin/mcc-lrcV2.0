<?php
session_start();
include('../admin/config/dbcon.php');

// Check if user_info and success session variables are set
if (isset($_SESSION['user_info']) && isset($_SESSION['success']) && $_SESSION['success'] == true) {
    // User info retrieved from session
    $user_info = $_SESSION['user_info'];

    // Success flag
    $success = $_SESSION['success'];

    // Reset the session success flag after using it
    unset($_SESSION['success']);

    // Optionally, clear user info if no longer needed
    // unset($_SESSION['user_info']);
} else {
    // If no session data or success flag, handle accordingly
    echo "No user information found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
</head>
<body>

    <?php if ($success): ?>
        <h2>User Information</h2>
        <img src="<?php echo $user_info['profile_image']; ?>" alt="Profile Picture" style="max-width: 100px;">
        <p><strong>Name:</strong> <?php echo $user_info['firstname'] . ' ' . $user_info['middlename'] . ' ' . $user_info['lastname']; ?></p>
        <p><strong>Course:</strong> <?php echo $user_info['course']; ?></p>
        <p><strong>Year Level:</strong> <?php echo $user_info['year_level']; ?></p>
    <?php else: ?>
        <p>User information not available.</p>
    <?php endif; ?>

</body>
</html>
