<h2>Registrieren</h2>
<hr>

<p style="font-size: 18px">
    Mit diesem Formular könne sich ein Benutzeraccount registrieren. <br />
    Bitte geben Sie dafür alle nötigen Infórmationen an und drücken Sie anschließend <br />
    Auf "Registrieren".
</p>

<hr>
<form action="index.php?module=register" method="post">
    <div class="formElements">
        <div class="formLine">
            <label for="accountname">Nickname:</label><input type="text" id="accountname" name="account[nickname]" >
        </div>
        <div class="formLine">
            <label for="email">E-Mail:</label><input type="text" id="email" name="account[email]">
        </div>
    </div>
    <div class="btnLine">
        <input type="submit" value="Registrieren">
    </div>
</form>