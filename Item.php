<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items</title>
</head>
<style>
    #name {
        margin-left: 80px;
    }

    #mera {
        display: flex;
    }

    #para {
        margin-top: 50px;
    }

    #para p, h2 
    {
        margin-left: 50px;
        width: 600px;
    }
</style>

<body>
    <?php
    require "views/_dbconnect.php";
    require "views/_navbar.php";
    ?>
    <?php
    $id = $_GET['shopid'];
    $sql = "SELECT * FROM `shopkeeper` WHERE `shop_id` = $id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $shopname = $row['shop_name'];
        $shopaddress = $row['shop_address'];
        $shopzip = $row['shop_zip'];
        echo '<div class="container">
            <div class="row m-4">
                <div class="col-lg-4" id="mera">
                  <img class="rounded-circle" src="https://source.unsplash.com/1600x900/?profile" alt="Generic placeholder image" width="250" height="250">
                  <div id="para">
                  <h2>'. $shopname.'</h2>
                  <p>'.$shopaddress.'</p>
                  <p>'.$shopzip.'</p>
                  </div>
                </div>
              </div>
              <hr>
        </div>';
    }
    ?>

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
                        <div class="card" style="width: 18rem;">
                            <img src="https://source.unsplash.com/1600x900/?' . $itemname . '" class="card-img-top" alt="...">
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
    <div class="container">
        <?php
            require "views/_footer.php"
        ?>
    </div>

</body>

</html>