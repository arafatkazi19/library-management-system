<?php include "inc/header.php"?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-9">


                <?php
                if (!empty($_SESSION['msg'])){?>
                    <div class="alert alert-success">
                        <?php  echo $_SESSION['msg']; ?>
                    </div>
                <?php }
                ?>
                <div  class="card shadow mt-3 p-1 bg-white" style="border-radius: 30px;">
                    <div class="card-body">
                        <table class="table mt-5" style="margin-bottom:80px;">
                            <thead>
                            <tr>
                                <th scope="col">Sl. no</th>
                                <th scope="col">Book Title</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Receive Date</th>
                                <th scope="col">Return Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $user_id = $_SESSION['user_id'];
                            $sql = "select * from booking_list where user_id='$user_id'";
                            $allBooksListed = mysqli_query($db, $sql);
                            $numofbooks = mysqli_num_rows($allBooksListed);

                            if (!empty($user_id)){
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
                                            <td><?php echo $booking_date ?></td>
                                            <td><?php echo $rcv_date ?></td>
                                            <td><?php echo $rtn_date ?></td>
                                            <td>
                                                <?php
                                                if ($status == 1){ ?>
                                                    <span class="badge bg-success">Active Order</span>
                                                <?php } else if($status == 2){ ?>
                                                    <span class="badge bg-info">Returned</span>
                                                <?php } else if($status == 3){ ?>
                                                    <span class="badge bg-danger">Cancelled</span>
                                                <?php   } else if($status == 4){ ?>
                                                    <span class="badge bg-warning">Pending</span>
                                                <?php } ?>
                                            </td>
                                            <?php if ($status!=2 && $status!=1 && $status!=3){ ?>
                                            <td>
                                                <div class="tbl-action">
                                                    <ul>
                                                        <li class="text-center"><a href="user-change-status.php?booking_id=<?php echo $id ?>"><i class="fa fa-edit"></i></a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <?php } ?>
                                        </tr>
                                    <?php }
                                }
                            }else {
                                header("Location: index.php");
                            }

                            ?>



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!--Side bar starts-->
            <?php include "inc/sidebar.php"?>
            <!--Side bar ends-->
        </div>
    </div>
</section>
<?php unset($_SESSION['msg']); ?>
<?php include "inc/footer.php"?>
