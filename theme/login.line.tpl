<form  class="loginForm" method="post" action="index.php?module=login">
    <label for="nickname">Benutzername:</label><input type="text" id="nickname" name="login[nickname]" />
    <label for="password">Passwort:</label><input type="password" id="password" name="login[passwort]" />
    <input type="hidden" value="0" name="login[autologin]" />
    <input type="checkbox" value="1" id="autologin" name="login[autologin]">
    <label for="autologin">Autologin</label>
    <input type="submit" value="Login" />
</form>