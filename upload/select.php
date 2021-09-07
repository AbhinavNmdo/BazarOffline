<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display</title>
</head>
<body>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "image";
    
        $conn = mysqli_connect($servername, $username, $password, $database);

        $sql = "SELECT * FROM `images`";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $image = $row['image'];
            echo '<div class="container">
            <img src="' . $row['image'] . '" style="width: 100px; height: 100px;">
        </div>';
            
        }
    ?>
    
</body>
</html>