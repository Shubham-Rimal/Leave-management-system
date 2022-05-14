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
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
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
        $sql = "SELECT id, username, password, role FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = $username;
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1)
            {
                mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $role);
                if(mysqli_stmt_fetch($stmt))
                {
                    if(password_verify($password, $hashed_password))
                    {
                        session_start();
                        $_SESSION["username"] = $username;
                        $_SESSION["id"] = $id;
                        $_SESSION["loggedin"] = true;

                        if($role=="admin"){
                            header("location: admin_welcome_lms.php");

                        }else{
                            header("location: welcome_lms.php");
                        }
                        header("location:welcome_lms.php");
                    }
                }

            }

        }
    }


}
?>


    <h1>Login</h1>
    <a href="register_lms.php">Register</a>
    <a href="login_lms.php">Login</a>


    <div class="container mt-4">
        <h3>Please Login Here:</h3>
        <hr>

        <form action="login_lms.php" method="post">
            <label for="email">Username:</label>
            <input type="text" name="username" id="email" placeholder="Enter Username">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Enter Password">
            <button type="submit" >Sign in</button>
        </form>

    </div>
