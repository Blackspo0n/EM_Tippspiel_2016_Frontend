<?php
require_once ROOT_DIR . DS . 'classes' . DS . 'Database.php';
require_once ROOT_DIR . DS . 'classes' . DS . 'SmartyInstance.php';
require_once ROOT_DIR . DS . 'classes' . DS . 'FrontController.php';
require_once ROOT_DIR . DS . 'classes' . DS . 'libs' . DS . 'smarty-3.1.29' . DS . 'libs' . DS .  'Smarty.class.php';


/**
 * Class Application Our entrypoint for our OOP orientated website
 *
 * @author Mario Kellner <mario.kellner@studmail.w-ha.de>
 * @static
 * @version 1.0
 *
 */
class Application
{
    /**
     * @var SmartyInstance
     */
    public static $smarty;
    /**
     * @var Database
     */
    public static $database;
    /**
     * @var boolean
     */
    public static $hasValidDatabaseConnection;

    /**
     * @var FrontController
     */
    public static $frontController;

    /**
     * This static function will initialize the App.
     */
    public static function Initialize() {
        //register classloader for dynamic classloading
        spl_autoload_register(function ($class) {

            if(file_exists(ROOT_DIR . DS . 'classes' . DS . 'controller' . DS . $class . '.class.php')) {
                include ROOT_DIR . DS . 'classes' . DS . 'controller' . DS . $class . '.class.php';
                return true;
            }

            return false;
        });

        // Set our template
        self::$smarty = SmartyInstance::getInstance();

        // Connect to Database
        self::$database = new Database();
        self::$database->setServerInformation(Config::$databaseSettings['host'], Config::$databaseSettings['user'],
            Config::$databaseSettings['password'] , Config::$databaseSettings['database']
        );

        try {
            self::$database->connectToDatabase();
            self::$hasValidDatabaseConnection = true;
        }
        catch (Exception $err) {
        }

        // create our moduleloader (Frontcontroller)
        self::$frontController = new FrontController();
    }

    /**
     * This function is our main function like "static void main(String[] args)" in java.
     *
     * @param $mainModule String Controller that should be loaded
     */
    public static function Run($mainModule) {
        if(self::$hasValidDatabaseConnection) {
            if(self::$frontController->ControllerExists($mainModule)) {
                self::$frontController->runController($mainModule);
            }
            else {
                self::$frontController->runController(self::$frontController->defaultCobntroller);
            }

        }
        else {

            self::$frontController->runController("databaseerror");
        }

    }


    /**
     * Flush tells this class that everything should be outputed to the browser
     */
    public static function Flush() {

        self::$smarty->display('index.tpl');
    }
}