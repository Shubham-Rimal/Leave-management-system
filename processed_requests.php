<?php
require_once "config_lms.php";
$sql = "SELECT * FROM processed_requests";
$result=mysqli_query($conn,$sql)
?>
<html lang="en">
<head><title>Retrieve</title>
    <link rel="stylesheet" href="css/retrieve.css">
</head>

<body>
<div class="all">
    <div class="header">
        <button class="button"><a href="logout_lms.php"><p class="a">LOGOUT</p></a></button>

        <h1 class="title">PROCESSED REQUESTS</h1>
    </div>
<br><br><br>
<table class="table" border="3">
    <tr>
        <th class="th">id</th>
        <th class="th">Applicant's name</th>
        <th class="th">Applicant's leave reason</th>
        <th class="th">Status</th>
        <th class="th">Reason</th>
    </tr>
    <?php foreach ($result as $row){ ?>
        <tr>
            <td class="td"><?php echo $row['id']?></td>
            <td class="td"><?php echo $row['applicant_name']?></td>
            <td class="td"><?php echo $row['applicant_leave_reason']?></td>
            <td class="td"><?php echo $row['status']?></td>
            <td class="td"><?php echo $row['reason']?></td>
        </tr>
    <?php } ?>
</table>
</div>
</body>
</html>

