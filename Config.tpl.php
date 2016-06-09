<?php

/**
 * Class Config holds the configuration ofthis ebsite
 *
 * @author Mario Kellner <mario.kellner@studmail.w-ha.de>
 * @author Jan Markus Momper <jan-markus.momper@studmail.w-hs.de>
 * @author Philipp Miller <philipp.miller@studmail.w-hs.de>
 * @author Mark Friedrich <mark.friedrich@studmail.w-hs.de>
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
        'host' => 'smtp.web.de',
        'user' => 'whstippspiel@web.de',
        'email' => 'whstippspiel@web.de',
        'emailname' => 'WHS Tippspiel',
        'password' => 'Tdrl85_6',
    ];
}

define('ROOT_DIR', __DIR__);
define('DS', DIRECTORY_SEPARATOR);