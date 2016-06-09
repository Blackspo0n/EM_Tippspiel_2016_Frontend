<?php

class profil implements IController {
    public function __construct()
    {
        $benutzerID = $_SESSION['userid'];
        $resultSet = Application::$database->databaseLink->query("SELECT * FROM tipps AS T JOIN spiele AS S ON T.spieleid = S.spieleid WHERE benutzerid=" . $benutzerID);
        $gamesArray = [];
        if ($resultSet) {
            while ($row = $resultSet->fetch_assoc()) {
                $gamesArray[] = $row;
            }

            Application::$smarty->assign("TippArray", $gamesArray);
        }

        Application::$smarty->assign('contentfile', 'profil.tpl');
    }

    public function Run()
    {
        // TODO: Implement Run() method.
    }
}