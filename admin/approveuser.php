<?php
session_start();

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

    <!-- display budget information -->
    <section class="margin-top">
        <div class="container">
            <div class="row">


                <div class="col-md-12">

                    <?php
                    getdata();
                    ?>

                </div>

                <div class="col-md-12">
                    <form method="post" name="myform" onsubmit="return validateform()" action="approve.php">


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCity">UserName</label>
                                <input type="text" class="form-control" name="bid">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">Status</label>
                                <select name="inputState" class="form-control">
                                    <option>approved</option>
                                    <option>rejected</option>
                                </select>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>



                </div>
            </div>
        </div>
    </section>

    <?php

    function getdata()
    {
        $conn = new mysqli("localhost", "root", "", "connectcouncillor");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM `login` WHERE  `userAccountState` = '0'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $userName = $row['username'];
                echo $userName;

                $sql2 = "SELECT * FROM userinfo WHERE username='$userName'";
                $result2 = $conn->query($sql2);

                if ($result2->num_rows > 0) {
                    echo "ok";
                    while ($row = $result2->fetch_assoc()) {
                        $name = $row["name"];
                        $uname = $row["userName"];
                        $user= $row["voterid"];
                        $userAddress = $row["address"];
                        $ward = $row["ward"];

                        echo "<h3>Name:  $name </h3>";
                        echo "<h3>Username:  $uname </h3>";
                        echo "<h4>Voter ID Number:  $user </h4>";
                        echo "<h4>Address:  $userAddress </h4>";
                        echo "<h4>Ward:  $ward </h4>";

                        echo "<br> <br>";
                    }
                }
            }
        } else {
            $error = "Username or Password is invalid";
        }
        $conn->close();
    }

    ?>

    <script>
    function validateform() {
        var title = document.myform.bid.value;
        var status = document.myform.inputState.value;

        if (title == null || title == "") {
            alert("id can't be blank");
            return false;
        }
    }
    </script>


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