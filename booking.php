<?php include "inc/header.php"?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-9">

                <?php
                if (isset($_GET['book_id'])){
                    $book_id = $_GET['book_id'];
                    $sql = "select * from books where id='$book_id'";
                    $book = mysqli_query($db, $sql);
                    while ($row = mysqli_fetch_assoc($book)){
                        $id = $row['id'];
                        $title= $row['title'];
                        $quantity= $row['quantity'];
                    }

                    if ($quantity<=0) {
                        echo '<br><div class="text-center"><span class="alert alert-info text-center">This book is not available right now!! Please Try again later!!</span></div>';
                    } else { ?>

                        <?php
                        $user_id = $_SESSION['user_id'];
                        $sql = "select * from user where user_id='$user_id'";
                        $userData = mysqli_query($db, $sql);
                        while ($row = mysqli_fetch_assoc($userData)) {
                            $fullname = $row['fullname'];
                            $address = $row['address'];
                            $phone = $row['phone']; ?>
                            <h2 class="text-primary text-center mt-3">Please fill out the form for booking</h2>
                            <div  class="card shadow p-2 mb-2 bg-white" style="border-radius: 30px;">
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">Fullname</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Phone</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><?php echo $fullname?></td>
                                            <td><?php echo $_SESSION['email']?></td>
                                            <td><?php echo $address?></td>
                                            <td><?php echo $phone?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <form method="post" class="justify-content-center align-items-center pt-3 ml-5">
                                        <div class="row">
                                            <div class="col-lg-6 offset-lg-3">
                                                <div class="form-group">
                                                    <label>Receive Date</label>
                                                    <input id="rcv_datepicker" required="required" name="rcv_date" type="text" class="form-control mb-3" placeholder="Please input the Receive Date">
                                                </div>

                                                <div class="form-group">
                                                    <label>Return Date</label>
                                                    <input id="rtn_datepicker" required="required" name="rtn_date" type="text" class="form-control mb-3" placeholder="Please input the Return Date">
                                                </div>

                                                <div class="row">
                                                    <input type="hidden" name="book_id" value="<?php echo $book_id;?>">
                                                    <button name="proceed" type="submit" class="btn btn-dark">Click to Proceed</button>
                                                </div>

                                            </div>
                                        </div>
                                </div>
                            </div>
                            </form>
                        <?php
                            if (isset($_POST['proceed'])){
                                $book_id = $_POST['book_id'];
                                $user_id = $_SESSION['user_id'];
                                $rcv_date = date('Y-m-d',strtotime($_POST['rcv_date']));
                                $rtn_date = date('Y-m-d',strtotime($_POST['rtn_date']));

                                if (!empty($rcv_date) && !empty($rtn_date)){
                                    $sql = "insert into booking_list(user_id,book_id,rcv_date,rtn_date,booking_date)
                                            VALUES('$user_id','$book_id','$rcv_date','$rtn_date',now())";
                                    $bookingData = mysqli_query($db, $sql);

                                    if ($bookingData){
                                        $_SESSION['msg'] = 'Your booking is pending for Admin approval. Please contact with the admin for your book physically. Thankyou!!';
                                        header("Location: order-history.php");
                                    } else{
                                        die("MySQLi Error". mysqli_error($db));
                                    }
                                }


                            }
                        }
                    }

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
