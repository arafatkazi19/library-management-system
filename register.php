<?php include "inc/header.php"?>

<section class="vh-100">
    <div class="container h-100">
        <div class="row">
            <h3 class="mt-2 text-primary">Member Registration</h3>
            <div class="col-lg-9">
                <form method="post" class="justify-content-center align-items-center pt-3 ml-5">
                <div  class="card shadow p-2 mb-2 bg-white" style="border-radius: 30px;">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="form-group">
                                <label>Full name</label>
                                <input type="text" class="form-control mb-3" placeholder="Your Full Name">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="form-group">
                                <label>Email</label>
                                <input name="email" type="email" class="form-control mb-3" placeholder="Your Email">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="form-group">
                                <label>Password</label>
                                <input name="password" type="password" class="form-control mb-3" placeholder="Your Password">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="form-group">
                                <label>Re-type Password</label>
                                <input name="password" type="password" class="form-control mb-3" placeholder="Re-type Password">
                            </div>
                        </div>
                        <div class="row">
                            <button name="register" type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </div>
                </div>
                </form>

                <div class="login-option">
                    <ul>
                        <li>Already a member? <a href="login.php">Login Here</a></li>
                    </ul>
                </div>
            </div>
            <!--Side bar starts-->
            <?php include "inc/sidebar.php"?>
            <!--Side bar ends-->
        </div>
    </div>
</section>

<?php include "inc/footer.php"?>
