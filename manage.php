<?php include "inc/header.php"?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-md-3">
                <h2 class="text-primary mt-3">Manage your Info</h2>
                <form method="post" enctype="multipart/form-data">
                    <div  class="card shadow p-2 mb-2 bg-white" style="border-radius: 30px;">
                        <?php
                        if (isset($_GET['user_id'])) {
                            $user_id = $_GET['user_id'];
                            $sql = "SELECT * FROM user WHERE user_id='$user_id'";
                            $res = mysqli_query($db, $sql);
                            $r = mysqli_fetch_assoc($res);

                        }
                        ?>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="form-group">
                                    <label>Full name</label>
                                    <input value="<?php echo $r['fullname'] ?>" name="fullname" type="text" class="form-control mb-3" placeholder="Your Full Name">
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input value="<?php echo $r['email'] ?>"  name="email" type="email" class="form-control mb-3" readonly="readonly">
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input name="password" type="password" class="form-control mb-3" placeholder="xxxxx">
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="form-group">
                                    <label>Re-type Password</label>
                                    <input name="repassword" type="password" class="form-control mb-3" placeholder="xxxxx">
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="form-group">
                                    <label for="address">Phone</label>
                                    <input value="<?php echo $r['phone'] ?>" name="phone" type="text" class="form-control mb-3" placeholder="Address">
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input value="<?php echo $r['address'] ?>" name="address" type="text" class="form-control mb-3" placeholder="Address">
                                </div>
                            </div>

                            <div class="align-items-center row">
                                <div class="form-group">
                                <?php
                                if (!empty($r['image'])) { ?>
                                    <img src="admin/dist/img/users/<?php echo $r['image']?>" width="100px" height="100px"><br>

                                <?php    } else { ?>
                                    <span class="text text-success">No Picture Uploaded</span><br>
                                <?php    }
                                ?>
                                <br><input name="image" type="file" class="form-control-file mb-3">
                            </div>
                            </div>
                            <div class="row">
                                <input name="user_id" type="hidden" value="<?php echo $r['user_id'] ?>">
                                <button name="manage" type="submit" class="btn btn-warning text-white">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
                <?php
                if (isset($_POST['manage'])){
                    $user_id = $_POST['user_id'];
                    $fullname = $_POST['fullname'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $repassword = $_POST['repassword'];
                    $phone = $_POST['phone'];
                    $address = $_POST['address'];

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
                            unlink("admin/dist/img/users/".$thisImage);
                        }
                        //upload new image
                        $image_name = rand(1, 99999). '_' .$image;
                        move_uploaded_file($image_temp, "admin/dist/img/users/$image_name");

                        $updateUser = "update user set fullname='$fullname',email='$email',password='$hassedPassword',phone='$phone',address='$address',image='$image_name' 
                                    where user_id='$user_id'";
                        $updateRes = mysqli_query($db, $updateUser);

                        if ($updateRes){
                            header("Location:index.php");
                        } else {
                            die("MySQLi Error". mysqli_error($db));
                        }


                    }
                    elseif (!empty($password) && empty($image)){
                        if ($password==$repassword){
                            $hassedPassword = sha1($password);
                        }


                        $updateUser = "update user set fullname='$fullname',email='$email',password='$hassedPassword',phone='$phone',address='$address' 
                                    where user_id='$user_id'";
                        $updateRes = mysqli_query($db, $updateUser);

                        if ($updateRes){
                            header("Location:index.php");
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
                            unlink("admin/dist/img/users/".$thisImage);
                        }
                        //upload new image
                        $image_name = rand(1, 99999). '_' .$image;
                        move_uploaded_file($image_temp, "admin/dist/img/users/$image_name");

                        $updateUser = "update user set fullname='$fullname',email='$email',phone='$phone',address='$address',image='$image_name'
                                    where user_id='$user_id'";
                        $updateRes = mysqli_query($db, $updateUser);

                        if ($updateRes){
                            header("Location:index.php");
                        } else {
                            die("MySQLi Error". mysqli_error($db));
                        }
                    }
                    else{


                        $updateUser = "update user set fullname='$fullname',email='$email',phone='$phone',address='$address'
                                    where user_id='$user_id'";
                        $updateRes = mysqli_query($db, $updateUser);

                        if ($updateRes){
                            header("Location:index.php");
                        } else {
                            die("MySQLi Error". mysqli_error($db));
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>
<?php include "inc/footer.php"?>
