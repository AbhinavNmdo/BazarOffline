<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "image";

    $conn = mysqli_connect($servername, $username, $password, $database);

    if (isset($_FILES['image'])){
        $filename = $_FILES['image']['name'];
        $filetmp = $_FILES['image']['tmp_name'];

        $sql = "INSERT INTO `images` (`image`) VALUES ('$filename')";
        $result = mysqli_query($conn, $sql);
        move_uploaded_file($filetmp, $result);
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
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="image">
        <input type="submit">
    </form>
</body>
</html>