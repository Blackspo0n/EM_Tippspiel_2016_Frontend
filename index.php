<?php

session_start();
error_reporting(E_ERROR | E_WARNING);

ini_set('display_errors', '1');

require __DIR__ . DIRECTORY_SEPARATOR . 'Config.php';
require_once __DIR__  . DS . 'Application.php';

if(!isset($_GET['module'])) {
    $_GET['module'] = 'main';
}

Application::Initialize();
Application::Run($_GET['module']);
Application::Flush();

