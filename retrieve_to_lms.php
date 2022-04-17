<?php
require_once "config_lms.php";
$sql = "SELECT * FROM grade_xi";
$result=mysqli_query($conn,$sql)
?>
    <html>
    <head><title>Retrieve</title></head>
    <header class="p-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="#" class="nav-link px-2 text-secondary">Home</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">Features</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">Pricing</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">About</a></li>
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
            <th>Image</th>
            <th>Section</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
            <th>Accepted or rejected</th>
        </tr>
        <?php foreach ($result as $row){ ?>
            <tr>
                <td><?php echo$row['id']?></td>
                <td><img src="upload/<?php echo $row['image']?>" height= "2%" width="5%"></td>
                <td><?php echo $row['section']?></td>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['email']?></td>
                <td><select>Action
                        <option onselect="update_details_lms.php?id=<?php echo $row["id"]?>">Edit</a></option>
                        <option><a href="delete_details_lms.php? id=<?php echo $row["id"]?>">Delete</a></option>
                    </select></td>
                <td><select>
                        <option>On hold</option>
                        <option>Approved</option>
                        <option>Rejected</option>
                    </select></td>
            </tr>
        <?php } ?>
    </table>
    </body>
    </html>

