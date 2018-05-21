<?php
session_start();
require_once  'HTMLkop.php';
require_once 'Algemeen.php';
$user = $_SESSION["user"];
Uitvoer::toonLogout($user);
Uitvoer::toonHoofdTitel("Daxboard");
Uitvoer::toonTussenTitel("Daxboard forum");

$daxboarddb = daxboard::getDaxboardInstantie();
$config = Config::getConfigInstantie();

if($user == null){
    header("location: Login.php");
}else{

    Uitvoer::toonCategories($daxboarddb->geefAlleCategories());

}
require_once 'HTMLstaart.php';