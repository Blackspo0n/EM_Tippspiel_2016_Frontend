<?php

/**
 * Class login
 * 
 */
class login implements IController
{

    public function Run()
    {
        if(array_key_exists("login", $_POST) && !UserHelper::isUserLogged()) {
            if (UserHelper::UserLogin($_POST['login']['nickname'], $_POST['login']['passwort'], (boolean)$_POST['login']['autologin'])) {
                header('Location: index.php');
            }
            else {
                Application::$smarty->assign("contentfile", "login.fail.tpl");
            }
        }
        elseif(array_key_exists("logout", $_GET)) {
            if(UserHelper::UserLogout()) {
                header('Location: index.php');
            }
        }
    }
}