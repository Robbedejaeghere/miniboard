<?php
require_once  'HTMLkop.php';
require_once 'Algemeen.php';
Uitvoer::toonHoofdTitel("Daxboard");
Uitvoer::toonTussenTitel("Welkom op daxboard");
$daxboarddb = daxboard::getDaxboardInstantie();

Uitvoer::toonRegistratieForm();
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    if($username!=""&&$password!=""){
        $daxboarddb->voegUserToe($username,$password);
        header("location: Login.php");
    }

}


require_once 'HTMLstaart.php';