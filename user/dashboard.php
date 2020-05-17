<?php
session_start();
$userName = $_SESSION["username"];
$user = $_SESSION["userStatus"];

if (empty($_SESSION["username"])) {
    header("Location: ../index.php"); // Redirecting To Home Page
} 
?>

<!DOCTYPE html>
<html lang="en">
<header>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</header>
<link rel="stylesheet" href="../css/main.css">

<body>
    <!--       navigation menu -->
    <?php include('userNav.html') ?>
    <!--        user homepage -->
    <section class="userInfo margin-top">
        <div class="container">
            <div class="row">

                <?php 
                $conn = new mysqli("localhost", "root", "", "connectcouncillor");
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT * FROM userinfo WHERE username='$userName'";
                $result = $conn->query($sql);
            
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $user = $row["name"];
                        $userName = $row["userName"];
                        $userAge = $row["age"];
                        $userBloodGroup = $row["bloodGroup"];
                        $userAddress = $row["address"];
                        $totalComplain = $row["numPostedComplain"];
                        $wardNumber = $row["ward"];
                        $_SESSION["wardNumber"] = $wardNumber;
                        $userImage = $row["userImage"];
                    }
                } else {
                    $error = "Username or Password is invalid";
                }
            
                // problem solved number
            
                $sql2 = "SELECT COUNT(complainStatus) FROM `complain` WHERE userName = '$userName' and complainStatus = 1";
                $result = $conn->query($sql2);
            
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $problemSolved = $row["COUNT(complainStatus)"];
                    }
                } else {
                    $error = "Username or Password is invalid";
                }
            
            
                $conn->close();
            
            ?>
                <div class="col-md-3">
                    <img class="card-img-top"
                        src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($userImage); ?>" />
                </div>

                <div class="col-md-5">
                    <h1>Name: <?php echo $user; ?></h1>
                    <h4>Userame: <?php echo $userName; ?></h4>
                    <h1>Age: <?php echo $userAge; ?></h1>
                    <h1>Blood Group: <?php echo $userBloodGroup; ?></h1>
                    <h1>Address: <?php echo $userAddress; ?></h1>
                    <span>Ward Number: <?php echo $wardNumber; ?></span>
                </div>

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
                            <p class="card-text"><?php echo $problemSolved; ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Remaining Problem</h5>
                            <p class="card-text"><?php echo $totalComplain - $problemSolved; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>