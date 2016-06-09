<h2 class="headerguidelines">Tippabgabe</h2>

<hr>

<p></p>

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
            <td style="border-right: 0px;">
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
                <td align="center"><input type="number" id="homefirsthalf" name="tipinput[heimmannschafthz]" /></td>
                <td align="center"><input type="number" id="guestfirsthalf" name="tipinput[gastmannschafthz]"></td>
            </tr>

            <tr>
                <td>Tore nach 2. Halbzeit {strpos($singleGameData.spielbezeichnung, "Gruppe")}</td>
                <td align="center"><input type="number" id="homefirsthalf" name="tipinput[heimmannschaftende]" /></td>
                <td align="center"><input type="number" id="guestfirsthalf" name="tipinput[gastmannschaftende]"></td>
            </tr>

            {if strpos($singleGameData.spielbezeichnung, "Gruppe") == false}
            <tr>
                <td>Tore nach Verlängerung</td>
                <td align="center"><input type="number" id="homefirsthalf" name="tipinput[heimmannschaftverl]" /></td>
                <td align="center"><input type="number" id="guestfirsthalf" name="tipinput[gastmannschaftverl]"></td>
            </tr>

            <tr>
                <td>Tore nach Elfmeter</td>
                <td align="center"><input type="number" id="homefirsthalf" name="tipinput[heimmannschaftelf]" /></td>
                <td align="center"><input type="number" id="guestfirsthalf" name="tipinput[heimmannschaftelf]"></td>
            </tr>
            {/if}

            <tr>
                <td>Gelbe Karten</td>
                <td align="center"><input type="number" id="homefirsthalf" name="tipinput[gelbekartenheim]" /></td>
                <td align="center"><input type="number" id="guestfirsthalf" name="tipinput[gelbekartengast]"></td>
            </tr>
            <tr>
                <td>Rote Karten</td>
                <td align="center"><input type="number" id="homefirsthalf" name="tipinput[rotekartenheim]" /></td>
                <td align="center"><input type="number" id="guestfirsthalf" name="tipinput[rotekartengast]"></td>
            </tr>
            <tr>
                <td></td>
                <td align="center" style="padding: 10px;"><input type="submit" value="Tipps Speichern"></td>
                <td align="center"></td>
            </tr>
        </tbody>
    </table>
</form>