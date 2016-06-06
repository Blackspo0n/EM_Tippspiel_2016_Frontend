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
                {$grpPhase.heimmannschaft}
            </td>
            <td>
                {$grpPhase.gastmannschaft}
            </td>
            <td>
                {$grpPhase.heimmannschaftende|default:"-"} : {$grpPhase.gastmannschaftende|default:"-"}
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>

<br />
<hr />
<h3 class="h3Games">K.O. - Phase</h3>

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
    {foreach from=$KOArray item=KOPhase}
        <tr>
            <td>
                {$KOPhase.spielbezeichnung}
            </td>
            <td>
                {$KOPhase.spielort}
            </td>
            <td>
                {$KOPhase.datumuhrzeit}
            </td>
            <td style="border-right: 0px;">
                <img class="flags" src="/theme/img/flags/{$KOPhase.heimmannschaft}.png" /> {$KOPhase.heimmannschaft}
            </td>
            <td>
                <img class="flags" src="/theme/img/flags/{$KOPhase.gastmannschaft}.png" /> {$KOPhase.gastmannschaft}
            </td>
            <td>
                {$KOPhase.heimmannschaftende|default:"-"} : {$KOPhase.gastmannschaftende|default:"-"}
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>