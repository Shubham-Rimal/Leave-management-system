<?php

require_once "config_lms.php";

$section = $name = $email = "";
$section_err = $name_err = $email_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_section = trim($_POST["section"]);
    if (empty($input_section)) {
        $section_err = "Please enter a section name.";
        echo "Please enter a section name.";

    } elseif (!filter_var($input_section, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $section_err = "Please enter a valid section name.";
        echo "Please enter a valid section name.";

    } else {
        $section = $input_section;
    }

    $input_email = trim($_POST["email"]);
    if (empty($input_email)) {
        $email_err = "Please enter a email.";
        echo "Please enter a email";
    } else {
        $email = $input_email;
    }

    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
        echo "Please enter a name.";
    } elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $name_err = "Please enter a valid name.";
        echo "Please enter a valid name.";
    } else {
        $name = $input_name;
    }


    if (empty($section_err_err) && empty($name_err) && empty($email_err)) {

        $temp_name = $_FILES['image']['tmp_name'];
        $filename = $_FILES['image']['name'];
        $folder = "Leave_management_system/" . $filename;
        if (move_uploaded_file($temp_name, $folder)) {
            $msg = "Image uploaded successfully";
        } else {
            $msg = "Failed to upload image";
        }

        $sql = "INSERT INTO grade_xi (section, name, email, image) VALUES (?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssss", $section, $name, $email, $filename);

            $section= trim($_POST['section']);
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $filename = $_FILES['image']['name'];

            if (mysqli_stmt_execute($stmt)) {
                header("location: retrieve_to_lms.php");
            } else {
                echo "ERROR: Could not execute query: $sql. " . mysqli_error($conn);
            }
        } else {
            echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);

        mysqli_close($conn);
    }
}
?>
<html>
<head><title>Create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
</head>
<div class="container mt-3">

    <div class="form-group">
        <h2>Create page</h2>
        <form action="create_lms.php" method="post" enctype="multipart/form-data">
            Username:<input type="text" class="form-control" id="section" placeholder="Enter Section name" name="section"><br>
            Password:<input type="text" class="form-control" id="name" placeholder="Enter name" name="name"><br>
            Email:<input type="email" class="form-control" id="email" placeholder="Enter email" name="email"><br>
            <button type="submit">Submit</button>
        </form>
    </div>
</div>
    <div class="container mt-3">
        <div class="form-group">
            <

</html>