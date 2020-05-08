<?php
session_start();
$userName = $_SESSION["username"];
$user = $_SESSION["userStatus"];
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
    <section class="userInfo margin-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" name="myform" onsubmit="return validateform()" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div>
                            <div class="form-group col-md-7">
                                <label>Title</label>
                                <input name="title" type="text" class="form-control" placeholder="Title">
                            </div>
                            <div class="form-group col-md-7">

                                <label>
                                    <h5>description</h5>
                                </label>
                                <textarea class="form-control" name="des" rows="5"></textarea>

                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>


            </div>
        </div>
    </section>

    <script>
        function validateform() {
            var title = document.myform.title.value;
            var des = document.myform.des.value;

            if (title == null || title == "") {
                alert("title can't be blank");
                return false;
            } else if (des == null || des == "") {
                alert("desciption can't be blank");
                return false;
            }
        }
    </script>


    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = new mysqli("localhost", "root", "", "connectcouncillor");
        $title = $_REQUEST["title"];
        $des = $_REQUEST["des"];
        $status = "pending";

        $sql = $conn->query("INSERT INTO `budget`(`budgetTitle`, `description`, `wardNumber`, `status`) VALUES ('$title','$des','$ward','$status')");

        $conn->close();
    }
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>