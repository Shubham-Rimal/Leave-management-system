<?php
require_once "config_lms.php";
$sql = "DELETE FROM leave_requests WHERE id=?";
if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $param_id);
    $param_id = $_GET['id'];
    if (mysqli_stmt_execute($stmt)) {
        header("location:retrieve_to_lms.php");
    }
}
