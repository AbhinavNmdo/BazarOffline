<?php
$target_dir = "upload/";
$target_file = $target_dir . basename($_FILES["pic"]["name"]); //Image:<input type="file" id="pic" name="pic">
$tag = $_REQUEST['username'];
$m = new MongoClient();   
$db = $m->test;      //mongo db name
$collection = $db->storeUpload; //collection name

//-----------converting into mongobinary data----------------

$document = array( "user_name" => $tag,"image"=>new MongoBinData(file_get_contents($target_file)));

//-----------------------------------------------------------
if($collection->save($document)) // saving into collection
{
echo "One record successfully inserted";
}
else
{
echo "Insertion failed";
}

// ******************Image Retrieving******************


$m=new MongoClient();
$db=$m->test;
$collection=$db->storeUpload;
$record = $collection->find();
foreach ($record as $data)
{
$imagebody = $data["image"]->bin;
$base64   = base64_encode($imagebody);
echo '<img src="data:png;base64,<?php echo $base64 ?>"/>';

?>
<input type="file" name="pic">