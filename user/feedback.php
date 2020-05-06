<?php
session_start();
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
    <!--        user complain -->

    <section class="userInfo margin-top">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-3">
                    <?php
                    $conn = new mysqli("localhost", "root", "", "connectcouncillor");

                    $query = "SELECT * FROM `complain` WHERE `userWardNumber`='$ward'";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $title = $row['title'];
                            $complain = $row['postedComplain'];
                            $id = $row['complainId'];
                            echo "<h6>Title:  $title </h6>";
                            echo "<h6>Description:  $complain </h6>";
                            echo "<h6>ID:  $id </h6>";
                            echo " <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModalCenter'> Launch demo modal </button>";
                            echo "<br> <br>";
                        }
                    }
                    ?>
                </div>
                <div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form method="POST" id="comment_form">
                                        <div class="form-group">
                                            <input type="text" name="post_id" id="post_id" class="form-control" placeholder="post ID" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="comment_name" id="comment_name" class="form-control" placeholder="Enter Name" />
                                        </div>
                                        <div class="form-group">
                                            <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Enter Comment" rows="5"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="comment_id" id="comment_id" value="0" />

                                            <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
                                        </div>
                                    </form>
                                    <span id="comment_message"></span>
                                    <br />
                                    <div id="display_comment"></div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!--          code to upload image  -->


    <!--        user statstic section-->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>


</body>

</html>
<script>
    $(document).ready(function() {

        $('#comment_form').on('submit', function(event) {
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: "../comment/add_comment.php",
                method: "POST",
                data: form_data,
                dataType: "JSON",
                success: function(data) {
                    if (data.error != '') {
                        $('#comment_form')[0].reset();
                        $('#comment_message').html(data.error);
                        $('#comment_id').val('0');
                        $('#post_id');
                        load_comment();
                    }
                }
            })
        });

        load_comment();

        function load_comment() {
            $.ajax({
                url: "../comment/fetch_comment.php",
                method: "POST",
                success: function(data) {
                    $('#display_comment').html(data);
                }
            })
        }

        $(document).on('click', '.reply', function() {
            var comment_id = $(this).attr("id");
            $('#comment_id').val(comment_id);
            $('#comment_name').focus();
        });

    });
</script>