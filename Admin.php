<?php
$exist = false;
require "views/_dbconnect.php";
    if (isset($_POST['shopsubmit'])){
        $shopname = $_POST['nameofshop'];
        $ownername = $_POST['nameofowner'];
        $shopaddress = $_POST['address'];
        $shopemail = $_POST['email'];
        $username11 = $_POST['username11'];
        $pass = $_POST['password'];
        $cpass = $_POST['cpassword'];
        $category = $_POST['select'];
        $zip = $_POST['zip'];
        // Image
        $terget = basename($_FILES['profile']['name']);
        $img = $_FILES['profile']['name'];
        $tmp_name = $_FILES['profile']['tmp_name'];
        $sql1 = "SELECT * FROM `shopkeeper` WHERE `shop_username` = '$username'";
        $result1 = mysqli_query($conn, $sql1);
        $num = mysqli_num_rows($result1);
        if ($num==0){
            $sql = "INSERT INTO `shopkeeper`(`catshop_id`, `shop_name`, `shop_owner`, `shop_username`, `shop_email`, `shop_address`, `shop_password`, `shop_cpassword`, `shop_zip`, `shop_image`) VALUES ('$category','$shopname','$ownername','$username','$shopemail','$shopaddress','$pass','$cpass','$zip', '$img')";
            $result = mysqli_query($conn, $sql);
            if (move_uploaded_file($tmp_name, $target)){
                echo "Uploaded Successfully";
            }
            else {
                echo "Failed";
            }
        }
        else{
            $exist = true;
        }

        
    }
    if (isset($_POST['catsubmit'])){
        $catname = $_POST['catname'];
        $catdesc = $_POST['catdesc'];
        $sql = "INSERT INTO `categories`(`cat_name`, `cat_desc`) VALUES ('$catname','$catdesc')";
        $result = mysqli_query($conn, $sql);
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome! Admin</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <?php
        
        require "views/_navbar.php";
    ?>
    <?php
        if($exist){
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Failed!</strong> User already exist.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }

    ?>



    <div class="container" id="form">
        <div class="row">
            <!-- Category Add -->
            <div class="col-md-4">
                <div class="card rounded-3 m-4">
                    <h2 style="margin: 20px;" align="center">Category Addition</h2>
                    <form class="m-4" action="Admin.php" method="POST">
                        <div class="mb-3">
                            <label for="catname" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="catname" name="catname">
                        </div>
                        <div class="mb-3">
                            <label for="catdesc" class="form-label">Category Description</label>
                            <input type="text" class="form-control" id="catdesc" name="catdesc">
                        </div>
                        <button type="submit" name="catsubmit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <!-- Shopkeeper Registration -->
            <div class="col-md-4">
                <div class="card rounded-3 m-4">
                    <h2 style="margin: 20px;" align="center" class="m-4">Shopkeeper Registration</h2>
                    <form class="m-4" action="<?php $_SERVER['REQUEST_URI'] ?>" method="POST">
                        <div class="mb-3">
                            <label for="nameofowner" class="form-label">Name Of Owner</label>
                            <input type="text" class="form-control" id="nameofowner" name="nameofowner">
                        </div>
                        <div class="mb-3">
                            <label for="nameofshop" class="form-label">Name of shop</label>
                            <input type="text" class="form-control" id="nameofshop" name="nameofshop">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Shop Address</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="username11" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username11" name="username11">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="cpassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="cpassword" name="cpassword">
                        </div>
                        <div class="mb-3">
                            <label for="zip" class="form-label">Shop Zip</label>
                            <input type="text" class="form-control" id="zip" name="zip">
                        </div>
                        <div class="mb-3">
                            <label for="profile" class="form-label">Choose Profile</label>
                            <input type="file" class="form-control" id="profile" name="profile">
                        </div>
                        <div class="mb-3">
                            <label for="timing" class="form-label">Timing</label>
                            <input type="text" class="form-control" id="timing" name="timing">
                        </div>
                        <div class="mb-3">
                            <label for="select" class="form-label">Select Category</label>
                            <select name="select" id="select" class="form-control">
                                <?php
                                        $sql = "SELECT * FROM `categories`";
                                        $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($result)){
                                        $id = $row['cat_id'];
                                        $categories = $row['cat_name'];
                                        echo '<option value="'.$id.'">'.$categories.'</option>';
                                        }
                                    ?>
                            </select>
                        </div>
                        <button type="submit" name="shopsubmit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>





</body>
<script>
function getvalue() {
    var cvalue = document.getElementsByName("select").value;
    console.log("cvalue");
}
</script>

</html>