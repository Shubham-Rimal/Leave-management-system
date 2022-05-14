<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login_lms.php");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Leave Management System- HOME</title>
</head>
<body>
<a href="logout_lms.php">Logout</a>

    <h3><?php echo "Welcome user ". $_SESSION['username']?>! Has your request been approved? Better Check!</h3>
    <hr>

</div></body>
</html>