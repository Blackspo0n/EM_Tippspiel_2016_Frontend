<?php

/**
 *
 * @author Mario Kellner <mario.kellner@studmail.w-ha.de>
 * @author Jan Markus Momper <jan-markus.momper@studmail.w-hs.de>
 * @author Philipp Miller <philipp.miller@studmail.w-hs.de>
 * @author Mark Friedrich <mark.friedrich@studmail.w-hs.de>
 */
class profil implements IController
{

    /**
     *
     */
    public function Run()
    {
        if (isset($_SESSION['userid'])) {
            if (isset($_POST['tipchange'])) {

                $singleChangeData = Application::$database->databaseLink->query("SELECT * FROM tipps WHERE tippid = " . $_GET['tipp']);

                if ($singleChangeData && $game = $singleChangeData->fetch_assoc()) {
                    $message = $this->doCheckValidData($_POST['tipchange'], $_GET['showform'], $_SESSION['userid'], $_GET['tipp']);
                    if ($message === true) {
                        Application::$smarty->assign('message', 'Tipp erfolgreich abgegeben!');
                        $this->displayList();
                    } else {
                        Application::$smarty->assign('errors', $message);
                        $this->displayForm($_GET['showform']);
                    }
                } else {
                    $this->displayList();
                }
            } elseif (isset($_GET['showform']) && $_GET['showform'] !== "") {
                if ($this->checkDateValidation($_GET['showform'])) {
                    $this->displayForm($_GET['showform']);
                } else {
                    $this->displayList();
                }

            } else {
                $this->displayList();
            }
        }
    }

    /**
     * @param array $tipinputdata
     * @param $spieleid
     * @param $benutzerid
     * @return array|bool
     */
    public function doCheckValidData(array $tipchangedata, $spieleid, $benutzerid, $tippid)
    {

        $errorMessages = [];
        $tipchangedata['spieleid'] = $spieleid;
        $tipchangedata['benutzerid'] = $benutzerid;
        $tipchangedata['tippdatum'] = 'NOW()';
        $db = Application::$database->databaseLink; // because its shorter than Application::$database->databaseLink

        if ((int)$tipchangedata['tippheimhz'] > (int)$tipchangedata['tippheimende'] || (int)$tipchangedata['tippgasthz'] > (int)$tipchangedata['tippgastende']) {
            $errorMessages[] = "Tipp für die zweite Halbzeit kann nicht kleiner sein als der Tipp für die erste Halbzeit";
            return $errorMessages;
        }

        if ($this->checkDateValidation($spieleid)) {

            $sql = "UPDATE tipps SET tippheimhz=" . (int)$tipchangedata['tippheimhz'] . ", tippgasthz=" . (int)$tipchangedata['tippgasthz'] . ", tippheimende=" . (int)$tipchangedata['tippheimende'] . ", tippgastende=" . (int)$tipchangedata['tippgastende'] . ", tippheimverl=" . (int)$tipchangedata['tippheimverl'] . ", tippgastverl=" . (int)$tipchangedata['tippgastverl'] . ", tippheimelf=" . (int)$tipchangedata['tippheimelf'] . ", tippgastelf=" . (int)$tipchangedata['tippgastelf'] . ", tippgelbeheim=" . (int)$tipchangedata['tippgelbeheim'] . ", tippgelbegast=" . (int)$tipchangedata['tippgelbegast'] . ", tipproteheim=" . (int)$tipchangedata['tipproteheim'] . ", tipprotegast=" . (int)$tipchangedata['tipprotegast'] . " WHERE tippid=" . $tippid;

            if ($db->query($sql)) {
                return true;
            } else {
                $errorMessages[] = "Konnte Tipp nicht einspeichern." . $db->error;
            }

            // all conditions checked, lets create the account
            if (count($errorMessages) === 0) {
                return true;
            }
        } else {
            $errorMessages[] = "Dieses Spiel wurde bereits gespielt!";
        }

        return $errorMessages;
    }


    /**
     * @param $spieleID
     */
    public function displayForm($spieleID)
    {
        $singleChangeData = Application::$database->databaseLink->query("SELECT * FROM spiele WHERE spieleid = " . (int)$spieleID);

        $selectTipps = Application::$database->databaseLink->query("SELECT * FROM tipps AS t JOIN spiele AS s ON t.spieleid = s.spieleid WHERE t.benutzerid = " . (int)$_SESSION['userid'] . " AND t.tippid = " . (int)$_GET['tipp'] . " AND s.datumuhrzeit > NOW()");
        if (($selectTipps && $tipp = $selectTipps->fetch_assoc()) && ($singleChangeData && $game = $singleChangeData->fetch_assoc())) {
            Application::$smarty->assign('TippArray', $tipp);
            Application::$smarty->assign('singleChangeData', $game);
            Application::$smarty->assign('contentfile', 'profil.form.tpl');
        } else {
            Application::$smarty->assign("error", "Das ausgewählte Spiel wurde bereits gespielt.");
            Application::$smarty->assign('contentfile', 'profil.tpl');
        }
    }

    /**
     * @param $spieleID
     * @return bool
     */
    public function checkDateValidation($spieleID) {
        $singleChangeData = Application::$database->databaseLink->query("SELECT * FROM spiele WHERE spieleid = " . (int)$spieleID . " AND datumuhrzeit > NOW()");

        if ($singleChangeData && $game = $singleChangeData->fetch_assoc()) {
            return true;
        } else {
            return false;
        }
    }

    public function displayList() {
        $benutzerID = $_SESSION['userid'];
        $resultSet = Application::$database->databaseLink->query("SELECT * FROM tipps AS T JOIN spiele AS S ON T.spieleid = S.spieleid WHERE benutzerid=" . $benutzerID);
        $gamesArray = [];
        if ($resultSet) {
            while ($row = $resultSet->fetch_assoc()) {
                $row['editable'] = $this->checkDateValidation($row['spieleid']);
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