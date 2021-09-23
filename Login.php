<?php
    $login = false;
    $err = false;
    $emailnotexist = false;
    $adminlogin = false;
    require "views/_dbconnect.php";
    if (isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if(!empty($username and !empty($password))){
            $collection = $db->shopkeeper;
            $check = $collection->findOne(['Username' => $username]);
            if($check['Password'] == $password){
                $login = true;
                session_start();
                $shopid = $check['_id'];
                $ownername = $check['OwnerName'];
                $_SESSION['ownername'] = $check['OwnerName'];
                $_SESSION['shopzip'] = $check['Zip'];
                $_SESSION['shopid'] = $shopid;
                $_SESSION['username'] = $check['Username'];
                $_SESSION['loggedin'] = true;
                header("location: Shopkeeper.php?shopids=$shopid");
            }
            else if(isset($_POST['login'])){
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    if($username == "admin1122"){
                        if($password == "admin1122"){
                            session_start();
                            $adminlogin = true;
                            $_SESSION['admin'] = true;
                            header("location: Admin.php");
                        }
                    }
            }
            else{
                $err = true;
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Chettan+2:wght@500&display=swap" rel="stylesheet">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<style>
    *
    {
        font-family: 'Baloo Chettan 2', cursive;
        scroll-behavior: smooth;
    }

#div {
    width: 300px;
}
</style>

<body>
    <?php
        require 'views/_navbar.php';
    ?>
    <?php
        if ($login) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Loggid in Successfully!</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
        }
        if ($err) {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Incorrect Password!</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
        }
        if ($emailnotexist) {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>User does not exist!</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
        }

    ?>
    <h1 align="center" class="my-4">Login Here</h1>
    <div class="container my-4" id="div">
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
</body>

</html>