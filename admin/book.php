  <?php include "inc/header.php"; ?>

<!-- Content Wrapper Starts -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Book Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Book Management</li>
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
                                            <td><?php echo $row['sub_title'] ?></td>
                                            <td><?php echo $row['author_name'] ?></td>
                                            <td><?php echo $row['quantity']?></td>
                                            <td><?php
                                                    $cat_id = $row['cat_id'];
                                                    $sql = "select * from category where category_id='$cat_id'";
                                                    $res = mysqli_query($db, $sql);
                                                    while ($r=mysqli_fetch_assoc($res)){
                                                        $cat_id = $r['category_id'];
                                                        $cat_name = $r['category_name'];
                                                        $is_parent = $r['is_parent'];

/*                                                        $is_parent==0 : '<span class="badge badge-primary"><?php echo $cat_name ?></span>' : '<span class="badge badge-primary"><?php echo $cat_name ?></span>';*/

                                                        if ($is_parent==0){
                                                        ?>
                                                            <span class="badge badge-primary"><?php echo $cat_name ?></span>
                                                <?php  } else { ?>
                                                      <span class="badge badge-success"><?php echo $cat_name ?></span>
                                               <?php } ?>
                                            </td>
                                            <td><?php echo $row['status'] == 1 ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>' ?></td>
                                            <td>
                                                <div class="tbl-action">
                                                    <ul>
                                                        <li><a href="book.php?do=Edit&id=<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></a></li>
                                                        <li><a href="" data-toggle="modal" data-target="#delete<?php echo $row['id'] ?>"><i class="fa fa-trash"></i></a></li>
                                                    </ul>
                                                </div>
                                                <!-- Modal Starts -->
                                                <div class="modal fade" id="delete<?php echo $row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                    <li style="display: inline;margin: 0px 7px"><a class="btn btn-danger" href="book.php?do=Delete&id=<?php echo $row['id']?>">Confirm</a></li>
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

                    <?php } }

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
                                                <label for="description">Description (Optional)</label>
                                                <textarea id="editor" name="description" class="form-control"></textarea>
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
                        if(isset($_POST['addBook'])){
                            $title = $_POST['title'];
                            $sub_title = $_POST['sub_title'];
                            $description = $_POST['description'];
                            $author_name = $_POST['author_name'];
                            $quantity = $_POST['quantity'];
                            $cat_id = $_POST['cat_id'];
                            $status = $_POST['status'];

                            $image = $_FILES['image']['name'];
                            $image_temp = $_FILES['image']['tmp_name'];


                                if (!empty($image)){
                                    $image_name = rand(1, 99999). '_' .$image;
                                    move_uploaded_file($image_temp, "dist/img/books/$image_name");
                                    $sql = "insert into books (title,sub_title,description,cat_id,author_name,quantity,image,status)
                                        values('$title','$sub_title','$description','$cat_id','$author_name','$quantity','$image_name','$status')";
                                    $addBook = mysqli_query($db, $sql);
                                    if ($addBook){
                                        header("Location: book.php?do=Manage");
                                    } else {
                                        die("MySQLi Error". mysqli_error($db));
                                    }
                                } else {
                                    $sql = "insert into books (title,sub_title,description,cat_id,author_name,quantity,status)
                                        values('$title','$sub_title','$description','$cat_id','$author_name','$quantity','$status')";
                                    $addBook = mysqli_query($db, $sql);
                                    if ($addBook){
                                        header("Location: book.php?do=Manage");
                                    } else {
                                        die("MySQLi Error". mysqli_error($db));
                                    }
                                }


                            }


                        }


                    elseif ($do == "Edit") { ?>
                        <?php

                        if (isset($_GET['id'])){
                            $update_id = $_GET['id'];

                            $sql = "select * from books where id='$update_id'";
                            $data = mysqli_query($db, $sql);
                            $editabledata = mysqli_fetch_assoc($data);
                        }
                        ?>

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
                                <form action="book.php?do=Update" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg">
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input value="<?php echo $editabledata['title'] ?>" name="title" type="text" class="form-control" autocomplete="off" required="required" placeholder="Title">
                                            </div>
                                            <div class="form-group">
                                                <label for="sub-title">Sub-title</label>
                                                <input value="<?php echo $editabledata['sub_title'] ?>" name="sub_title" type="text" class="form-control" autocomplete="off" required="required" placeholder="Sub-title">
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description (Optional)</label>
                                                <textarea id="editor" name="description" class="form-control"><?php echo $editabledata['description'] ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="author_name">Author Name</label>
                                                <input value="<?php echo $editabledata['author_name'] ?>" name="author_name" type="text" class="form-control" autocomplete="off" required="required" placeholder="Author Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="quantity">Quantity</label>
                                                <input value="<?php echo $editabledata['quantity'] ?>" name="quantity" type="number" class="form-control" autocomplete="off" required="required" placeholder="Quantity">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="role">Category</label>
                                                <select class="form-control" name="cat_id">
                                                    <option>Please select Category</option>
                                                    <?php
                                                    //fething parent category
                                                    $sql = "select * from category where is_parent=0";
                                                    $res = mysqli_query($db,$sql);
                                                    while ($r = mysqli_fetch_assoc($res)){
                                                        $p_cat_id = $r['category_id'];
                                                        $cat_name = $r['category_name'];
                                                        ?>

                                                        <option value="<?php echo $p_cat_id ?>"
                                                            <?php
                                                            $cat_id = $editabledata['cat_id'];
                                                            if($cat_id == $p_cat_id) { echo 'selected'; }
                                                            ?>
                                                        ><?php echo $cat_name; ?></option>

                                                        <?php
                                                        //fetching sub category
                                                        $cat_id = $editabledata['cat_id'];
                                                        $sql2 = "select * from category where is_parent='$p_cat_id'";
                                                        $res2 = mysqli_query($db, $sql2);
                                                        while ($r2 = mysqli_fetch_assoc($res2)) {
                                                            $sub_cat_id = $r2['category_id'];
                                                            $sub_cat_name = $r2['category_name']; ?>

                                                            <option value="<?php echo $sub_cat_id; ?>"
                                                                <?php
                                                                if($cat_id == $sub_cat_id) { echo 'selected'; }
                                                                ?>
                                                            >--<?php echo $sub_cat_name; ?></option>

                                                        <?php  }
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="0">Please select Status</option>
                                                    <option value="1" <?php echo $editabledata['status']==1 ? 'selected' : '' ?> >Active</option>
                                                    <option value="2" <?php echo $editabledata['status']==2 ? 'selected' : '' ?> >Inactive</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="image">Thumbnail</label>
                                                <?php
                                                 if (!empty($editabledata['image'])){ ?>

                                                    <img src="dist/img/books/<?php echo $editabledata['image'] ?>" width="100px" height="100px">

                                                <?php } else { ?>
                                                   <span class="text text-success">No Picture Uploaded</span>
                                                <?php } ?>
                                                <input name="image" type="file" class="form-control-file">


                                            </div>
                                            <div class="form-group">
                                                <input name="id" type="hidden" value="<?php echo $editabledata['id'] ?>">
                                                <input name="updateBook" type="submit" class="btn btn-success">
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>

                    <?php   }


                    elseif ($do == "Update") {
                       if (isset($_POST['updateBook'])){
                           $id = $_POST['id'];
                           $title = $_POST['title'];
                           $sub_title = $_POST['sub_title'];
                           $description = $_POST['description'];
                           $cat_id = $_POST['cat_id'];
                           $author_name = $_POST['author_name'];
                           $quantity = $_POST['quantity'];
                           $status = $_POST['status'];

                           $image = $_FILES['image']['name'];
                           $image_temp = $_FILES['image']['tmp_name'];

                           if (!empty($image)){

                                //delete exiting image if user change image
                                $oldimage = "select * from books where id='$id'";
                                $resImage = mysqli_query($db, $oldimage);
                                while ($existingImage = mysqli_fetch_assoc($resImage)){
                                    $thisImage = $existingImage['image'];
                                    unlink("dist/img/books/".$thisImage);
                                }
                                //upload new image
                               $image_name = rand(1, 99999). '_' .$image;
                               move_uploaded_file($image_temp, "dist/img/books/$image_name");

                               $updateBook = "update books set title='$title',sub_title='$sub_title',description='$description',cat_id='$cat_id',author_name='$author_name',image='$image_name',quantity='$quantity',status='$status' 
                                    where id='$id'";
                               $updateRes = mysqli_query($db, $updateBook);

                               if ($updateRes){
                                   header("Location:book.php?do=Manage");
                               } else {
                                   die("MySQLi Error". mysqli_error($db));
                               }


                           }
                           elseif(empty($image)){


                               $updateBook = "update books set title='$title',sub_title='$sub_title',description='$description',cat_id='$cat_id',author_name='$author_name',quantity='$quantity',status='$status' 
                                    where id='$id'";
                               $updateRes = mysqli_query($db, $updateBook);

                               if ($updateRes){
                                   header("Location:book.php?do=Manage");
                               } else {
                                   die("MySQLi Error". mysqli_error($db));
                               }
                           }


                       }

                    }

                    elseif ($do == "Delete") {
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];

                            $sql = "DELETE from books where id='$id'";
                            $res = mysqli_query($db, $sql);

                            if ($res) {
                                header("Location: book.php?do=Manage");
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
