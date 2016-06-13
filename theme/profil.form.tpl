<h2 class="headerguidelines">Tippänderung</h2>
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
        <td>{$singleChangeData.spielbezeichnung}</td>
        <td>
            {IF strstr($singleChangeData.gastmannschaft, " ", true) ne null}<img class="flags" src="theme/img/flags/euFlag.png" />{ELSE}<img class="flags" src="theme/img/flags/{$singleChangeData.heimmannschaft}.png" />{/IF} {$singleChangeData.heimmannschaft}
        </td>
        <td>
            {IF strstr($singleChangeData.gastmannschaft, " ", true) ne null}<img class="flags" src="theme/img/flags/euFlag.png" />{ELSE}<img class="flags" src="theme/img/flags/{$singleChangeData.gastmannschaft|default:"euFlag"}.png" />{/IF} {$singleChangeData.gastmannschaft}
        </td>
        <td align="center">{$singleChangeData.datumuhrzeit|date_format:'d. M Y H:i'}</td>
        <td>{$singleChangeData.spielort}</td>
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

<form action="index.php?module=profil&showform={$singleChangeData.spieleid}" method="post" class="tipinputForm">
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
            <td align="center"><input type="number" id="homefirsthalf" name="tipchange[tippheimhz]" /></td>
            <td align="center"><input type="number" id="guestfirsthalf" name="tipchange[tippgasthz]"></td>
        </tr>

        <tr>
            <td>Tore nach 2. Halbzeit {strpos($singleGameData.spielbezeichnung, "pe")}</td>
            <td align="center"><input type="number" id="homefirsthalf" name="tipchange[tippheimende]" /></td>
            <td align="center"><input type="number" id="guestfirsthalf" name="tipchange[tippgastende]"></td>
        </tr>

        {if strpos($singleChangeData.spielbezeichnung, "ruppe ") eq false}
            <tr>
                <td>Tore nach Verlängerung</td>
                <td align="center"><input type="number" id="homefirsthalf" name="tipchange[tippheimverl]" /></td>
                <td align="center"><input type="number" id="guestfirsthalf" name="tipchange[tippgastverl]"></td>
            </tr>

            <tr>
                <td>Tore nach Elfmeter</td>
                <td align="center"><input type="number" id="homefirsthalf" name="tipchange[tippheimelf]" /></td>
                <td align="center"><input type="number" id="guestfirsthalf" name="tipchange[tippgastelf]"></td>
            </tr>
        {/if}

        <tr>
            <td>Gelbe Karten</td>
            <td align="center"><input type="number" id="homefirsthalf" name="tipchange[tippgelbeheim]" /></td>
            <td align="center"><input type="number" id="guestfirsthalf" name="tipchange[tippgelbegast]"></td>
        </tr>
        <tr>
            <td>Rote Karten</td>
            <td align="center"><input type="number" id="homefirsthalf" name="tipchange[tipproteheim]" /></td>
            <td align="center"><input type="number" id="guestfirsthalf" name="tipchange[tipprotegast]"></td>
        </tr>
        <tr>
            <td></td>
            <td align="center" style="padding: 10px;"><input type="submit" value="Tipp ändern"></td>
            <td align="center"></td>
        </tr>
        </tbody>
    </table>
</form>