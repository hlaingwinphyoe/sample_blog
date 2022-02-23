<?php
    include "core/base.php";
    include "core/functions.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="<?php echo $url; ?>/assets/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $url; ?>/assets/vendor/feather-icons-web/feather.css">
</head>
<body style="background: var(--primary-soft)">

<div class="container">
    <div class="row min-vh-100 justify-content-center align-items-center">
        <div class="col-12 col-lg-7">
            <div class="">
                <img src="<?php echo $url; ?>/assets/img/login.svg" class="img-fluid" alt="">
            </div>
        </div>
        <div class="col-12 col-lg-5">
            <div class="">
                <div class="card border-0">
                    <div class="card-body">
                        <h4 class="font-weight-bolder mb-4 text-center text-primary">
                            <i class="text-primary feather-users mr-2"></i>
                            User Register
                        </h4>
                        <?php
                        if (isset($_POST['reg-btn'])){
                            echo register();
                        }
                        ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="name">
                                    <i class="text-primary feather-user"></i>
                                    Your Name
                                </label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="name">
                                    <i class="text-primary feather-mail"></i>
                                    Email
                                </label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="name">
                                    <i class="text-primary feather-lock"></i>
                                    Password
                                </label>
                                <input type="password" name="password" min="8" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="name">
                                    <i class="text-primary feather-lock"></i>
                                    Confirm Password
                                </label>
                                <input type="password" name="cpassword" min="8" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" name="reg-btn"><i class="feather-log-in mr-2"></i>Register</button>
                                <a href="login.php" class="btn btn-link">Already have registered? Sign In</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo $url; ?>/assets/vendor/jquery.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="<?php echo $url; ?>/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $url; ?>/assets/js/app.js"></script>
</body>
</html>
