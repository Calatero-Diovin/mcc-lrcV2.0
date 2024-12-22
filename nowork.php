<?php
// Start the session if you need to access session variables (optional)
session_start();
$request = $_SERVER['REQUEST_URI'];

if (strpos($request, '.php') !== false) {
    // Redirect to remove .php extension
    $new_url = str_replace('.php', '', $request);
    header("Location: $new_url", true, 301);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No Work Today</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            text-align: center;
            padding: 50px;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }

        h1 {
            font-size: 36px;
            color: #e74c3c;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            color: #555;
        }

        .btn {
            padding: 12px 25px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<div class="container">
    <p style="font-size: 20px;">MCC - LEARNING RESOURCE CENTER</p>
    <h1>No Work Today</h1>
    <p>Sorry, it's Sunday and we're taking a break today. Please try again on a weekday.</p>
    <p>If you'd like to return to the home page, click the button below.</p>
    <a href="." class="btn">Go to Home</a>
</div>

</body>
</html>
