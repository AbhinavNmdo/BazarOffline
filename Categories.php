<!-- INSERT INTO `shops` (`shop_id`, `shop_name`, `shop_address`, `shop_zip`, `catsh_id`) VALUES ('1', 'Shiv Aurnaments', 'Near Ganesh Mandir, Sarafa road, Dixitpura, Jabalpur', '482002', '1'); -->

<?php
    session_start();
    $id = $_GET['catid'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Chettan+2:wght@500&display=swap" rel="stylesheet">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<style>
    *
    {
        font-family: 'Baloo Chettan 2', cursive;
        scroll-behavior: smooth;
    }

    #heading
    {
        display: flex;
        justify-content: center;
        align-items: center;
    }

</style>
<body>
    <?php
        require "views/_dbconnect.php";   
        require "views/_navbar.php";
    ?>



    <div class="container my-4">
        <?php
            $collection = $db->categories;
            $category = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($id)]);
            echo '<div id="heading">
            <h2 style="margin: 20px;">Category: '. $category['name'] .'</h2>
            </div>';
        ?>
    </div>


    <div class="container">
        <div class="row">
            <?php
                $collection = $db->shopkeeper;
                $shops = $collection->find(['category' => $id]);
                $count = $collection->count($shops);
                echo $count;
                if ($count != 0){
                    foreach ($shops as $shop) {
                        $data = base64_encode($shop->Image->getData());
                        echo '<div class="col-md-4">
                        <div class="row-md-4 m-4">
                        <div class="card" style="height: auto; border-radius: 15px;">
                            <img src="data:jpeg;base64,'. $data .'" class="card-img-top" alt="Oops" style="border-radius: 15px;">
                            <div class="card-body">
                                <h5 class="card-title">'. $shop['ShopName'] . '</h5>
                                <p class="card-text">' . $shop['Address'] . '</p>
                                <p class="card-text">Timing: ' . $shop['Timing'] . '</p>
                                <a href="Item.php?shopid=' . $shop['_id'] . '" class="btn btn-primary">View Products</a>
                            </div>
                        </div>
                        </div>
                        </div>';
                        $count = 0;
                    }
                }
                else{
                    echo '<div class="alert alert-info" role="alert">
                    <h4 class="alert-heading">Well done!</h4>
                    <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                    <hr>
                    <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
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