<?php
require_once "config_lms.php";

$name = $leave_start_date = $leave_end_date = $leave_reason ="";
$name_err = $leave_start_date_err = $leave_end_date_err = $leave_reason_err = "";
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    echo "1";

    $id = $_POST["id"];

    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter your name.";
        echo "Please enter your name.";
    } elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $name_err = "Please enter a valid name.";
        echo "Please enter a valid name.";
    } else {
        $name = $input_name;
    }

    $input_leave_start_date = trim($_POST["leave_start_date"]);
    if (empty($input_leave_start_date)) {
        $leave_start_date_err = "Please enter a start date.";
        echo "Please enter a start date.";
    } elseif (!filter_var($input_leave_start_date, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $leave_start_date_err = "Please enter a valid start date.";
        echo "Please enter a valid start date.";
    } else {
        $leave_start_date = $input_leave_start_date;
    }

    $input_leave_end_date = trim($_POST["leave_end_date"]);
    if (empty($input_leave_end_date)) {
        $leave_end_date_err = "Please enter an end date.";
        echo "Please enter an end date.";
    }  elseif (!filter_var($input_leave_start_date, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $leave_start_date_err = "Please enter a valid end date.";
        echo "Please enter a valid end date.";
    } else {
        $leave_end_date = $input_leave_end_date;
    }

    $input_leave_reason = trim($_POST["leave_reason"]);
    if (empty($input_leave_reason)) {
        $leave_reason_err = "Please enter a reason.";
        echo "Please enter a reason.";
    } elseif (!filter_var($input_leave_start_date, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $leave_reason_err = "Please enter a valid reason.";
        echo "Please enter a valid reason.";
    } else {
        $leave_reason = $input_leave_reason;
    }

    if (empty($name_err) && empty($leave_start_date_err) && empty($leave_end_date_err) && empty($leave_reason_err)) {
        echo "2";
            $sql = "UPDATE leave_requests SET name=?, leave_start_date=?, leave_end_date=?, leave_reason=? WHERE id=?";
            if ($stmt = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($stmt, "ssssi", $param_name, $param_leave_start_date, $param_leave_end_date, $param_leave_reason, $param_id);

                $param_name = $name;
                $param_leave_start_date = $leave_start_date;
                $param_leave_end_date = $leave_end_date;
                $param_leave_reason = $leave_reason;
                $param_id = $id;
        }
        if (mysqli_stmt_execute($stmt)) {
            header("location: retrieve_to_lms.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }


    mysqli_stmt_close($stmt);

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
</head>
<body>
<a href="retrieve_to_lms.php">Home</a>
<br><br>
<form method="post" action="" enctype="multipart/form-data">
    <label for="name">Name:</label>
    <input type="text" name="name" value="<?php echo $name; ?>"<br><br>
    <label for="leave_start_date">Leave start date:</label>
    <input type="text" name="leave_start_date" value="<?php echo $leave_start_date; ?>"<br><br>
    <label for="leave_end_date">Leave end date:</label>
    <input type="text" name="leave_end_date" value="<?php echo $leave_end_date; ?>" <br><br>
    <label for="leave_reason">Reason for leave:</label>
    <input type="text" name="leave_reason" value="<?php echo $leave_reason; ?>" <br><br>
    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
    <input type="submit" value="update">
</form>

</body>
</html>