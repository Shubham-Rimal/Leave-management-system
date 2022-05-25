<?php
require_once "config_lms.php";
$sql = "SELECT * FROM leave_requests";
$result=mysqli_query($conn,$sql)
?>
    <html lang="en">
    <head><title>Retrieve</title></head>
    <header class="p-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="welcome_lms.php" class="nav-link px-2 text-secondary">Home</a></li>
                    <li><a href="logout_lms.php" class="nav-link px-2 text-white">Logout</a></li>
                </ul>

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                    <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
                </form>

                <div class="text-end">
                    <button type="button" class="btn btn-outline-light me-2">Login</button>
                    <button type="button" class="btn btn-warning">Sign-up</button>
                </div>
            </div>
        </div>
    </header>
    <body>
    <a href="create_lms.php">Create</a>
    <form action="search_lms.php" method="post">
        <input type="text" name="search_keyword" required>
        <select name="search_field" required>
            <option value="section" selected>Section</option>
            <option value="name">Name</option>
            <option value="email">Email</option>
        </select>
        <input type="submit" value="Search">
    </form>
    <table class="table table-dark table-hover">
        <tr>
            <th>id</th>
            <th>User ID</th>
            <th>Name</th>
            <th>Leave Start Date</th>
            <th>Leave End Date</th>
            <th>Leave Reason</th>
            <th>Action-1</th>
            <th>Action-2</th>
        </tr>
        <?php foreach ($result as $row){ ?>
            <tr>
                <td><?php echo $row['id']?></td>
                <td><?php echo $row['user_profile_id']?></td>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['leave_start_date']?></td>
                <td><?php echo $row['leave_end_date']?></td>
                <td><?php echo $row['leave_reason']?></td>
                <td><a href="delete_details_lms.php">Delete</a></td>
                <td><a href="update_details_lms.php">Edit</a></td>
            </tr>
        <?php } ?>
    </table>
    </body>
    </html>

