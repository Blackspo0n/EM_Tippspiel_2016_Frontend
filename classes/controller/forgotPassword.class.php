<?php

/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 07.06.2016
 * Time: 09:49
 */
class forgotPassword implements IController
{

    public function Run()
    {
        if(array_key_exists("forgotPassword", $_POST)) {
            $this->doPasswordRecover($_POST['forgotPassword']);
        }
        else {
            $this->displayPasswordForm();
        }
    }

    public function doPasswordRecover(array $passwordRecover) {
        $db = Application::$database->databaseLink;

        $result = $db->query("SELECT * FROM benutzer WHERE email = '" . $db->real_escape_string($passwordRecover['email']) . "'");

        if($result) {
            if($fetch = $result->fetch_assoc()) {
                $newPassword = $this->generatePassword();

                Application::$database->databaseLink->query("UPDATE benutzer SET passwort = '" . md5($newPassword) . "' WHERE benutzerid = " . (int)$fetch['benutzerid']);
                $fetch['passwort'] = $newPassword;


                $this->sendMail($fetch);

                Application::$smarty->assign('contentfile', 'forgotPassword.success.tpl');
            }
            else {
                Application::$smarty->assign("error", "E-Mail Adresse existiert nicht");

                Application::$smarty->assign('contentfile', 'forgotPassword.tpl');
            }
        }
        else {
            Application::$smarty->assign("error", "E-Mail Adresse existiert nicht");

            Application::$smarty->assign('contentfile', 'forgotPassword.tpl');
        }
    }

    private function generatePassword()  {
        $pool = "qwertzupasdfghkyxcvbnm";
        $pool .= "23456789";
        $pool .= "WERTZUPLKJHGFDSAYXCVBNM";

        srand ((double)microtime()*1000000);
        $pass_word = '';

        for($index = 0; $index < 7; $index++) {
            $pass_word .= substr($pool,(rand()%(strlen ($pool))), 1);
        }

        return $pass_word;
    }
    public function displayPasswordForm() {
        Application::$smarty->assign("contentfile", "forgotPassword.tpl");
    }

    public function sendMail(array $userdata)
    {
        $mailbody = "Hallo " . $userdata['nickname'] . ",\n\n" .
        "du hast erfolgreich dein Passwort zurück gesetzt. \n" .
        "Anbei findest du dein neues Passwort:\n\n" .
        $userdata['passwort'] . "\n\n" .
        "Bitte beachte, dass dein Passwort nur als Hash in unsere Datenbank gespeichert wird.\n" .
        "Notiere dir dein Passwort daher gut.\n\n" .
        "Auf gutes Tippen \n" .
        "Dein W-HS Tippspiel Team";

        //erzeuge Email
        $mail = new phpmailer();

        $mail->isSMTP();
        $mail->CharSet = 'utf-8';
        $mail->SetLanguage("de");
        $mail->Host = Config::$smtpSettings['host'];
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username =  Config::$smtpSettings['user'];
        $mail->Password =  Config::$smtpSettings['password'];
        $mail->From     =  Config::$smtpSettings['email'];
        $mail->FromName = Config::$smtpSettings['emailname'];

        //main
        $mail->AddAddress($userdata['email'], $userdata['nickname']);
        $mail->WordWrap = 50;
        $mail->IsHTML(false);
        $mail->Subject  =  "WHS Tippspiel - Passwort vergessen";
        $mail->Body     =  $mailbody;

        Application::$smarty->assign("sendEmail", true);

        if(!$mail->Send()) {
            Application::$smarty->assign("sendEmail", false);
            Application::$smarty->assign("emailError", $mail->ErrorInfo);
        }
    }
}