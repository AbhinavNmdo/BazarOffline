<!-- INSERT INTO `agent` (`name`, `password`, `cpassword`) VALUES ('Abhinav', 'asdfasdf', 'asdfsdf'); -->
<?php
$servername = "sql6.freesqldatabase.com";
$username = "sql6434961";
$password= "lLD32M89PA";
$database = "sql6434961";

// Connecting to Database
$conn = mysqli_connect($servername, $username, $password, $database);

// Die statnment if not connected
if (!$conn) {
  die("Sorry, Cant connect " . mysqli_connect_error());
}

?>
