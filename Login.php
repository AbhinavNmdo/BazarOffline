<?php
    $login = false;
    $err = false;
    $emailnotexist = false;
    require "views/_dbconnect.php";
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $pincode = 
        // $sql = "SELECT * FROM `agent` WHERE name = '$email' AND password = '$password'";
        $sql = "SELECT * FROM `agent` WHERE name = '$email'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if($num == 1){
            while ($row = mysqli_fetch_assoc($result)) {
                if (password_verify($password, $row['password'])) {
                    $login = true;
                    session_start();
                    $_SESSION['email'] = $email;
                    $_SESSION['loggedin'] = true;
                    header("location: Welcome.php");
                    
                }
                else{
                    $err = true;
                }
            }
        }
        else {
            $emailnotexist = true;
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
</head>
<style>
#div {
    width: 500px;
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
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="email">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>

</html>