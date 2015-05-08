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
include_once "include/header.inc";
require_once "php/DataPrinter.php";
?>

    <div id="todobox">
        <div id="todoheader"><?php echo $_SESSION["memberName"]?>&#x27;s todos:</div>
        <div id="todo">Blues Bude putzen</div>
        <div id="todo">Tische aufstellen</div>
        <div id="todo">Grillkohle besorgen</div>
        <div id="todo">Betten machen</div>
    </div>

    <div id="contentbox">
        <?php $printer = new DataPrinter();
         $printer->printAktivLan()
        ?>
    </div>



<?php
include_once "include/footer.inc";



