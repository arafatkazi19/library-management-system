<?php include "inc/header.php"?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-md-3">
                <h2 class="text-primary mt-3">Member Login</h2>
                <form action="" method="post">
                    <div  class="card shadow p-2 mb-1 bg-white" style="border-radius: 30px;">
                        <div class="card-body">
                    <div class="form-group">
                        <label for="email">Email address:</label>
                        <input name="email" type="email" placeholder="Your Email..." class="form-control" required="required" autocomplete="off">
                    </div>
                    <div class="form-group mt-2">
                        <label for="password">Password:</label>
                        <input name="password" type="password" placeholder="Your Password..." class="form-control" required="required">
                    </div>
                    <div class="row">
                    <button name="login" type="submit" class="btn btn-large btn-success mt-3">Login</button>
                    </div>
                        </div>
                    </div>
                </form>

                <div class="login-option">
                    <ul>
                        <li>Not a member? <a href="register.php">Register Here</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include "inc/footer.php"?>