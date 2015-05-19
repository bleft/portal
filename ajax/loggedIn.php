<?php
/**
 * Created by PhpStorm.
 * User: sven.bautz
 * Date: 19/05/15
 * Time: 14:06
 */

session_start();
$result = false;
$err = 0;

if(!isset($_SESSION['loggedIn']))
{
    $result = false;
} else {
    $result = $_SESSION['memberName'];
}

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