<?php

/**
 * @author Mario Kellner <mario.kellner@studmail.w-ha.de>
 * @author Jan Markus Momper <jan-markus.momper@studmail.w-hs.de>
 * @author Philipp Miller <philipp.miller@studmail.w-hs.de>
 * @author Mark Friedrich <mark.friedrich@studmail.w-hs.de>
 */
class FrontController
{
    /**
     * @var IController
     */
    public $activeController;
    /**
     * @var string
     */
    public $defaultController = 'main';

    /**
     * FrontController constructor.
     */
    public function __construct() {

    }

    /**
     * @param $controller
     * @return bool
     */
    public function ControllerExists($controller) {
        if(file_exists(ROOT_DIR . DS . 'classes' . DS . 'controller' . DS . $controller . '.class.php')) return true;
        return false;
    }

    /**
     * @param $controller
     */
    public function runController($controller) {
        $this->activeController = new $controller();

        $this->activeController->Run();
    }
}