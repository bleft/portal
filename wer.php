<?php
/**
 * Created by PhpStorm.
 * User: sven.bautz
 * Date: 08/05/15
 * Time: 08:43
 */

session_start();
if (!$_SESSION["memberName"]){
    header ("location: index.html");
    exit;
}
require_once "php/DataPrinter.php";

include_once "include/header.inc";
?>

    <div id="contentbox">Die aktiven Mitglieder:
    <?php $printer = new DataPrinter();
        $printer->printMembers();
    ?>
    </div>


<?php
include_once "include/footer.inc";

