<?php
include('loginValidation.php');

if (isset($_SESSION['username'])) {
    $userStatus = $_SESSION['userStatus'];
    if($userStatus == "user"){
        header("location: user/dashboard.php");
    }
    else if($userStatus == "councilor"){
        header("location: councilor/dashboard.php");
    }
    else if ($userStatus == "admin"){
        header("location: admin/dashboard.php");
    }
    else{
        echo "something went wrong";
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Copatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- main css -->
    <link rel="stylesheet" type="text/css" href="css/login-main.css">
    
    <!-- the file font awesome for icon -->
    <link rel="stylesheet" type="text/css" href="css/font-awsome-all.css">
</head>

<body>
    <section class="login_form">
        <div class="container">
            <div class="row">
                <div class="offset-md-4 col-md-4">
                    <div class="login-box">
                        <div class="log_head text-center">
                            <h2>Login</h2>
                        </div>
                        <div class="textbox">
                            <form action="" method="post">
                                <div class="form-group textbox_bord">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <label for="exampleInputEmail">Username</label>
                                    <input type="text" class="form-control" name="username" placeholder="Enter username"> 
                                </div>
                                <div class="form-group textbox_bord">
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                    <label for="exampleInputPassword">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password"> 
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </form>
                            <br>
                            <?php echo $error; ?>
                        </div>
                        <div class="log_create">
                            <span>
                                <a href="create.php">Create Account</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>