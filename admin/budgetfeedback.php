<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $amount = $_REQUEST["amount"];
    $bid = $_REQUEST["bid"];
    $inputState = $_REQUEST["inputState"];

    

    $conn = new mysqli("localhost", "root", "", "connectcouncillor");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    
    $sql = $conn->query("UPDATE `budget` SET `amount` = '$amount',`status`= '$inputState' WHERE `bid` = '$bid'");
    
     
   
    $conn->close();

    header("Location: ../admin/budget.php");
}
