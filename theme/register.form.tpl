<h2 style="text-align: center">Registrieren</h2>
<hr>

<p style="font-size: 18px; text-align: center">
    Mit diesem Formular können Sie einen Benutzeraccount registrieren. <br />
    Bitte geben Sie dafür alle nötigen Informationen an und drücken Sie anschließend <br />
    auf "Registrieren".
</p>
{if isset($registrationErrors)}
    <hr/>
    <div style="font-size: 18px; text-align: center; color: white; background: lightcoral;">
        {foreach from=$registrationErrors item=error}
            {$error}<br />
        {/foreach}
    </div>
{/if}
<div></div>
<hr>
<form action="index.php?module=register" method="post" class="registForm">
    <div class="formElements">
        <div class="formLine">
            <label for="accountname">Benutzername:</label><input type="text" id="accountname" name="account[benutzerName]" title="Wird zur Anmeldung benötigt." value="{$defaults.benutzerName|default:''}">
        </div>
        <div class="formLine">
            <label for="nickname">Nickname:</label><input type="text" id="nickname" name="account[nickname]" title="Wird in der Tipprunde angezeigt."  value="{$defaults.nickname|default:''}">
        </div>
        <div class="formLine">
            <label for="password">Passwort:</label><input type="password" id="password" name="account[passwort]" >
        </div>
        <div class="formLine">
            <label for="passwordrepeat">Passwort - Bestätigung:</label><input type="password" id="passwordrepeat" name="account[passwortrepeat]">
        </div>
        <div class="formLine">
            <label for="email">E-Mail:</label><input type="text" id="email" name="account[email]"  value="{$defaults.email|default:''}">
        </div>
        <div class="formLine">
            <label for="emailrepeat">E-Mail - Bestätigung:</label><input type="text" id="emailrepeat" name="account[emailrepeat]">
        </div>
        <div class="formLine">
            <label for="show_Email">E-Mail Anzeigen?</label>
            <input type="hidden" value="0" name="account[show_Email]">
            <input type="checkbox" value="1" id="show_Email" name="account[show_Email]">
        </div>
    </div>
    <div class="btnLine">
        <input type="submit" value="Registrieren">
    </div>
</form>