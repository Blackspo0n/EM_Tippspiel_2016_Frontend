<?php

/**
 * Created by PhpStorm.
 * User: JMO
 * Date: 25.05.2016
 * Time: 11:00
 */
class games implements IController
{

    public function Run()
    {
        $resultSet = Application::$database->databaseLink->query("SELECT * FROM spiele WHERE spielbezeichnung LIKE '%Gruppe%'");
        $myArray = [];
        if ($resultSet) {
            while ($row = $resultSet->fetch_assoc()) {
                $myArray[] = $row;
            }

            Application::$smarty->assign("GruppenArray", $myArray);
        }

        $resultSet = Application::$database->databaseLink->query("SELECT * FROM spiele WHERE spielbezeichnung LIKE '%Achtelfinale%'");
        $myArray = [];
        if ($resultSet) {
            while ($row = $resultSet->fetch_assoc()) {
                $myArray[] = $row;
            }

            Application::$smarty->assign("AchtelArray", $myArray);
        }

        $resultSet = Application::$database->databaseLink->query("SELECT * FROM spiele WHERE spielbezeichnung LIKE '%Viertelfinale%'");
        $myArray = [];
        if ($resultSet) {
            while ($row = $resultSet->fetch_assoc()) {
                $myArray[] = $row;
            }

            Application::$smarty->assign("ViertelArray", $myArray);
        }

        $resultSet = Application::$database->databaseLink->query("SELECT * FROM spiele WHERE spielbezeichnung LIKE '%Halbfinale%'");
        $myArray = [];
        if ($resultSet) {
            while ($row = $resultSet->fetch_assoc()) {
                $myArray[] = $row;
            }

            Application::$smarty->assign("HalbArray", $myArray);
        }

        $resultSet = Application::$database->databaseLink->query("SELECT * FROM spiele WHERE spielbezeichnung='Finale'");
        $myArray = [];
        if ($resultSet) {
            while ($row = $resultSet->fetch_assoc()) {
                $myArray[] = $row;
            }

            Application::$smarty->assign("FinalArray", $myArray);
        }

        Application::$smarty->assign("contentfile", "games.tpl");
    }
}