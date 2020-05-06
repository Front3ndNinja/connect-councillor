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

    <!--        user complain -->

    <section class="userInfo margin-top">
        <div class="container">
            <div class="row">
                <div class="col-md-7 offset-2">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-7">
                                    <label for="inputEmail4">Name</label>
                                    <input type="Name" class="form-control" placeholder="Name" name="name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputVoterID">Blood Group</label>
                                    <input type="text" class="form-control" placeholder="Blood Group" name="blood">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputVoterID">Age</label>
                                    <input type="text" class="form-control" placeholder="Age" name="age">
                                </div>
                                <div class="form-group col-md-7">
                                    <label for="inputVoterID">Voter ID</label>
                                    <input type="text" class="form-control" placeholder="Voter ID" name="vid">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Username</label>
                                    <input type="text" class="form-control" placeholder="username" name="uname">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Password</label>
                                    <input type="password" class="form-control" placeholder="Password" name="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Address</label>
                                <input type="text" class="form-control" placeholder="1234 Main St" name="address">
                            </div>
                            <div class="form-row">

                                <div class="form-group col-md-4">
                                    <label for="inputState">City</label>
                                    <select class="form-control" name="city">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputZip">Ward Number</label>
                                    <input type="text" class="form-control" name="wardnumber">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Select Image File:</label>
                                <input type="file" name="image"> </div>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--          code to upload image  -->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = new mysqli("localhost", "root", "", "connectcouncillor");

        echo "connected";

        // If file upload form is submitted
        $name = $_REQUEST["name"];
        $bloodgroup = $_REQUEST["blood"];
        $age = $_REQUEST["age"];
        $voterID = $_REQUEST["vid"];
        $uname = $_REQUEST["uname"];
        $password = $_REQUEST["password"];
        $address = $_REQUEST["address"];
        $city = $_REQUEST["city"];
        $ward = $_REQUEST["wardnumber"];


        if (isset($_REQUEST["submit"])) {
            $status = 'error';
            if (!empty($_FILES["image"]["name"])) {
                // Get file info
                $fileName = basename($_FILES["image"]["name"]);
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

                // Allow certain file formats
                $allowTypes = array(
                    'jpg',
                    'png',
                    'jpeg',
                    'gif'
                );
                if (in_array($fileType, $allowTypes)) {
                    $image = $_FILES['image']['tmp_name'];
                    $imgContent = addslashes(file_get_contents($image));

                    // Insert image content into database

                    $insert = $conn->query("INSERT into userinfo (`name`,`userName`, `age`, `bloodgroup`, `address`,`ward`,`userImage`,`voterid`) VALUES ('$name','$uname','$age','$bloodgroup', '$address','$ward','$imgContent','$voterID')");

                    $insert = $conn->query("INSERT INTO `login`(`username`, `password`) VALUES ('$uname','$password')");
                    
                    

                    if ($insert) {
                        $status = 'success';
                        $statusMsg = "user created successfully.";
                        
                    
                    } else {
                        $statusMsg = "user creation failed, please try again.";
                    }
                } else {
                    $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
                }
            } else {
                $statusMsg = 'Please select an image file to upload.';
            }
        }

        // Display status message
        echo $statusMsg;
    }
    ?>
    <!--        user statstic section-->
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