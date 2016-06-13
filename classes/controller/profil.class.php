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

            if (isset($_GET['showform'])) {
                $this->displayForm($_GET['showform']);
            } else {
                $message = $this->doCheckValidData($_POST['tipinput'], $_GET['showform'], $_SESSION['userid']);
                if ($message === true) {
                    Application::$smarty->assign('message', 'Tipp erfolgreich abgegeben!');
                } else {
                    Application::$smarty->assign('errors', $message);
                    $this->displayForm($_GET['showform']);
                }
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
    }

    /**
     * @param array $tipinputdata
     * @param $spieleid
     * @param $benutzerid
     * @return array|bool
     */
    public function doCheckValidData(array $tipinputdata, $spieleid, $benutzerid)
    {

        $errorMessages = [];
        $tipinputdata['spieleid'] = $spieleid;
        $tipinputdata['benutzerid'] = $benutzerid;
        $tipinputdata['tippdatum'] = 'NOW()';
        $db = Application::$database->databaseLink; // because its shorter than Application::$database->databaseLink

        if((int)$tipinputdata['tippheimhz'] > (int)$tipinputdata['tippheimende'] || (int)$tipinputdata['tippgasthz'] > (int)$tipinputdata['tippgastende']) {
            $errorMessages[] = "Tipp für die zweite Halbzeit kann nicht kleiner sein als der Tipp für die erste Halbzeit";
            return $errorMessages;
        }

        $sql = "INSERT INTO tipps (" . implode(',', array_keys($tipinputdata)) . ") VALUES (";

        foreach($tipinputdata as $key => &$value) {
            if(empty($value)) {
                $value = 0;
            }
        }

        $sql .= implode(",", $tipinputdata);

        $sql.=")";

        if($db->query($sql)) {
            return true;
        }
        else {
            $errorMessages[] = "Konnte Tipp nicht einspeichern." . $db->error;
        }

        // all conditions checked, lets create the account
        if (count($errorMessages) === 0) {
            return true;
        }

        return $errorMessages;
    }



    /**
     * @param $spieleID
     */
    public function displayForm($spieleID)
    {
        $singleGameData = Application::$database->databaseLink->query("SELECT * FROM spiele WHERE spieleid = " . (int)$spieleID);

        if ($singleGameData && $game = $singleGameData->fetch_assoc()) {

            Application::$smarty->assign('singleGameData', $game);
            Application::$smarty->assign('contentfile', 'profil.form.tpl');
        } else {
            Application::$smarty->assign("error", "Das ausgewählte Spiel wurde bereits gespielt.");
            Application::$smarty->assign('contentfile', 'profil.tpl');
        }
    }
}