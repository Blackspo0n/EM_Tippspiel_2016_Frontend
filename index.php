<?php
/**
 * Our index.php is the default file that is be called by the apache server
 * it setup our oop app load the default module main if no modulename was
 * specified.
 *
 * @license MIT
 * @author Mario Kellner <mario.kellner@studmail.w-ha.de>
 * @author Jan Markus Momper <jan-markus.momper@studmail.w-hs.de>
 * @author Philipp Miller <philipp.miller@studmail.w-hs.de>
 * @author Mark Friedrich <mark.friedrich@studmail.w-hs.de>
 * @version 1.0
 */
// Start session
session_start();

// Enable error_reporting
error_reporting(E_ERROR);
ini_set('display_errors', '1');

// include our config and application php
require __DIR__ . DIRECTORY_SEPARATOR . 'Config.php';
require_once __DIR__  . DS . 'Application.php';

// check if our param is setted. if not set it to main.
if(!isset($_GET['module'])) {
    $_GET['module'] = 'main';
}

// Call our entry
Application::Initialize();
Application::Run($_GET['module']);
Application::Flush();

