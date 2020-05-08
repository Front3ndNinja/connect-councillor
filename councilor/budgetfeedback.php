<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $bid = $_REQUEST["bid"];
    $inputState = $_REQUEST["inputState"];

    

    $conn = new mysqli("localhost", "root", "", "connectcouncillor");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    
    $sql = $conn->query("UPDATE `budget` SET `status`= '$inputState' WHERE `bid` = '$bid'");
    
     
   
    $conn->close();

    header("Location: ../councilor/budget.php");
}
