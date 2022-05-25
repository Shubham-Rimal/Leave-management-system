<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
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

<div class="container mt-4"
    <h3><?php echo "Welcome user ". $_SESSION['username']?>! Has your request been approved? Better Check!</h3>
    <hr>
<a href="create_lms.php">Apply for leave</a>
<a href="retrieve_to_lms.php">See requests for leave</a>
</div>

</body>
</html>