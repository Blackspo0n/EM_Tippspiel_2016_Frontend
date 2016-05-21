<?php

class main {
    public function __construct()
    {
        var_dump("hallo");

        Application::$smarty->assign("yolo", "You only 'lies' once.");
        Application::$smarty->assign('contentfile', 'main.tpl');
    }
}