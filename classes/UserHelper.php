<?php

/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 25.05.2016
 * Time: 14:22
 */
class UserHelper
{
    public static function UserLogin($user, $password, $remember = false) {
        if($user === null || $password === null) {
            return false;
        }

        $result = Application::$database->databaseLink->query("SELECT * FROM benutzer WHERE nickname = '" .
            Application::$database->databaseLink->real_escape_string($user)
            . "' AND passwort = '" . Application::$database->databaseLink->real_escape_string($password) . "'");


        if(!$result)  return false;

        $fetch = $result->fetch_assoc();

        if(!$fetch) return false;


        $_SESSION['userid'] = $fetch['benutzerid'];
        $_SESSION['username'] = $user;
        $_SESSION['logged'] = true;

        Application::$database->databaseLink->query("UPDATE benutzer SET IP = '" . $_SERVER['REMOTE_ADDR'] . "' WHERE benutzerid = " . $fetch['benutzerid'] );


        if($remember) {
            $browserhash = md5(substr($fetch["passwort"], 0, 5)."|".$fetch["benutzerid"]);

            setcookie("loginHash", $browserhash, time() + 3600 * 24 * 60);
            setcookie("login", base64_encode($fetch["benutzerid"]) , time() + 3600 * 24 * 60);
            
            Application::$database->databaseLink->query("UPDATE benutzer SET sessionID = '" . $browserhash . "' WHERE benutzerid = " . $fetch['benutzerid'] );

        }
        return true;
    }

    public function AutoLogin() {
        $userId = base64_decode($_COOKIE["login"]);

        $result = Application::$database->databaseLink->query("SELECT * FROM benutzer WHERE benutzerid = " .
            Application::$database->databaseLink->real_escape_string($userId)
        );

        $fetch = $result->fetch_assoc();


        if($fetch['sessionID'] == $_COOKIE["loginHash"]){
            UserHelper::UserLogin($fetch['nickname'], $fetch['passwort'], false);
        }

        return false;

    }//function

    public static function UserLogout() {
        if($_SESSION['userid']) {
            Application::$database->databaseLink->query("UPDATE benutzer SET sessionID = '' WHERE benutzerid =" . $_SESSION['userid']);
        }

        session_destroy();
    }

    public static function isUserLogged() {
        if(!array_key_exists("logged", $_SESSION)) return false;

        if($_SESSION['logged'] == false) return false;

        return true;

    }

    public static function UserRegister($userdata) {

    }
}