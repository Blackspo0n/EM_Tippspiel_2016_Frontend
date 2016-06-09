<?php

/**
 * Class login
 *
 *
 * @author Mario Kellner <mario.kellner@studmail.w-ha.de>
 * @author Jan Markus Momper <jan-markus.momper@studmail.w-hs.de>
 * @author Philipp Miller <philipp.miller@studmail.w-hs.de>
 * @author Mark Friedrich <mark.friedrich@studmail.w-hs.de>
 */
class login implements IController
{

    /**
     *
     */
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