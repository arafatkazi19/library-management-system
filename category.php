<?php include "inc/header.php"?>
    <section class="all-books">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <?php
                        if (isset($_GET['catid'])){
                            $catid = $_GET['catid'];
                            $sql = "select * from books where cat_id='$catid'";
                            $res = mysqli_query($db,$sql);
                            $countBooks = mysqli_num_rows($res);

                            if ($countBooks<=0){ ?>
                                <div class="alert alert-primary">No Books Found!!!</div>
                          <?php  } else {
                            while($row = mysqli_fetch_assoc($res)){
                                $id = $row['id'];
                                $title = $row['title'];
                                $sub_title = $row['sub_title'];
                                $description = $row['description'];
                                $cat_id = $row['cat_id'];
                                $author_name = $row['author_name'];
                                $quantity = $row['quantity'];
                                $image = $row['image'];
                                $status = $row['status'];

                            } ?>
                            <div class="col-lg-4 book-item mt-3">
                                <div class="book-thumbnail">
                                    <?php
                                    if (!empty($image)) { ?>
                                        <img src="admin/dist/img/books/<?php echo $image;?>" class="img-fluid img-size">
                                    <?php    } else { ?>
                                        <img src="admin/dist/img/books/default_book.jpg" class="img-fluid img-size">
                                    <?php   }
                                    ?>

                                    <div class="author-info">
                                        <h4><?php echo $author_name; ?></h4>
                                    </div>
                                </div>
                                <div class="book-info">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="sub-title"><?php echo $sub_title; ?></p>
                                    <p class="quantity"><span>Quantity: <?php echo $quantity;?> PCs</span></p>

                                    <p><?php echo substr($description, 0,40) ?>...<a href="details.php?id=<?php echo $id ?>">Read More</a></p>

                                    <?php
                                    if (empty($_SESSION['email'])) { ?>
                                        <a href="login.php" class="book-now-btn">Login to Book</a>
                                    <?php } else{ ?>
                                        <a href="booking.php?book_id=<?php echo $id ?>" class="book-now-btn">Book Now</a>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                        <?php }
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