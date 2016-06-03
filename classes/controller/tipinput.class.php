<?php

/**
 * Created by PhpStorm.
 * User: JMO
 * Date: 25.05.2016
 * Time: 11:00
 */
class tipinput implements IController
{

    public function Run()
    {
        $gameData = $this->gameData();
 
        Application::$smarty->assign('contentfile', 'tipinput.form.tpl');


        if (array_key_exists('tipinput', $_POST)) {
            $result = $this->doCheckValidData($_POST['tipinput']);
            if ($result === true) {

            } else {
                Application::$smarty->assign('registrationErrors', $result);
                $this->RegisterFormular($_POST['account']);


            }
        }
    }


    public function gameData()
    {
        $db = Application::$database->databaseLink;

        $result = $db->query("SELECT * FROM spiele");

        echo "<table>";

        while ($row = mysql_fetch_array($result)) {
            echo "<tr>
                 <td>" . $row['spielbezeichnung'] . "</td>
                 <td>" . $row['heimmannschaft'] . "</td>
                 <td>" . $row['gastmannschaft'] . "</td>
                 </tr>";
        }

        echo "</table>";

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


}