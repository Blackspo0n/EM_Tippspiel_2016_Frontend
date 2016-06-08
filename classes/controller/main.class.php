<?php

class main implements IController {
    public function __construct()
    {

        $resultSet = Application::$database->databaseLink->query("SELECT * FROM spiele WHERE gelbekartenheim IS NULL AND datumuhrzeit BETWEEN DATE_SUB(NOW(), INTERVAL 2 HOUR) AND NOW() ");
        $gamesArray = [];
        if ($resultSet) {
            while ($row = $resultSet->fetch_assoc()) {
                $gamesArray[] = $row;
            }

            Application::$smarty->assign("SpieleArray", $gamesArray);
        }

        Application::$smarty->assign('contentfile', 'main.tpl');
    }

    public function Run() 
    {
        // TODO: Implement Run() method.
    }
}