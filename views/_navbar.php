<?php
  if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)) {
  $loggin= true;
  }
  else{
  $loggin= false;
  }
  require "_dbconnect.php";

  echo '<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We"
      crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
      href="semantic/dist/semantic.min.css">
      <link rel="icon" href="favicon.ico" type="image/x-icon">

    <title>BazarOffline</title>
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
                placeholder="Enter Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
      <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
        crossorigin="anonymous"></script>
      <script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="crossorigin="anonymous"></script>
      <script src="semantic/dist/semantic.min.js"></script>
    </body>
  </html>';
  ?>