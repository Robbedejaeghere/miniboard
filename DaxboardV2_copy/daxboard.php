<?php
class daxboard{
    private static $daxboardInstantie = null;
    private $db;
    private function __construct()
    {
        try{
            $config = Config::getConfigInstantie();
            $server = $config->getServer();
            $database = $config->getDatabase();
            $username = $config->getUsername();
            $password = $config->getPassword();

            $this->db = new PDO("mysql:host=$server; dbname=$database; charset=utf8mb4",
                $username,
                $password,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }catch (PDOException $e){
            die($e ->getMessage());
        }
    }

    public static function getDaxboardInstantie(){
        if(is_null(self::$daxboardInstantie))
        {
            self::$daxboardInstantie = new daxboard();
        }
        return self::$daxboardInstantie;
    }

    public function sluitDB(){
        self::$daxboardInstantie = null;
    }

    public function geefAlleCategories(){
        try{
            $sql = "SELECT * FROM categorie;";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $categories = $stmt->fetchAll(PDO::FETCH_OBJ);

        }catch (PDOException $e){
            die($e->getMessage());
        }
        return $categories;
    }

    public function geefAlleTopicsVanCategorie($catid){
        try{
            $sql = "SELECT * FROM topic JOIN users ON userid = Fkuserid WHERE FKcatid = ". $catid . ";";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $topics = $stmt->fetchAll(PDO::FETCH_OBJ);

        }catch (PDOException $e){
            die($e->getMessage());
        }
        return $topics;
    }

    public function geefContentVanTopic($topicid){
        try{
            $sql = "SELECT * FROM topic WHERE topicid = ". $topicid . ";";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $content = $stmt->fetchColumn(2);

        }catch (PDOException $e){
            die($e->getMessage());
        }
        return $content;
    }
    public function  geefRepliesVanTopic($topicid){
        try{
            $sql = "SELECT * FROM replie JOIN users ON userid = Fkuserid WHERE FKtopicid=". $topicid . ";";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $topics = $stmt->fetchAll(PDO::FETCH_OBJ);
        }catch(PDOException $e){
            die($e->getMessage());
        }
        return $topics;
    }
    public function valideerLogin($username, $password){
        $validatie = false;

        try{
            $sql = "SELECT * FROM users WHERE username='". $username ."' AND userpassword='". $password ."';";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        }catch(PDOException $e){
            die($e->getMessage());
        }

        if(count($users) == 1){
            $validatie = true;
        }

        return $validatie;
    }
    public function voegUserToe($uname, $passw){
        try{
            $sql = "INSERT INTO users(username, userpassword) VALUES(:uname, :passw);";
            $stmt= $this->db->prepare($sql);
            $stmt->bindParam(":uname", $uname);
            $stmt->bindParam(":passw", $passw);
            $stmt->execute();
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
    public function  voegReplieToe($replieAre, $user, $topicid){

        try{
            $sql = "INSERT INTO replie(repliecontent, FKtopicid, FKuserid) VALUES(:replie,:topic, :userid)";
            $stmt= $this->db->prepare($sql);
            $stmt->bindParam(":replie", $replieAre);
            $stmt->bindParam(":topic", $topicid);
            $userid =  $this->geefUserID($user);
            $stmt->bindParam(":userid", $userid);
            $stmt->execute();
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
    private function  geefUserID($user){
        try{
            $sql = "SELECT userid FROM users WHERE username= '". $user."';";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $userid = $stmt->fetchColumn(0);
        }catch(PDOException $e){
            die($e->getMessage());
        }
        return $userid;
    }
    public function voegTopicToe($topiconderwerp, $topicContent, $user, $catid){
        try{
            $sql = "INSERT INTO topic(topicname, topiccontent, FKcatid, FKuserid) VALUES(:topicname,:topiccontent,:catid,:userid);";
            $stmt= $this->db->prepare($sql);
            $stmt->bindParam(":topicname", $topiconderwerp);
            $stmt->bindParam(":topiccontent", $topicContent);
            $stmt->bindParam(":catid", $catid);
            $userid =  $this->geefUserID($user);
            $stmt->bindParam(":userid", $userid);
            $stmt->execute();
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
}