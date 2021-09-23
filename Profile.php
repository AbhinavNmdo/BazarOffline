<?php
    session_start();
    $shopkeeperid = $_GET['shopkeeperid'];
    require "views/_dbconnect.php";
?>
<?php
    $success = false;
    $failed = false;

    // if (isset($_POST['item'])) {
    //     $collection = $db->items;
    //     $shopzip = $_SESSION['shopzip'];
    //     $itemname = $_POST['itemname'];
    //     $itemdesc = $_POST['itemdesc'];
    //     if(!empty($itemname)){
    //         $image = $_FILES['itempic'];
    //         $document = array(
    //             "name" => "$itemname",
    //             "description" => "$itemdesc",
    //             "shop_id" => "$shopkeeperid",
    //             "shop_zip" => "$shopzip",
    //             "image" => new MongoDB\BSON\Binary(file_get_contents($image['tmp_name']), MongoDB\BSON\Binary::TYPE_GENERIC)
    //         );
    //         $result = $collection->insertOne($document);
    //         if ($result) {
    //             $success = true;
    //             header("location: Shopkeeper.php?shopids=$shopkeeperid");
    //         } else {
    //             $failed = true;
    //         }
    //     }
    //     else{
    //         $failed = true;
    //     }
    // }
    
    // Update Image
    // if (isset($_FILES['profile'])){
    //     $image = $_FILES['profile'];
    //     $collection = $db->shopkeeper;
    //     $update = $collection->updateOne(
    //         ['_id' => new MongoDB\BSON\ObjectID($shopkeeperid)],
    //         ['$set' => ['Image' => new MongoDB\BSON\Binary(file_get_contents($image["tmp_name"]), MongoDB\BSON\Binary::TYPE_GENERIC)]]
    //     );
    //     if($update){
    //         header("location: Shopkeeper.php?shopids=$shopkeeperid");
    //     }
    //     else{
    //         $failed = true;
    //     }
        
    // }

    // Update Timing
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

    // Update Map
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
.image_area {
        position: relative;
    }

    img {
        display: block;
        max-width: 100%;
    }

    .preview {
        overflow: hidden;
        width: 160px;
        height: 160px;
        margin: 10px;
        border: 1px solid red;
    }

    .modal-lg {
        max-width: 1000px !important;
    }

    .overlay {
        position: absolute;
        bottom: 10px;
        left: 0;
        right: 0;
        background-color: rgba(255, 255, 255, 0.5);
        overflow: hidden;
        height: 0;
        transition: .5s ease;
        width: 100%;
    }

    .image_area:hover .overlay {
        height: 50%;
        cursor: pointer;
    }

    .text {
        color: #333;
        font-size: 20px;
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        text-align: center;
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
<!-- Product Cropper Modal -->
<div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Crop Product Image</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="img-container">
                                <div class="row">
                                    <div class="col-md-8">
                                        <img src="" id="sample_itemimage" />
                                    </div>
                                    <div class="col-md-4">
                                        <div class="preview"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="itemCrop" class="btn btn-primary">Upload</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      
                        </div>
                    </div>
                </div>
            </div>

<!-- Profile Cropper Modal -->
<div class="modal fade" id="proModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Crop Profile Image</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="img-container">
                                <div class="row">
                                    <div class="col-md-8">
                                        <img src="" id="sample_proimage" />
                                    </div>
                                    <div class="col-md-4">
                                        <div class="preview"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="proCrop" class="btn btn-primary">Upload</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      
                        </div>
                    </div>
                </div>
            </div>

    <div class="container" id="form">
        <div class="row">
            <!-- Insert Item form -->
            <div class="col-md-4 my-4">
                <div class="card rounded-3">
                    <h2 style="margin-top: 20px;" align="center">Add Items</h2>
                    <form class="m-4" action="<?php "Shopkeeper.php?shopids='. $shopkeeperid .'" ?>" method="POST"  enctype="multipart/form-data" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="itemname" class="form-label">Item Name</label>
                            <input type="text" class="form-control" id="itemname" aria-describedby="emailHelp"
                                name="itemname">
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">Description</label>
                            <input type="textarea" class="form-control" id="itemdesc" name="itemdesc">
                        </div>
                        <div class="mb-3">
                            <label for="itempic" class="form-label">Item Image</label>
                            <input type="file" class="form-control" id="itempic" name="itempic">
                        </div>
                        <!-- <button type="submit" name="item" class="btn btn-primary">Submit</button> -->
                    </form>
                </div>
            </div>
            <!-- Update Profile Pic -->
            <div class="col-md-4 my-4">
                <div class="card rounded-3">
                    <h2 style="margin-top: 20px;" align="center">Update Profile Pic</h2>
                    <!-- action="<?php "Shopkeeper.php?shopids='. $shopkeeperid .'" ?>" -->
                    <form class="m-4"  method="POST">
                        <div class="res">
                            <div class="mb-3">
                                <label for="profile" class="form-label">Update Your Profile</label>
                                <input type="file" class="form-control" name="profile" id="profile">
                            </div>
                            <div class="mb-3">
                                <!-- <input type="submit" name="profile" class="btn btn-primary" id="profile"> -->
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

    <!-- Item Cropper Modal -->

</body>
<script>
// Product Cropper
$(document).ready(function() {

var $modal = $('#itemModal');

var image = document.getElementById('sample_itemimage');

var cropper;

$('#itempic').change(function(event) {
    var files = event.target.files;

    var done = function(url) {
        image.src = url;
        $modal.modal('show');
    };

    if (files && files.length > 0) {
        reader = new FileReader();
        reader.onload = function(event) {
            done(reader.result);
        };
        reader.readAsDataURL(files[0]);
    }
});

$modal.on('shown.bs.modal', function() {
    cropper = new Cropper(image, {
        aspectRatio: 16 / 9,
        viewMode: 3,
        preview: '.preview'
    });
}).on('hidden.bs.modal', function() {
    cropper.destroy();
    cropper = null;
});

$('#itemCrop').click(function() {
    canvas = cropper.getCroppedCanvas({
        width: 300,
        height: 300
    });

    canvas.toBlob(function(blob) {
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
        reader.readAsDataURL(blob);
        reader.onloadend = function() {
            var base64data = reader.result;
            var name = $("#itemname").val();
            var desc = $("#itemdesc").val();
            var shopids = <?php echo json_encode($shopkeeperid) ?>;
            $.ajax({
                url: 'upload.php',
                method: 'POST',
                data: {itempic: base64data, itemname: name, itemdesc: desc, shopid: shopids},
                success: function(data) {
                    $modal.modal('hide');
                    window.location.reload();
                }
            });
        };
    });
});

});

// Profile Cropper
$(document).ready(function() {

var $modal = $('#proModal');

var image = document.getElementById('sample_proimage');

var cropper;

$('#profile').change(function(event) {
    var files = event.target.files;

    var done = function(url) {
        image.src = url;
        $modal.modal('show');
    };

    if (files && files.length > 0) {
        reader = new FileReader();
        reader.onload = function(event) {
            done(reader.result);
        };
        reader.readAsDataURL(files[0]);
    }
});

$modal.on('shown.bs.modal', function() {
    cropper = new Cropper(image, {
        aspectRatio: 16 / 9,
        viewMode: 3,
        preview: '.preview'
    });
}).on('hidden.bs.modal', function() {
    cropper.destroy();
    cropper = null;
});

$('#proCrop').click(function() {
    canvas = cropper.getCroppedCanvas({
        width: 300,
        height: 300
    });

    canvas.toBlob(function(blob) {
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
        reader.readAsDataURL(blob);
        reader.onloadend = function() {
            var base64data = reader.result;
            var name = $("#itemname").val();
            var desc = $("#itemdesc").val();
            var shopids = <?php echo json_encode($shopkeeperid) ?>;
            $.ajax({
                url: 'upload.php',
                method: 'POST',
                data: {profile: base64data, shopid: shopids},
                success: function(data) {
                    $modal.modal('hide');
                    window.location.reload();
                }
            });
        };
    });
});

});
</script>
</html>