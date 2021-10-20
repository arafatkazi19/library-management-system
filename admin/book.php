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
                                <h3 class="card-title">Manage Books</h3>

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
                                        <th scope="col">Thumbnail</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Sub-title</th>
                                        <th scope="col">Author Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Status</th>
                                        <th class="text-center" scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $sql = "select * from books";
                                    $fetchBooks = mysqli_query($db, $sql);

                                    $bookCounter = mysqli_num_rows($fetchBooks);


                                    if ($bookCounter==0){ ?>
                                        <p class="alert alert-primary">No Books Found</p>
                                 <?php   }  else {
                                         $i=1;
                                    while($row = mysqli_fetch_assoc($fetchBooks)){ ?>



                                        <tr>
                                            <th scope="row"><?php echo $i++ ?></th>
                                            <td>
                                                <?php
                                                if (!empty($row['image'])) { ?>
                                                    <img src="dist/img/books/<?php echo $row['image']?>" width="100px">
                                                <?php    } else { ?>
                                                    <img src="dist/img/books/default_book.jpg" width="80px">
                                                <?php   }
                                                ?>
                                            </td>
                                            <td><?php echo $row['title'] ?></td>
                                            <td><?php echo $row['sub-title'] ?></td>
                                            <td><?php echo $row['author_name'] ?></td>
                                            <td><?php echo $row['quantity']?></td>
                                            <td><?php echo $row['cat_id']?></td>
                                            <td><?php echo $row['status'] == 1 ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>' ?></td>
                                            <td>
                                                <div class="tbl-action">
                                                    <ul>
                                                        <li><a href="books.php?do=Edit&id=<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></a></li>
                                                        <li><a href="" data-toggle="modal" data-target="#delete<?php echo $row['user_id'] ?>"><i class="fa fa-trash"></i></a></li>
                                                    </ul>
                                                </div>
                                                <!-- Modal Starts -->
                                                <div class="modal fade" id="delete<?php echo $row['user_id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete?</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <ul style="list-style: none;">
                                                                    <li style="display: inline;margin: 0px 7px"><a class="btn btn-danger" href="users.php?do=Delete&user_id=<?php echo $row['user_id']?>">Confirm</a></li>
                                                                    <li style="display: inline;margin: 0px 7px"><a class="btn btn-success" href="" data-dismiss="modal">Cancel</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>


                                        </tr>
                                    <?php } }?>



                                    </tbody>
                                </table>
                            </div>
                        </div>

                    <?php }

                    elseif ($do == "Add") {  ?>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add New Book</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="book.php?do=Store" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg">
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input name="title" type="text" class="form-control" autocomplete="off" required="required" placeholder="Title">
                                            </div>
                                            <div class="form-group">
                                                <label for="sub-title">Sub-title</label>
                                                <input name="sub_title" type="text" class="form-control" autocomplete="off" required="required" placeholder="Sub-title">
                                            </div>
                                            <div class="form-group">
                                                <label for="category_description">Description (Optional)</label>
                                                <textarea id="editor" name="category_description" class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="author_name">Author Name</label>
                                                <input name="author_name" type="text" class="form-control" autocomplete="off" required="required" placeholder="Author Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="quantity">Quantity</label>
                                                <input name="quantity" type="number" class="form-control" autocomplete="off" required="required" placeholder="Quantity">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="role">Category</label>
                                                <select class="form-control" name="cat_id">
                                                    <option>Please select Category</option>
                                                    <?php
                                                        $sql = "select * from category where is_parent=0";
                                                        $res = mysqli_query($db,$sql);
                                                        while ($r = mysqli_fetch_assoc($res)){
                                                             $cat_id = $r['category_id'];
                                                             $cat_name = $r['category_name']; ?>

                                                    <option value="<?php echo $cat_id; ?>"><?php echo $cat_name; ?></option>
                                                     <?php
                                                        $sql2 = "select * from category where is_parent='$cat_id'";
                                                        $res2 = mysqli_query($db, $sql2);
                                                        while ($r2 = mysqli_fetch_assoc($res2)) {
                                                            $sub_cat_id = $r2['category_id'];
                                                            $sub_cat_name = $r2['category_name']; ?>

                                                        <option value="<?php echo $sub_cat_id  ?>">  &nbsp;&nbsp;&nbsp;--<?php echo $sub_cat_name ?></option>

                                                      <?php  }
                                                     } ?>
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
                                                <label for="image">Thumbnail</label>
                                                <input name="image" type="file" class="form-control-file">
                                            </div>
                                            <div class="form-group">
                                                <input name="addBook" type="submit" class="btn btn-success">
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
                                        die("MySQLi Error". mysqli_error($db));
                                    }
                                }


                            } else{
                                echo "Password doesn't match";
                            }


                        }
                    }


                    elseif ($do == "Edit") { ?>
                        <?php

                        if (isset($_GET['user_id'])){
                            $user_id = $_GET['user_id'];

                            $sql = "select * from user where user_id='$user_id'";
                            $data = mysqli_query($db, $sql);
                            $editabledata = mysqli_fetch_assoc($data);
                        }
                        ?>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Edit User</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="users.php?do=Update" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg">
                                            <div class="form-group">
                                                <label for="fullname">Full Name</label>
                                                <input value="<?php echo $editabledata['fullname'] ?>" name="fullname" type="text" class="form-control" autocomplete="off" required="required" placeholder="Full Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input value="<?php echo $editabledata['email'] ?>" name="email" type="text" class="form-control" autocomplete="off" required="required" placeholder="Email">
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input name="password" type="password" class="form-control" placeholder="xxxxxx">
                                            </div>
                                            <div class="form-group">
                                                <label for="repassword">Re-type password</label>
                                                <input name="repassword" type="password" class="form-control" placeholder="xxxxxx">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input value="<?php echo $editabledata['phone'] ?>" name="phone" type="text" class="form-control" autocomplete="off" required="required" placeholder="Phone">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input value="<?php echo $editabledata['address'] ?>" name="address" type="text" class="form-control" autocomplete="off" required="required" placeholder="Address">
                                            </div>
                                            <div class="form-group">
                                                <label for="role">User Role</label>
                                                <select class="form-control" name="role">
                                                    <option value="2">Please select User Role</option>
                                                    <option <?php echo $editabledata['role']==1 ? 'selected' : '' ?> value="1">Admin</option>
                                                    <option <?php echo $editabledata['role']==2 ? 'selected' : '' ?> value="2">User</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="0">Please select Status</option>
                                                    <option <?php echo $editabledata['status']==1 ? 'selected' : '' ?> value="1">Active</option>
                                                    <option <?php echo $editabledata['status']==0 ? 'selected' : '' ?> value="0">Inactive</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="image">Profile Picture</label>
                                                <?php
                                                if (!empty($editabledata['image'])) { ?>
                                                    <img src="dist/img/users/<?php echo $editabledata['image']?>" width="100px" height="100px">

                                                <?php    } else { ?>
                                                    <span class="text text-success">No Picture Uploaded</span>
                                                <?php    }
                                                ?>
                                                <input name="image" type="file" class="form-control-file">
                                            </div>
                                            <div class="form-group">
                                                <input name="user_id" type="hidden" value="<?php echo $editabledata['user_id'] ?>">
                                                <input value="Save Changes" name="updateUser" type="submit" class="btn btn-success">
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>

                    <?php   }


                    elseif ($do == "Update") {
                       if (isset($_POST['updateUser'])){
                           $user_id = $_POST['user_id'];
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

                           if (!empty($password) && !empty($image)){
                                if ($password==$repassword){
                                    $hassedPassword = sha1($password);
                                }

                                //delete exiting image if user change image
                                $oldimage = "select * from user where user_id='$user_id'";
                                $resImage = mysqli_query($db, $oldimage);
                                while ($existingImage = mysqli_fetch_assoc($resImage)){
                                    $thisImage = $existingImage['image'];
                                    unlink("dist/img/users/".$thisImage);
                                }
                                //upload new image
                               $image_name = rand(1, 99999). '_' .$image;
                               move_uploaded_file($image_temp, "dist/img/users/$image_name");

                               $updateUser = "update user set fullname='$fullname',email='$email',password='$hassedPassword',phone='$phone',address='$address',image='$image_name',role='$role',status='$status' 
                                    where user_id='$user_id'";
                               $updateRes = mysqli_query($db, $updateUser);

                               if ($updateRes){
                                   header("Location:users.php?do=Manage");
                               } else {
                                   die("MySQLi Error". mysqli_error($db));
                               }


                           }
                           elseif (!empty($password) && empty($image)){
                                   if ($password==$repassword){
                                       $hassedPassword = sha1($password);
                                   }


                                   $updateUser = "update user set fullname='$fullname',email='$email',password='$hassedPassword',phone='$phone',address='$address',role='$role',status='$status' 
                                    where user_id='$user_id'";
                                   $updateRes = mysqli_query($db, $updateUser);

                                   if ($updateRes){
                                       header("Location:users.php?do=Manage");
                                   } else {
                                       die("MySQLi Error". mysqli_error($db));
                                   }
                           }
                           elseif (empty($password) && !empty($image)){

                                   //delete exiting image if user change image
                                   $oldimage = "select * from user where user_id='$user_id'";
                                   $resImage = mysqli_query($db, $oldimage);
                                   while ($existingImage = mysqli_fetch_assoc($resImage)){
                                       $thisImage = $existingImage['image'];
                                       unlink("dist/img/users/".$thisImage);
                                   }
                                   //upload new image
                                   $image_name = rand(1, 99999). '_' .$image;
                                   move_uploaded_file($image_temp, "dist/img/users/$image_name");

                                   $updateUser = "update user set fullname='$fullname',email='$email',phone='$phone',address='$address',image='$image_name',role='$role',status='$status' 
                                    where user_id='$user_id'";
                                   $updateRes = mysqli_query($db, $updateUser);

                                   if ($updateRes){
                                       header("Location:users.php?do=Manage");
                                   } else {
                                       die("MySQLi Error". mysqli_error($db));
                                   }
                           }
                           else{


                                   $updateUser = "update user set fullname='$fullname',email='$email',phone='$phone',address='$address',role='$role',status='$status' 
                                    where user_id='$user_id'";
                                   $updateRes = mysqli_query($db, $updateUser);

                                   if ($updateRes){
                                       header("Location:users.php?do=Manage");
                                   } else {
                                       die("MySQLi Error". mysqli_error($db));
                                   }
                           }
                       }

                    }



                    elseif ($do == "Delete") {
                        if (isset($_GET['user_id'])) {
                            $user_id = $_GET['user_id'];

                            $sql = "DELETE from user where user_id='$user_id'";
                            $res = mysqli_query($db, $sql);

                            if ($res) {
                                header("Location: users.php?do=Manage");
                            } else{
                                die("MySQLi Error ". mysqli_error($db));
                            }
                        }
                    }

                    ?>

                </div>
            </div>
        </div>
    </section>
</div>

<!-- Content Wrapper Ends -->

<?php include "inc/footer.php"; ?>
