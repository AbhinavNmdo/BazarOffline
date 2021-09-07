<?php
    session_start();
    session_unset();
    session_destroy();
    $login = false;
    header("location: Welcome.php")
?>