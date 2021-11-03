<?php include "inc/header.php"?>

<!-- book details section starts-->
<section class="all-books">
    <div class="container">
        <div class="row">
            <!--    Show book details    -->
            <div class="col-lg-4">

                <?php
                    if (isset($_GET['id'])){
                        $bid = $_GET['id'];
                        $sql = "select * from books where id='$bid'";
                        $details = mysqli_query($db, $sql);
                        while ($row = mysqli_fetch_assoc($details)){
                            $id = $row['id'];
                            $title = $row['title'];
                            $sub_title = $row['sub_title'];
                            $description = $row['description'];
                            $cat_id = $row['cat_id'];
                            $author_name = $row['author_name'];
                            $quantity = $row['quantity'];
                            $image = $row['image'];
                            $status = $row['status']; ?>

                            <div class="book-detail-thumbnail">
                                <?php
                                if (!empty($row['image'])) { ?>
                                    <img src="admin/dist/img/books/<?php echo $row['image']?>" class="img-fluid">
                                <?php    } else { ?>
                                    <img src="admin/dist/img/books/default_book.jpg" class="img-fluid">
                                <?php   }
                                ?>

                            </div>

                    <?php    }
                    }
                ?>

            </div>
            <div class="col-lg-5 book-details">
                <h4 style="color: red"><?php echo $title; ?></h4>
                <p class="sub-title" style="color: darkgreen"><?php echo $sub_title; ?></p>
                <h6>Written By - <?php echo $author_name; ?></h6>

                <p><?php echo $description ?></p>

                <?php
                if (empty($_SESSION['email'])) { ?>
                <a href="login.php" class="book-now-btn">Login to Book</a>
               <?php } else{ ?>
                  <a href="booking.php?book_id=<?php echo $id ?>" class="book-now-btn">Book Now</a>
               <?php }
                ?>

            </div>
            <!--    Show book details ends    -->

            <!--Side bar starts-->
            <?php include "inc/sidebar.php"?>
            <!--Side bar ends-->
        </div>
    </div>
</section>
<!-- book details section ends-->
<?php include "inc/footer.php"?>
