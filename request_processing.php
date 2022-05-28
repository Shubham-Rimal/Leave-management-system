<?php
require_once "config_lms.php";

$status = $reason = $applicant_name = $applicant_leave_reason = "";
$status_err = $reason_err = $applicant_name_err = $applicant_leave_reason_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_status = trim($_POST["status"]);
    if (empty($input_status)) {
        $status_err = "Please approve or reject the request.";
        echo "Please approve or reject the request.";
    } else {
        $status = $input_status;
    }

    $input_reason = trim($_POST["reason"]);
    if (empty($input_reason)) {
        $leave_reason_err = "Please enter a reason.";
        echo "Please enter a reason";
    } else {
        $reason = $input_reason;
    }

    $input_applicant_name = trim($_POST["applicant_name"]);
    if (empty($input_applicant_name)) {
        $applicant_name_err = "Please enter applicant's name.";
        echo "Please enter applicant's name.";
    } else {
        $applicant_name = $input_applicant_name;
    }

    $input_applicant_leave_reason = trim($_POST["applicant_leave_reason"]);
    if (empty($input_applicant_leave_reason)) {
        $applicant_leave_reason_err = "Please enter applicant's leave reason.";
        echo "Please enter applicant's leave reason";
    } else {
        $applicant_leave_reason = $input_applicant_leave_reason;
    }


    if (empty($reason_err) && empty($status_err) && empty($applicant_leave_reason_err) && empty($applicant_name_err)) {


        $sql = "INSERT INTO processed_requests (applicant_name, applicant_leave_reason, status, reason) VALUES (?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssss", $applicant_name, $applicant_leave_reason, $status, $reason);

            $status = trim($_POST['status']);
            $reason = trim($_POST['reason']);
            $applicant_name = trim($_POST['applicant_name']);
            $applicant_leave_reason = trim($_POST['applicant_leave_reason']);

            if (mysqli_stmt_execute($stmt)) {
                header("location: processed_requests.php");
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
<head><title>Request Processing</title>
    <link href="css/create.css" rel="stylesheet">
</head>
<div class="all">
    <div class="container mt-3">

        <h2 class="create_title">Process Request Page</h2>
        <div class="card">
            <form action="request_processing.php" method="post" enctype="multipart/form-data">
                <div class="input-group">
                    <input required="" type="text" name="applicant_name" autocomplete="off" class="input" id="applicant_name">
                    <label class="user-label" style="font-family: 'Agency FB'">Applicant's name</label><br><br><br>
                </div>
                <div class="input-group">
                    <input required="" type="text" name="applicant_leave_reason" autocomplete="off" class="input" id="applicant_leave_reason">
                    <label class="user-label" style="font-family: 'Agency FB'">Applicant's leave reason</label><br><br><br>
                </div>
                <div class="input-group">
                    <input required="" type="text" name="status" autocomplete="off" class="input" id="status">
                    <label class="user-label" style="font-family: 'Agency FB'">Status</label><br><br><br>
                </div>
                <div class="input-group">
                    <input required="" type="text" name="reason" autocomplete="off" class="input" id="reason">
                    <label class="user-label" style="font-family: 'Agency FB'">Reason</label><br>
                </div>
                <button type="submit" class="button">Submit</button>
            </form>
        </div>
    </div>
</div>
</html>