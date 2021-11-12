<?php
session_start();
ob_start();
include "admin/inc/db.php";
//if (empty($_SESSION['user_id']) || empty($_SESSION['email']) || empty($_SESSION['role'])!=1){
//    header("Location: index.php");
//}

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

    <!-- JQuery UI   -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

    <!-- Font Awesome   -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                        <a class="navbar-brand" href="index.php">Online <span>Library</span></a>
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
                                                <a class="nav-link" href="category.php?category=<?php echo $pCatName; ?>&catid=<?php echo $pCatId ?>"><?php echo $pCatName; ?></a>
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
                                                            <li><a class="dropdown-item" href="sub-category.php?category=<?php echo $sCatName; ?>&subcatid=<?php echo $sCatId; ?>"><?php echo $sCatName; ?></a></li>
                                                     <?php   }
                                                    ?>
                                                </ul>
                                            </li>
                                     <?php   }

                                    }

                                if (empty($_SESSION['user_id']) || empty($_SESSION['email'])){ ?>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="login.php">Signin</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="register.php">Signup</a>
                                </li>
                     <?php          } else { ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <?php
                                            $user_id = $_SESSION['user_id'];
                                            $sql = "select * from user where user_id='$user_id'";
                                            $userData = mysqli_query($db, $sql);
                                            while ($row = mysqli_fetch_assoc($userData)){
                                                $fullname = $row['fullname'];
                                                $image = $row['image'];

                                            if(!empty($image)){ ?>
                                            <img src="admin/dist/img/users/<?php echo $image ?>" class="nav-user-img" alt="User Image">
                                            <?php  } else { ?>
                                            <img src="admin/dist/img/avatar5.png" class="nav-user-img" alt="User Image" alt="User Image">
                                            <?php   } ?>
                                            <strong><?php echo $row['fullname'] ?></strong>
                                          <?php  }
                                            ?>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <li><a class="dropdown-item" href="order-history.php">Booking Item List</a></li>
                                            <li><a class="dropdown-item" href="manage.php?uid=<?php echo $user_id ?>">Manage Profile</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                        </ul>
                                    </li>

                      <?php } ?>

                            </ul>
                        </div>

                    </div>
                </nav>
                <!--Navbar Ends-->
            </div>
        </div>
    </div>
</header>


