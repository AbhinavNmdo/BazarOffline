<?php
    session_start();
    $shopkeeperid = $_GET['shopkeeperid'];
    require "views/_dbconnect.php";
?>
<?php
    $success = false;
    $failed = false;

    if (isset($_POST['item'])) {
        $collection = $db->items;
            $shopzip = $_SESSION['shopzip'];
            $itemname = $_POST['itemname'];
            $itemdesc = $_POST['itemdesc'];
            if(!empty($itemname) or !empty($itemdesc)){
                $document = array(
                    "name" => "$itemname",
                    "description" => "$itemdesc",
                    "shop_id" => "$shopkeeperid",
                    "shop_zip" => "$shopzip"
                );
                $result = $collection->insertOne($document);
                if ($result) {
                    $success = true;
                    header("location: Shopkeeper.php?shopids=$shopkeeperid");
                } else {
                    $failed = true;
                }
            }
            else{
                $failed = true;
            }
        }
    
    // Need to update it    
    if (isset($_POST['profile'])){
            $fileName = $_FILES['profile']['name'];
            $fileType = $_FILES['profile']['type'];
            $fileContent = file_get_contents($_FILES['profile']['tmp_name']);
            $dataUrl = 'data:' . $fileType . ';base64,' . base64_encode($fileContent);
            
            $item = array(
                'name' => $fileName,
                'type' => $fileType,
                'data' => $dataUrl
            );
            
            $collection = $db->shopkeeper;
            $update = $collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectID($shopkeeperid)],
                ['$set' => ['Image' => $item]]
            );
        
    }
    if (isset($_POST['chtiming'])){
        $timing = $_POST['timing'];
        if(!empty($timing)){
            $collection = $db->shopkeeper;
            $update = $collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectID($shopkeeperid)],
                ['$set' => ['Timing' => $timing]]
            );
            if ($update) {
                $success = true;
                header("location: Shopkeeper.php?shopids=$shopkeeperid");
            } else {
                $failed = true;
            }
        }
        else{
            $failed = true;
        }
    }
    if(isset($_POST['mapsubmit'])){
        $maplink = $_POST['maps'];
        if(!empty($maplink)){
            $collection = $db->shopkeeper;
            $update = $collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectID($shopkeeperid)],
                ['$set' => ['Map' => $maplink]]
            );
            if ($update) {
                $success = true;
                header("location: Shopkeeper.php?shopids=$shopkeeperid");
            } else {
                $failed = true;
            }
        }
    }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Chettan+2:wght@500&display=swap" rel="stylesheet">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<style>
* {
    font-family: 'Baloo Chettan 2', cursive;
    scroll-behavior: smooth;
}
</style>

<body>
    <?php
    require "views/_navbar.php";
    ?>
    <?php
        if ($success){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Successfully Updated your Profile!</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
        }
        if ($failed){
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Failed to Update Profile!</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
        }

    ?>

    <!-- Security for Shopkeepers -->
    <?php
    $collection = $db->shopkeeper;
    $user = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($shopkeeperid)]);
        $active = $user['Username'];
        if ($_SESSION['username'] != $active) {
            header("location: Logout.php");
            header("location: Login.php");
        }
    ?>


    <div class="container" id="form">
        <div class="row">
            <!-- Insert Item form -->
            <div class="col-md-4 my-4">
                <div class="card rounded-3">
                    <h2 style="margin-top: 20px;" align="center">Add Items</h2>
                    <form class="m-4" action="<?php "Shopkeeper.php?shopids='. $shopkeeperid .'" ?>" method="POST">
                        <div class="mb-3">
                            <label for="itemname" class="form-label">Item Name</label>
                            <input type="text" class="form-control" id="itemname" aria-describedby="emailHelp"
                                name="itemname">
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">Description</label>
                            <input type="textarea" class="form-control" id="desc" name="itemdesc">
                        </div>
                        <button type="submit" name="item" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <!-- Update Profile Pic -->
            <div class="col-md-4 my-4">
                <div class="card rounded-3">
                    <h2 style="margin-top: 20px;" align="center">Update Profile Pic</h2>
                    <form class="m-4" action="<?php "Shopkeeper.php?shopids='. $shopkeeperid .'" ?>" method="POST"
                        enctype="multipart/form-data">
                        <div class="res">
                            <div class="mb-3">
                                <label for="profile" class="form-label">Update Your Profile</label>
                                <input type="file" class="form-control" name="profile" id="profile">
                            </div>
                            <div class="mb-3">
                                <input type="submit" name="profile" class="btn btn-primary" id="profile">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Update timing of shop -->
            <div class="col-md-4 my-4">
                <div class="card rounded-3">
                    <h2 style="margin-top: 20px;" align="center">Update Shop Timing</h2>
                    <form class="m-4" action="<?php "Shopkeeper.php?shopids='. $shopkeeperid .'" ?>" method="POST">
                        <div class="mb-3">
                            <label for="itemname" class="form-label">Timing</label>
                            <input type="text" class="form-control" id="timing" name="timing">
                        </div>
                        <button type="submit" name="chtiming" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-md-4 my-4">
                <div class="card rounded-3">
                    <h2 style="margin-top: 20px;" align="center">Update in Maps</h2>
                    <form class="m-4" action="<?php "Shopkeeper.php?shopids='. $shopkeeperid .'" ?>" method="POST">
                        <div class="mb-3">
                            <label for="maps" class="form-label">Paste Map link</label>
                            <input type="text" class="form-control" id="maps" name="maps">
                        </div>
                        <button type="submit" name="mapsubmit" class="btn btn-primary">Submit</button>
                        <hr>
                        <p style="margin-top: 15px;">Need Help?</p>
                        <p>Go to Google Maps -> Search your shop -> Copy the link -> And Paste Here</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>