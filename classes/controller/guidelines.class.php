<?php

/**
 * Created by PhpStorm.
 * User: janos_000
 * Date: 25.05.2016
 * Time: 11:00
 */
class guidelines implements IController
{

    public function Run()
    {
        Application::$smarty->assign('contentfile', 'guidelines.tpl');
    }
}