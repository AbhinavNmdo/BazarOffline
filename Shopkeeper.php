<?php
ob_start();
session_start();
$ids = $_GET['shopids'];
$success = false;
$failed = false;

require "views/_dbconnect.php";
// $method = $_SERVER['REQUEST_METHOD'];
if (isset($_POST['add'])) {
    // $ids = $_GET['shopids'];
    $sql12 = "SELECT * FROM `shopkeeper` WHERE `shop_id` = $ids";
    $result12 = mysqli_query($conn, $sql12);
    while ($row = mysqli_fetch_assoc($result12)) {
        $shopzip = $row['shop_zip'];
        $itemname = $_POST['itemname'];
        $itemdesc = $_POST['itemdesc'];
        $sql = "INSERT INTO `items`(`item_name`, `item_desc`, `itemshop_id`, `item_zip`) VALUES ('$itemname','$itemdesc','$ids','$shopzip')";
        $result = mysqli_query($conn, $sql);
        if ($result){
            $success = true;
        }
        else{
            $failed = true;
        }
    }
}

    if (isset($_POST['upload'])){
        $target = basename($_FILES['profile']['name']);
        $img_tmp = $_FILES['profile']['tmp_name'];
        $img = $_FILES['profile']['name'];
        $sql = "UPDATE `shopkeeper` SET `shop_image`='$img' WHERE `shop_id` = '$ids'";
        $result = mysqli_query($conn, $sql);
        if (move_uploaded_file($img_tmp, $target)){
            $success = true;
        }
        else{
            $failed = true;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopkeeper</title>
    <style>
    .responsive
    {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    #form
    {
        width: 300px;
    }
    .res
    {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin: 100px;
    }
    </style>
</head>

<body>
    <?php
    require "views/_dbconnect.php";
    require "views/_navbar.php";
    
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

    <!-- Profile for Shopkeepers -->
    <div class="container">
        <?php
        // $get = $_GET['shopids'];
        $sql = "SELECT * FROM `shopkeeper` WHERE `shop_id` = $ids";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $shopname = $row['shop_name'];
            $shopaddress = $row['shop_address'];
            $shopzip = $row['shop_zip'];
            $profile = $row['shop_image'];
            $shoptiming = $row['shop_timing'];
            echo '<div class="container responsive">
            <div class="col-lg-4 m-4 responsive">
            <img class="bd-placeholder-img rounded-circle responsive" src=" ' .$profile. ' " alt="" width="200px" height="200px">
            <h2 style="margin-top: 15px;">' . $shopname . '</h2>
            <p style="text-align: center;">' . $shopaddress . '</p>
            <p>'.$shopzip.'</p>
            <p class="card-text">Shop Timing : '. $shoptiming . '</p>
            <hr>
            <a href="Profile.php?shopkeeperid='. $ids .'" class="btn btn-info">Update your profile or add Items</a>
            <br>
            <br>
          </div>
            </div>
            <hr>';
        }
        ?>
    </div>

    <!-- Security for shopkeepers -->
    <?php
    // $user = $_GET['shopids'];
    $sql = "SELECT * FROM `shopkeeper` WHERE `shop_id` = '$ids'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $active = $row['shop_username'];
        if ($_SESSION['username'] != $active) {
            header("location: Logout.php");
            // header("location: Login.php");
        }
    }
    ?>


    <!-- Displaying items -->
    <div class="container">
        <div class="row">
            <?php
            // $getid = $_GET['shopids'];
            $sql = "SELECT * FROM `items` WHERE `itemshop_id` = $ids";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $itemname = $row['item_name'];
                $itemdesc = $row['item_desc'];
                $itemid = $row['item_id'];
                echo '<div class="col-md-4">
                    <div class="row-md-4 m-4">
                    <div class="card" style="width: 18rem;">
                        <img src="https://source.unsplash.com/1600x900/?'. $itemname .'" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">' . $itemname . '</h5>
                            <p class="card-text">' . substr($itemdesc, 0, 100) . '...</p>
                        </div>
                    </div>
                </div>
                </div>';
            }
            ?>
        </div>
    </div>

    <!-- Footer -->
    <div class="container">
        <?php
            require "views/_footer.php";
            ob_end_flush();
        ?>
    </div>
</body>

</html>