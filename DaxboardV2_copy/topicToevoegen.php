<?php
session_start();
require_once  'HTMLkop.php';
require_once 'Algemeen.php';
$daxboarddb = daxboard::getDaxboardInstantie();
Uitvoer::toonHoofdTitel("Daxboard");
Uitvoer::toonTussenTitel($_SESSION['categoryname']);
Uitvoer::geefTopicToevoegenForm();
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $topiconderwerp = $_POST['topiconderwerp'];
    $topicContent= $_POST['topicContentArea'];
    if($topicContent !="" && $topiconderwerp !=""){
        $daxboarddb->voegTopicToe($topiconderwerp, $topicContent,$_SESSION['user'],$_SESSION['categoryid']);
        header("location: topic.php?actie=toonTopics");
    }

}
require_once 'HTMLstaart.php';