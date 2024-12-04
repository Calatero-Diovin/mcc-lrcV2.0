<?php
// Get the current request URL
$request = $_SERVER['REQUEST_URI'];

// Redirect to remove .php extension
if (strpos($request, '.php') !== false) {
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
    <title>404 - Page Not Found</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #1a1a1a;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        color: #fff;
    }

    .container {
        text-align: center;
        margin-top: -90px;
    }

    .error-code {
        font-size: 400px;
        font-weight: bold;
        color: #fff;
        text-shadow: 0 0 10px rgba(255, 0, 0, 0.7), 0 0 20px rgba(255, 0, 0, 0.7), 0 0 30px rgba(255, 0, 0, 0.7);
        animation: glow 1.5s ease-in-out infinite alternate;
    }

    .message {
        font-size: 20px;
        margin: 20px 0;
        position: relative;
        display: inline-block;
        color: #fff;
        margin-top: -30px;
    }

    .message::before, .message::after {
        content: attr(data-text);
        position: absolute;
        top: 0;
        left: 0;
        color: #ff6347;
        overflow: hidden;
        z-index: -1;
    }

    .message::before {
        left: -10px;
        top: 8px;
        text-shadow: -1px 0 red, 1px 0 red;
        animation: glitch-1 1s infinite linear alternate-reverse;
    }

    .message::after {
        left: -10px;
        top: -8px;
        text-shadow: -1px 0 blue, 1px 0 blue;
        animation: glitch-2 1s infinite linear alternate-reverse;
    }

    @keyframes glitch-1 {
        0% {
            transform: translate(0);
        }
        50% {
            transform: translate(-2px, -2px);
        }
        100% {
            transform: translate(2px, 2px);
        }
    }

    @keyframes glitch-2 {
        0% {
            transform: translate(0);
        }
        50% {
            transform: translate(2px, 2px);
        }
        100% {
            transform: translate(-2px, -2px);
        }
    }


    .home-link {
        font-size: 18px;
        color: #ff6347;
        text-decoration: none;
        border: 2px solid #ff6347;
        padding: 10px 20px;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .home-link:hover {
        background-color: #ff6347;
        color: #fff;
    }

    @keyframes glow {
        0% {
            text-shadow: 0 0 10px rgba(255, 0, 0, 0.7), 0 0 20px rgba(255, 0, 0, 0.7), 0 0 30px rgba(255, 0, 0, 0.7);
        }
        100% {
            text-shadow: 0 0 20px rgba(255, 0, 0, 1), 0 0 30px rgba(255, 0, 0, 1), 0 0 40px rgba(255, 0, 0, 1);
        }
    }

    /* Responsive for smaller screens */
    @media (max-width: 768px) {
        .error-code {
            font-size: 150px;
        }
        .message {
            font-size: 16px;
        }
    }

    @media (max-width: 480px) {
        .error-code {
            font-size: 100px;
        }
        .message {
            font-size: 14px;
        }
    }
</style>
<body>
    <div class="container">
        <h1 class="error-code">404</h1>
        <p class="message" data-text="Oops! The page you are looking for cannot be found.">Oops! The page you are looking for cannot be found.</p>
        <br>
        <br>
        <a href="/" class="home-link">Go back to Home</a>
    </div>
</body>
</html>
