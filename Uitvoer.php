<?php

class Uitvoer
{
    public static function toonHoofdTitel($titel)
    {
        echo "<h1><a href='index.php' id='titel'>$titel</a></h1>";
    }

    public static function toonTussenTitel($titel){
        echo "<h2>$titel</h2>";
    }
    public static function toonTussenTitelMetAdd($titel){
        echo "<a href='topicToevoegen.php' id='addTopic'>Voeg een Topic toe</a><h2>$titel</h2>";
    }
    public static function toonLogout($username){
        echo "<a href='logout.php' id='logout'>Welkom $username | Logout</a>";
    }

    public static function toonCategories($categories){
        $resultaatstring = "<div id='lijst'>";

        foreach ($categories as $category){
            $catname = Helper::zuiverData($category->catname);
            $catnameZonderSpaties = str_replace(' ','-', $catname);
            $catid = Helper::zuiverData($category->catid);
            $resultaatstring .= "<a href=\DaxboardV2/topic.php?actie=toonTopics&categoryid=". $catid ."&catname=". $catnameZonderSpaties ." id=" . $catid . ">" . $catname . "</a><br>";
            $resultaatstring .= "<p>" . Helper::zuiverData($category->catdescription) . "</p>";
        }

        $resultaatstring .= "</div>";
        echo $resultaatstring;
    }

    public static function toonTopics($topics){
        $resultaatString = "<div id='lijst'>";

        foreach ($topics as $topic){
            $topicname =  Helper::zuiverData($topic->topicname);
            $topicnameZonderSpaties = str_replace(' ', '-', $topicname);
            $topicid = Helper::zuiverData($topic->topicid);

            $resultaatString .= "<a href=\DaxboardV2/topic.php?actie=toonContent&topicid=".$topicid. "&topicname=". $topicnameZonderSpaties. " id=". $topicid . ">" . $topicname."</a><br>";
            $resultaatString .= "<p>" . "Door: " . Helper::zuiverData($topic->username) . "</p>";

        }

        $resultaatString .= "</div>";
        echo $resultaatString;
    }

    public static function toonTopicContent($topicContent){
        $resultaatString = "<div id='lijst'>";
        $resultaatString .= "<p>". $topicContent ."</p>";
        $resultaatString .= "</div>";
        echo $resultaatString;
    }

    public static function toonTopicReplies($topicreplies){
        $resultaatString = "<div id='replies'>";
        foreach ($topicreplies as $topicreply){
            $resultaatString .= "<div id=lijst>";
            $resultaatString .= "<p>" . "Van: " . Helper::zuiverData($topicreply->username) . "</p>";
            $resultaatString .= "<p>" . Helper::zuiverData($topicreply->repliecontent) . "</p>";
            $resultaatString .= "</div>";
        }
        $resultaatString .= "</div>";
        echo $resultaatString;
    }
    public static function toonReplieForm(){
        $resultaatString = "<div id='lijst'>";
        $resultaatString .= "<form action='' method='post' id='replieform'>";
        $resultaatString .= "<textarea rows='5' cols='50' name='replieArea'></textarea><br>";
        $resultaatString .= "<input type='submit' value='Submit'>";
        $resultaatString .= "</form>";
        $resultaatString .= "</div>";
        echo $resultaatString;
    }

    public static function toonLoginForm(){
        $resultaatString = "<div id='lijst'>";
        $resultaatString .= "<Form action='' method='post' id='loginform'/>";
        $resultaatString .= "<label id='label'>Username:</label>";
        $resultaatString .= "<input type='text' name='username' class='box'/><br>";
        $resultaatString .= "<label id='label'>Password:</label>";
        $resultaatString .= "<input type='password' name='password' class='box'/><br>";
        $resultaatString .= "<input type='submit' value='Login'/><br>";
        $resultaatString .= "<a href='registration.php'>Not registered yet? Click here...</a>";
        $resultaatString .= "</form>";
        $resultaatString .= "</div>";
        echo $resultaatString;
    }
    public static function toonRegistratieForm(){
        $resultaatString = "<div id='lijst'>";
        $resultaatString .= "<Form action='' method='post' id='registrationForm'/>";
        $resultaatString .= "<label id='label'>Username:</label>";
        $resultaatString .= "<input type='text' name='username' class='box'/><br>";
        $resultaatString .= "<label id='label'>Password:</label>";
        $resultaatString .= "<input type='password' name='password' class='box'/><br>";
        $resultaatString .= "<input type='submit' value='Registration'/><br>";
        $resultaatString .= "</form>";
        $resultaatString .= "</div>";
        echo $resultaatString;
    }
    public static function geefTopicToevoegenForm(){
        $resultaatString = "<div id='lijst'>";
        $resultaatString .= "<form action='' method='post' id='topictoevoegenform'>";
        $resultaatString .= "<label id='label'>Onderwerp:</label> <input type='text' name='topiconderwerp'/>";
        $resultaatString .= "<textarea rows='10' cols='120' name='topicContentArea'></textarea><br>";
        $resultaatString .= "<input type='submit' value='Submit'>";
        $resultaatString .= "</form>";
        $resultaatString .= "</div>";
        echo $resultaatString;
    }


}