<?php

session_start();
$comment_sender_name = $_SESSION["uname"];
$postID = $_SESSION["postI"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comment = $_REQUEST["comment_content"];
   
    $conn = new mysqli("localhost", "root", "", "connectcouncillor");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = $conn->query("INSERT INTO `comment`(`comment`, `comment_sender_name`, `postID`) VALUES ('$comment','$comment_sender_name','$postID')");
   
   
    $conn->close();

    header("Location: ../councilor/feedback.php");
}
