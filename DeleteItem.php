<?php
    $itemid = $_GET['itemid'];
    include "views/_dbconnect.php";
    $sql = "SELECT * FROM `items` WHERE `item_id` = $itemid";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $shopid = $row['itemshop_id'];
    $deletesql = "DELETE FROM `items` WHERE `item_id` = '$itemid'";
    $resultdelete = mysqli_query($conn, $deletesql);
    
    header("location: Shopkeeper.php?shopids=$shopid");

?>