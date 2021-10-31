<?php include "inc/header.php"?>


<!--Search books section starts-->
<section class="all-books">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <h2>Search Results</h2>
                <div class="row">
             <?php
                if ($_POST['searchBtn']){
                    $searchValue = $_POST['search'];

                    $sql = "select * from books where title like '%$searchValue%' or author_name like '%$searchValue%'
                             order by title asc";

                    $searchRes = mysqli_query($db, $sql);
                    $searchCount = mysqli_num_rows($searchRes);

                    if ($searchCount == 0){ ?>
                        <div class="alert alert-danger">
                            Sorry!! No books found on keyword <b>'<?php echo $searchValue ?>'</b>
                        </div>
                  <?php  } else {
                     while ($row = mysqli_fetch_assoc($searchRes)){
                         $id = $row['id'];
                         $title = $row['title'];
                         $sub_title = $row['sub_title'];
                         $description = $row['description'];
                         $cat_id = $row['cat_id'];
                         $author_name = $row['author_name'];
                         $quantity = $row['quantity'];
                         $image = $row['image'];
                         $status = $row['status'];
                      ?>
                        <div class="col-lg-4 book-item mt-3">
                            <div class="book-thumbnail">
                                <?php
                                if (!empty($row['image'])) { ?>
                                    <img src="admin/dist/img/books/<?php echo $image?>" class="img-fluid img-size">
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

                                <a href="" class="book-now-btn">Book Now</a>
                            </div>
                        </div>
              <?php      }
                   }
                }
             ?>
            </div>
            </div>
            <!--Side bar starts-->
            <?php include "inc/sidebar.php"?>
            <!--Side bar ends-->
        </div>
    </div>
</section>
<!--Search books section ends-->

<?php include "inc/footer.php"?>