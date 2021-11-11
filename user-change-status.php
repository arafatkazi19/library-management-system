<?php include "inc/header.php"?>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <h3 class="text-primary">Change Status</h3>
                    <form action="" method="post">
                        <div  class="card shadow p-2 mb-1 bg-white" style="border-radius: 30px;">
                            <div class="card-body">
                                <?php
                                    if (isset($_GET['booking_id'])){
                                        $booking_id = $_GET['booking_id'];
                                        $sql = "select * from booking_list where id='$booking_id'";
                                        $dataStatus = mysqli_query($db, $sql);
                                        $r = mysqli_fetch_assoc($dataStatus);
                                        $status = $r['status'];
                                    }
                                ?>
                                <select class="form-select" name="status" aria-label="Default select example">
                                    <option>Select from dropdown</option>
                                    <option value="3">Cancel</option>
                                </select>

                                <div class="mt-3">
                                    <button name="changeStatus" type="submit" class="btn btn-warning text-white">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                        if (isset($_POST['changeStatus'])){

                                $status = $_POST['status'];
                                $sql = "update booking_list set status='$status' where id='$booking_id'";
                                $cngStatus = mysqli_query($db, $sql);

                            if ($cngStatus)
                                header("Location: order-history.php");
                            else
                                die("MySQLi Error" . mysqli_error($db));
                        }
                    ?>
                </div>
                <!--Side bar starts-->
                <?php include "inc/sidebar.php"?>
                <!--Side bar ends-->
            </div>
        </div>
    </section>

<?php include "inc/footer.php"?>