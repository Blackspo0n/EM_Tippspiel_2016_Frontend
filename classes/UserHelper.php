<?php

/**
 * Userhelper provide some useful function.
 *
 * @author Mario Kellner <mario.kellner@studmail.w-ha.de>
 * @author Jan Markus Momper <jan-markus.momper@studmail.w-hs.de>
 * @author Philipp Miller <philipp.miller@studmail.w-hs.de>
 * @author Mark Friedrich <mark.friedrich@studmail.w-hs.de>
 */
class UserHelper
{
    /**
     * @param $user
     * @param $password
     * @param bool $remember
     * @return bool
     */
    public static function UserLogin($user, $password, $remember = false) {
        if($user === null || $password === null) {
            return false;
        }

        $result = Application::$database->databaseLink->query("SELECT * FROM benutzer WHERE nickname = '" .
            Application::$database->databaseLink->real_escape_string($user)
            . "' AND passwort = '" . Application::$database->databaseLink->real_escape_string(md5($password)) . "'");


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

    /**
     * @return bool
     */
    public function AutoLogin() {
        $userId = base64_decode($_COOKIE["login"]);

        $result = Application::$database->databaseLink->query("SELECT * FROM benutzer WHERE benutzerid = " .
            Application::$database->databaseLink->real_escape_string($userId)
        );

        $fetch = $result->fetch_assoc();


        if($fetch['sessionID'] === $_COOKIE['loginHash']){
            UserHelper::UserLogin($fetch['nickname'], $fetch['passwort'], false);
        }

        return false;

    }//function

    /**
     * @return bool
     */
    public static function UserLogout() {
        if($_SESSION['userid']) {
            // invalidate token. It is easier than invalidate the cokies
            Application::$database->databaseLink->query("UPDATE benutzer SET sessionID = '' WHERE benutzerid =" . $_SESSION['userid']);
        }

        session_destroy();

        return true;
    }

    /**
     * @return bool
     */
    public static function isUserLogged() {
        if(!array_key_exists('logged', $_SESSION)) return false;

        if($_SESSION['logged'] === false) return false;

        return true;

    }

    /**
     * Regist a Useraccount
     *
     * Regist a useraccount. It only return false if a user allready exists otherwise the function will
     * regist any user with valid and INVALID data.
     *
     * @param $userdata array
     * @return boolean true registration was successful
     * @return boolean false a error appear during the registration
     */
    public static function UserRegister($userdata) {
        $db = Application::$database->databaseLink;

        $result = $db->query("SELECT benutzerid FROM benutzer WHERE benutzerName = '" . $db->escape_string($userdata['benutzerName']) . "'");
        if(!$result)  return false;

        $fetch = $result->fetch_assoc();

        if($fetch) return false; // username allready exists

        $result = $db->query("SELECT benutzerid FROM benutzer WHERE email = '" . $db->escape_string($userdata['email']) . "'");
        if(!$result)  return false;

        $fetch = $result->fetch_assoc();

        if($fetch) return false; // email allready exists

        if(!array_key_exists('IP', $userdata)) {
            $userdata['IP'] = $_SERVER['REMOTE_ADDR'];
        }

        $counter = 0;
        $sql = "INSERT INTO benutzer (";
        foreach ($userdata as $key => $value)  {
            $sql .= $db->escape_string($key);

            $counter++;
            if($counter < count($userdata)) {
                $sql .= ",";
            }

        }
        $sql .= ") VALUES (";

        $counter = 0;
        foreach ($userdata as $key => $value)  {
            if($key === 'show_Email') {
                $sql .= (int)$value;
            }
            elseif($key === 'passwort') {
                $sql .= "'" . $db->real_escape_string(md5($value)) ."'";
            }
            else {
                $sql .= "'" . $db->real_escape_string($value) ."'";
            }
            $counter++;
            if($counter < count($userdata)) {
                $sql .= ",";
            }
        }

        $sql .= ')';

        if($db->query($sql)) {
            return true;
        }

        return false;

    }
}