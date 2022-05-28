<?php
require_once "config_lms.php";

$name = $leave_start_date = $leave_end_date =  $leave_reason = "";
$name_err = $leave_start_date_err = $leave_end_date_err = $leave_reason_err = "";
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    echo "1";

    $id = $_POST["id"];

    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter your name";
        echo "Please enter your name.";
    } elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $name_err = "Please enter a valid name";
        echo "Please enter a valid name";
    } else {
        $name = $input_name;
    }

    $input_leave_start_date = trim($_POST["leave_start_date"]);
    if (empty($input_leave_start_date)) {
        $leave_start_date_err = "Please enter a leave start date";
        echo "Please enter a leave start date.";
    } elseif (!filter_var($input_leave_start_date, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z0-9\s]+$/")))) {
        $leave_start_date_err = "Please enter a valid leave start date";
        echo "Please enter a valid leave start date";

    } else {
        $leave_start_date = $input_leave_start_date;
    }
    
    $input_leave_end_date = trim($_POST["leave_end_date"]);
    if (empty($input_leave_end_date)) {
        $leave_end_date_err = "Please enter a leave end date";
        echo "Please enter a leave end date";
    } elseif (!filter_var($input_leave_start_date, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z0-9\s]+$/")))) {
        $leave_start_date_err = "Please enter a valid leave end date";
        echo "Please enter a valid leave end date";

    } else {
        $leave_end_date = $input_leave_end_date;
    }

    $input_leave_reason = trim($_POST["leave_reason"]);
    if (empty($input_leave_reason)) {
        $leave_reason_err = "Please enter a leave reason";
        echo "Please enter a leave reason";
    } elseif (!filter_var($input_leave_start_date, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z0-9\s]+$/")))) {
        $leave_start_date_err = "Please enter a valid leave reason";
        echo "Please enter a valid leave reason";

    } else {
        $leave_end_date = $input_leave_end_date;
    }


    if (empty($name_err) && empty($leave_start_date_err) && empty($leave_end_date_err)) {
        echo "2";
            $sql = "UPDATE leave_requests SET name=?, leave_start_date=?, leave_end_date=? WHERE id=?";
            if ($stmt = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_leave_start_date, $param_leave_end_date, $param_leave_reason);

                $param_name = $name;
                $param_leave_start_date = $leave_start_date;
                $param_leave_end_date = $leave_end_date;
            }
        else {
            $sql = "UPDATE leave_requests SET name=?, leave_start_date=?, leave_end_date=?, leave_reason=? WHERE id=?";
            if ($stmt = mysqli_prepare($conn, $sql)) {

                mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_leave_start_date, $param_leave_end_date, $param_leave_reason);
                $param_name = $name;
                $param_leave_start_date = $leave_start_date;
                $param_leave_end_date = $leave_end_date;
                $param_leave_reason = $leave_reason;
            }
        }
        if (mysqli_stmt_execute($stmt)) {
            header("location: retrieve_to_lms.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }


    mysqli_close($conn);

} else {
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        $id = trim($_GET["id"]);
        echo "8";

        $sql = "SELECT * FROM leave_requests WHERE id = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            $param_id = $id;

            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result);

                    $name = $row["name"];
                    $leave_start_date = $row["leave_start_date"];
                    $leave_end_date = $row["leave_end_date"];
                    $leave_reason = $row["leave_reason"];

                } else {
                    echo "11";

                    header("location: error.php");
                    exit();
                }

            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);

        mysqli_close($conn);
    } else {
        header("location: error.php");
        exit();
    }
}
?>
<html lang="en">
<head>
    <title>Edit Data</title>
    <link href="css/create.css" rel="stylesheet">
</head>
<body>
<a href="retrieve_to_lms.php">Home</a>
<br><br>
<div class="all">
    <h2 class="create_title">Update Page</h2>
    <div class="card">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="input-group">
                <input required="" type="text" name="name" autocomplete="off" class="input" id="name" value="<?php echo $name; ?>">
                <label class="user-label" style="font-family: 'Agency FB'">Name</label><br><br><br>
            </div>
            <div class="input-group">
                <input required="" type="text" name="leave_start_date" autocomplete="off" class="input" id="leave_start_date" value="<?php echo $leave_start_date; ?>">
                <label class="user-label" style="font-family: 'Agency FB'">Leave start date</label><br><br><br>
            </div>
            <div class="input-group">
                <input required="" type="text" name="leave_end_date" autocomplete="off" class="input" id="leave_end_date" value="<?php echo $leave_end_date; ?>">
                <label class="user-label" style="font-family: 'Agency FB'">Leave end date</label><br><br><br>
            </div>
            <div class="input-group">
                <input required="" type="text" name="leave_reason" autocomplete="off" class="input" id="leave_reason" value="<?php echo $leave_reason; ?>">
                <label class="user-label" style="font-family: 'Agency FB'">Leave reason</label><br>
            </div>
            <button type="submit" class="button">Submit</button>
        </form>
    </div>
</div>
</body>