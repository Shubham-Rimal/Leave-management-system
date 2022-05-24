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
</head>
<body>
<a href="logout_lms.php">Logout</a>

<div class="container mt-4">
    <h3><?php echo "Welcome teacher ". $_SESSION['username']?>! Are there any pending requests waiting approval? Better check!</h3>
    <hr>

</div></body>
</html>

