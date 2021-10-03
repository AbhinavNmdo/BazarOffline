<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>Welcome</title>
    <link rel="stylesheet" href="views/Welcomestyle.css">
    <link rel="stylesheet" media="screen and (max-width: 1100px)" href="views/_phonestyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Chettan+2:wght@500&display=swap" rel="stylesheet">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link href="css/hover-min.css" rel="stylesheet">
</head>
<style>
.div {
    margin: 5px 50px;
}

#radius {
    border-radius: 15px;
}

#popupmain {
    position: fixed;
    height: 100%;
    width: 100%;
    background-color: rgba(68, 68, 68, 0.5);
    z-index: 1001;
}

#popup {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    border-radius: 20px;
    height: auto;
    width: 325px;
    background-color: white;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 20px;

}
.button{
    padding: 8px;
    background-color: blue;
    border-radius: 15px;
    text-decoration: none;
}
</style>

<body onload="loadingfunc()">
    <div id="loading"></div>
    <!-- <div id="popupmain" style="display: none;">
        <div id="popup">
            <h2 align="center" id="heading">।। श्री गणेशाय नमः ।।</h2>
            <img src="Images/ganeshji.jpeg" alt="">
            <button class="btn btn-primary sametoyou" style="margin-top: 20px;">जय हो</button>
            <p align="center">Click this button to dismiss.</p>
        </div>
    </div> -->
    <?php
        require 'views/_dbconnect.php';
        require 'views/_navbar.php';
    ?>
    <div id="header">
        <div id="header2" data-aos="fade-right" data-aos-duration="900">
            <h2>Welcome to <strong id="title" style="font-size: 3rem;"> BazarOffline</strong></h2>
            <p>You can find shops and products near you.</p>
        </div>
    </div>
    

    <div id="heading1">
        <h2>Categories</h2>
    </div>

    <!-- Cards -->
    <div class="container">
        <div class="row">
            <?php
                    $collection = $db->categories;
                    $category = $collection->find();
                    foreach($category as $cat){
                        $data = base64_encode($cat->image->getData());
                        $desc = $cat['description'];
                        echo '<div class="col-md-4" data-aos="zoom-in" data-aos-offset="130">
                        <div class="row-md-4 m-4">
                        <div class="card" style="height: auto; border-radius: 15px;">
                            <img class="card-img-top" src="data:jpeg;base64,'. $data .'" alt="Oops" style="border-radius: 15px;" id="catImage">
                            <div class="card-body">
                                <h5 align="center" class="card-title">'. $cat['name'] . '</h5>
                                <!-- <p class="card-text">' . substr($desc, 0, 90) . '...</p> -->
                                <a href="Categories.php?catid=' . $cat['_id'] . '" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                    </div>
                    ';
                    }
                ?>
        </div>
    </div>
    <div class="container">
        <?php
            require "views/_footer.php"
        ?>
    </div>

<!--Login Modal -->
<div class="modal fade" id="login" tabindex="-1" aria-labelledby="loginLabel" aria-hidden="true" style="border-radius: 15px;">
  <div class="modal-dialog" style="border-radius: 15px;">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="modal-title" id="loginLabel">Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="Login.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password">
                <span>
                    <i class="fa fa-eye" aria-hidden="true" id="eye" onclick="toggle()"></i>
                </span>
            </div>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"></button>
      </div>
    </div>
  </div>
</div>
</body>
<script>
// $(document).ready(function() {
//     setTimeout(function() {
//         $('#popupmain').css('display', 'block');
//     }, 4000);
// });
// $('.sametoyou').click(function() {
//     $('#popupmain').css('display', 'none');
// });

var preloader = document.getElementById('loading');

function loadingfunc() {
    preloader.style.display = 'none';
}

function error() {
    let image = document.getElementById('catImage');
    image.setAttribute('src', "Images/catPlace.png");
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
</script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
  AOS.init();
</script>


</html>