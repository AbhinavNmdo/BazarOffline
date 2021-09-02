<?php
$servername = "remotemysql.com";
$username = "xfPaLAmTxD";
$password= "vR5LH3oNBw";
$database = "xfPaLAmTxD";

// Connecting to Database
$conn = mysqli_connect($servername, $username, $password, $database);

// Die statnment if not connected
if (!$conn) {
  die("Sorry, Cant connect" . mysqli_connect_error());
}

?>