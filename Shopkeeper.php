<?php
session_start();
?>
<?php
require "views/_dbconnect.php";
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "POST") {
    $ids = $_GET['shopids'];
    $sql12 = "SELECT * FROM `shopkeeper` WHERE `shop_id` = $ids";
    $result12 = mysqli_query($conn, $sql12);
    while ($row = mysqli_fetch_assoc($result12)) {
        $shopzip = $row['shop_zip'];
        $itemname = $_POST['itemname'];
        $itemdesc = $_POST['itemdesc'];
        $sql = "INSERT INTO `items`(`item_name`, `item_desc`, `itemshop_id`, `item_zip`) VALUES ('$itemname','$itemdesc','$ids','$shopzip')";
        $result = mysqli_query($conn, $sql);
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
</head>

<body>
    <?php
    require "views/_dbconnect.php";
    require "views/_navbar.php";
    ?>
    <div class="container">
        <?php
        $get = $_GET['shopids'];
        $sql = "SELECT * FROM `shopkeeper` WHERE `shop_id` = $get";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $shopname = $row['shop_name'];
            echo '<h2 class="m-4">' . $shopname . '</h2>';
        }
        ?>
    </div>

    <?php
    // $user = $_GET['shopids'];
    $sql = "SELECT * FROM `shopkeeper` WHERE `shop_id` = '$get'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $active = $row['shop_username'];
        if ($_SESSION['username'] != $active) {
            header("location: Logout.php");
            header("location: Login.php");
        }
    }
    ?>

    <div class="container">
        <div class="row">
            <?php
            // $getid = $_GET['shopids'];
            $sql = "SELECT * FROM `items` WHERE `itemshop_id` = $get";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $itemname = $row['item_name'];
                $itemdesc = $row['item_desc'];
                $itemid = $row['item_id'];
                echo '<div class="col-md-4">
                    <div class="row-md-4 m-4">
                    <div class="card" style="width: 18rem;">
                        <img src="https://source.unsplash.com/1600x900/?market" class="card-img-top" alt="...">
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

    <div class="container">
        <form action="<?php $_SERVER['REQUEST_URI'] ?>" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Item Name</label>
                <input type="text" class="form-control" id="itemname" aria-describedby="emailHelp" name="itemname">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Description</label>
                <input type="text" class="form-control" id="desc" name="itemdesc">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="container">
        <?php
            require "views/_footer.php"
        ?>
    </div>
</body>

</html>