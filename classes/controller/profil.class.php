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
        if (UserHelper::isUserLogged()) {
            if (isset($_POST['tipchange'])) {
                $singleChangeData = Application::$database->databaseLink->query("SELECT * FROM tipps WHERE tippid = " . $_GET['tipp']);

                if ($singleChangeData && $game = $singleChangeData->fetch_assoc()) {
                    $message = $this->doCheckValidData($_POST['tipchange'], $_SESSION['userid'], $_GET['tipp']);

                    if ($message === true) {
                        Application::$smarty->assign('message', 'Tipp erfolgreich abgegeben!');
                        $this->displayList();
                    } else {
                        Application::$smarty->assign('errors', $message);
                        $this->displayForm($_GET['tipp']);
                    }
                } else {
                    $this->displayList();
                }
            } elseif (isset($_GET['tipp']) && !empty($_GET['tipp'])) {
                $this->displayForm($_GET['tipp']);

            } else {
                $this->displayList();
            }
        }
    }

    /**
     * @param array $tipchangedata
     * @param int $tippid
     * @param int $benutzerid
     * @return array|bool
     */
    public function doCheckValidData(array $tipchangedata, $benutzerid, $tippid)
    {
        $errorMessages = [];
        $db = Application::$database->databaseLink; // because its shorter than Application::$database->databaseLink

        $selectTipps = Application::$database->databaseLink->query(
            "SELECT * FROM tipps AS t JOIN spiele AS s ON t.spieleid = s.spieleid WHERE t.benutzerid = " . (int)$benutzerid . " AND t.tippid = " . (int)$tippid . " AND s.datumuhrzeit > NOW()"
        );

        if ($selectTipps && $tipp = $selectTipps->fetch_assoc()) {
            if ((int)$tipchangedata['tippheimhz'] > (int)$tipchangedata['tippheimende'] || (int)$tipchangedata['tippgasthz'] > (int)$tipchangedata['tippgastende']) {
                $errorMessages[] = 'Tipp für die zweite Halbzeit kann nicht kleiner sein als der Tipp für die erste Halbzeit';
                return $errorMessages;
            }

            $sql = "UPDATE tipps SET tippheimhz=" . (int)$tipchangedata['tippheimhz'] . ", tippgasthz=" . (int)$tipchangedata['tippgasthz'] . ", tippheimende=" . (int)$tipchangedata['tippheimende'] . ", tippgastende=" . (int)$tipchangedata['tippgastende'] . ", tippheimverl=" . (int)$tipchangedata['tippheimverl'] . ", tippgastverl=" . (int)$tipchangedata['tippgastverl'] . ", tippheimelf=" . (int)$tipchangedata['tippheimelf'] . ", tippgastelf=" . (int)$tipchangedata['tippgastelf'] . ", tippgelbeheim=" . (int)$tipchangedata['tippgelbeheim'] . ", tippgelbegast=" . (int)$tipchangedata['tippgelbegast'] . ", tipproteheim=" . (int)$tipchangedata['tipproteheim'] . ", tipprotegast=" . (int)$tipchangedata['tipprotegast'] . " WHERE tippid=" . $tippid;

            if ($db->query($sql)) {
                return true;
            } else {
                $errorMessages[] = 'Konnte Tipp nicht einspeichern. ' . $db->error;
            }

            // all conditions checked, lets create the account
            if (count($errorMessages) === 0) {
                return true;
            }
        }
        else {
            $errorMessages[] = 'Dieses Spiel wurde bereits gespielt!';
        }

        return $errorMessages;
    }


    /**
     * @param int %tippid
     */
    public function displayForm($tippid)
    {

        $selectTipps = Application::$database->databaseLink->query("SELECT * FROM tipps AS t JOIN spiele AS s ON t.spieleid = s.spieleid WHERE t.benutzerid = " . (int)$_SESSION['userid'] . " AND t.tippid = " . (int)$tippid . " AND s.datumuhrzeit > NOW()");

        if ($selectTipps && $tipp = $selectTipps->fetch_assoc()) {
            Application::$smarty->assign('TippArray', $tipp);
            Application::$smarty->assign('contentfile', 'profil.form.tpl');
        } else {
            $this->displayList();
        }
    }

    /**
     * @param int $spieleID
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

    /**
     *
     */
    public function displayList() {
        $resultSet = Application::$database->databaseLink->query("SELECT * FROM tipps AS T JOIN spiele AS S ON T.spieleid = S.spieleid WHERE benutzerid=" . $_SESSION['userid']);
        $gamesArray = [];
        if ($resultSet) {
            while ($row = $resultSet->fetch_assoc()) {
                $row['editable'] = $this->checkDateValidation($row['spieleid']);
                $gamesArray[] = $row;
            }
            Application::$smarty->assign('TippArray', $gamesArray);
        }

        $resultSet = Application::$database->databaseLink->query("SELECT * FROM ranking WHERE benutzerid=" . $_SESSION['userid'] . " ORDER BY datum DESC LIMIT 1");

        if ($resultSet) {
            $userRanking = $resultSet->fetch_assoc();
            Application::$smarty->assign('UserRanking', $userRanking);
        }

        Application::$smarty->assign('contentfile', 'profil.tpl');
    }
}