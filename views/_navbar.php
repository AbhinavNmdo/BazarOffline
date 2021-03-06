<?php
  if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)) {
  $loggin= true;
  }
  else{
  $loggin= false;
  }
  require "_dbconnect.php";

  echo '<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
    <link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <img src="Images/logo.png" alt="" style="width: 70px; margin-right:
          10px;">
        <a class="navbar-brand" href="index.php" style="font-size: 25px;">BazarOffline</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" onclick="logout()" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="About.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="Contact.php">Feedback</a>
            </li>';

              if (!$loggin) {
              echo '<li class="nav-item">
                <a class="nav-link active" aria-current="page" href="Login.php">Shop Login</a>
                </li>';
              }

              if(isset($_SESSION['admin'])){
                echo '<li class="nav-item">
                <a class="btn btn-danger" aria-current="page" href="Logout.php">Admin Logout</a>
              </li>';
              }

              if($loggin){
              echo '<li class="nav-item">
                <a class="btn btn-danger" aria-current="page" href="Logout.php">Logout</a>
              </li>';
              
              echo '<li class="nav-item">
                <a aria-current="page" href="Shopkeeper.php?shopids='. $_SESSION['shopid'] .'" class="btn btn-outline-secondary" style="margin-top: 2px; margin-left: 8px;">Profile: '. $_SESSION['ownername'] .'</a>
              </li>';
              }
              echo '</ul>
            <form class="d-flex" action="Search.php" method="GET">
              <input class="form-control me-2" type="search" name="search"
                placeholder="Enter Search" aria-label="Search" disabled>
              <button class="btn btn-outline-success" type="submit" disabled>Search</button>
            </form>
          </div>
        </div>
      </nav>
  
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://unpkg.com/dropzone"></script>
		<script src="https://unpkg.com/cropperjs"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  </html>
      ';
  ?>