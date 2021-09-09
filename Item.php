<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen and (max-width: 1010px)" href="views/phone.css">
    <title>Items</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Chettan+2:wght@500&display=swap" rel="stylesheet">
</head>
<style>
    *
    {
        font-family: 'Baloo Chettan 2', cursive;
        scroll-behavior: smooth;
    }

    .responsive
    {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    #ownerimage
    {
        padding-top: 200px;
    }

</style>

<body>
    <?php
    require "views/_dbconnect.php";
    require "views/_navbar.php";
    ?>

    <!-- Shopkeeper Profile -->
    <?php
    $id = $_GET['shopid'];
    $sql = "SELECT * FROM `shopkeeper` WHERE `shop_id` = $id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $shopname = $row['shop_name'];
        $shopaddress = $row['shop_address'];
        $shopzip = $row['shop_zip'];
        $profile = $row['shop_image'];
        $ownerprofile = $row['owner_image'];
        $shoptiming = $row['shop_timing'];
        $maps = $row['shop_maps'];
        echo '<div class="container responsive">
            <div class="col-lg-4 m-4 responsive">
            <!-- <svg class="bd-placeholder-img rounded-circle responsive" width="200" height="200" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg> -->
            <img id="profileimage" class="bd-placeholder-img rounded-circle responsive" src="'.$profile.'" alt="" width="200px" height="200px">
            <h2 style="margin-top: 15px;">' . $shopname . '</h2>
            <p style="text-align: center;">' . $shopaddress . '</p>
            <p class="card-text">Shop Timing : '. $shoptiming . '</p>
            <a href="'. $maps .'" class="btn btn-info" target="_blank">Show in Maps</a>
          </div>
            </div>
            <hr>
            <h2 align="center" style="margin: 40px;">Products Available</h2> ';
    }
    ?>


    <!-- Displaying items of the shop -->
    <div class="container my-4">
        <div class="row">
            <?php
            $id = $_GET['shopid'];
            $sql = "SELECT * FROM `items` WHERE `itemshop_id`=$id";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $itemid = $row['item_id'];
                $itemname = $row['item_name'];
                $itemdesc = $row['item_desc'];
                echo '<div class="col-md-4">
                        <div class="row-md-4 m-4">
                        <div class="card" style="height: 300px; border-radius: 15px;">
                            <img src="https://source.unsplash.com/1600x900/?' . $itemname . '" class="card-img-top" alt="..." style="border-radius: 15px;">
                            <div class="card-body">
                                <h5 class="card-title">' . $itemname . '</h5>
                                <p class="card-text">' . substr($itemdesc, 0, 190) . '</p>
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
        require "views/_footer.php"
        ?>
    </div>

</body>

</html>