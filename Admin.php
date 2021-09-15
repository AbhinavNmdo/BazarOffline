<?php
ob_start();
session_start();
if(!isset($_SESSION['admin'])){
    header("location: Login.php");
}
use MongoDB\Operation\FindOne;

$exist = false;
$done = false;
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
        $shoptiming = $_POST['timing'];
        $maplink = $_POST['map'];
        $mobileno = $_POST['mobile'];
        
        if(!empty($username11) and !empty($shopemail) and !empty($pass)){
            $collection = $db->shopkeeper;
            $document = array(
                "ShopName" => "$shopname",
                "OwnerName" => "$ownername",
                "Address" => "$shopaddress",
                "E-mail" => "$shopemail",
                "Username" => "$username11",
                "Password" => "$pass",
                "C-Password" => "$cpass",
                "category" => "$category",
                "Zip" => "$zip",
                "Timing" => "$shoptiming",
                "Map" => "$maplink",
                "Mobile" => "$mobileno",
                "Image" => "",
                "AgentCode" => ""
            );
            $result = $collection->insertOne($document);
            if ($result){
                $done = true;
            }
            else{
                $exist = true;
            }
        }
        else{
            $exist = true;
            // echo error_log($result);
        }

        
    }

    if (isset($_POST['catsubmit'])){
        $catname = $_POST['catname'];
        $catdesc = $_POST['catdesc'];
        if(!empty($catname) or !empty($catdesc)){
            $collection = $db->categories;
            $document = array(
                "cat_name" => "$catname", 
                "cat_desc" => "$catdesc"
            );
            $result = $collection->insertOne($document);
            if ($result){
                $done = true;
            }
            else{
                $exist = true;
            }
            
        }
        else{
            $exist = true;
        }
    }

    if(isset($_POST['agentsubmit'])){
        $agentname = $_POST['agent_name'];
        $agentusername = $_POST['agent_username'];
        $agentemail = $_POST['agent_email'];
        $agentaddress = $_POST['agent_address'];
        $agentmobile = $_POST['agent_mobile'];
        $agentpass = $_POST['agent_password'];
        $agentcpass = $_POST['agent_cpassword'];

        if(!empty($agentusername)){
            $collection = $db->agent;
            $document = array(
                "Name" => "$agentname",
                "Username" => "$agentusername",
                "E-mail" => "$agentemail",
                "Address" => "$agentaddress",
                "Mobile" => "$agentmobile",
                "Password" => "$agentpass",
                "C-Password" => "$agentcpass"
            );
            $result = $collection->insertOne($document);
            if ($result){
                $done = true;
            }
            else{
                $exist = true;
            }
        }
        else{
            $exist = true;
        }
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
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Chettan+2:wght@500&display=swap" rel="stylesheet">
</head>
<style>
    *
    {
        font-family: 'Baloo Chettan 2', cursive;
        scroll-behavior: smooth;
    }

</style>

<body>
    <?php
        
        require "views/_navbar.php";
    ?>
    <?php
        if($exist){
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Failed!</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
        if($done){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Successfully Inserted!</strong>
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
                            <input type="textarea" class="form-control" id="username11" name="username11">
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
                            <label for="mobile" class="form-label">Mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile">
                        </div>
                        <div class="mb-3">
                            <label for="zip" class="form-label">Shop Zip</label>
                            <input type="text" class="form-control" id="zip" name="zip">
                        </div>
                        <div class="mb-3">
                            <label for="map" class="form-label">Paste Map link</label>
                            <input type="text" class="form-control" id="map" name="map">
                        </div>
                        <div class="mb-3">
                            <label for="timing" class="form-label">Timing</label>
                            <input type="text" class="form-control" id="timing" name="timing">
                        </div>
                        <div class="mb-3">
                            <label for="select" class="form-label">Select Category</label>
                            <select name="select" id="select" class="form-control">
                                <?php
                                        $collection = $db->categories;
                                        $category = $collection->find();
                                        foreach($category as $cat){
                                            echo '<option value="'.$cat['_id'].'">'.$cat['cat_name'].'</option>';
                                        }
                                ?>
                            </select>
                        </div>
                        <button type="submit" name="shopsubmit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card rounded-3 m-4">
                    <h2 style="margin: 20px;" align="center" class="m-4">Agent Registration</h2>
                    <form class="m-4" action="<?php $_SERVER['REQUEST_URI'] ?>" method="POST">
                        <div class="mb-3">
                            <label for="agent_name" class="form-label">Agent Name</label>
                            <input type="text" class="form-control" id="agent_name" name="agent_name">
                        </div>
                        <div class="mb-3">
                            <label for="agent_username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="agent_username" name="agent_username">
                        </div>
                        <div class="mb-3">
                            <label for="agent_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="agent_email" name="agent_email">
                        </div>
                        <div class="mb-3">
                            <label for="agent_address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="agent_address" name="agent_address">
                        </div>
                        <div class="mb-3">
                            <label for="agent_mobile" class="form-label">Mobile</label>
                            <input type="text" class="form-control" id="agent_mobile" name="agent_mobile">
                        </div>
                        <div class="mb-3">
                            <label for="agent_password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="agent_password" name="agent_password">
                        </div>
                        <div class="mb-3">
                            <label for="agent_cpassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="agent_cpassword" name="agent_cpassword">
                        </div>
                        <button class="btn btn-primary" type="submit" name="agentsubmit">Submit</button>
                    </form>
                </div>    
            </div>    
        </div>
    </div>
<div class="container m-4">
    <a href="Logout.php" class="btn btn-danger m-4">Logout</a>
</div>




</body>
<script>
function getvalue() {
    var cvalue = document.getElementsByName("select").value;
    console.log("cvalue");
}


</script>

</html>