<?php
/**
 * Created by PhpStorm.
 * User: sven.bautz
 * Date: 19/05/15
 * Time: 11:41
 */
include_once "../php/DBHandler.php";
$entityBody = file_get_contents('php://input');
$var = json_decode($entityBody, true);

$db = new DBHandler();
$name = $var["name"];
$pswd = $var["pswd"];
$mail = $var["email"];

$err = $db->registerUser($name, $pswd, $mail);
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