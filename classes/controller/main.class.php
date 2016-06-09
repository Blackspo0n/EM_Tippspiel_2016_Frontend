<?php

/**
 * Class main
 *
 * @author Mario Kellner <mario.kellner@studmail.w-ha.de>
 * @author Jan Markus Momper <jan-markus.momper@studmail.w-hs.de>
 * @author Philipp Miller <philipp.miller@studmail.w-hs.de>
 * @author Mark Friedrich <mark.friedrich@studmail.w-hs.de>
 */
class main implements IController {

    /**
     *
     */
    public function Run()
    {
        $resultSet = Application::$database->databaseLink->query("SELECT * FROM spiele WHERE gelbekartenheim IS NULL AND datumuhrzeit BETWEEN DATE_SUB(NOW(), INTERVAL 3 HOUR) AND NOW() ");
        $gamesArray = [];
        if ($resultSet) {
            while ($row = $resultSet->fetch_assoc()) {
                $gamesArray[] = $row;
            }

            Application::$smarty->assign("SpieleArray", $gamesArray);
        }

        Application::$smarty->assign('contentfile', 'main.tpl');
    }
}