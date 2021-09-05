<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "image";

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (isset($_POST)){
        echo "<pre>", print_r($_FILES['profileImage']['name']);
        $img = $_FILES['profileImage']['tmp_name'];
        $sql = "INSERT INTO `images`(`image`) VALUES ('$img')";
        $result = mysqli_query($conn, $sql);
        if (move_uploaded_file($img, $result)){
            echo "Uploaded Successfully";
        }
        else {
            echo "Failed";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image</title>
</head>
<body>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="profileImage" id="profileImage">
        <input type="submit">
    </form>
</body>
</html>