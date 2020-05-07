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
                    $conn = new mysqli("localhost", "root", "", "connectcouncillor");

                    $query = "SELECT * FROM `complain` WHERE `userWardNumber` = '$ward'";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $title = $row['title'];
                            $complain = $row['postedComplain'];
                            $id = $row['complainId'];
                            $status = $row['complainStatus'];
                            if ($status == 0) {
                                $stat = "false";
                            } else {
                                $stat = "true";
                            }
                            echo "<h6>Title:  $title </h6>";
                            echo "<h6>ID:  $id </h6>";
                            echo "<h6>Status:  $stat </h6>";
                            echo "<br>";
                        }
                    }
                    ?>
                </div>


                <div class="col-md-12">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="form-group">
                            <input type="text" name="post_id" id="post_id" class="form-control" placeholder="post ID" />
                        </div>

                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary">Load Comment</button>
                    </form>
                </div>

                <?php getComment() ?>

                <div class="col-md-6">
                    <?php
                    function getComment()
                    {

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {

                            $postID = $_REQUEST["post_id"];

                            $_SESSION["postI"] = $postID;
                            
                            $conn = new mysqli("localhost", "root", "", "connectcouncillor");
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            $sql = "SELECT * FROM `comment` WHERE `postID`='$postID'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $name = $row['comment_sender_name'];
                                    $date = $row['date'];
                                    $comment = $row['comment'];

                                    echo '
          <div class="panel panel-default">
           <div class="panel-heading">By <b>' . $row["comment_sender_name"] . '</b> on <i>' . $row["date"] . '</i></div>
           <div class="panel-body">' . $row["comment"] . '</div>
          </div>';

                                    echo "<br>";
                                }
                            } else {
                                $error = "Username or Password is invalid";
                            }
                            $conn->close();
                        }
                    }
                    ?>
                </div>


                <div class="col-md-12">

                    <?php
                    $conn = new mysqli("localhost", "root", "", "connectcouncillor");

                    $query = "SELECT * FROM `userinfo` WHERE `username` = '$userName'";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            
                            $_SESSION["uname"] = $row['name'];
                            
                        }
                    }
                    ?>


                    <form method="post" action="addcomment.php">

                        <div class="form-group">
                            <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Enter Comment" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="comment_id" id="comment_id" value="0" />
                            <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
                        </div>
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