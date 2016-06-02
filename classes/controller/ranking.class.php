<?php

/**
 * Created by PhpStorm.
 * User: Chuckl0r
 * Date: 02.06.2016
 * Time: 14:31
 */
class ranking implements IController
{

    public function Run()
    {
        $resultSet = Application::$database->databaseLink->query("SELECT * from ranking");
        if ($resultSet) {
            while ($row = $resultSet->fetch_assoc()) {
                var_dump($row);
            }

        }

    }
}