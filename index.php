<?php
/**
 * Our index.php is the default file thats be called by the apache server
 * it setup our oop app load the default module main if no modulename was
 * specified.
 *
 * @author Mario Kellner <mario.kellner@studmail.w-hs.de>
 * @version 1.0
 * 
 */
session_start();
error_reporting(E_ERROR);

ini_set('display_errors', '1');

require __DIR__ . DIRECTORY_SEPARATOR . 'Config.php';
require_once __DIR__  . DS . 'Application.php';

if(!isset($_GET['module'])) {
    $_GET['module'] = 'main';
}

Application::Initialize();
Application::Run($_GET['module']);
Application::Flush();

