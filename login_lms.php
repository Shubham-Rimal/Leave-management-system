<?php
session_start();

if(isset($_SESSION['username']))
{
    header("location: welcome_lms.php");
    exit;
}
require_once "config_lms.php";
$username = $password = "";
$err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])) )
    {
        $err = "Please enter username and password";
        echo $err;
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }


    if(empty($err))
    {
        $sql = "SELECT id, username, password, role FROM user_profile WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt,'s', $param_username);
        $param_username = $username;

        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1)
            {
                mysqli_stmt_bind_result($stmt,$id, $username, $hashed_password, $role);
                if(mysqli_stmt_fetch($stmt))
                {
                    if(password_verify($password, $hashed_password))
                    {
                        session_start();
                        $_SESSION["username"] = $username;
                        $_SESSION["id"] = $id;
                        $_SESSION["loggedin"] = true;

                        if ($role == 'teacher'){
                            header("location: admin_welcome_lms.php");
                        }else {
                            header("location: welcome_lms.php");
                        }
                    }
                }

            }

        }
    }


}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>LMS-Login</title>
    <link href="css/signinup.css" rel="stylesheet">
</head>
<body>
<div class="all">
<h1 class="header">LMS-Login</h1>
<button class="redirect"><a href="register_lms.php"><p style="font-family: 'Agency FB'">Register</p></a></button>
<button class="redirect"><a href="login_lms.php"><p style="font-family: 'Agency FB'">Login</p></a></button>
    <div class="card">
    <div class="container mt-4">
    <form action="login_lms.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" name="username" id="username" placeholder="Enter Username" class="input"><br><br>
        <label for="password">Password:</label><br>
        <input type="password" name="password" id="password" placeholder="Enter Password" class="input"><br><br>
        <button type="submit" class="button">
            <span></span>
            <span></span>
            <span></span>
            <span></span>LOGIN</button>
    </form>

</div>
</div>
</div>
</body>
</html>