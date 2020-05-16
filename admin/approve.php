<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $bid = $_REQUEST["bid"];
    $inputState = $_REQUEST["inputState"];

    if($inputState == "approved"){
        $inputState = 1;
    }
    else{
        $inputState = 0;
    }

    $conn = new mysqli("localhost", "root", "", "connectcouncillor");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    
     $conn->query("UPDATE `login` SET `userAccountState`= '$inputState' WHERE `username` = '$bid'");
    
     
   
    $conn->close();

    header("Location: ../admin/approveuser.php");
}
