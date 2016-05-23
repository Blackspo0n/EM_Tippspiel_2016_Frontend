<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 12.05.2016
 * Time: 12:29
 */


class FrontController
{
    /**
     * @var IController
     */
    public $activeController;
    public $defaultController = "main";

    public function __construct() {

    }

    public function ControllerExists($controller) {
        if(file_exists(ROOT_DIR . DS . 'classes' . DS . 'controller' . DS . $controller . '.class.php')) return true;
        return false;
    }

    public function runController($controller) {
        $this->activeController = new $controller();

        $this->activeController->Run();
    }
}