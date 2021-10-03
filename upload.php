<?php
require "views/_dbconnect.php";

if(isset($_POST['catname'])){
    $collectoin = $db->categories;
    
    $data = $_POST['catpic'];
    $name = $_POST['catname'];
    $desc = $_POST['catdesc'];
    if(!empty($data) and !empty($name) and !empty($desc)){
        $image_array_1 = explode(";", $data);
        $image_array_2 = explode(",", $image_array_1[1]);
        $image = base64_decode($image_array_2[1]);
        $document = array(
            "name" => $name,
            "description" => $desc,
            "image" => new MongoDB\BSON\Binary($image, MongoDB\BSON\Binary::TYPE_GENERIC)
        );
        $insert = $collectoin->insertOne($document);
    }
    else {
        $exist = true;
    }
    
}
if(isset($_POST['itemname'])){
    $collectoin = $db->items;
    
    $data = $_POST['itempic'];
    $name = $_POST['itemname'];
    $desc = $_POST['itemdesc'];
    $shopid = $_POST['shopid'];
    if(!empty($data) and !empty($name) and !empty($desc)){
        $image_array_1 = explode(";", $data);
        $image_array_2 = explode(",", $image_array_1[1]);
        $image = base64_decode($image_array_2[1]);
        $document = array(
            "name" => $name,
            "description" => $desc,
            "shop_id" => $shopid,
            "image" => new MongoDB\BSON\Binary($image, MongoDB\BSON\Binary::TYPE_GENERIC)
        );
        $insert = $collectoin->insertOne($document);
    }
    
}
if(isset($_POST['profile'])){
    $collectoin = $db->shopkeeper;
    
    $data = $_POST['profile'];
    $shopid = $_POST['shopid'];
	$image_array_1 = explode(";", $data);

	$image_array_2 = explode(",", $image_array_1[1]);
	$image = base64_decode($image_array_2[1]);
    $collectoin->updateOne(
        ['_id' => new MongoDB\BSON\ObjectID($shopid)],
        ['$set' => ['Image' => new MongoDB\BSON\Binary($image, MongoDB\BSON\Binary::TYPE_GENERIC)]]
    );
    
}
?>