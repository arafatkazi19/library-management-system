<?php include "inc/header.php"; ?>
<!-- Content Wrapper Starts -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">All Orders</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manage Orders</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Manage All Orders</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <?php
                                $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

                                if ($do=='Manage'){

                            ?>

                            <table id="dataSearch" class="table table-dark table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">Sl. no</th>
                                    <th scope="col">Book Title</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Receive Date</th>
                                    <th scope="col">Return Date</th>
                                    <th scope="col">Status</th>
                                    <th class="text text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $user_id = $_SESSION['user_id'];
                                $sql = "select * from booking_list order by id desc";
                                $allBooksListed = mysqli_query($db, $sql);
                                $numofbooks = mysqli_num_rows($allBooksListed);

                                if ($numofbooks<=0){ ?>
                                    <div class="alert alert-primary">No Books Listed</div>
                                <?php } else {
                                    $i=1;
                                    while ($row = mysqli_fetch_assoc($allBooksListed)){
                                        $id = $row['id'];
                                        $user_id = $row['user_id'];
                                        $book_id = $row['book_id'];
                                        $rcv_date = $row['rcv_date'];
                                        $rtn_date = $row['rtn_date'];
                                        $booking_date = $row['booking_date'];
                                        $status = $row['status'];



                                        ?>

                                        <tr>
                                            <th scope="row"><?php echo $i++ ?></th>
                                            <td>
                                                <?php
                                                $sql = "select * from books where id='$book_id'";
                                                $theBook = mysqli_query($db, $sql);
                                                while ($r = mysqli_fetch_assoc($theBook)){
                                                    $title = $r['title'];
                                                    echo $title;
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $sql = "select * from user where user_id='$user_id'";
                                                $userData = mysqli_query($db, $sql);
                                                while ($r = mysqli_fetch_assoc($userData)){
                                                    $name = $r['fullname'];
                                                    echo $name;
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $booking_date ?></td>
                                            <td><?php echo $rcv_date ?></td>
                                            <td><?php echo $rtn_date ?></td>
                                            <td>
                                                <?php
                                                if ($status == 1){ ?>
                                                    <span class="badge bg-success">Active Order</span>
                                                <?php } else if($status == 2){ ?>
                                                    <span class="badge bg-warning">Returned</span>
                                                <?php } else if($status == 3){ ?>
                                                    <span class="badge bg-danger">Cancelled</span>
                                                <?php   } else if($status == 4){ ?>
                                                    <span class="badge bg-warning">Pending</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <div class="tbl-action">
                                                    <ul>
                                                        <li><a href="order-details.php?do=Edit&o_id=<?php echo $id ?>"><i class="fa fa-edit"></i></a></li>
                                                        <li><a href="" data-toggle="modal" data-target="#deleteOrder"><i class="fa fa-trash"></i></a></li>
                                                    </ul>
                                                </div>
                                            </td>

                                        </tr>
                                    <?php }
                                }

                                ?>



                                </tbody>
                            </table>

                            <?php } elseif ($do=='Edit'){
                                    if (isset($_GET['o_id'])){
                                        $order_id = $_GET['o_id'];

                                        $sql = "select * from booking_list where id='$order_id'";
                                        $orderData = mysqli_query($db, $sql);
                                        while ($row = mysqli_fetch_assoc($orderData)){
                                            $id = $row['id'];
                                            $user_id = $row['user_id'];
                                            $book_id = $row['book_id'];
                                            $rcv_date = $row['rcv_date'];
                                            $rtn_date = $row['rtn_date'];
                                            $booking_date = $row['booking_date'];
                                            $status = $row['status'];
                                        ?>

                                        <form method="post" action="order-details.php?do=Update">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="rcv_date">Receive Date</label>
                                                                <input value="<?php echo $rcv_date ?>" id="datepicker" name="rcv_date" type="text" class="form-control" autocomplete="off" required="required" placeholder="Receive Date">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="rtn_date">Return Date</label>
                                                                <input value="<?php echo $rtn_date ?>" id="rtn_datepicker" name="rtn_date" type="text" class="form-control" autocomplete="off" required="required" placeholder="Return Date">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label for="status">Status</label>
                                                                <select class="form-control" name="status">
                                                                    <option value="1" <?php echo ($status == 1) ? 'selected' : ''; ?>>Active</option>
                                                                    <option value="2" <?php echo ($status == 2) ? 'selected' : ''; ?>>Return</option>
                                                                    <option value="3" <?php echo ($status == 3) ? 'selected' : ''; ?>>Cancel</option>
                                                                    <option value="4" <?php echo ($status == 4) ? 'selected' : ''; ?>>Pending</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="hidden" name="order_id" value="<?php echo $id?>">
                                                                <input type="hidden" name="book_id" value="<?php echo $book_id?>">
                                                                <input type="submit" name="updateOrder" class="btn btn-success" value="Update Order">
                                                            </div>
                                                        </div>


                                                </div>
                                        </form>

                            <?php        }
                                    }
                                }

                                elseif ($do == 'Update') {
                                    if (isset($_POST['updateOrder'])) {
                                        $order_id = $_POST['order_id'];
                                        $book_id = $_POST['book_id'];
                                        $rcv_date = date('Y-m-d',strtotime($_POST['rcv_date']));
                                        $rtn_date = date('Y-m-d',strtotime($_POST['rtn_date']));
                                        $status = $_POST['status'];
                                        $sql = "update booking_list set rcv_date='$rcv_date',rtn_date='$rtn_date',status='$status' 
                                    where id='$order_id'";
                                        $updateRes = mysqli_query($db, $sql);
                                        $quantity=0;
                                        if ($status == 1) {


                                            //Update number of books after status change
                                            $sql2 = "select * from books where id='$book_id'";
                                            $updateRes2 = mysqli_query($db, $sql2);
                                            while ($r = mysqli_fetch_assoc($updateRes2)) {
                                                $quantity = $r['quantity'];
                                                $quantity--;
                                            }
                                            $bookQuanSql = "update books set quantity='$quantity' where id='$book_id'";
                                            $bookQuanUpdate = mysqli_query($db, $bookQuanSql);

                                            if ($bookQuanUpdate)
                                                header("Location: order-details.php?do=Manage");
                                            else
                                                die("MySQLi Error" . mysqli_error($db));

                                        } elseif ($status==2){
//                                            $sql = "update booking_list set rcv_date='$rcv_date',rtn_date='$rtn_date',status='$status'
//                                    where id='$order_id'";
//                                            $updateRes = mysqli_query($db, $sql);

                                            //Update number of books after status change
                                            $sql2 = "select * from books where id='$book_id'";
                                            $updateRes2 = mysqli_query($db, $sql2);
                                            while ($r = mysqli_fetch_assoc($updateRes2)) {
                                                $quantity = $r['quantity'];
                                                $quantity++;
                                            }
                                            $bookQuanSql = "update books set quantity='$quantity' where id='$book_id'";
                                            $bookQuanUpdate = mysqli_query($db, $bookQuanSql);

                                            if ($bookQuanUpdate)
                                                header("Location: order-details.php?do=Manage");
                                            else
                                                die("MySQLi Error" . mysqli_error($db));
                                        }
                                    }
                                }
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Content Wrapper Ends -->

<?php include "inc/footer.php"; ?>
