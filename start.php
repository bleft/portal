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

    <div id="contentbox">Die n&auml;chste Lan:
        <?php $printer = new DataPrinter();
         $printer->printAktivLan()
        ?>
    </div>

    <div id="chatterbox">Chat:
        <div id="chatentry">
            <div id="chatentrykopf">Werner sagte (04:30 Uhr, 08.05.2015)</div>
            <div>Ihr alten Laberkasper. Kommt ihr mal in mein alter.</div>
        </div>
        <div id="chatentry">
            <div id="chatentrykopf">Werner sagte (04:30 Uhr, 08.05.2015)</div>
            <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
        </div>
        <div id="chatentry">
            <div id="chatentrykopf">Werner sagte (04:30 Uhr, 08.05.2015)</div>
            <div>Ihr alten Laberkasper. Kommt ihr mal in mein alter.</div>
        </div>
        <div id="chatentry">
            <div id="chatentrykopf">Werner sagte (04:30 Uhr, 08.05.2015)</div>
            <div>Ihr alten Laberkasper. Kommt ihr mal in mein alter.</div>
        </div>
        <div id="chatentry">
            <div id="chatentrykopf">Werner sagte (04:30 Uhr, 08.05.2015)</div>
            <div>Ihr alten Laberkasper. Kommt ihr mal in mein alter.</div>
        </div>
        <div id="chatentry">
            <div id="chatentrykopf">Werner sagte (04:30 Uhr, 08.05.2015)</div>
            <div>Ihr alten Laberkasper. Kommt ihr mal in mein alter.</div>
        </div>
        <div id="chatentry">
            <div id="chatentrykopf">Werner sagte (04:30 Uhr, 08.05.2015)</div>
            <div>Ihr alten Laberkasper. Kommt ihr mal in mein alter.</div>
        </div>
        <div id="chatentry">
            <div id="chatentrykopf">Werner sagte (04:30 Uhr, 08.05.2015)</div>
            <div>Ihr alten Laberkasper. Kommt ihr mal in mein alter.</div>
        </div>
        <div id="chatentry">
            <div id="chatentrykopf">Werner sagte (04:30 Uhr, 08.05.2015)</div>
            <div> Ihr alten Laberkasper. Kommt ihr mal in mein alter. Ihr alten Laberkasper. Kommt ihr mal in mein alter.
                Ihr alten Laberkasper. Kommt ihr mal in mein alter. Ihr alten Laberkasper. Kommt ihr mal in mein alter.</div>
        </div>
    </div>


<?php
include_once "include/footer.inc";



