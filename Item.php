<?php
session_start();
$id = $_GET['shopid'];
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
    <link rel="icon" href="favicon.ico" type="image/x-icon">
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
    $collection = $db->shopkeeper;
    $shops = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($id)]);
    
    echo '<div class="container responsive">
            <div class="col-lg-4 m-4 responsive">
            <img id="profileimage" class="bd-placeholder-img rounded-circle responsive" src="shop.jpg" alt="" width="200px" height="200px">
            <h2 style="margin-top: 15px;">' . $shops['ShopName'] . '</h2>
            <p style="text-align: center;">' . $shops['Address'] . '</p>
            <p class="card-text">Shop Timing : '. $shops['Timing'] . '</p>
            <a href="'. $shops['Map'] .'" class="btn btn-info" target="_blank">Show in Maps</a>
          </div>
            </div>
            <hr>
            <h2 align="center" style="margin: 40px;">Products Available</h2> ';
    
    ?>


    <!-- Displaying items of the shop -->
    <div class="container my-4">
        <div class="row">
            <?php
            $collection = $db->items;
            $items = $collection->find(['shop_id' => $id]);
            foreach($items as $item){
                echo '<div class="col-md-4">
                        <div class="row-md-4 m-4">
                        <div class="card" style="height: auto; border-radius: 15px;">
                            <img src="https://source.unsplash.com/1600x900/?' . $item['name'] . '" class="card-img-top" alt="..." style="border-radius: 15px;">
                            <div class="card-body">
                                <h5 class="card-title">' . $item['name'] . '</h5>
                                <p class="card-text">' . $item['description'] . '</p>
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