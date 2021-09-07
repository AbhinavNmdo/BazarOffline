<?php
    session_start();
    $shopkeeperid = $_GET['shopkeeperid'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>

<body>
    <?php
        require "views/_dbconnect.php";
        require "views/_navbar.php";
    ?>

    <!-- Security for Shopkeepers -->
    <?php
        $sqlforcheck = "SELECT * FROM `shopkeeper` WHERE `shop_id` = $shopkeeperid";
        $resultforcheck = mysqli_query($conn, $sqlforcheck);
        while ($row = mysqli_fetch_assoc($resultforcheck)){
            $username = $row['shop_username'];
            if ($_SESSION['username'] != $username){
                header("location: Logout.php");
                header("location: Login.php");
            }
        }


    ?>


    <!-- Insert Item form -->
    <div class="container" id="form">
        <div class="row">
            <div class="col-md-4 m-4">
                <div class="card rounded-3">
                    <h2 style="margin-top: 20px;" align="center">Add Items</h2>
                    <form class="m-4" action="<?php "Shopkeeper.php?shopids='. $shopkeeperid .'" ?>" method="POST">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Item Name</label>
                            <input type="text" class="form-control" id="itemname" aria-describedby="emailHelp"
                                name="itemname">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Description</label>
                            <input type="textarea" class="form-control" id="desc" name="itemdesc">
                        </div>
                        <button type="submit" name="add" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-md-4 m-4">
                <div class="card rounded-3">
                    <h2 style="margin-top: 20px;" align="center">Update Profile Pic</h2>
                    <form class="m-4" action="<?php "Shopkeeper.php?shopids='. $shopkeeperid .'" ?>" method="POST"
                        enctype="multipart/form-data">
                        <div class="res">
                            <div class="mb-3">
                                <label for="profile" class="form-label">Update Your Profile</label>
                                <input type="file" class="form-control" name="profile" id="profile">
                            </div>
                            <div class="mb-3">
                                <input type="submit" name="upload" class="btn btn-primary" id="upload">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>