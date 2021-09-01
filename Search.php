<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    
</head>
<style>
    #container1 {
        margin-left: 100px;
        display: flex;
        flex-wrap: wrap;
        
    }
    #heading1122
    {
        margin-left: 150px;
        margin-top: 40px;
        font-size: 20px;
    }
    </style>
<body>
    <?php
        require ("views/_dbconnect.php");
        require ("views/_navbar.php")
    ?>


    
        <?php
            $search = $_GET['search'];
            $sql = "SELECT * FROM `shops` WHERE MATCH (`shop_name`, `shop_zip`, `shop_address`) against ('$search')";
            $result = mysqli_query($conn, $sql);
            echo '<p id="heading1122">You Searched for "'. $search .'"</p>';
            while ($row = mysqli_fetch_assoc($result)){
                $shoppin = $row['shop_zip'];
                $shopname = $row['shop_name'];
                $shopid = $row['shop_id'];
                $shopaddress = $row['shop_address'];
                echo '<div id="container1">
                <div class="card mb-3 m-4" style="max-width: 540px;">
                <div class="row g-0">
                  <div class="col-md-4">
                    <img src="https://source.unsplash.com/600x600/?shops,jewelery" class="img-fluid rounded-start" alt="...">
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


    
</body>
</html>