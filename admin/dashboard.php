<?php
session_start();
$userName = $_SESSION["username"];
$user = $_SESSION["userStatus"];

if (empty($_SESSION["username"])) {
    header("Location: ../index.php"); // Redirecting To Home Page
} else {

    $conn = new mysqli("localhost", "root", "", "connectcouncillor");
    
    //total problem 
    
    $sql3 = "SELECT COUNT(userWardNumber) FROM `complain`";
    $result3 = $conn->query($sql3);

    if ($result3->num_rows > 0) {
        while ($row = $result3->fetch_assoc()) {
            $totalComplain = $row["COUNT(userWardNumber)"];
        }
    } else {
        $error = "Something is wrong";
    }


    // problem solved number

    $sql2 = "SELECT COUNT(complainStatus) FROM `complain` WHERE complainStatus = 1";
    $result = $conn->query($sql2);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $problemSolved = $row["COUNT(complainStatus)"];
        }
    } else {
        $error = "Something is wrong";
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</header>
<link rel="stylesheet" href="../css/main.css">

<body>
    <!--       navigation menu -->
    <?php include('userNav.html') ?>
    <!--        user homepage -->

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

                            <h5 class="card-title">Solved</h5>
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