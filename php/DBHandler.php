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
require_once "ChatEntry.php";

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
        $query = "SELECT `id` as ID, `BEZEICHNER`, `VERANSTALTER`, `BESCHREIBUNG`, `STREET`, `ZIPCODE`, `CITY`, `MAPLINK`, `BANNERLINK`, `BEGINN`, `ENDE` FROM `LANPARTIES` WHERE `AKTIV` = 1";
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


    public function insertChatEntry(ChatEntry $entry){
        $stmt = $this->mysqli->prepare("INSERT INTO `CHATTERBOX` (`AUTOR`, `TIMESTAMP`, `TEXT`) VALUES (?,?,?)");
        $stmt->bind_param("sss", $entry->AUTOR, $entry->TIMESTAMP, $entry->TEXT);
        $stmt->execute();
        return $stmt->errno;

    }


    public function chatEntries(){
        $query = "SELECT `id`, `AUTOR`, `TEXT`, `TIMESTAMP` FROM `CHATTERBOX` ORDER BY `id` DESC";
        $result = $this->mysqli->query($query);
        $entries  = array();
        while ($obj = $result->fetch_object("ChatEntry")){
            $entries[] = $obj;
        }
        return $entries;
    }


    public function isAttendie($username) {
        $lan = $this->aktiveLan();
        $stmt = $this->mysqli->prepare("SELECT USERNAME FROM TEILNEHMER WHERE LAN_ID = ? AND USERNAME = ?");
        $stmt->bind_param("is",$lan->ID, $username);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0){
            return true;
        } else {
            return false;
        }
    }

    public function subscripeToActiveLan($user){
        $stmt = $this->mysqli->prepare("INSERT INTO TEILNEHMER (LAN_ID, USERNAME) VALUES (?,?)");
        $lan = $this->aktiveLan();
        $stmt->bind_param("is", $lan->ID, $user);
        $stmt->execute();
        return $stmt->errno;
    }

    public function removeFromActiveLan($user){
        $stmt = $this->mysqli->prepare("DELETE FROM TEILNEHMER WHERE LAN_ID = ? AND USERNAME = ?");
        $lan = $this->aktiveLan();
        $stmt->bind_param("is", $lan->ID, $user);
        $stmt->execute();
        return $stmt->errno;
    }

    public function allMemberNames(){
        $stmt = $this->mysqli->prepare("SELECT USERNAME FROM MITGLIEDER");
        $stmt->execute();
        $result = $stmt->get_result();
        $members = array();
        while ($obj = $result->fetch_object("Mitglied")){
            $obj->DABEI = $this->isAttendie($obj->USERNAME);
            $members[] = $obj;
        }

        return $members;
    }

} 