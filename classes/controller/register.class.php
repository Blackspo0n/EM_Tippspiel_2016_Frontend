<?php

/**
 * This Controller provides a User registry
 *
 * This Controller provided the webpage for the user creation
 * and perform the write task to the database.
 *
 * @author Mario Kellner <mario.kellner@studmail.w-hs.de>
 * @version 1.0
 */
class register implements IController
{
    public function Run()
    {
            if(array_key_exists('account', $_POST)) {
            $result = $this->doAccountRegister($_POST['account']);
            if($result === true) {
                $this->sendMail($_POST['account']);
                $this->RegisterSuccess();
            }
            else {
                Application::$smarty->assign('registrationErrors', $result);
                $this->RegisterFormular($_POST['account']);


            }
        }
        else {
            $this->RegisterFormular();
        }
    }

    public function RegisterSuccess() {
        Application::$smarty->assign('contentfile', 'register.success.tpl');
    }

    public function RegisterFormular(array $formDefaults = null) {
        Application::$smarty->assign('defaults', $formDefaults);
        Application::$smarty->assign('contentfile', 'register.form.tpl');
    }

    /**
     * This function checks if the userdata from the form are valid
     *
     * Note: Yes, it is possible to return two different types in PHP.
     * It is dirty, but i dont want zo create a abstract class with constants (like a enum in java)
     *
     * @param array $accountdata The userdata that was posted by the form
     * @return array Error messages
     * @return true registration complete
     */
    public function doAccountRegister(array $accountdata) {
        $errorMessages = [];

        $db = Application::$database->databaseLink; // because its shorter than Application::$database->databaseLink

        if(empty($accountdata['benutzerName'])) {
            $errorMessages[] = 'Kein Benutzernamen angegeben.';
        }

        if(empty($accountdata['nickname'])) {
            $errorMessages[] = 'Kein Nicknamen angegeben.';
        }
        
        if(empty($accountdata['email'])) {
            $errorMessages[] = 'Keine E-Mail angegeben.';
        }
        
        if(empty($accountdata['passwort'])) {
            $errorMessages[] = 'Keine Passwort angegeben.';
        }
        
        if(count($errorMessages) === 0) {
            if($accountdata['passwort'] !== $accountdata['passwortrepeat']) {

                $errorMessages[] = 'Die Passwörter stimmen nicht überein';

            }
            if($accountdata['email'] !== $accountdata['emailrepeat']) {
                $errorMessages[] = 'Die Passwörter stimmen nicht überein';
            }
            unset($accountdata['emailrepeat']);
            unset($accountdata['passwortrepeat']);
        }

        // all conditions checked, lets create the account
        if(count($errorMessages) === 0) {
            if(!UserHelper::UserRegister($accountdata)) {
                $errorMessages[] = 'Account konnte nicht erstellt werden. Interner Fehler.';
            }
            else {
                return true;
            }
        }
        
        return $errorMessages;
    }


    public function sendMail(array $userdata) {

    }
}