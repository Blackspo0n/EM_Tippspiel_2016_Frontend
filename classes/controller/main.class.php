<?php

class main implements IController {
    public function __construct()
    {
        var_dump("hallo");

        Application::$smarty->assign("yolo", "You only 'lies' once.");
        Application::$smarty->assign('contentfile', 'main.tpl');
    }

    public function Run()
    {
        // TODO: Implement Run() method.
    }
}