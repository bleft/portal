<?php
/**
 * Created by PhpStorm.
 * User: sven.bautz
 * Date: 07/05/15
 * Time: 15:41
 */

session_start();
if (!$_SESSION["memberName"]){
    header ("location: index.html");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Title of the document</title>
    <link href='http://fonts.googleapis.com/css?family=Ubuntu|Kalam' rel='stylesheet' type='text/css'>
    <link href='styles/style.css' rel='stylesheet' type='text/css'>
</head>

<body>
<div >
    <div id="loginbox"><a href="php/logout.php" id="loginbox">logout</a></div>
    <div>St. LAN 2.0</div>

    <div id="todobox">
        <div id="todoheader"><?php echo $_SESSION["memberName"]?>&#x27;s todos:</div>
        <div id="todo">Blues Bude putzen</div>
        <div id="todo">Tische aufstellen</div>
        <div id="todo">Grillkohle besorgen</div>
        <div id="todo">Betten machen</div>
    </div>

    <div id="contentbox">Hier drin steht was.</div>




    <div id="footer">
        <div id="footerbox">
            <a href="http://www.spiegel.de">Wer?</a>
            <a href="http://www.spiegel.de">Wie?</a>
            <a href="http://www.spiegel.de">Was?</a>
        </div>
    </div>
</body>

</html>
