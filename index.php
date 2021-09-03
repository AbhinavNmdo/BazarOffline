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
</head>
<style>
.div {
    margin: 5px 50px;
}

#radius {
    border-radius: 15px;
}
</style>

<body>
    <?php
    require 'views/_dbconnect.php';
    require 'views/_navbar.php';
    ?>

    <div class="container my-4">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Welcome!</h4>
            <p>If you want the people in your local area to avail your services or use your products then you must focus on offline marketing. It gives you a wonderful opportunity to establish a good relationship with the people. This will increase customer loyalty.</p>
        </div>
    </div>


    <!-- Cards -->
    <div class="container">
        <div class="row">
            <?php
                    $sql = "SELECT * FROM `categories`";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['cat_id'];
                        $cat = $row['cat_name'];
                        $desc = $row['cat_desc'];
                        echo '<div class="col-md-4">
                        <div class="row-md-4 m-4">
                        <div class="card" style="width: 18rem;">
                            <img src="https://source.unsplash.com/1600x900/?'. $cat .'" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">'. $cat . '</h5>
                                <p class="card-text">' . substr($desc, 0 , 80) . '...</p>
                                <a href="Categories.php?catid=' . $id . '" class="btn btn-primary">View ' . $cat . '</a>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
</script>

</html>