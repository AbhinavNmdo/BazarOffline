<!-- INSERT INTO `shops` (`shop_id`, `shop_name`, `shop_address`, `shop_zip`, `catsh_id`) VALUES ('1', 'Shiv Aurnaments', 'Near Ganesh Mandir, Sarafa road, Dixitpura, Jabalpur', '482002', '1'); -->

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
                $id = $_GET['catid'];
                $sql = "SELECT * FROM `shops` WHERE `catid_shop` = $id";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $shopid = $row['shop_id'];
                    $shopname = $row['shop_name'];
                    $shopaddress = $row['shop_address'];
                    echo '<div class="col-md-6">
                    <div class="card mb-3 m-4">
                    <div class="row g-0">
                    <div class="col-md-4">
                        <img src="https://source.unsplash.com/600x715/?shops,jewelery" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                        <h5 class="card-title">' . $shopname . '</h5>
                        <p class="card-text">' . $shopaddress . '</p>
                        </div>
                        <a class="btn btn-primary mx-3 my-4" href="Item.php?shopid=' . $shopid .'">View Products</a>
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