<?php
require "vendor/autoload.php";

// Connect to MongoDB
$m = new MongoDB\Client('mongodb+srv://abhinav:abhinav1234@bazaroffline.0hj24.mongodb.net/test');

// Select Database
$db = $m->bazaroffline;
?>