<?php
session_start();
$userName = $_SESSION["username"];
$ward = $_SESSION["wardNumber"];
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</header>
<link rel="stylesheet" href="../css/main.css">

<body>
    <!--       navigation menu -->
    <?php include('userNav.html') ?>
    <!--        user homepage -->
    <section>
        <div class="container">
            <div class="row">

                <div class="col-md-6 offset-3">
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $conn = new mysqli("localhost", "root", "", "connectcouncillor");

                        $f = $_REQUEST["category"];

                        $query = "SELECT * FROM `complain` WHERE `userWardNumber` = '$ward' and `category` = '$f' ";
                        // echo $query;
                        $result = $conn->query($query);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $title = $row['title'];
                                $complain = $row['postedComplain'];
                                $id = $row['complainId'];
                                $userImage = $row['complainImage'];
                                $status = $row['complainStatus'];
                                if ($status == 0) {
                                    $stat = "pending";
                                } else {
                                    $stat = "solved";
                                }
                                echo "<a href='details.php?id=$id'>$title</a>";
                                echo "<h6>Status:  $stat </h6>";
                                echo "<br>";
                            }
                        }
                    }
                    else{
                        $conn = new mysqli("localhost", "root", "", "connectcouncillor");

                        $query = "SELECT * FROM `complain` WHERE `userWardNumber` = '$ward'";
                        // echo $query;
                        $result = $conn->query($query);

                        if ($result->num_rows > 0) {
                            echo "<h1>all problem</h1>";
                            echo "<br>";
                            while ($row = $result->fetch_assoc()) {
                                $title = $row['title'];
                                $complain = $row['postedComplain'];
                                $id = $row['complainId'];
                                $userImage = $row['complainImage'];
                                $status = $row['complainStatus'];
                                if ($status == 0) {
                                    $stat = "pending";
                                } else {
                                    $stat = "solved";
                                }
                                echo "<a href='details.php?id=$id'>$title</a>";
                                echo "<h6>Status:  $stat </h6>";
                                echo "<br>";
                            }
                        }
                    }
                    ?>

                </div>

                <div class="col-md-6 offset-3">
                    <form method="post" name="complain" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">
                                <h5>Filter By Category</h5>
                            </label>
                            <select class="form-control" name="category" id="exampleFormControlSelect1">
                                <option>water problem</option>
                                <option>road problem</option>
                                <option>Suggestion</option>
                                <option>Need Goverment Paper</option>
                                <option>Other issue</option>
                            </select>
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>