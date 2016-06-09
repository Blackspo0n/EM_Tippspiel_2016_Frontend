<h2 class="headerguidelines">Tippabgabe</h2>

<hr />

<p style="width: 600px; text-align: center; margin: 0 auto;">
    Hier hast du die Möglichkeit auf Spiele zu tippen die du noch nicht getippt hast.
    Klicke dazu einfach auf ein angezeigtes Spiel in gebe auf der nächsten Seite deine Tippwerte ein.
</p>
<hr/>

<table class="gamesTable" style="width:900px !important;    ">
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
            Aktionen
        </th>
    </tr>
    </thead>

    <tbody>
    {foreach from=$gameData item=grpPhase}
        <tr>
            <td>
                {$grpPhase.spielbezeichnung}
            </td>
            <td>
                {$grpPhase.spielort}
            </td>
            <td>
                {$grpPhase.datumuhrzeit|date_format:"d. M Y H:i"}
            </td>
            <td style="border-right: 0px;">
                {IF strstr($grpPhase.gastmannschaft, " ", true) ne null}<img class="flags" src="theme/img/flags/euFlag.png" />{ELSE}<img class="flags" src="theme/img/flags/{$grpPhase.heimmannschaft}.png" />{/IF} {$grpPhase.heimmannschaft}
            </td>
            <td>
                {IF strstr($grpPhase.gastmannschaft, " ", true) ne null}<img class="flags" src="theme/img/flags/euFlag.png" />{ELSE}<img class="flags" src="theme/img/flags/{$grpPhase.gastmannschaft|default:"euFlag"}.png" />{/IF} {$grpPhase.gastmannschaft}
            </td>
            <td style="width: 130px !important; text-align: center;">
                <a style="color: orangered; " href="index.php?module=tipinput&showform={$grpPhase.spieleid}">Tipp abgeben</a>
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>
