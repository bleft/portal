<?php
/**
 * Created by PhpStorm.
 * User: sven.bautz
 * Date: 07/05/15
 * Time: 15:46
 */
session_start();
$_SESSION = array();
session_destroy();
header("location: ../index.html");