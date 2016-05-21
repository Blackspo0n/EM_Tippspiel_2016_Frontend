<?php

session_start();
error_reporting(-1);
ini_set('display_errors', '1');

require 'classes/libs/smarty-3.1.29/libs/Smarty.class.php';
require_once 'classes/SmartyInstance.php';

$mario = new Smarty();
$mario->setTemplateDir('theme');
$mario->setCompileDir('theme_compile');

$infoFromMySql = mysql_connect('guessandwin.gamer-point.com', 'guessandwinTeam', 'Tdrl85_6');

if ($infoFromMySql) {
    mysql_select_db('em2016');
    $mario->assign('yolo', 'Erfolgreich zur Datenbank verbunden.');
} else {
    $mario->assign('yolo', 'Verbindung fehlgeschlagen.');
}

$result = mysql_query('SELECT * from spiele');

if ($result) {
    while ($row = mysql_fetch_assoc($result)) {
        var_dump($row);
    }
} else {
    var_dump(mysql_error());
}

$mario->display('index.tpl');
