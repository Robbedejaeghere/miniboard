<?php
session_start();
require_once  'HTMLkop.php';
require_once 'Algemeen.php';
Uitvoer::toonHoofdTitel("Daxboard");
Uitvoer::toonTussenTitel("Welkom op daxboard");
$daxboarddb = daxboard::getDaxboardInstantie();
$config = Config::getConfigInstantie();

Uitvoer::toonLoginForm();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $logintruefalse = false;
    $logintruefalse = $daxboarddb->valideerLogin($username, $password);

    if ($logintruefalse == 1) {
        $_SESSION['user'] = $username;
        header("location: index.php");
    } else {
        echo "Verkeerde Username of Password";
    }
}


require_once 'HTMLstaart.php';