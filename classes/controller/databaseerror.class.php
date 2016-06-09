<?php

/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 21.05.2016
 * Time: 19:54
 */
class databaseerror implements IController
{
    /**
     * databaseerror constructor.
     */
    public function __construct()
    {
    }

    /**
     *
     */
    public function Run()
    {
        Application::$smarty->assign('mysqlerror', mysqli_error(Application::$database->databaseLink));
        Application::$smarty->assign('contentfile', 'databaseerror.tpl');
    }
}