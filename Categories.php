<!-- INSERT INTO `shops` (`shop_id`, `shop_name`, `shop_address`, `shop_zip`, `catsh_id`) VALUES ('1', 'Shiv Aurnaments', 'Near Ganesh Mandir, Sarafa road, Dixitpura, Jabalpur', '482002', '1'); -->

<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
</head>
<body>
    <?php
        require "views/_dbconnect.php";   
        require "views/_navbar.php";
    ?>
    


    <div class="container my-4">
        <?php
            $id1 = $_GET['catid'];
            $sql = "SELECT * FROM `categories` WHERE `cat_id` = $id1";
            $result = mysqli_query($conn, $sql);
            $cat = $row['cat_name'];
            while ($row = mysqli_fetch_assoc($result)) {
                $cat = $row['cat_name'];
                $desc = $row['cat_desc'];
                echo '<div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Welcome to ' . $cat . ' world!</h4>
                <p>' . $desc . '</p>
            </div>';
            }
        ?>
    </div>


    <div class="container">
        <div class="row">
            <?php
                $id2 = $_GET['catid'];
                $sql = "SELECT * FROM `shopkeeper` WHERE `catshop_id` = $id2";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $shopid = $row['shop_id'];
                    $shopname = $row['shop_name'];
                    $shopaddress = $row['shop_address'];
                    $profile = $row['shop_image'];
                    $shoptiming = $row['shop_timing'];
                    echo '<div class="col-md-4">
                    <div class="row-md-4 m-4">
                    <div class="card rounded-3">
                        <img src="https://source.unsplash.com/1600x900/?'. $cat .'" class="card-img-top rounded-3" alt="Oops">
                        <div class="card-body">
                            <h5 class="card-title">'. $shopname . '</h5>
                            <p class="card-text">' . $shopaddress . '</p>
                            <p class="card-text">Timing: ' . $shoptiming . '</p>
                            <a href="Item.php?shopid=' . $shopid . '" class="btn btn-primary">View Products</a>
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