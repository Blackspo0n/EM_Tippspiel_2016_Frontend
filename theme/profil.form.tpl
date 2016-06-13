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
        <td>{$TippArray.spielbezeichnung}</td>
        <td>
            {IF strstr($TippArray.heimmannschaft, " ", true) ne null}<img class="flags" src="theme/img/flags/euFlag.png" />{ELSE}<img class="flags" src="theme/img/flags/{$TippArray.heimmannschaft}.png" />{/IF} {$TippArray.heimmannschaft}
        </td>
        <td>
            {IF strstr($TippArray.gastmannschaft, " ", true) ne null}<img class="flags" src="theme/img/flags/euFlag.png" />{ELSE}<img class="flags" src="theme/img/flags/{$TippArray.gastmannschaft|default:"euFlag"}.png" />{/IF} {$TippArray.gastmannschaft}
        </td>
        <td align="center">{$TippArray.datumuhrzeit|date_format:'d. M Y H:i'}</td>
        <td>{$TippArray.spielort}</td>
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

<form action="index.php?module=profil&tipp={$TippArray.tippid}" method="post" class="tipinputForm">
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
            <td align="center"><input type="number" id="homefirsthalf" name="tipchange[tippheimhz]" value="{$TippArray.tippheimhz}" /></td>
            <td align="center"><input type="number" id="guestfirsthalf" name="tipchange[tippgasthz]" value="{$TippArray.tippgasthz}" /></td>
        </tr>

        <tr>
            <td>Tore nach 2. Halbzeit</td>
            <td align="center"><input type="number" id="homefirsthalf" name="tipchange[tippheimende]" value="{$TippArray.tippheimende}" /></td>
            <td align="center"><input type="number" id="guestfirsthalf" name="tipchange[tippgastende]" value="{$TippArray.tippgastende}" /></td>
        </tr>

        {if strpos($TippArray.spielbezeichnung, "ruppe ") eq false}
            <tr>
                <td>Tore nach Verlängerung</td>
                <td align="center"><input type="number" id="homefirsthalf" name="tipchange[tippheimverl]" value="{$TippArray.tippheimverl}" /></td>
                <td align="center"><input type="number" id="guestfirsthalf" name="tipchange[tippgastverl]" value="{$TippArray.tippgastverl}" /></td>
            </tr>

            <tr>
                <td>Tore nach Elfmeter</td>
                <td align="center"><input type="number" id="homefirsthalf" name="tipchange[tippheimelf]" value="{$TippArray.tippheimelf}" /></td>
                <td align="center"><input type="number" id="guestfirsthalf" name="tipchange[tippgastelf]" value="{$TippArray.tippgastelf}" /></td>
            </tr>
        {/if}

        <tr>
            <td>Gelbe Karten</td>
            <td align="center"><input type="number" id="homefirsthalf" name="tipchange[tippgelbeheim]" value="{$TippArray.tippgelbeheim}" /></td>
            <td align="center"><input type="number" id="guestfirsthalf" name="tipchange[tippgelbegast]" value="{$TippArray.tippgelbegast}" /></td>
        </tr>
        <tr>
            <td>Rote Karten</td>
            <td align="center"><input type="number" id="homefirsthalf" name="tipchange[tipproteheim]" value="{$TippArray.tipproteheim}" /></td>
            <td align="center"><input type="number" id="guestfirsthalf" name="tipchange[tipprotegast]" value="{$TippArray.tipprotegast}" /></td>
        </tr>
        <tr>
            <td></td>
            <td align="center" style="padding: 10px;"><input type="submit" value="Tipp ändern"></td>
            <td align="center"></td>
        </tr>
        </tbody>
    </table>
</form>