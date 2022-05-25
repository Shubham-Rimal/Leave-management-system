<?php
session_start();
echo $_SESSION['id'];
require_once "config_lms.php";

$leave_reason = $name = $leave_end_date = $leave_start_date = "";
$leave_reason_err = $name_err = $leave_end_date_err = $leave_start_date_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_leave_reason = trim($_POST["leave_reason"]);
    if (empty($input_leave_reason)) {
        $leave_reason_err = "Please enter a leave reason.";
        echo "Please enter a leave reason.";
    } else {
        $leave_reason = $input_leave_reason;
    }

    $input_leave_end_date = trim($_POST["leave_end_date"]);
    if (empty($input_leave_end_date)) {
        $leave_end_date_err = "Please enter your leave end date.";
        echo "Please enter your leave end date";
    } else {
        $leave_end_date = $input_leave_end_date;
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

    $input_leave_start_date = trim($_POST["leave_start_date"]);
    if (empty($input_leave_start_date)){
        $leave_start_date_err = "Please enter your leave start date.";
        echo "Please enter your leave start date.";

    } else {
        $leave_start_date = $input_leave_start_date;
    }

    if (empty($leave_reason_err) && empty($name_err) && empty($leave_end_date_err) && empty($leave_start_date_err)) {


        $sql = "INSERT INTO leave_requests (id, name, user_profile_id, leave_end_date, leave_start_date, leave_reason) VALUES (?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "sisss", $name, $user_profile, $leave_end_date, $leave_start_date, $leave_reason);

            $leave_reason= trim($_POST['leave_reason']);
            $name = trim($_POST['name']);
            $leave_end_date = trim($_POST['leave_end_date']);
            $leave_start_date = trim($_POST['leave_start_date']);
            $user_profile = $_SESSION['id'];

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
<html lang="en">
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
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name"><br>
            <label for="leave_start_date">Leave start date:</label>
            <input type="text" class="form-control" id="leave_start_date" placeholder="Enter leave start date." name="leave_start_date"><br>
            <label for="leave_end_date">Leave end date:</label>
            <input type="text" class="form-control" id="leave_end_date" placeholder="Enter leave end date" name="leave_end_date"><br>
            <label for="leave_reason">Leave reason:</label>
            <input type="text" class="form-control" id="leave_reason" placeholder="Enter reason for leave." name="leave_reason"><br>
            <button type="submit">Submit</button>
        </form>
    </div>
</div>

</html>