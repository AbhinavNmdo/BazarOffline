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
.container1 {
    margin-left: 100px;
    display: flex;
    flex-wrap: wrap;
}

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
              echo '<h1 class="display-5 m-4"> ' . $shopname . ' </h1>';
            }
      
      ?>

    <?php
        $added = false;
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST'){
            $item_name = $_POST['item'];
            $item_desc = $_POST['desc'];
            $sql = "INSERT INTO `items` (`item_name`, `item_desc`, `catid_shop_items`) VALUES ('$item_name', '$item_desc', '$id')";
            $result = mysqli_query($conn, $sql);
            $added = true;
        }
    ?>
    <?php
      if ($added){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your Item added successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }

    ?>

    <div class="container1">
        <?php
            $id = $_GET['shopid'];
            $sql = "SELECT * FROM `items` WHERE `catid_shop_items`=$id";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $itemid = $row['item_id'];
                $itemname = $row['item_name'];
                $itemdesc = $row['item_desc'];
                echo '<div class="card mb-3 m-4" style="max-width: 540px;">
                <div class="row g-0">
                  <div class="col-md-4">
                    <img src="https://source.unsplash.com/600x600/?'. $itemname .'" class="img-fluid rounded-start" alt="...">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title">' . $itemname . '</h5>
                      <p class="card-text">' . $itemdesc . '</p>
                    </div>
                  </div>
                </div>
              </div>';
            }
        
        ?>
        <div class="card mb-3 m-4" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="https://source.unsplash.com/600x600/?shops,jewelery" class="img-fluid rounded-start"
                        alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">sadf</h5>
                        <p class="card-text">sadfasdf</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3 m-4" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="https://source.unsplash.com/600x600/?shops,jewelery" class="img-fluid rounded-start"
                        alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">asdfsadf</h5>
                        <p class="card-text">asdfsadfsfd</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-4" style="width: 500px;">
        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
            <div class="form-group">
                <label for="item">Item Name</label>
                <input type="text" class="form-control" id="item" name="item" aria-describedby="emailHelp"
                    placeholder="Item Name">
            </div>
            <div class="form-group my-4">
                <label for="desc">Description</label>
                <input type="textarea" class="form-control" id="desc" name="desc" placeholder="Description">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>