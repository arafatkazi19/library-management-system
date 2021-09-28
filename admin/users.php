<?php include "inc/header.php"; ?>

<!-- Content Wrapper Starts -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">User Management</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12">

                    <?php

                    $do = isset($_GET['do']) ? $_GET['do'] : "Manage";

                    if ($do == "Manage") { ?>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Manage Users</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-dark table-bordered table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">User Role</th>
                                        <th scope="col">Status</th>
                                        <th class="text-center" scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql = "select * from user";
                                        $fetchUser = mysqli_query($db, $sql);
                                        $i=1;
                                        while($row = mysqli_fetch_assoc($fetchUser)){

                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i++ ?></th>
                                        <td>
                                            <?php
                                                if (!empty($row['image'])) { ?>
                                                    <img src="dist/img/users/<?php echo $row['image']?>" width="40px">
                                            <?php    } else { ?>
                                                    <img src="dist/img/avatar5.png" width="40px">
                                             <?php   }
                                            ?>
                                        </td>
                                        <td><?php echo $row['fullname'] ?></td>
                                        <td><?php echo $row['email'] ?></td>
                                        <td><?php echo $row['phone'] ?></td>
                                        <td><?php echo $row['role'] == 1 ? '<span class="badge badge-success">Admin</span>' : '<span class="badge badge-warning">User</span>' ?></td>
                                        <td><?php echo $row['status'] == 1 ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>' ?></td>
                                        <td>
                                            <div class="tbl-action">
                                                <ul>
                                                    <li><a href=""><i class="fa fa-edit"></i></a></li>
                                                    <li><a href=""><i class="fa fa-trash"></i></a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    <?php }

                    elseif ($do == "Add") {  ?>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add New User</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                    <form action="users.php?do=Store" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-lg">
                                                    <div class="form-group">
                                                        <label for="fullname">Full Name</label>
                                                        <input name="fullname" type="text" class="form-control" autocomplete="off" required="required" placeholder="Full Name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input name="email" type="text" class="form-control" autocomplete="off" required="required" placeholder="Email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input name="password" type="password" class="form-control" autocomplete="off" required="required" placeholder="Password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="repassword">Re-type password</label>
                                                        <input name="repassword" type="password" class="form-control" autocomplete="off" required="required" placeholder="Re-type Password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="phone">Phone</label>
                                                        <input name="phone" type="text" class="form-control" autocomplete="off" required="required" placeholder="Phone">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="phone">Address</label>
                                                        <input name="address" type="text" class="form-control" autocomplete="off" required="required" placeholder="Address">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="role">User Role</label>
                                                        <select class="form-control" name="role">
                                                            <option value="2">Please select User Role</option>
                                                            <option value="1">Admin</option>
                                                            <option value="2">User</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="status">Status</label>
                                                        <select class="form-control" name="status">
                                                            <option value="0">Please select Status</option>
                                                            <option value="1">Active</option>
                                                            <option value="0">Inactive</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="image">Profile Picture</label>
                                                        <input name="image" type="file" class="form-control-file">
                                                    </div>
                                                    <div class="form-group">
                                                        <input name="addUser" type="submit" class="btn btn-success">
                                                    </div>
                                                </div>

                                            </div>
                                    </form>
                            </div>
                        </div>
                    <?php }


                    elseif ($do == "Store") {
                        if(isset($_POST['addUser'])){
                            $fullname = $_POST['fullname'];
                            $email = $_POST['email'];
                            $password = $_POST['password'];
                            $repassword = $_POST['repassword'];
                            $phone = $_POST['phone'];
                            $address = $_POST['address'];
                            $role = $_POST['role'];
                            $status = $_POST['status'];
                            $image = $_FILES['image']['name'];
                            $image_temp = $_FILES['image']['tmp_name'];


                            if ($password == $repassword){
                                $hassedPassword = sha1($password);

                                if (!empty($image)){
                                    $image_name = rand(1, 99999). '_' .$image;
                                    move_uploaded_file($image_temp, "dist/img/users/$image_name");
                                    $sql = "insert into user (fullname,email,password,phone,address,image,role,status,join_date)
                                        values('$fullname','$email','$hassedPassword','$phone','$address','$image_name','$role','$status',now())";
                                    $addUser = mysqli_query($db, $sql);
                                    if ($addUser){
                                        header("Location: users.php?do=Manage");
                                    } else {

                                    }
                                } else {
                                    $sql = "insert into user (fullname,email,password,phone,address,role,status,join_date)
                                        values('$fullname','$email','$hassedPassword','$phone','$address','$role','$status',now())";
                                    $addUser = mysqli_query($db, $sql);
                                    if ($addUser){
                                        header("Location: users.php?do=Manage");
                                    } else {

                                    }
                                }


                            } else{
                                echo "Password doesn't match";
                            }


                        }
                    }


                    elseif ($do == "Edit") {
                        echo "This page will show update user info in edit form";
                    }


                    elseif ($do == "Update") {
                        echo "This page will update user info in database";
                    }


                    elseif ($do == "Delete") {
                        echo "Deleting user from database";
                    }

                    ?>

                </div>
            </div>
        </div>
    </section>
</div>

<!-- Content Wrapper Ends -->

<?php include "inc/footer.php"; ?>
