<h2 class="headerguidelines">Passwort zurücksetzen</h2>
<hr>

<p style="width: 600px; text-align: center; margin: 0 auto;">
    Hier hast du die Möglichkeit dein Passwort auf ein zufällig generiertes Passwort zurück zu setzen.
    Gebe hier zu einfach deine E-Mail. Sofern die E-Mail bekannt ist wird das neu generierte Passwort
    an diese E-Mail geschickt.
</p>


<form action="index.php?module=register" method="post" class="registForm">
    <div class="formElements">
        <div class="formLine">
            <label for="email">E-MailAdresse:</label><input type="text" id="email" name="forgotPassword[email]" title="Wird zur Anmeldung ben&ouml;tigt.">
        </div>
    </div>

    <div class="btnLine" style="margin-top: 20px;">
        <input type="submit" value="Passwort zurücksetzen">
    </div>
</form>