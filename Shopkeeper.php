<?php
ob_start();
session_start();
$id = $_GET['shopids'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopkeeper</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Chettan+2:wght@500&display=swap" rel="stylesheet">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <style>
    *
    {
        font-family: 'Baloo Chettan 2', cursive;
        scroll-behavior: smooth;
    }
  
    .responsive {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    #form {
        width: 300px;
    }

    .res {
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
    ?>

    <!-- Profile for Shopkeepers -->
    <div class="container">
        <?php
        $collection = $db->shopkeeper;
        $profile = $collection->findOne(['_id' => $_SESSION['shopid']]);
        $data = base64_encode($profile->Image->getData());
            echo '<div class="container responsive">
            <div class="col-lg-4 m-4 responsive">
            <img class="bd-placeholder-img rounded-circle responsive" src="data:jpeg;base64,'.$data.'" alt="" width="auto" height="200px">
            <h2 style="margin-top: 15px;">' . $profile['ShopName'] . '</h2>
            <p style="text-align: center;">' . $profile['Address'].', '. $profile['Zip'] . '</p>
            <p class="card-text">Shop Timing : '. $profile['Timing'] . '</p>
            <hr>
            <a href="Profile.php?shopkeeperid='. $id .'" class="btn btn-info">Update Profile / Add Items</a>
            <br>
            </div>
            </div>
            <hr>
            <h2 style="margin: 40px;" align="center">Products Available</h2>';
        ?>
    </div>

    <!-- Security for shopkeepers -->
    <?php
    $collection = $db->shopkeeper;
    $user = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($id)]);
    $active = $user['Username'];
    if ($_SESSION['username'] != $active) {
        header("location: Logout.php");
    }
    elseif($id != $_SESSION['shopid']){
        header("location: Logout.php");
    }
    // Making more stable security
    ?>


    <!-- Displaying items -->
    <div class="container">
        <div class="row">
            <?php
            $collection = $db->items;
            $items = $collection->find(['shop_id' => $id]);
            foreach($items as $item){
                $desc = $item['description'];
                $data = base64_encode($item->image->getData());
                echo '<div class="col-md-4">
                    <div class="row-md-4 m-4">
                    <div class="card" style="height: auto; border-radius: 15px;">
                        <img src="data:jpeg;base64,'. $data .'" class="card-img-top" alt="..." style="border-radius: 15px;">
                        <div class="card-body">
                            <h5 class="card-title">' . $item['name'] . '</h5>
                            <p class="card-text">' . substr($desc, 0, 100) . '</p>
                            <a class="btn btn-danger" href="DeleteItem.php?itemid='. $item['_id'] .'">Delete Item</a>
                        </form>
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