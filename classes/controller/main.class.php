<?php

class main implements IController {
    public function __construct()
    {

        $resultSet = Application::$database->databaseLink->query("SELECT * FROM spiele WHERE gelbekarteheim=NULL");
        $myArray = [];
        if ($resultSet) {
            while ($row = $resultSet->fetch_assoc()) {
                $myArray[] = $row;
            }

            Application::$smarty->assign("SpieleArray", $myArray);
        }

        Application::$smarty->assign("yolo", "You only 'lie' once.");
        Application::$smarty->assign('contentfile', 'main.tpl');
    }

    public function Run() 
    {
        // TODO: Implement Run() method.
    }
}