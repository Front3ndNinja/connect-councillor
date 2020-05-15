<?php

$postid = $_POST["post_id"];


$conn = new mysqli("localhost", "root", "", "connectcouncillor");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = $conn->query("UPDATE `complain` SET `complainStatus`= '1' WHERE `complainId` = '$postid'");



$conn->close();


return "updated";

?>