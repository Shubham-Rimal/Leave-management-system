<?php
require_once "config_lms.php";
$id = $_GET['id'];
$sql = "SELECT * FROM leave_requests WHERE id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $sql = "UPDATE leave_requests SET name=?, leave_start_date=?, leave_end_date=?, leave_reason=?  WHERE id=?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssssi", $name,$leave_start_date,$leave_end_date, $leave_reason, $id_param);
        $id_param= $id;
        $name = $_POST["name"];
        $leave_start_date = $_POST["leave_start_date"];
        $leave_end_date = $_POST["leave_end_date"];
        $leave_reason = $_POST["leave_reason"];

        if (mysqli_stmt_execute($stmt)) {
            header("location: retrieve_to_lms.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
}
?>

<html lang="en">
<head>
    <title>Update page</title>
</head>
<body>
<form method="post" action="">
    <label for="name">Name:</label>
    <input type="text" name="name" value="<?php echo $row["name"] ?>"><br>
    <label for="leave_start_date">Leave start date:</label>
    <input type="text" name="leave_start_date" value="<?php echo $row["leave_start_date"]?>"><br>
    <label for="leave_end_date">Leave end date:</label>
    <input type="text" name="leave_end_date" value="<?php echo $row["leave_end_date"] ?>"><br>
    <label for="leave_reason">Leave reason:</label>
    <input type="text" name="leave_reason" value="<?php echo $row["leave_reason"] ?>"><br>
    <input type="submit" value="Update">
</form>
</body>
</html>
