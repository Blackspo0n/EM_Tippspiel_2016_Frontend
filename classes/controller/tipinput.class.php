<?php

/**
 * Created by PhpStorm.
 * User: JMO
 * Date: 25.05.2016
 * Time: 11:00
 */
class tipinput implements IController
{

    /**
     *
     */
    public function Run()
    {

       // $gameData = Application::$database->databaseLink->query("SELECT * FROM spiele AS R JOIN benutzer AS B JOIN tipps AS T ON R.spieleid = T.spieleid WHERE  R.gelbekartenheim = 0 AND WHERE T.tippgelbeheim = 0 ORDER BY datumuhrzeit LIMIT 1");
        $this->gameData();
        Application::$smarty->assign('contentfile', 'tipinput.form.tpl');

      if (isset($_POST['tipinput'])) {
            echo "mamaaa";
           $message =  $this->doCheckValidData($_POST['tipinput']);
            if ($message === true) {
                Application::$smarty->assign('message', 'Tipp erfolgreich abgegeben!'); 
                $this->displayList();
            } else {
                Application::$smarty->assign('errors', $message);
                $this->displayForm($_GET['showform']);
            }
        }
        elseif (isset($_GET['showform'])) {
            $this->displayForm($_GET['showform']);
        }else {
            $this->displayList();
        }

    }


    public function gameData()
    {
        // $username = $smarty.session.username;
        $db = Application::$database->databaseLink;
        $result = $db->query("SELECT * FROM spiele WHERE spieleid NOT IN (SELECT spieleid FROM tipps WHERE benutzerid = 1) AND heimmannschafthz IS NULL AND datumuhrzeit > NOW() ");
        
        $gameData = [];
        
        while ($row = $result->fetch_assoc()) {
            $gameData[] = $row;
        }
        Application::$smarty->assign('gameData', $gameData);
    }

    public function doCheckValidData(array $tipinputdata)
    {
        $errorMessages = [];

        $db = Application::$database->databaseLink; // because its shorter than Application::$database->databaseLink

        if (empty($tipinputdata['homefirsthalf'])) {
            $errorMessages[] = 'Keine oder falsche Eingabe.';
        }

        if (empty($tipinputdata['guestfirsthalf'])) {
            $errorMessages[] = 'Keine oder falsche Eingabe.';
        }

        if (empty($tipinputdata['homesecondhalf'])) {
            $errorMessages[] = 'Keine oder falsche Eingabe.';
        }

        if (empty($tipinputdata['guestsecondhalf'])) {
            $errorMessages[] = 'Keine oder falsche Eingabe.';
        }

        if (empty($tipinputdata['yellowcardshome'])) {
            $errorMessages[] = 'Keine oder falsche Eingabe.';
        }

        if (empty($tipinputdata['yellowcardsguest'])) {
            $errorMessages[] = 'Keine oder falsche Eingabe.';
        }

        if (empty($tipinputdata['redcardshome'])) {
            $errorMessages[] = 'Keine oder falsche Eingabe.';
        }

        if (empty($tipinputdata['redcardsguest'])) {
            $errorMessages[] = 'Keine oder falsche Eingabe.';
        }

        // all conditions checked, lets create the account
        if (count($errorMessages) === 0) {
            return true;
        }

        return $errorMessages;
    }

    public function displayList () {
        $this->gameData();
        Application::$smarty->assign('contentfile', 'tipinput.list.tpl');

    }

    public function displayForm ($spieleID) {
        $singleGameData = Application::$database->databaseLink->query("SELECT * FROM spiele WHERE spieleid NOT IN (SELECT spieleid FROM tipps WHERE benutzerid = 1) AND heimmannschafthz IS NULL AND datumuhrzeit > NOW() AND spieleid = ". (int) $spieleID);

        if ($singleGameData) {
            $game = $singleGameData->fetch_assoc();
            Application::$smarty->assign('singleGameData', $game);
            Application::$smarty->assign('contentfile', 'tipinput.form.tpl');
        } else {
            Application::$smarty->assign("message", "Das ausgewählte Spiel wurde entweder bereits getippt oder das Spiel wurde bereits gespielt.");
            $this->displayList();
        }
    }
}