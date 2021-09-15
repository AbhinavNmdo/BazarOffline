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
    <link rel="stylesheet" href="views/_Welcomestyle.css">
    <link rel="stylesheet" media="screen and (max-width: 1100px)" href="views/_phone.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Chettan+2:wght@500&display=swap" rel="stylesheet">
</head>
<style>
.div {
    margin: 5px 50px;
}

#radius {
    border-radius: 15px;
}
#popupmain  
{
    position: fixed;
    height: 100%;
    width: 100%;
    background-color: rgba(68, 68, 68, 0.5);
    z-index: 1001;
}

#popup
{
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
</style>
<!-- onload="loadingfunc()" -->
<body>
    <!-- <div id="loading"></div> -->
    <div id="popupmain" style="display: none;">
        <div id="popup">
            <h2 align="center" id="heading">।। श्री गणेशाय नमः ।।</h2>
            <img src="Images/ganeshji.jpeg" alt="">
            <button class="btn btn-primary sametoyou" style="margin-top: 20px;">जय हो</button>
            <p align="center">Click this button to dismiss.</p>
        </div>
    </div>
    <?php
    require 'views/_dbconnect.php';
    require 'views/_navbar.php';
    ?>
    <div id="header">
        <div id="header2">
            <h2 class="bazar">Welcome to BazarOffline.</h2>
            <p class="bazar2">You can find shops and products near you.</p>
        </div>
    </div>

    <div id="heading1">
        <h2>Category</h2>
    </div>

    <!-- <div class="container my-4">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Welcome!</h4>
            <p>If you want the people in your local area to avail your services or use your products then you must focus on offline marketing. It gives you a wonderful opportunity to establish a good relationship with the people. This will increase customer loyalty.</p>
        </div>
    </div> -->


    <!-- Cards -->
    <div class="container">
        <div class="row">
            <?php
                    $collection = $db->categories;
                    $category = $collection->find();
                    foreach($category as $cat){
                        $desc = $cat['cat_desc'];
                        echo '<div class="col-md-4">
                        <div class="row-md-4 m-4">
                        <div class="card" style="height: 370px; border-radius: 15px;">
                            <img src="https://source.unsplash.com/1600x900/?'. $cat['cat_name'] .'" class="card-img-top" alt="Oops" style="border-radius: 15px;">
                            <div class="card-body">
                                <h5 class="card-title">'. $cat['cat_name'] . '</h5>
                                <p class="card-text">' . substr($desc, 0, 90) . '...</p>
                                <a href="Categories.php?catid=' . $cat['_id'] . '" class="btn btn-primary">View ' . $cat['cat_name'] . '</a>
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
<script>
    $(document).ready(function(){
        setTimeout(function(){
            $('#popupmain').css('display', 'block');
        }, 4000);
    });
    $('.sametoyou').click(function(){
        $('#popupmain').css('display', 'none');
    });

    // var preloader = document.getElementById('loading');
    // function loadingfunc(){
    //     preloader.style.display = 'none';
    // }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
</script>

</html>