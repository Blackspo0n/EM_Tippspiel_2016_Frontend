<?php

/**
 *
 * @author Mario Kellner <mario.kellner@studmail.w-ha.de>
 * @author Jan Markus Momper <jan-markus.momper@studmail.w-hs.de>
 * @author Philipp Miller <philipp.miller@studmail.w-hs.de>
 * @author Mark Friedrich <mark.friedrich@studmail.w-hs.de>
 */
class ranking implements IController
{

    /**
     *
     */
    public function Run()
    {
        $zeitResultSet = Application::$database->databaseLink->query("SELECT datum FROM ranking ORDER BY datum DESC LIMIT 1");
        if ($zeitResultSet) {
            $zeit = $zeitResultSet->fetch_assoc();

            $resultSet = Application::$database->databaseLink->query("SELECT * FROM ranking AS R JOIN benutzer AS B ON R.benutzerid = B.benutzerid WHERE datum='" . $zeit["datum"] . "' ORDER BY platz");
            $myArray = [];
            if ($resultSet) {
                while ($row = $resultSet->fetch_assoc()) {
                    $myArray[] = $row;
                }

                Application::$smarty->assign("RankingArray", $myArray);
            }
        }
        Application::$smarty->assign("contentfile", "ranking.tpl");
    }
}