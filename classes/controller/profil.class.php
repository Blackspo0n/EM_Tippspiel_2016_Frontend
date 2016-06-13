<?php

/**
 *
 * @author Mario Kellner <mario.kellner@studmail.w-ha.de>
 * @author Jan Markus Momper <jan-markus.momper@studmail.w-hs.de>
 * @author Philipp Miller <philipp.miller@studmail.w-hs.de>
 * @author Mark Friedrich <mark.friedrich@studmail.w-hs.de>
 */
class profil implements IController {

    /**
     *
     */
    public function Run()
    {
        if (isset($_SESSION['userid'])) {
            $benutzerID = $_SESSION['userid'];
            $resultSet = Application::$database->databaseLink->query("SELECT * FROM tipps AS T JOIN spiele AS S ON T.spieleid = S.spieleid WHERE benutzerid=" . $benutzerID);
            $gamesArray = [];
            if ($resultSet) {
                while ($row = $resultSet->fetch_assoc()) {
                    $gamesArray[] = $row;
                }

                Application::$smarty->assign('TippArray', $gamesArray);
            }

            $resultSet = Application::$database->databaseLink->query("SELECT * FROM ranking WHERE benutzerid=" . $benutzerID . " ORDER BY datum DESC LIMIT 1");
            $userRanking = [];
            if ($resultSet) {
                $userRanking = $resultSet->fetch_assoc();

                Application::$smarty->assign('UserRanking', $userRanking);
            }

            Application::$smarty->assign('contentfile', 'profil.tpl');
        }
    }

    /**
     * @param $spieleID
     */
    public function displayForm($spieleID)
    {
        $singleGameData = Application::$database->databaseLink->query("SELECT * FROM spiele WHERE spieleid NOT IN (SELECT spieleid FROM tipps WHERE benutzerid = " . $_SESSION['userid'] . ") AND heimmannschafthz IS NULL AND datumuhrzeit > NOW() AND spieleid = " . (int)$spieleID);

        if ($singleGameData && $game = $singleGameData->fetch_assoc()) {

            Application::$smarty->assign('singleGameData', $game);
            Application::$smarty->assign('contentfile', 'tipinput.form.tpl');
        } else {
            Application::$smarty->assign("error", "Das ausgewählte Spiel wurde entweder bereits getippt oder das Spiel wurde bereits gespielt.");
            $this->displayList();
        }
    }
}