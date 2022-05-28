<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: admin_welcome_lms.php");
}
?>

<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Leave Management System - HOME</title>
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
<div class="all">
<button class="button"><a href="logout_lms.php"><p class="logout">LOGOUT</p></a></button>

<div class="container mt-4">
    <h3 class="header"><?php echo "Welcome teacher ". $_SESSION['username']?>! Are there any pending requests waiting approval? Better check!</h3><br>
    <br><br><br><br><br><br><br>
    <button class="redirect"><a href="retrieve_to_lms.php"><p class="p"><span>SEE REQUESTS</span></p></a></button>
    <button class="redirect"><a href="request_processing.php"><p class="p"><span>REQUESTS PROCESSING</span></p></a></button>
    <button class="redirect"><a href="processed_requests.php"><p class="p"><span>PROCESSED REQUESTS</span></p></a></button>

</div>
</div>
</body>
</html>

