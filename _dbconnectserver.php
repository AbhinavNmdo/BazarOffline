<?php
$servername = "remotemysql.com";
$username = "QkWkSm31fm";
$password= "xBKzJ5oSCW";
$database = "QkWkSm31fm";

// Connecting to Database
$conn = mysqli_connect($servername, $username, $password, $database);

// Die statnment if not connected
if (!$conn) {
  die("Sorry, Cant connect " . mysqli_connect_error());
}

?>
