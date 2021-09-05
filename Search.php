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

  #heading1122 {
    display: flex;
    justify-content: left;
    margin: 50px 0px;
    margin-left: 10px;
    align-items: center;
    font-size: 20px;
    padding: 0%;
  }
</style>

<body>
  <?php
  require("views/_dbconnect.php");
  require("views/_navbar.php")
  ?>
  <div class="container">
    <div class="row">
      <?php
      $search = $_GET['search'];
      $sql32 = "SELECT * FROM `shopkeeper` WHERE MATCH (`shop_name`, `shop_zip`, `shop_address`, `shop_owner`) against ('$search')";
      $result32 = mysqli_query($conn, $sql32);
      echo '<h2 id="heading1122">You Searched for "' . $search . '"</h2>';
      while ($row = mysqli_fetch_assoc($result32)) {
        $shoppin = $row['shop_zip'];
        $shopname = $row['shop_name'];
        $shopid = $row['shop_id'];
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
            <a class="btn btn-primary mx-3 my-4" href="Item.php?shopid=' . $shopid . '">View Products</a>
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