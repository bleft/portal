<?php
/**
 * Created by PhpStorm.
 * User: sven.bautz
 * Date: 07/05/15
 * Time: 11:34
 */

require_once "Config.php";
require_once "Mitglied.php";
require_once "Lanpartie.php";


class DBHandler {
    /** @var mysqli */
    private $mysqli;

    public function __construct() {
        $db_host = Config::$db_host;
        $db_user = Config::$db_user;
        $db_pass = Config::$db_pass;
        $db_db = Config::$db_db;

        // Verbindung zur Datenbank aufbauen
        $this->mysqli = new mysqli($db_host, $db_user, $db_pass, $db_db);
        if ($this->mysqli->connect_error) {
            throw new Exception('Could not connect to database.');
        }
        // Zeichensatz setzen
        if (!$this->mysqli->set_charset('utf8')) {
            throw new Exception('Could not set character set.');
        }
    }



    /**
    * liefert class Mitglied oder false
    */
    public function login($user, $pw) {
        $stmt = $this->mysqli->prepare("SELECT id, USERNAME, EMAIL FROM `MITGLIEDER` where USERNAME = ? AND PASSWORD = ?");
        $stmt->bind_param("ss", $user, $pw);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($obj = $result->fetch_object("Mitglied")){
            $member = $obj;
            return $member;
        }
    }


    public function mitglieder() {
        $query = "SELECT id, name, email FROM MITGLIEDER";
        $result = $this->mysqli->query($query);
        $members  = array();
        while ($obj = $result->fetch_object("Mitglied")){
            $members[] = $obj;
        }
        return $members;
    }

    public function lanparties() {
        $query = "SELECT * FROM LANPARTIES";
        $result = $this->mysqli->query($query);
        $lans = array();
        while ($obj = $result->fetch_object("Lanpartie")){
            $lans[] = $obj;
        }
        return $lans;
    }

    public function aktiveLan(){
        $query = "SELECT `id`, `BEZEICHNER`, `VERANSTALTER`, `BESCHREIBUNG`, `STREET`, `ZIPCODE`, `CITY`, `MAPLINK`, `BANNERLINK` FROM `LANPARTIES` WHERE `AKTIV` = 1";
        $result = $this->mysqli->query($query, MYSQLI_STORE_RESULT);
        if ($result->num_rows != 1){
            return false;
        } else {
            $lan = $result->fetch_object("Lanpartie");
            return $lan;
        }
    }


    public function registerUser($name, $pswd, $email){
        $stmt = $this->mysqli->prepare("INSERT INTO `MITGLIEDER` (`USERNAME`, `PASSWORD`, `EMAIL`) VALUES (?,?,?)");
        $stmt->bind_param("sss", $name, $pswd, $email);
        $stmt->execute();
        return $stmt->errno;
    }



} 