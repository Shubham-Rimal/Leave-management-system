<?php
require_once "CRUD/config_lms.php";

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
</head>
<body>
<h1>Register</h1>
<a href="register_lms.php">Register</a>
<a href="login_lms.php">Login</a>

<div class="container mt-4">
    <hr>
    <form action="register_lms.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" placeholder="Email">

        <label for="password">Password:</label>
        <input type="password"  name="password" id="password" placeholder="Password">
        <label for="confirm_password">Confirm Password:</label>
        <input type="password"  name="confirm_password" id="confirm_password"
               placeholder="Confirm Password">
        <label for="section">Section:</label>
        <input type="text" name="section" id="section" placeholder="section">

        <select name="role">
            <option value="teacher">Teacher</option>
            <option value="student">Student</option>
        </select>

        <button type="submit" >Register</button>
    </form>
</div>
</body>
</html>
















