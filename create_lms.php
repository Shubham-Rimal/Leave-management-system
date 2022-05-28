<?php
session_start();
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


        $sql = "INSERT INTO leave_requests (name, user_profile_id, leave_end_date, leave_start_date, leave_reason) VALUES (?, ?, ?, ?, ?)";

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
    <link href="css/create.css" rel="stylesheet">
</head>
<body >
<div class="all">
<div class="container mt-3">

    <h2 class="create_title">Create page</h2>
    <div class="card">
        <form action="create_lms.php" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <input required="" type="text" name="name" autocomplete="off" class="input" id="name">
                <label class="user-label" style="font-family: 'Agency FB'">Name</label><br><br><br>
            </div>
            <div class="input-group">
                <input required="" type="text" name="leave_start_date" autocomplete="off" class="input" id="leave_start_date">
                <label class="user-label" style="font-family: 'Agency FB'">Leave start date</label><br><br><br>
            </div>
            <div class="input-group">
                <input required="" type="text" name="leave_end_date" autocomplete="off" class="input" id="leave_end_date">
                <label class="user-label" style="font-family: 'Agency FB'">Leave end date</label><br><br><br>
            </div>
            <div class="input-group">
                <input required="" type="text" name="leave_reason" autocomplete="off" class="input" id="leave_reason">
                <label class="user-label" style="font-family: 'Agency FB'">Leave reason</label><br>
            </div>
            <button type="submit" class="button">Submit</button>
        </form>
            </div>
    </div>
</div>
</div>
</body>
</html>