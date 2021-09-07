<?php
  if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)) {
    $loggin = true;
  }
  else{
    $loggin = false;
  }
  
  echo '<!doctype html>
  <html lang="en">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  
      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
  
      <title>BazarOffline</title>
    </head>
    <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <img src="Images/logo.png" alt="" style="width: 70px; margin-right: 10px;">
      <a class="navbar-brand" href="index.html" style="font-size: 25px;">BazarOffline</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="Welcome.php">Home</a>
          </li>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';

          $sqllli = "SELECT * FROM `categories`";
          $resultlli = mysqli_query($conn, $sqllli);
          while ($row = mysqli_fetch_assoc($resultlli)){
            $id = $row['cat_id'];
            $categories = $row['cat_name'];
            echo '<li><a class="dropdown-item" href="Categories.php?catid=' . $id . '">'. $categories .'</a></li>';
          }

          echo '</ul>';
          
          if (!$loggin) {
            echo '<li class="nav-item">
              <a class="nav-link" href="Login.php">Shop Login</a>
            </li>';
          }
          
          if($loggin){
            echo '<li class="nav-item">
              <a class="nav-link" href="Logout.php">Logout</a>
            </li>';
            
            echo '<li class="nav-item">
              <a class="nav-link">Welcome! ' . $_SESSION['username']  . '</a>
            </li>';
          }
        echo  '</ul>
        <form class="d-flex" action="Search.php" method="GET">
          <input class="form-control me-2" type="search" name= "search" placeholder="Enter Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
  <script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
  <script src="semantic/dist/semantic.min.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script> -->
  </body>
</html>';


?>