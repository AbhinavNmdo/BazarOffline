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
    <title>Welcome <?php echo $_SESSION['email'] ?></title>
</head>
<style>
.container
{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
}

.div {
    margin: 5px 50px;
}
</style>

<body>
    <?php
    require 'views/_navbar.php';
    require 'views/_dbconnect.php'
    ?>

    <div class="div">
        <div class="alert alert-success my-4" role="alert">
            <h4 class="alert-heading">Well done! <?php echo $_SESSION['email'] ?></h4>
            <p>Login Successfull</p>
        </div>
    </div>


    <!-- Cards -->
    <div class="container">        
    <?php
        $sql = "SELECT * FROM `categories`";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['cat_id'];
            $cat = $row['cat_name'];
            $desc = $row['cat_desc'];
            echo '<div class="row-md-4 m-4">
            <div class="card" style="width: 18rem;">
                <img src="https://source.unsplash.com/1600x900/?'. $cat .'" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">'. $cat . '</h5>
                    <p class="card-text">' . substr($desc, 0 , 100) . '...</p>
                    <a href="Categories.php?catid=' . $id . '" class="btn btn-primary">View ' . $cat . '</a>
                </div>
            </div>
        </div>';
        }
    ?>
    </div>
</body>

</html>