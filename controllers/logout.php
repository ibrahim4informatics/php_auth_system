<?php
    require_once __DIR__ . "/../includes/Config.php";
    use conf\Config;


    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        unset($_SESSION['user']);
        header("Location:". Config::get_host() ."/index.php");

        exit(0);
    }

    else {
        header("Location:". Config::get_host() ."/profile.php");
        exit(1);
    }