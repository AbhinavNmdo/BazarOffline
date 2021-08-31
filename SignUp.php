<?php
$successAlert = false;
$passerror = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    require 'views/_dbconnect.php';
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Checking the user is exist or not
    $sql = "SELECT * FROM `agent` WHERE `name`='$email'";
    $result1 = mysqli_query($conn, $sql);
    $numexists = mysqli_num_rows($result1);
    if ($numexists > 0) {
        $exist = true;
        $error = mysqli_error($conn);
        echo $error;
    }
    else{
        $exist = false;
        $error = mysqli_error($conn);
        echo $error;
    }
    if (($password == $cpassword) && $exist == false){
        $hash = password_hash($password , PASSWORD_DEFAULT);
        $sql = "INSERT INTO `agent` (`name`, `password`, `cpassword`) VALUES ('$email', '$hash', '$cpassword')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $successAlert = true;
        }
    }
    else {
        $passerror = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
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
    if ($successAlert) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Congrats..
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    if ($passerror) {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Failed!</strong> Password not matching or Email already exist.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    
    ?>

    <h1 align="center" class="my-4">SignUp Here</h1>
    <div class="container my-4" id="div">
        <form action="/learnPHP/FullyFunctioningLogin/SignUp.php" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="email">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="cpassword" id="cpassword">
            </div>
            <button type="submit" class="btn btn-primary">SignUp</button>
        </form>
    </div>
</body>

</html>