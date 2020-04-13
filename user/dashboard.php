<?php
session_start();

if (empty($_SESSION["username"]))
{
    header("Location: login.php"); // Redirecting To Home Page
    
}


else
{
//for displaying user info
    $conn = new mysqli("localhost", "root", "", "connectcouncillor");
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM userinfo WHERE username='test'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc())
        {
            $testName = $row["userName"];
            $wardNumber = $row["ward"];
            $totalComplain = $row["numPostedComplain"];
            $userImage = $row["userImage"];
        }

    }
    else
    {
        $error = "Username or Password is invalid";
    }
    $conn->close();
}

?>


    <!DOCTYPE html>
    <html lang="en">
    <header>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> </header>
    <link rel="stylesheet" href="../css/main.css">

    <body>
        <!--       navigation menu -->
        <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
            <a class="navbar-brand" href="#"><img src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="test.html">Complain</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Post Issue</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Budget</a>
                    </li>

                </ul>
                <a href="../logout.php">
                    <button class="btn btn-danger my-2 my-sm-0" type="submit">Logout</button>
                </a>
            </div>
        </nav>
        <!--        user homepage -->
        <section class="userInfo margin-top">
            <div class="container">
                <div class="row">

                    <div class="col-md-3">
                        <img class="card-img-top" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($userImage); ?>" /> 
                    </div>
                    
                    
                    
                    <div class="col-md-5">
                        <h1><?php echo $testName; ?></h1>
                        <span><?php echo $wardNumber; ?></span>
                    </div>


                    <!--
                    <div class="col-md-6 offset-4">
                        <div class="card" style="width: 12rem;">
                            <img class="card-img-top" src="https://images.pexels.com/photos/45201/kitty-cat-kitten-pet-45201.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $testName; ?></h5>
                                
                                <h6 class="card-title"><?php echo $wardNumber; ?></h6>
                            </div>
                        </div>
                    </div>
-->
                </div>
            </div>
        </section>
        <!--        user statstic section-->
        <section class="stat margin-top">
            <div class="container">
                <div class="row text-center">
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Complain</h5>
                                <p class="card-text"><?php echo $totalComplain; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">

                                <h5 class="card-title">Got Solved</h5>
                                <p class="card-text">55</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">

                                <h5 class="card-title">Remaining Problem</h5>
                                <p class="card-text">5555</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>

    </html>
