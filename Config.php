<?php

/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 21.05.2016
 * Time: 11:50
 */
class Config
{
    public static $databaseSettings = [
        'host' => 'localhost',
        'user' => 'root',
        'password' => '',
        'database' => 'em2016'
    ];
}

define('ROOT_DIR', __DIR__);
define('DS', DIRECTORY_SEPARATOR);