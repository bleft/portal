<?php
/**
 * Created by PhpStorm.
 * User: sven.bautz
 * Date: 23.06.15
 * Time: 10:00
 */
include_once("../php/DBHandler.php");

session_start();

if(!isset($_SESSION['loggedIn']))
{
    $result = false;
    header("../index.html");
    exit;
}

$db = new DBHandler();
$result = $db->allMemberNames();


$json = '{"result":'.json_encode($result).', "error":'.json_encode($err).'}';
sendJson($json);

// functions:
function sendJson($data) {
    header('Cache-Control: max-age=0, no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: Thu, 01 Jan 1970 00:00:00 GMT');
    header('Content-type: application/json');
    print $data;
}