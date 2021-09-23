<?php
    $itemid = $_GET['itemid'];
    include "views/_dbconnect.php";
    $collection = $db->items;
    $shop = $collection->findOne(
        ['_id' => new MongoDB\BSON\ObjectID($itemid)]
    );
    $shopid = $shop['shop_id'];
    $delete = $collection->deleteOne(
        ['_id' => new MongoDB\BSON\ObjectID($itemid)]
    );
    
    header("location: Shopkeeper.php?shopids=$shopid");

?>