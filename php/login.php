<?php
/**
 * Created by PhpStorm.
 * User: sven.bautz
 * Date: 07/05/15
 * Time: 09:57
 */

require_once "DBHandler.php";
require_once "Mitglied.php";



 $user =  $_POST["user"];
 $pw   =  $_POST["password"];


if ($user == "" || $pw == ""){
    header ("location: ../index.html");
} else {
    $handler = new DBHandler();
    $member = $handler->login($user, $pw);
    if ($member){
        session_start();
        $_SESSION["loggedIn"] = true;
        $_SESSION["memberName"] = $member->USERNAME;
        $_SESSION["memberID"] = $member->id;
        header ("location: ../start.php");
    } else {
        header ("location: ../index.html");
    }
}