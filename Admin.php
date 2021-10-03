<?php
ob_start();
session_start();
if(!isset($_SESSION['admin'])){
    header("location: Login.php");
}

$exist = false;
$done = false;
require "views/_dbconnect.php";
    // Shopkeeper
    if (isset($_POST['shopsubmit'])){
        $shopname = $_POST['nameofshop'];
        $ownername = $_POST['nameofowner'];
        $shopaddress = $_POST['address'];
        $shopemail = $_POST['email'];
        $username11 = $_POST['username11'];
        $pass = $_POST['password'];
        $cpass = $_POST['cpassword'];
        $category = $_POST['select'];
        $zip = $_POST['zip'];
        $shoptiming = $_POST['timing'];
        $maplink = $_POST['map'];
        $mobileno = $_POST['mobile'];
        
        if($pass == $cpass){
            if(!empty($username11) and !empty($shopemail) and !empty($pass) and !empty($shopname) and !empty($ownername) and !empty($shopaddress) and !empty($shopemail) and !empty($cpass) and !empty($zip) and !empty($shoptiming) and !empty($maplink) and !empty($mobileno) and $category === null){
                $collection = $db->shopkeeper;
                $image = $_FILES['profile'];
                $document = array(
                    "ShopName" => "$shopname",
                    "OwnerName" => "$ownername",
                    "Address" => "$shopaddress",
                    "E-mail" => "$shopemail",
                    "Username" => "$username11",
                    "Password" => "$pass",
                    "C-Password" => "$cpass",
                    "category" => "$category",
                    "Zip" => "$zip",
                    "Timing" => "$shoptiming",
                    "Map" => "$maplink",
                    "Mobile" => "$mobileno",
                    "Image" => new MongoDB\BSON\Binary(file_get_contents($image["tmp_name"]), MongoDB\BSON\Binary::TYPE_GENERIC),
                    "AgentCode" => ""
                );
                $result = $collection->insertOne($document);
                if ($result){
                    $done = true;
                }
                else{
                    $exist = true;
                }
            }
            else {
                echo "else";
                $exist = true;
            }
        }
        else{
            $exist = true;
        }
    }

    // Category
    // if(isset($_POST['catsubmit'])){
    //     $collection = $db->categories;
    //     $catname = $_POST['catname'];
    //     $catdesc = $_POST['catdesc'];
    //     $image = $_FILES['catpic'];
    //     if(!empty($catname)){
    //       $document = array(
    //         "name" => $_POST['catname'],
    //         "description" => $_POST['catdesc'],
    //         "image" => new MongoDB\BSON\Binary(file_get_contents($image['tmp_name']), MongoDB\BSON\Binary::TYPE_GENERIC)
    //       );

    //       $result = $collection->insertOne($document);
    //       if($result){
    //         $done = true;
           
    //       }
    //       else{
    //         $exist = true;
    //       }
    //     }
      
    // }
    // Agent
    if(isset($_POST['agentsubmit'])){
        $agentname = $_POST['agent_name'];
        $agentusername = $_POST['agent_username'];
        $agentemail = $_POST['agent_email'];
        $agentaddress = $_POST['agent_address'];
        $agentmobile = $_POST['agent_mobile'];
        $agentpass = $_POST['agent_password'];
        $agentcpass = $_POST['agent_cpassword'];

        if(!empty($agentusername) and !empty($agentname) and !empty($agentemail) and !empty($agentaddress) and !empty($agentmobile) and !empty($agentpass) and !empty($agentcpass)){
            if ($agentpass == $agentcpass) {
                $collection = $db->agent;
                $document = array(
                    "Name" => "$agentname",
                    "Username" => "$agentusername",
                    "E-mail" => "$agentemail",
                    "Address" => "$agentaddress",
                    "Mobile" => "$agentmobile",
                    "Password" => "$agentpass",
                    "C-Password" => "$agentcpass"
                );
                $result = $collection->insertOne($document);
                if ($result){
                    $done = true;
                }
                else{
                    $exist = true;
                }
            }
        }
        else{
            $exist = true;
        }
    }

    // Delete Category
    if(isset($_POST['deletecat'])){
        $collection = $db->categories;
        $catid = $_POST['delete'];
        if($catid === null){
            $category = $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectID($catid)]);
            if($category){
                $done = true;
            }
            else {
                $exist = true;
            }
        }
        else{
            $exist = true;
        }
    }

    // Delete Shopkeeer
    if(isset($_POST['deleteshop'])){
        $collection = $db->shopkeeper;
        $shopid = $_POST['deleteshopkeeper'];
        if($shopid === null){
            $shop = $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectID($shopid)]);
            if($shop){
                $done = true;
            }
            else {
                $exist = true;
            }
        }
        else{
            $exist = true;
        }
    }

    if(isset($_POST['updateshopsub'])){
        $collection = $db->shopkeeper;
        $shopid = $_POST['updateshop'];
        $shopcatid = $_POST['updateshopcat'];
        if($shopid === null and $shopcatid === null){
            $update = $collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectID($shopid)],
                ['$set' => ['category' => $shopcatid]]
            );
            if($update){
                $done = true;
            }
            else {
                $exist = true;
            }
        }
        else{
            $exist = true;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome! Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Chettan+2:wght@500&display=swap" rel="stylesheet">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<style>
    *
    {
        font-family: 'Baloo Chettan 2', cursive;
        scroll-behavior: smooth;
    }
    .rowbutton
    {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
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
        width: 190px;
        height: 190px;
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
    <div style="height: 50px;">
    <?php
        if($exist){
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Failed!</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
        if($done){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Successfully Inserted!</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }

    ?>
    </div>

    



<div class="container rowbutton my-4">
<!-- For Category Addition -->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary m-1" style="width: 13rem;" data-bs-toggle="modal" data-bs-target="#addCat">
  Add Category
</button>

<!-- Modal -->
<div class="modal fade" id="addCat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="0" aria-labelledby="addCatLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCatLabel">Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form class="m-4" action="Admin.php" method="POST">
          <div class="mb-3">
              <label for="catname" class="form-label">Category Name</label>
              <input type="text" class="form-control" id="catname" name="catname">
          </div>
          <div class="mb-3">
              <label for="catdesc" class="form-label">Category Description</label>
              <input type="text" class="form-control" id="catdesc" name="catdesc">
          </div>
          <div class="mb-3">
              <label for="catpic" class="form-label">Choose Profile</label>
              <input type="file" class="form-control" id="catpic" name="catpic">
          </div>
          <!-- <button type="submit" name="catsubmit" class="btn btn-primary">Add</button> -->
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- For Agent Addition -->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary m-1" style="width: 13rem;" data-bs-toggle="modal" data-bs-target="#addAgent">
  Add Agent
</button>

<!-- Modal -->
<div class="modal fade" id="addAgent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addAgentLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addAgentLabel">Agent Registration</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                    <form class="m-4" action="Admin.php" method="POST">
                        <div class="mb-3">
                            <label for="agent_name" class="form-label">Agent Name</label>
                            <input type="text" class="form-control" id="agent_name" name="agent_name">
                        </div>
                        <div class="mb-3">
                            <label for="agent_username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="agent_username" name="agent_username">
                        </div>
                        <div class="mb-3">
                            <label for="agent_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="agent_email" name="agent_email">
                        </div>
                        <div class="mb-3">
                            <label for="agent_address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="agent_address" name="agent_address">
                        </div>
                        <div class="mb-3">
                            <label for="agent_mobile" class="form-label">Mobile</label>
                            <input type="text" class="form-control" id="agent_mobile" name="agent_mobile">
                        </div>
                        <div class="mb-3">
                            <label for="agent_password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="agent_password" name="agent_password">
                        </div>
                        <div class="mb-3">
                            <label for="agent_cpassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="agent_cpassword" name="agent_cpassword">
                        </div>
                        <button class="btn btn-primary" type="submit" name="agentsubmit">Add</button>
                    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- For Adding Shopkeeper -->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary m-1" style="width: 13rem;" data-bs-toggle="modal" data-bs-target="#addShop">
  Add Shopkeeper
</button>

<!-- Modal -->
<div class="modal fade" id="addShop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addShopLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addShopLabel">Shopkeeper Registration</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                    <form class="m-4" action="Admin.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nameofowner" class="form-label">Name Of Owner</label>
                            <input type="text" class="form-control" id="nameofowner" name="nameofowner">
                        </div>
                        <div class="mb-3">
                            <label for="nameofshop" class="form-label">Name of shop</label>
                            <input type="text" class="form-control" id="nameofshop" name="nameofshop">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Shop Address</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="username11" class="form-label">Username</label>
                            <input type="textarea" class="form-control" id="username11" name="username11">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="cpassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="cpassword" name="cpassword">
                        </div>
                        <div class="mb-3">
                            <label for="mobile" class="form-label">Mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile">
                        </div>
                        <div class="mb-3">
                            <label for="zip" class="form-label">Shop Zip</label>
                            <input type="text" class="form-control" id="zip" name="zip">
                        </div>
                        <div class="mb-3">
                            <label for="map" class="form-label">Paste Map link</label>
                            <input type="text" class="form-control" id="map" name="map">
                        </div>
                        <div class="mb-3">
                            <label for="profile" class="form-label">Profile Pic</label>
                            <input type="file" class="form-control" id="profile" name="profile">
                        </div>
                        <div class="mb-3">
                            <label for="timing" class="form-label">Timing</label>
                            <input type="text" class="form-control" id="timing" name="timing">
                        </div>
                        <div class="mb-3">
                            <label for="select" class="form-label">Select Category</label>
                            <select name="select" id="select" class="form-control">
                                <option value=null selected>--Select Category--</option>
                                <?php
                                        $collection = $db->categories;
                                        $category = $collection->find();
                                        foreach($category as $cat){
                                            echo '<option value="'.$cat['_id'].'">'.$cat['name'].'</option>';
                                        }
                                ?>
                            </select>
                        </div>
                        <button type="submit" name="shopsubmit" class="btn btn-primary">Add</button>
                    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- For Deleting Category -->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary m-1" style="width: 13rem;" data-bs-toggle="modal" data-bs-target="#delCat">
  Delete Category
</button>

<!-- Modal -->
<div class="modal fade" id="delCat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="delCatLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="delCatLabel">Delete Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="m-4" action="Admin.php" method="POST">
        <label for="delete" class="form-label">Select Category</label>
        <select name="delete" id="delete" class="form-control">
            <option value=null selected>--Select Category--</option>
            <?php
                $collection = $db->categories;
                $category = $collection->find();
                foreach($category as $cat){
                    echo '<option value="'.$cat['_id'].'">'.$cat['name'].'</option>';
                }
            ?>
        </select>
        <button type="submit" name="deletecat" class="my-4 btn btn-primary">Delete</button>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- For Deleting Shopkeeper -->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary m-1" style="width: 13rem;" data-bs-toggle="modal" data-bs-target="#delShop">
  Delete Shopkeeper
</button>

<!-- Modal -->
<div class="modal fade" id="delShop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="delShopLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="delShopLabel">Delete Shopkeeper</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="m-4" action="Admin.php" method="POST">
        <label for="deleteshop" class="form-label">Select Shopkeeper</label>
        <select name="deleteshopkeeper" id="deleteshopkeeper" class="form-control">
            <option value=null selected>--Select Shopkeeper--</option>
            <?php
                $collection = $db->shopkeeper;
                $shopkeeper = $collection->find();
                foreach($shopkeeper as $shop){
                    echo '<option value="'.$shop['_id'].'">'.$shop['ShopName'].'</option>';
                }
            ?>
        </select>
        <button type="submit" name="deleteshop" class="my-4 btn btn-primary">Delete</button>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- For Update Shopkeeper Category-->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary m-1" style="width: 13rem;" data-bs-toggle="modal" data-bs-target="#upShop">
  Update Shopkeeper
</button>

<!-- Modal -->
<div class="modal fade" id="upShop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="upShopLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="upShopLabel">Update Shopkeeper Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="m-4" action="Admin.php" method="POST">
        <div class="mb-3">
        <label for="updateshop" class="form-label">Select Shopkeeper</label>
        <select name="updateshop" id="updateshop" class="form-control">
            <option value=null selected>--Select Shopkeeper--</option>
            <?php
                $collection = $db->shopkeeper;
                $shopkeeper = $collection->find();
                foreach($shopkeeper as $shop){
                    echo '<option value="'.$shop['_id'].'">'.$shop['ShopName'].'</option>';
                }
            ?>
        </select>
        </div>
        <div class="mb-3">
        <label for="updateshopcat" class="form-label">Select Shopkeeper</label>
        <select name="updateshopcat" id="updateshopcat" class="form-control">
            <option value=null selected>--Select Category--</option>
                <?php
                $collection = $db->categories;
                $category = $collection->find();
                foreach($category as $cat){
                    echo '<option value="'.$cat['_id'].'">'.$cat['name'].'</option>';
                }
                ?>
        </select>
        </div>
        <button type="submit" onclick="update()" name="updateshopsub" class="my-4 btn btn-primary">Update</button>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>

<!-- Category Cropper Modal -->
<div class="modal fade" id="catModal" tabindex="100" role="dialog" aria-labelledby="modalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Crop Category Image</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="img-container">
                                <div class="row">
                                    <div class="col-md-8">
                                        <img src="" id="sample_catimage" />
                                    </div>
                                    <div class="col-md-4">
                                        <div class="preview"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="catCrop" class="btn btn-primary">Upload</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      
                        </div>
                    </div>
                </div>
            </div>


</body>
<script>
function update() {
    let shopcat = document.getElementById('updateshopcat').value;
    let shop = document.getElementById('updateshop').value;
    console.log(shop);
    console.log(shopcat);
    
}

$(document).ready(function() {

  var $modal = $('#catModal');

  var image = document.getElementById('sample_catimage');

  var cropper;

  $('#catpic').change(function(event) {
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

  $('#catCrop').click(function() {
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
              var name = $("#catname").val();
              var desc = $("#catdesc").val();
              var url = "Admin.php"
              $.ajax({
                  url: 'upload.php',
                  method: 'POST',
                  data: {catpic: base64data, catname: name, catdesc: desc},
                  success: function(data) {
                      $modal.modal('hide');
                      $(location).attr('href',url);
                  }
              });
          };
      });
  });

});


</script>

</html>