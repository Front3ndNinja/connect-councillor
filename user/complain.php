<?php
session_start();

if (empty($_SESSION["username"]))
{
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> </header>
    <link rel="stylesheet" href="../css/main.css">

    <body>
        <!--       navigation menu -->
        <?php include ('userNav.html') ?>
            <!--        user complain -->
            <!--
            <section class="userInfo margin-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-3">
                            <form action="postComplain.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>
                                        <h4 class="text-cente">Post Your Complain</h4></label>
                                    <textarea class="form-control" name="testComp" id="complainTextBox" rows="5"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Select Image File:</label>
                                    <input type="file" name="image"> </div>
                                     <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </form>
                           
                        </div>
                    </div>
                </div>
            </section>
-->
            <section class="userInfo margin-top">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-3">
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleInputTitle">
                                        <h5>Title</h5></label>
                                    <input type="text" class="form-control" name="complainTitle" aria-describedby="emailHelp"> </div>
                                <div class="form-group">
                                    <label>
                                        <h5>description</h5> </label>
                                    <textarea class="form-control" name="postedComplain" id="complainTextBox" rows="5"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Select Image File:</label>
                                    <input type="file" name="image"> </div>
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!--          code to upload image  -->
            <?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  
    $conn = new mysqli("localhost", "root", "", "connectcouncillor");

    // If file upload form is submitted
    $userName = $_SESSION["username"];
    $complainTitle = $_REQUEST["complainTitle"];
    $complain = $_REQUEST["postedComplain"];
    $status = $statusMsg = '';
    if (isset($_REQUEST["submit"]))
    {
        $status = 'error';
        if (!empty($_FILES["image"]["name"]))
        {
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
            if (in_array($fileType, $allowTypes))
            {
                $image = $_FILES['image']['tmp_name'];
                $imgContent = addslashes(file_get_contents($image));

                // Insert image content into database
                
                $insert = $conn->query("INSERT into complain (`userName`,`title`, `postedComplain`, `complainImage`, `userWardNumber`) VALUES ('$userName','$complainTitle','$complain','$imgContent', NOW())");

                if ($insert)
                {
                    $status = 'success';
                    $statusMsg = "File uploaded successfully.";
                }
                else
                {

                    $statusMsg = "File upload failed, please try again.";
                }
            }
            else
            {
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
            }
        }
        else
        {
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
                <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>

    </html>