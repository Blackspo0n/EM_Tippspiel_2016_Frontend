<h2 style="text-align: center">Dein Profil</h2>
<hr>

<h3 class="h3Games">Deine Tipps</h3>
<table class="tippTable">
    <thead style="height: 30px; vertical-align: top">
        <tr>
            <th style="width: 350px">
                Mannschaften
            </th>
            <th>
                Spieldatum
            </th>
            <th>
                Ergebnis 1. HZ
            </th>
            <th>
                Ergebnis 2. HZ
            </th>

            <th>
                Ergebnis Verl&auml;ngerung
            </th>
            <th>
                Ergebnis Elfmeter
            </th>
            <th>
                Gelbe Karten
            </th>
            <th>
                Rote Karten
            </th>
        </tr>
    </thead>
    <tbody>
        {foreach from=$TippArray item=tipps}
            <tr>
                <td>
                    {IF strstr($tipps.heimmannschaft, " ", true) ne null}<img class="flags" src="theme/img/flags/euFlag.png" />{ELSE}<img class="flags" src="theme/img/flags/{$tipps.heimmannschaft}.png" />{/IF} {$tipps.heimmannschaft}
                    :
                    {IF strstr($tipps.gastmannschaft, " ", true) ne null}<img class="flags" src="theme/img/flags/euFlag.png" />{ELSE}<img class="flags" src="theme/img/flags/{$tipps.gastmannschaft}.png" />{/IF} {$tipps.gastmannschaft}
                </td>
                <td>
                    {$tipps.datumuhrzeit|date_format:"d. M Y H:i"}
                </td>
                <td>
                    {$tipps.heimmannschafthz}
                    :
                    {$tipps.gastmannschafthz}
                </td>
                <td>
                    {$tipps.heimmannschaftende}
                    :
                    {$tipps.gastmannschaftende}
                </td>
                <td>
                    {$tipps.heimmannschaftverl}
                    {IF $tipps.verlaengerung ne null}:{/IF}
                    {$tipps.gastmannschaftverl}
                </td>
                <td>
                    {$tipps.heimmannschaftelf}
                    {IF $tipps.elfmeter ne null}:{/IF}
                    {$tipps.gastmannschaftelf}
                </td>
                <td>
                    {$tipps.gelbekartenheim}
                    :
                    {$tipps.gelbekartengast}
                </td>
                <td>
                    {$tipps.rotekartenheim}
                    :
                    {$tipps.rotekartengast}
                </td>
            </tr>
        {/foreach}
    </tbody>
</table>