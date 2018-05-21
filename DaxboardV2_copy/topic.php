<?php
session_start();
require_once  'HTMLkop.php';
require_once 'Algemeen.php';

Uitvoer::toonHoofdTitel("Daxboard");


$daxboarddb = daxboard::getDaxboardInstantie();
$actie = isset($_GET["actie"]) ? $_GET["actie"] : "";
switch ($actie){
    case "toonTopics":
        $_SESSION['categoryid'] = null;
        if(is_null($_SESSION['categoryid'])){
            $idClicked = $_GET['categoryid'];
            $_SESSION['categoryid'] = $idClicked;
            $nameClicked = $_GET['catname'];
            $nameClicked = str_replace('-', ' ', $nameClicked);
            $_SESSION['categoryname'] = $nameClicked;
        }

        Uitvoer::toonTussenTitelMetAdd($nameClicked);
        Uitvoer::toonTopics($daxboarddb->geefAlleTopicsVanCategorie($idClicked));
        break;
    case "toonContent":
        $idClicked = $_GET['topicid'];
        $_SESSION["topicid"] = $idClicked;
        $nameClicked = $_GET['topicname'];
        $nameClicked = str_replace('-',' ', $nameClicked);
        Uitvoer::toonTussenTitel($nameClicked);
        Uitvoer::toonTopicContent($daxboarddb->geefContentVanTopic($idClicked));
        Uitvoer::toonTussenTitel("Reacties");
        Uitvoer::toonTopicReplies($daxboarddb->geefRepliesVanTopic($idClicked));
        Uitvoer::toonTussenTitel("Snelle Reactie");
        Uitvoer::toonReplieForm();
        break;

}
if($_SERVER["REQUEST_METHOD"] == "POST") {

    $replieArea = $_POST['replieArea'];
    if($replieArea!=""){
        $daxboarddb->voegReplieToe($replieArea, $_SESSION['user'], $_SESSION['topicid']);
        echo "<meta http-equiv='refresh' content='0'>";
    }


}


require_once 'HTMLstaart.php';