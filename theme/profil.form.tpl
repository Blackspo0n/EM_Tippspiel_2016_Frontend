<h2 class="headerguidelines">Tippabgabe</h2>
<hr />

<table class="NoneHoverTable">
    <thead>
    <tr>
        <th>Spielbezeichnung</th>
        <th>Heim</th>
        <th>Gast</th>
        <th>Datum / Uhrzeit</th>
        <th>Austragungsort</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{$singleGameData.spielbezeichnung}</td>
        <td>
            {IF strstr($singleGameData.gastmannschaft, " ", true) ne null}<img class="flags" src="theme/img/flags/euFlag.png" />{ELSE}<img class="flags" src="theme/img/flags/{$singleGameData.heimmannschaft}.png" />{/IF} {$singleGameData.heimmannschaft}
        </td>
        <td>
            {IF strstr($singleGameData.gastmannschaft, " ", true) ne null}<img class="flags" src="theme/img/flags/euFlag.png" />{ELSE}<img class="flags" src="theme/img/flags/{$singleGameData.gastmannschaft|default:"euFlag"}.png" />{/IF} {$singleGameData.gastmannschaft}
        </td>
        <td align="center">{$singleGameData.datumuhrzeit|date_format:'d. M Y H:i'}</td>
        <td>{$singleGameData.spielort}</td>
    </tr>
    </tbody>
</table>

{if isset($errors)}
    <hr/>
    <div style="font-size: 18px; text-align: center; color: white; background: lightcoral;">
        {foreach from=$errors item=message}
            {$message}
            <br/>
        {/foreach}
    </div>
    <hr/>
{/if}

<form action="index.php?module=tipinput&showform={$singleGameData.spieleid}" method="post" class="tipinputForm">
    <table style="width: 600px;">
        <thead>
        <tr>
            <th></th>
            <th>Heim</th>
            <th>Gast</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Tore nach Halbzeit</td>
            <td align="center"><input type="number" id="homefirsthalf" name="tipinput[tippheimhz]" /></td>
            <td align="center"><input type="number" id="guestfirsthalf" name="tipinput[tippgasthz]"></td>
        </tr>

        <tr>
            <td>Tore nach 2. Halbzeit {strpos($singleGameData.spielbezeichnung, "pe")}</td>
            <td align="center"><input type="number" id="homefirsthalf" name="tipinput[tippheimende]" /></td>
            <td align="center"><input type="number" id="guestfirsthalf" name="tipinput[tippgastende]"></td>
        </tr>

        {if strpos($singleGameData.spielbezeichnung, "ruppe ") eq false}
            <tr>
                <td>Tore nach Verlängerung</td>
                <td align="center"><input type="number" id="homefirsthalf" name="tipinput[tippheimverl]" /></td>
                <td align="center"><input type="number" id="guestfirsthalf" name="tipinput[tippgastverl]"></td>
            </tr>

            <tr>
                <td>Tore nach Elfmeter</td>
                <td align="center"><input type="number" id="homefirsthalf" name="tipinput[tippheimelf]" /></td>
                <td align="center"><input type="number" id="guestfirsthalf" name="tipinput[tippgastelf]"></td>
            </tr>
        {/if}

        <tr>
            <td>Gelbe Karten</td>
            <td align="center"><input type="number" id="homefirsthalf" name="tipinput[tippgelbeheim]" /></td>
            <td align="center"><input type="number" id="guestfirsthalf" name="tipinput[tippgelbegast]"></td>
        </tr>
        <tr>
            <td>Rote Karten</td>
            <td align="center"><input type="number" id="homefirsthalf" name="tipinput[tipproteheim]" /></td>
            <td align="center"><input type="number" id="guestfirsthalf" name="tipinput[tipprotegast]"></td>
        </tr>
        <tr>
            <td></td>
            <td align="center" style="padding: 10px;"><input type="submit" value="Tipp abgeben"></td>
            <td align="center"></td>
        </tr>
        </tbody>
    </table>
</form>