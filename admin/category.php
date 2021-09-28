<?php include "inc/header.php"; ?>
<!-- Content Wrapper Starts -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Categories and Sub-categories for Books</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manage Categories</li>
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
                                <h3 class="card-title">Manage Categories</h3>

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
                                        <th scope="col">#Sl.</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Category / Sub</th>
                                        <th scope="col">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>

                                    <?php

                                    $sql = "Select * from category where is_parent=0";
                                    $res = mysqli_query($db,$sql);
                                    $i = 1;
                                    while ($r = mysqli_fetch_assoc($res)) {
                                        $cat_id = $r['category_id'];
                                        ?>
                                        <tr>

                                            <th scope="row"><?php echo $i++ ?></th>
                                            <td><?php echo $r['category_name'] ?></td>
                                            <td><?php echo  $r['category_description'] ?></td>
                                            <td><?php
                                                echo  $r['is_parent'] == 0 ? "<span class='badge badge-success'>Parent Category</span>" : "<span class='badge badge-primary'>Sub Category</span>" ?>
                                            </td>
                                            <td><?php
                                                echo  $r['status'] == 1 ? "<span class='badge badge-success'>Active</span>" : "<span class='badge badge-danger'>Inactive</span>" ?>
                                            </td>
                                            <td>
                                                <div class="tbl-action">
                                                    <ul>
                                                        <li><a href="category.php?do=Edit&id=<?php echo $r['category_id']?>"><i class="fa fa-edit"></i></a></li>
                                                        <li><a href=""><i class="fa fa-trash"></i></a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>

                                        <?php
                                         //sub-category check start
                                        $sql = "select * from category where is_parent = '$cat_id'";
                                        $subcatres = mysqli_query($db,$sql);
                                        while($r = mysqli_fetch_assoc($subcatres)){
                                            $cat_id = $r['category_id'];
                                            $cat_name = $r['category_name'];
                                            $cat_description = $r['category_description'];
                                            $is_parent = $r['is_parent'];
                                            $status = $r['status']; ?>

                                            <tr>
                                                <th scope="row"></th>
                                                <td>--<?php echo $r['category_name'] ?></td>
                                                <td><?php echo  $r['category_description'] ?></td>
                                                <td><?php
                                                    echo  $r['is_parent'] == 0 ? "<span class='badge badge-success'>Parent Category</span>" : "<span class='badge badge-primary'>Sub Category</span>" ?>
                                                </td>
                                                <td><?php
                                                    echo  $r['status'] == 1 ? "<span class='badge badge-success'>Active</span>" : "<span class='badge badge-danger'>Inactive</span>" ?>
                                                </td>
                                                <td>
                                                    <div class="tbl-action">
                                                        <ul>
                                                            <li><a href="category.php?do=Edit&id=<?php echo $r['category_id']?>"><i class="fa fa-edit"></i></a></li>
                                                            <li><a href=""><i class="fa fa-trash"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                      <?php  }
                                        ?>

<!--                                        //sub-category check ends-->
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    <?php }

                    elseif ($do == "Add") {  ?>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add New Category</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="category.php?do=Store" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="category_name">Category Name</label>
                                        <input type="text" name="category_name" class="form-control" placeholder="Category Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="category_description">Description (Optional)</label>
                                        <textarea id="editor" name="category_description" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="is_parent">Parent Category</label>
                                        <select class="form-control" name="is_parent">
                                            <option value="0">Please Select Parent Category</option>
                                            <?php
                                                $parentsql = "select * from category where is_parent = 0";
                                                $parentres = mysqli_query($db, $parentsql);
                                                while($row = mysqli_fetch_assoc($parentres)){
                                                    $cat_id = $row['category_id'];
                                                    $cat_name = $row['category_name'];
                                                    ?>
                                                    <option value="<?php echo $cat_id ?>"><?php echo $cat_name ?></option>
                                                 <?php } ?>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" name="status">
                                            <option value="1">Please Select Status</option>
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" name="addcat" class="btn btn-success" value="Add Category">
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php }


                    elseif ($do == "Store") {
                        if (isset($_POST['addcat'])){
                            $category_name = $_POST['category_name'];
                            $category_description = $_POST['category_description'];
                            $is_parent = $_POST['is_parent'];
                            $status = $_POST['status'];


                            $sql = "insert into category(category_name,category_description,is_parent,status)
                                 values ('$category_name','$category_description','$is_parent','$status')";

                            $res = mysqli_query($db, $sql);

                            if ($res){
                                header("Location:category.php?do=Manage");
                            } else{
                                die("Something went wrong". mysqli_error());
                            }
                        }
                    }


                    elseif ($do == "Edit") {
                        if (isset($_GET['id'])) {
                            $cat_id = $_GET['id'];
                            $sql1 = "select * from category where category_id='$cat_id'";
                            $res1 = mysqli_query($db, $sql1);
                            $row = mysqli_fetch_assoc($res1);


                                ?>

                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Edit Category</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <form action="category.php?do=Update" method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="category_name">Category Name</label>
                                                <input value="<?php echo $row['category_name'] ?>" type="text" name="category_name" class="form-control" placeholder="Category Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="category_description">Description (Optional)</label>
                                                <textarea id="editor" name="category_description" class="form-control"><?php echo $row['category_description'] ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="is_parent">Parent Category</label>
                                                <select class="form-control" name="is_parent">
                                                    <option value="0">Please Select Parent Category</option>
                                                    <?php
                                                    $sql = "select * from category where is_parent=0";
                                                    $catres = mysqli_query($db,$sql);
                                                    while($r = mysqli_fetch_assoc($catres)){
                                                         $cat_id = $r['category_id'];
                                                         $cat_name = $r['category_name'];
                                                    ?>
                                                        <option value="<?php echo $cat_id ?>"><?php echo $cat_name ?></option>

                                                        <?php
                                                        $sql = "select * from category where is_parent='$cat_id'";
                                                        $subcatres = mysqli_query($db,$sql);
                                                        while($r = mysqli_fetch_assoc($subcatres)){
                                                            $cat_id = $r['category_id'];
                                                            $cat_name = $r['category_name'];
                                                            $is_parent = $r['is_parent'];
                                                        ?>
                                                            <option value="<?php echo $cat_id ?>">--<?php echo $cat_name ?></option>
                                                           <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="1">Please Select Status</option>
                                                    <option value="1" <?php echo $row['status'] == 1 ? 'selected' : ''?> >Active</option>
                                                    <option value="2" <?php echo $row['status'] == 2 ? 'selected' : ''?> >Inactive</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <input name="id" type="hidden" value="<?php echo $row['category_id']?>">
                                                <input type="submit" name="updatecat" class="btn btn-warning" value="Update Category">
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            <?php

                        }

                    }


                    elseif ($do == "Update") {
                        if (isset($_POST['updatecat'])){
                            $cat_id = $_POST['id'];
                            $category_name = $_POST['category_name'];
                            $category_description = $_POST['category_description'];
                            $is_parent = $_POST['is_parent'];
                            $status = $_POST['status'];


                            $updatecatsql = "update category set category_name='$category_name',category_description='$category_description',is_parent='$is_parent',status='$status' 
                                    where category_id='$cat_id'";

                            $updatecat = mysqli_query($db, $updatecatsql);

                            if ($updatecat){
                                header("Location:category.php?do=Manage");
                            } else{
                                die("Something went wrong". mysqli_error());
                            }
                        }
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


