<h2 style="text-align: center">Ranking</h2>
<hr />
<h3 class="h3Games">Gruppenphase</h3>
<table class="gamesTable">
    <thead>
    <tr>
        <th>
            Spielbezeichnung
        </th>
        <th>
            Spielort
        </th>
        <th>
            Start
        </th>
        <th colspan="2">
            Mannschaften
        </th>
        <th>
            Ergebnis
        </th>
    </tr>
    </thead>

    <tbody>
    {foreach from=$GruppenArray item=grpPhase}
        <tr>
            <td>
                {$grpPhase.spielbezeichnung}
            </td>
            <td>
                {$grpPhase.spielort}
            </td>
            <td>
                {$grpPhase.datumuhrzeit}
            </td>
            <td style="border-right: 0px;">
                {IF strstr($grpPhase.gastmannschaft, " ", true) ne null}<img class="flags" src="/theme/img/flags/euFlag.png" />{ELSE}<img class="flags" src="/theme/img/flags/{$grpPhase.heimmannschaft}.png" />{/IF} {$grpPhase.heimmannschaft}
            </td>
            <td>
                {IF strstr($grpPhase.gastmannschaft, " ", true) ne null}<img class="flags" src="/theme/img/flags/euFlag.png" />{ELSE}<img class="flags" src="/theme/img/flags/{$grpPhase.gastmannschaft|default:"euFlag"}.png" />{/IF} {$grpPhase.gastmannschaft}
            </td>
            <td style="text-align: center">
                {$grpPhase.heimmannschaftende|default:"-"} : {$grpPhase.gastmannschaftende|default:"-"}
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>

<br />
<hr />
<h3 class="h3Games">Achtelfinale</h3>

<table class="gamesTable">
    <thead>
    <tr>
        <th>
            Spielbezeichnung
        </th>
        <th>
            Spielort
        </th>
        <th>
            Start
        </th>
        <th colspan="2">
            Mannschaften
        </th>
        <th>
            Ergebnis
        </th>
    </tr>
    </thead>

    <tbody>
    {foreach from=$AchtelArray item=Achtelfinale}
        <tr>
            <td>
                {$Achtelfinale.spielbezeichnung}
            </td>
            <td>
                {$Achtelfinale.spielort}
            </td>
            <td>
                {$Achtelfinale.datumuhrzeit}
            </td>
            <td style="border-right: 0px;">
                {IF strstr($Achtelfinale.gastmannschaft, " ", true) ne null}<img class="flags" src="/theme/img/flags/euFlag.png" />{ELSE}<img class="flags" src="/theme/img/flags/{$Achtelfinale.heimmannschaft}.png" />{/IF} {$Achtelfinale.heimmannschaft}
            </td>
            <td>
                {IF strstr($Achtelfinale.gastmannschaft, " ", true) ne null}<img class="flags" src="/theme/img/flags/euFlag.png" />{ELSE}<img class="flags" src="/theme/img/flags/{$Achtelfinale.gastmannschaft|default:"euFlag"}.png" />{/IF} {$Achtelfinale.gastmannschaft}
            </td>
            <td style="text-align: center">
                {$Achtelfinale.heimmannschaftende|default:"-"} : {$Achtelfinale.gastmannschaftende|default:"-"}
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>

<br />
<hr />
<h3 class="h3Games">Viertelfinale</h3>

<table class="gamesTable">
    <thead>
    <tr>
        <th>
            Spielbezeichnung
        </th>
        <th>
            Spielort
        </th>
        <th>
            Start
        </th>
        <th colspan="2">
            Mannschaften
        </th>
        <th>
            Ergebnis
        </th>
    </tr>
    </thead>

    <tbody>
    {foreach from=$ViertelArray item=Viertelfinale}
        <tr>
            <td>
                {$Viertelfinale.spielbezeichnung}
            </td>
            <td>
                {$Viertelfinale.spielort}
            </td>
            <td>
                {$Viertelfinale.datumuhrzeit}
            </td>
            <td style="border-right: 0px;">
                {IF strstr($Viertelfinale.gastmannschaft, " ", true) ne null}<img class="flags" src="/theme/img/flags/euFlag.png" />{ELSE}<img class="flags" src="/theme/img/flags/{$Viertelfinale.heimmannschaft}.png" />{/IF} {$Viertelfinale.heimmannschaft}
            </td>
            <td>
                {IF strstr($Viertelfinale.gastmannschaft, " ", true) ne null}<img class="flags" src="/theme/img/flags/euFlag.png" />{ELSE}<img class="flags" src="/theme/img/flags/{$Viertelfinale.gastmannschaft|default:"euFlag"}.png" />{/IF} {$Viertelfinale.gastmannschaft}
            </td>
            <td style="text-align: center">
                {$Viertelfinale.heimmannschaftende|default:"-"} : {$Viertelfinale.gastmannschaftende|default:"-"}
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>

<br />
<hr />
<h3 class="h3Games">Halbfinale</h3>

<table class="gamesTable">
    <thead>
    <tr>
        <th>
            Spielbezeichnung
        </th>
        <th>
            Spielort
        </th>
        <th>
            Start
        </th>
        <th colspan="2">
            Mannschaften
        </th>
        <th>
            Ergebnis
        </th>
    </tr>
    </thead>

    <tbody>
    {foreach from=$HalbArray item=Halbfinale}
        <tr>
            <td>
                {$Halbfinale.spielbezeichnung}
            </td>
            <td>
                {$Halbfinale.spielort}
            </td>
            <td>
                {$Halbfinale.datumuhrzeit}
            </td>
            <td style="border-right: 0px;">
                {IF strstr($Halbfinale.gastmannschaft, " ", true) ne null}<img class="flags" src="/theme/img/flags/euFlag.png" />{ELSE}<img class="flags" src="/theme/img/flags/{$Halbfinale.heimmannschaft}.png" />{/IF} {$Halbfinale.heimmannschaft}
            </td>
            <td>
                {IF strstr($Halbfinale.gastmannschaft, " ", true) ne null}<img class="flags" src="/theme/img/flags/euFlag.png" />{ELSE}<img class="flags" src="/theme/img/flags/{$Halbfinale.gastmannschaft|default:"euFlag"}.png" />{/IF} {$Halbfinale.gastmannschaft}
            </td>
            <td style="text-align: center">
                {$Halbfinale.heimmannschaftende|default:"-"} : {$Halbfinale.gastmannschaftende|default:"-"}
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>

<br />
<hr />
<h3 class="h3Games">Finale</h3>

<table class="gamesTable">
    <thead>
    <tr>
        <th>
            Spielbezeichnung
        </th>
        <th>
            Spielort
        </th>
        <th>
            Start
        </th>
        <th colspan="2">
            Mannschaften
        </th>
        <th>
            Ergebnis
        </th>
    </tr>
    </thead>

    <tbody>
    {foreach from=$FinalArray item=Finale}
        <tr>
            <td>
                {$Finale.spielbezeichnung}
            </td>
            <td>
                {$Finale.spielort}
            </td>
            <td>
                {$Finale.datumuhrzeit}
            </td>
            <td style="border-right: 0px;">
                {IF strstr($Finale.gastmannschaft, " ", true) ne null}<img class="flags" src="/theme/img/flags/euFlag.png" />{ELSE}<img class="flags" src="/theme/img/flags/{$Finale.heimmannschaft}.png" />{/IF} {$Finale.heimmannschaft}
            </td>
            <td>
                {IF strstr($Finale.gastmannschaft, " ", true) ne null}<img class="flags" src="/theme/img/flags/euFlag.png" />{ELSE}<img class="flags" src="/theme/img/flags/{$Finale.gastmannschaft|default:"euFlag"}.png" />{/IF} {$Finale.gastmannschaft}
            </td>
            <td style="text-align: center">
                {$Finale.heimmannschaftende|default:"-"} : {$Finale.gastmannschaftende|default:"-"}
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>