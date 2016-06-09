<?php

class main implements IController {

    public function Run() 
    {
        $resultSet = Application::$database->databaseLink->query("SELECT * FROM spiele WHERE gelbekartenheim IS NULL AND datumuhrzeit BETWEEN DATE_SUB(NOW(), INTERVAL 3 HOUR) AND NOW() ");
        $gamesArray = [];
        if ($resultSet) {
            while ($row = $resultSet->fetch_assoc()) {
                $gamesArray[] = $row;
            }

            Application::$smarty->assign("SpieleArray", $gamesArray);
        }

        Application::$smarty->assign('contentfile', 'main.tpl');
    }
}