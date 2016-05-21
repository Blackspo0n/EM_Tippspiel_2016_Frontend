<?php

/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 21.05.2016
 * Time: 19:54
 */
class databaseerror
{
    public function __construct()
    {
        Application::$smarty->assign('mysqlerror', mysql_error(Application::$database->databaseLink));

        Application::$smarty->assign('contentfile', 'databaseerror.tpl');
    }
}