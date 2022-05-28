<?php
require_once "config_lms.php";
$sql = "SELECT * FROM leave_requests";
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
            <button class="button"><a href="create_lms.php"><p class="a">CREATE</p></a></button>
            <h1 class="title">REQUESTS FOR LEAVE</h1>
        </div>
        <br><br><br>
    <table class="table" border="3">
        <tr>
            <th class="th">id</th>
            <th class="th">User ID</th>
            <th class="th">Name</th>
            <th class="th">Leave Start Date</th>
            <th class="th">Leave End Date</th>
            <th class="th">Leave Reason</th>
            <th class="th">Action-1</th>
            <th class="th">Action-2</th>
        </tr>
        <?php foreach ($result as $row){ ?>
            <tr>
                <td class="td"><?php echo $row['id']?></td>
                <td class="td"><?php echo $row['user_profile_id']?></td>
                <td class="td"><?php echo $row['name']?></td>
                <td class="td"><?php echo $row['leave_start_date']?></td>
                <td class="td"><?php echo $row['leave_end_date']?></td>
                <td class="td"><?php echo $row['leave_reason']?></td>
                <td class="td"><a href="delete_details_lms.php?id=<?php echo $row['id']?>">Delete</a></td>
                <td class="td"><a href="update_details_lms.php?id=<?php echo $row['id']?>">Edit</a></td>
            </tr>
        <?php } ?>
    </table>
    </div>
    </body>
    </html>

