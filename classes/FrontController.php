<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 12.05.2016
 * Time: 12:29
 */


class FrontController
{
    public $activeController;
    public $defaultCobntroller = "main";

    public function __construct() {

    }

    public function ControllerExists($controller) {
        if(file_exists(ROOT_DIR . DS . 'classes' . DS . 'controller' . DS . $controller . '.php')) return true;
        return false;
    }

    public function runController($controller) {
        $this->activeController = new $controller();
        
    }
}