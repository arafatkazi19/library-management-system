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

                                    $sql = "Select * from category";
                                    $res = mysqli_query($db,$sql);
                                    $i = 1;
                                    while ($r = mysqli_fetch_assoc($res)) {
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $i++ ?></th>
                                        <td><?php echo $r['category_name'] ?></td>
                                        <td><?php echo  $r['category_description'] ?></td>
                                        <td><?php
                                            echo  $r['is_parent'] == 0 ? "<span class='badge badge-success'>Primary Category</span>" : "<span class='badge badge-primary'>Sub Category</span>" ?>
                                        </td>
                                        <td><?php
                                            echo  $r['status'] == 1 ? "<span class='badge badge-success'>Active</span>" : "<span class='badge badge-danger'>Inactive</span>" ?>
                                        </td>
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


