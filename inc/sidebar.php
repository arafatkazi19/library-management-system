
<div class="col-lg-3 mt-2">
    <div class="search-option">
        <form method="post" action="search.php">
            <div class="mb-3">
                <label>Search by Book Name, Author</label>
                <input type="text" name="search" class="form-control" placeholder="Search Here..." required="required" autocomplete="off">
            </div>

            <div class="mb-3">
                <input type="submit" value="Search" name="searchBtn" class="btn btn-primary">
            </div>

        </form>

    </div>
    <hr>
    <div>
        <h4 class="text-primary">Popular Books</h4>
        <?php
        $sql = "select books.*, sum(booking_list.book_id) as total from books inner join booking_list
                 on books.id = booking_list.book_id group by booking_list.book_id order by total desc limit 3";
        $books = mysqli_query($db, $sql);
        while ($row=mysqli_fetch_assoc($books)){

            ?>
            <div class="card">
                <div class="card-body">
                        <?php if (!empty($row['image'])) { ?>
                            <a href="details.php?id=<?php echo $row['id'] ?>"><img src="admin/dist/img/books/<?php echo $row['image']?>" width="100px"></a>

                        <?php    } else { ?>
                            <a href="details.php?id=<?php echo $row['id'] ?>"><img src="admin/dist/img/books/default_book.jpg" width="80px"></a>
                        <?php   }?>
                    <h4><a href="details.php?id=<?php echo $row['id'] ?>"><?php echo $row['title']; ?></a></h4>
                        <p style="margin: 0;padding: 0"><?php echo $row['sub_title']; ?></p>
                </div>
            </div>
        <?php   }


        ?>
    </div>
</div>