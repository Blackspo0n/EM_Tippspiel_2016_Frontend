<?php

/**
 * This Controller provides a User registry
 *
 * This Controller provided the webpage for the user creation
 * and perform the write task to the database.
 *
 * @author Mario Kellner <mario.kellner@studmail.w-ha.de>
 * @author Jan Markus Momper <jan-markus.momper@studmail.w-hs.de>
 * @author Philipp Miller <philipp.miller@studmail.w-hs.de>
 * @author Mark Friedrich <mark.friedrich@studmail.w-hs.de>
 * @version 1.0
 */
class register implements IController
{
    /**
     *
     */
    public function Run()
    {
        if (array_key_exists('account', $_POST)) {
            $result = $this->doAccountRegister($_POST['account']);
            if ($result === true) {
                $this->sendMail($_POST['account']);
                $this->RegisterSuccess();
            } else {
                Application::$smarty->assign('registrationErrors', $result);
                $this->RegisterFormular($_POST['account']);


            }
        } else {
            $this->RegisterFormular();
        }
    }

    /**
     *
     */
    public function RegisterSuccess()
    {
        Application::$smarty->assign('contentfile', 'register.success.tpl');
    }

    /**
     * @param array|null $formDefaults
     */
    public function RegisterFormular(array $formDefaults = null)
    {
        Application::$smarty->assign('defaults', $formDefaults);
        Application::$smarty->assign('contentfile', 'register.form.tpl');
    }

    /**
     * This function checks if the userdata from the form are valid
     *
     * Note: Yes, it is possible to return two different types in PHP.
     * It is dirty, but i dont want to create an abstract class with constants (like an enum in java)
     *
     * @param array $accountdata The userdata that was posted by the form
     * @return array Error messages
     * @return true registration complete
     */
    public function doAccountRegister(array $accountdata)
    {
        $errorMessages = [];

        $db = Application::$database->databaseLink; // because its shorter than Application::$database->databaseLink

        if (empty($accountdata['benutzerName'])) {
            $errorMessages[] = 'Kein Benutzernamen angegeben.';
        }

        if (empty($accountdata['nickname'])) {
            $errorMessages[] = 'Kein Nicknamen angegeben.';
        }

        if (empty($accountdata['email'])) {
            $errorMessages[] = 'Keine E-Mail angegeben.';
        }

        if (empty($accountdata['passwort'])) {
            $errorMessages[] = 'Kein Passwort angegeben.';
        }

        if (count($errorMessages) === 0) {
            if ($accountdata['passwort'] !== $accountdata['passwortrepeat']) {

                $errorMessages[] = 'Die Passwörter stimmen nicht überein';

            }
            if ($accountdata['email'] !== $accountdata['emailrepeat']) {
                $errorMessages[] = 'Die Passwörter stimmen nicht überein';
            }
            unset($accountdata['emailrepeat'], $accountdata['passwortrepeat']);
        }

        // all conditions checked, lets create the account
        if (count($errorMessages) === 0) {
            if (!UserHelper::UserRegister($accountdata)) {
                $errorMessages[] = 'Account konnte nicht erstellt werden. Interner Fehler.';
            } else {
                return true;
            }
        }

        return $errorMessages;
    }


    /**
     * @param array $userdata
     * @throws phpmailerException
     */
    public function sendMail(array $userdata)
    {
        $mailbody = "Hallo " . $userdata['nickname'] . ",\n\n" .
        "vielen Dank für deine Registrierung für das Tippspiel der W-HS. \n" .
        "Anbei findest du noch alle deine wichtigen Nutzerdaten:\n\n" .
        "E-Mail Adresse: " . $userdata['email'] . "\n" .
        "Nickname (dein Loginname): " . $userdata['nickname'] . "\n" .
        "Passwort: " . $userdata['passwort'] . " \n\n" .
        "Bitte beachte, dass dein Passwort nur als Hash in unsere Datenbank gespeichert wird.\n" .
        "Notiere dir dein Passwort daher gut.\n\n" .
        "Auf gutes Tippen \n" .
        "Dein W-HS Tippspiel Team";

        //erzeuge Email
        $mail = new phpmailer();
    
        $mail->isSMTP();
        $mail->CharSet = 'utf-8';
        $mail->setLanguage('de');
        $mail->Host = Config::$smtpSettings['host'];
        $mail->SMTPAuth = true;
        $mail->Username =  Config::$smtpSettings['user'];
        $mail->Password =  Config::$smtpSettings['password'];
        $mail->From     =  Config::$smtpSettings['email'];
        $mail->FromName =  Config::$smtpSettings['emailname'];

        //main
        $mail->addAddress($userdata['email'], $userdata['nickname']);
        $mail->WordWrap = 50;
        $mail->isHTML(false);
        $mail->Subject  = 'WHS Tippspiel - Registrierung';
        $mail->Body     =  $mailbody;

        Application::$smarty->assign('sendEmail', true);
        if(!$mail->send()) {
            Application::$smarty->assign('sendEmail', false);
            Application::$smarty->assign('emailError', $mail->ErrorInfo);
        }
    }
}