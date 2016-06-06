<?php

/**
 * Class Config
 *
 *
 */
class Config
{
    public static $databaseSettings = [
        'host' => 'guessandwin.gamer-point.com',
        'user' => 'guessandwinTeam',
        'password' => '***',
        'database' => 'em2016'
    ];
    
    public static $smtpSettings = [
        'host' => '',
        'user' => '',
        'email' => '',
        'password' => '',
    ];
}

define('ROOT_DIR', __DIR__);
define('DS', DIRECTORY_SEPARATOR);