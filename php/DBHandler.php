<?php
/**
 * Created by PhpStorm.
 * User: sven.bautz
 * Date: 07/05/15
 * Time: 11:34
 */

include_once "../configs/Config.example.php";
include_once "Mitglied.php";

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
        $u = $this->mysqli->real_escape_string($user);
        $p = $this->mysqli->real_escape_string($pw);
        $query = "SELECT id, name, email FROM `MITGLIEDER` where name = '$u' AND password = '$p'";
        $result = $this->mysqli->query($query, MYSQLI_STORE_RESULT);
        if ($result->num_rows != 1){
            return false;
        } else {
            $member = $result->fetch_object("Mitglied");
            return $member;
        }
    }

} 