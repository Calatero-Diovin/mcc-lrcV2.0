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
<html>
<head>
<title>404 - Page Not Found</title>  
<meta name='description' content='404 - Page Not Found'/> 
<meta name='keywords' content='404 - Page Not Found'/>
<meta name='author' content='404 - Page Not Found'/>
<link rel="stylesheet" href="https://nathanprinsley-files.prinsh.com/data-1/css/deface(02-01).css"/>
</head>
<body>
<div></div>  

 <h2 style="text-align: center;margin-top:170px;">Oops! Your link is expired; <br>Send a registration link again. Thank you!</h2>
</body>
</html>
