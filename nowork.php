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
            padding: 20px;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            margin: 20px auto;
        }

        h1 {
            font-size: 2.2rem;
            color: #e74c3c;
            margin-bottom: 20px;
        }

        p {
            font-size: 1rem;
            color: #555;
            font-weight: bold;
            margin: 10px 0;
        }

        .btn {
            padding: 12px 25px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 1rem;
            transition: background-color 0.3s;
            display: inline-block;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 1.8rem;
            }

            p {
                font-size: 0.9rem;
            }

            .btn {
                font-size: 0.9rem;
                padding: 10px 20px;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 1.5rem;
            }

            p {
                font-size: 0.8rem;
            }

            .btn {
                font-size: 0.8rem;
                padding: 8px 15px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <p style="font-size: 2rem; font-weight: bold; line-height: 1.4;">MCC <br> LEARNING RESOURCE CENTER</p>
    <h1>No Work Today</h1>
    <p>Sorry, it's Sunday and we're taking a break today. Please try again on a weekday.</p>
    <p>If you'd like to return to the home page, click the button below.</p><br>
    <a href="." class="btn">Go to Home</a>
</div>

</body>
</html>
