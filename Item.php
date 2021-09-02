<?php
    session_start();

    if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] != true) {
        header("location: Login.php");
        exit;
    }


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
</style>

<body>
    <?php
        require "views/_dbconnect.php";
        require "views/_navbar.php"; 
    ?>
    <?php
        $id = $_GET['shopid'];
        $sql = "SELECT * FROM `shops` WHERE `shop_id` = $id";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)){
            $shopname = $row['shop_name'];
            $shopaddress = $row['shop_address'];
            $shopzip = $row['shop_zip'];
            echo '<h1 class="display-5 m-4"> ' . $shopname . ' </h1>';
            echo '<h4 class="display-7 m-4"> ' . $shopaddress . ' </h4>';
        }  
    ?>

    <div class="container my-4">
        <div class="row">
        <?php
            $id = $_GET['shopid'];
            $sql = "SELECT * FROM `items` WHERE `catid_shop_items`=$id";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $itemid = $row['item_id'];
                $itemname = $row['item_name'];
                $itemdesc = $row['item_desc'];
                echo '<div class="col-md-4">
                        <div class="row-md-4 m-4">
                        <div class="card" style="width: 18rem;">
                            <img src="https://source.unsplash.com/1600x900/?'. $itemname .'" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">'. $itemname . '</h5>
                                <p class="card-text">' . $itemdesc . '</p>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        
        ?>
        </div>
    </div>
        
</body>

</html>