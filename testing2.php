<?php
require "views/_dbconnect.php";
$collection = $db->image;
$target_file = basename($_FILES["image"]["name"]);
$document = array("image" => new MongoBinData(file_get_contents($target_file)));
if($collection->save($document))
{
echo "One record successfully inserted";
}
else
{
echo "Insertion failed";
}


?>
<form action="" method="POST">
    <input type="file" name="image">
    <button type="submit" name="image">Submit</button>
</form>