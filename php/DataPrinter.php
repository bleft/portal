<?php
/**
 * Created by PhpStorm.
 * User: sven.bautz
 * Date: 08/05/15
 * Time: 10:36
 */
require_once "Lanpartie.php";
require_once "Mitglied.php";
require_once "DBHandler.php";

class DataPrinter {

    public function printAktivLan(){
        $handler = new DBHandler();
        /** @var $lan Lanpartie */
        $lan = $handler->aktiveLan();
        if (!$lan){
            echo "Aktuell steht <span style='color: red; font-weight: 600'>keine</span> LAN an. <br>Das gibts doch nicht!<br>MACH WAS!!!";
        } else {

            echo $lan->BEZEICHNER;
            echo " bei ";
            echo $lan->VERANSTALTER;
            echo "<br/>";
            echo $lan->BESCHREIBUNG;
            echo "<br/>";
            echo $lan->STREET;
            echo " ";
            echo $lan->ZIPCODE;
            echo " ";
            echo $lan->CITY;
            echo " ";
            echo "<a id='memberList' href='$lan->MAPLINK'>Landkarte</a>";
            echo "<br/>";
            echo "<img src='$lan->BANNERLINK' alt='LAN-BANNER'>";
            echo "<br/>";
            echo $lan->AKTIV;
        }

    }

    public function printMembers() {
        /** @var $handler DBHandler */
        $handler = new DBHandler();
        /** @var $member  Mitglied */
        $members = $handler->mitglieder();
        foreach($members as $member) {
            echo '<div id="memberList">';
            echo $member->name;
            echo '</div>';
        }
    }
} 
