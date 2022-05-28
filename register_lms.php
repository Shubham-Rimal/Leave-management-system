<?php
require_once "config_lms.php";

$username = $password = $confirm_password = $section = "";
$username_err = $password_err = $confirm_password_err = $section_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $username_err = "Username cannot be blank";
    } else {
        $sql = "SELECT id FROM user_profile WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = trim($_POST['username']);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken";
                    echo $username_err;
                } else {
                    $username = trim($_POST['username']);
                }

            } else {
                echo "Something went wrong";
            }

        }
    }

    mysqli_stmt_close($stmt);

    if (empty(trim($_POST['password']))) {
        $password_err = "Password cannot be blank!";
    } elseif (strlen(trim($_POST['password'])) < 5) {
        $password_err = "Password cannot be less than 5 characters!";
    } else {
        $password = trim($_POST['password']);
    }
    if (trim($_POST['password']) != trim($_POST['confirm_password'])) {
        $password_err = "Passwords should match!";
    }

    if (empty(trim($_POST['section']))){
        $section_err = "Please enter a section name!";
    }else {
        $section = trim($_POST['section']);
    }

    $role = $_POST['role'];
    echo $role;

    if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($section_err)) {
        $sql = "INSERT INTO user_profile (username, password, role, section) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_password, $param_role, $param_section);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_role= $role;
            $param_section = $section;

            if (mysqli_stmt_execute($stmt)) {
                header("location: login_lms.php");
            } else {
                echo mysqli_error($conn);
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}

?>


<!doctype html>
<html lang="en">
<head>
    <title>Register</title>
    <link href="css/signinup.css" rel="stylesheet">
</head>
<body>
<div class="all">
<h1 class="header">LMS-Register</h1>
    <button class="redirect"><a href="register_lms.php"><p style="font-family: 'Agency FB'">Register</p></a></button>
    <button class="redirect"><a href="login_lms.php"><p style="font-family: 'Agency FB'">Login</p></a></button>
<div class="container mt-4">
    <div class="card">
    <form action="register_lms.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" name="username" id="username" placeholder="Username" class="input"><br><br>
        <label for="password">Password:</label><br>
        <input type="password"  name="password" id="password" placeholder="Password" class="input"><br><br>
        <label for="confirm_password">Confirm Password:</label><br>
        <input type="password"  name="confirm_password" id="confirm_password" placeholder="Confirm Password" class="input"><br><br>
        <label for="section">Section:</label><br>
        <input type="text" name="section" id="section" placeholder="Section" class="input"><br><br>
        <label for="role">Role:</label><br>
        <select name="role" class="input">
            <option value="teacher">Teacher</option>
            <option value="student">Student</option>
        </select><br><br>
        <button type="submit" class="button">
            <span></span>
            <span></span>
            <span></span>
            <span></span>Register</button>
    </form>
</div>
</div>
</div>
</body>
</html>
















