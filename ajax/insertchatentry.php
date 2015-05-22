<?php
/**
 * Created by PhpStorm.
 * User: sven.bautz
 * Date: 22.05.15
 * Time: 14:09
 */
include_once "../php/DBHandler.php";
include_once "../php/ChatEntry.php";



session_start();
$autor = "";
$err = 0;

if(!isset($_SESSION['loggedIn']))
{
    exit;

} else {
    $autor = $_SESSION['memberName'];
}

$entityBody = file_get_contents('php://input');
$var = json_decode($entityBody, true);
$timestamp = time();
$text = $var["text"];


$db = new DBHandler();
$entry = new ChatEntry();
$entry->AUTOR = $autor;
$entry->TEXT = $text;
$entry->TIMESTAMP = $timestamp;

$err = $db->insertChatEntry($entry);
$result = "";

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