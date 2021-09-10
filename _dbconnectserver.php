<?php
$servername = "localhost";
$username = "id17545851_bazaroffline";
$password= "}[eV*]^z=?8*[oi1";
$database = "id17545851_abhay";

// Connecting to Database
$conn = mysqli_connect($servername, $username, $password, $database);

// Die statnment if not connected
if (!$conn) {
  die("Sorry, Cant connect" . mysqli_connect_error());
}

?>