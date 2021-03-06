<?php

/**
 * Class tipinput
 */
class tipinput implements IController
{

    /**
     *
     */
    public function Run()
    {
        if(isset($_SESSION['userid'])) {
            if (isset($_POST['tipinput'])) {
                $singleGameData = Application::$database->databaseLink->query("SELECT * FROM spiele WHERE spieleid NOT IN (SELECT spieleid FROM tipps WHERE benutzerid = " . $_SESSION['userid'] . ") AND heimmannschafthz IS NULL AND datumuhrzeit > NOW() AND spieleid = " . (int)$_GET['showform']);

                if ($singleGameData && $game = $singleGameData->fetch_assoc()) {
                    $message = $this->doCheckValidData($_POST['tipinput'], $_GET['showform'], $_SESSION['userid']);
                    if ($message === true) {
                        Application::$smarty->assign('message', 'Tipp erfolgreich abgegeben!');
                        $this->displayList();
                    } else {
                        Application::$smarty->assign('errors', $message);
                        $this->displayForm($_GET['showform']);
                    }
                }
                else {
                    $this->displayList();
                }
            } elseif (isset($_GET['showform'])) {
                $this->displayForm($_GET['showform']);
            } else {
                $this->displayList();
            }
        }
    }


    /**
     *
     */
    public function gameData()
    {
        $db = Application::$database->databaseLink;
        $result = $db->query("SELECT * FROM spiele WHERE spieleid NOT IN (SELECT spieleid FROM tipps WHERE benutzerid = " . $_SESSION['userid'] . ") AND heimmannschafthz IS NULL AND datumuhrzeit > NOW() ORDER BY datumuhrzeit");

        $gameData = [];

        while ($row = $result->fetch_assoc()) {
            $gameData[] = $row;
        }
        Application::$smarty->assign('gameData', $gameData);
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
     *
     */
    public function displayList()
    {
        $this->gameData();
        Application::$smarty->assign('contentfile', 'tipinput.list.tpl');

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