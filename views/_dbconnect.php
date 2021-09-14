<!-- INSERT INTO `agent` (`name`, `password`, `cpassword`) VALUES ('Abhinav', 'asdfasdf', 'asdfsdf'); -->
<?php
$servername = "localhost";
$username = "root";
$password= "";
$database = "bazaroffline";

// Connecting to Database
$conn = mysqli_connect($servername, $username, $password, $database);

// Die statnment if not connected
if (!$conn) {
  die("Sorry, Cant connect" . mysqli_connect_error());
}

?>