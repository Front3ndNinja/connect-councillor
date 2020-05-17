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
    <!--        user complain -->

    <section class="userInfo margin-top">
        <div class="container">
            <div class="row">
                <div class="col-md-7 offset-2">
                    <form method="post" name="create" onsubmit="return validateform()" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-7">
                                    <label for="inputEmail4">Name</label>
                                    <input type="Name" class="form-control" onkeypress="return isChar(event)" placeholder="Name" name="name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputVoterID">Blood Group</label>
                                    <input type="text" class="form-control" placeholder="Blood Group" name="blood">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputVoterID">Age</label>
                                    <input type="text" class="form-control" onkeypress="return isNumber(event)" placeholder="Age" name="age">
                                </div>
                                <div class="form-group col-md-7">
                                    <label for="inputVoterID">Voter ID</label>
                                    <input type="text" class="form-control" onkeypress="return isNumber(event)" placeholder="Voter ID" name="vid">
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
                                        <option selected>Dhaka</option>
                                        <option>Chittagong</option>
                                        <option>Rajshahi</option>
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

                    $conn->close();
                    
                    $conn2 = new mysqli("localhost", "root", "", "connectcouncillor");

                    $conn2->query("INSERT INTO `login`(`username`, `password`, `userStatus`,`userAccountState`) VALUES ('$uname','$password','councilor',1)");

                    $conn2->close();


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

    <script>
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        function isChar(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return true;
            }
            return false;
        }

        function validateform() {



            var name = document.create.name.value;
            var blood = document.create.blood.value;
            var age = document.create.age.value;
            var vid = document.create.vid.value;
            var uname = document.create.uname.value;
            var password = document.create.password.value;
            var address = document.create.address.value;
            var city = document.create.city.value;
            var wardnumber = document.create.wardnumber.value;



            if (name == null || name == "") {
                alert("name can't be blank");
                return false;
            } else if (blood == null || blood == "") {
                alert("blood can't be blank");
                return false;
            } else if (age == null || age == "") {
                alert("age can't be blank");
                return false;
            } else if (vid == null || vid == "") {
                alert("voter id can't be blank");
                return false;
            } else if (uname == null || uname == "") {
                alert("username can't be blank");
                return false;
            } else if (password == null || password == "") {
                alert("password can't be blank");
                return false;
            } else if (address == null || address == "") {
                alert("address can't be blank");
                return false;
            } else if (city == null || city == "") {
                alert("city can't be blank");
                return false;
            } else if (wardnumber == null || wardnumber == "") {
                alert("ward number can't be blank");
                return false;
            }
        }
    </script>


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