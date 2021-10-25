<?php
ob_start();
include "admin/inc/db.php";

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Library Management System</title>

    <!-- Bootstrap CDN CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="inc/assets/css/style.css">

</head>
<body>
<!--Header Starts-->

<header>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!--Navbar Starts-->
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">Online <span>Library</span></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                                </li>

                                <?php
                                //Parent Category Menu
                                    $sql = "select category_id, category_name from category
                                            where is_parent=0 and status = 1";
                                    $parentMenu = mysqli_query($db,$sql);
                                    while ($row = mysqli_fetch_assoc($parentMenu)){
                                        $pCatId = $row['category_id'];
                                        $pCatName = $row['category_name'];

                                        $sql2 = "select category_id, category_name from category
                                            where is_parent='$pCatId' and status = 1";
                                        $subMenu = mysqli_query($db,$sql2);
                                        $countSubMenu = mysqli_num_rows($subMenu);
                                        if ($countSubMenu == 0){ ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="category.php?category=<?php echo $pCatName; ?>"><?php echo $pCatName; ?></a>
                                            </li>
                                   <?php     } else { ?>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="category.php?category=<?php echo $pCatName; ?>" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <?php echo $pCatName; ?>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <?php
                                                        while ($row2 = mysqli_fetch_assoc($subMenu)){
                                                            $sCatId = $row2['category_id'];
                                                            $sCatName = $row2['category_name']; ?>
                                                            <li><a class="dropdown-item" href="category.php?category=<?php echo $sCatName; ?>"><?php echo $sCatName; ?></a></li>
                                                     <?php   }
                                                    ?>
                                                </ul>
                                            </li>
                                     <?php   }

                                    }
                                ?>



                            </ul>
                        </div>

                    </div>
                </nav>
                <!--Navbar Ends-->
            </div>
        </div>
    </div>
</header>

<!--All books section starts-->
<div class="container">
    <div class="row">
         <!--    Show books    -->
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-4">
                    <h1>Hello World</h1>
                </div>
            </div>
        </div>
        <!--    Show books end    -->

        <!--  Sidebar Starts  -->
        <div class="col-lg-3">

        </div>
        <!--   Sidebar ends   -->
    </div>
</div>
<!--All books section ends-->
