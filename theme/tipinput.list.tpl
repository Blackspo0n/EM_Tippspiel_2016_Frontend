<h2 class="headerguidelines">Tippabgabe</h2>

<hr />

<p style="width: 600px; text-align: center; margin: 0 auto;">
    Hier hast Du die M&ouml;glichkeit auf Spiele zu tippen die Du noch nicht getippt hast.
    Klicke dazu einfach auf ein angezeigtes Spiel und gebe auf der n&auml;chsten Seite Deine Tippwerte ein.
</p>
<hr/>

{if isset($message)}
    <div style="font-size: 18px; text-align: center; color: black; background: lightgreen;">
        {$message}
    </div>
    <hr>
{/if}
{if isset($error)}
    <div style="font-size: 18px; text-align: center; color: black; background: lightcoral;">
        {$error}
    </div>
    <hr>
{/if}
<table class="posTippTable" style="">
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
                <a href="index.php?module=tipinput&showform={$grpPhase.spieleid}">Tipp abgeben</a>
            </td>
        </tr>
    {foreachelse}
        <tr>
            <td colspan="6" align="center">Du kannst momentan keine Tipps abgeben.</td>
        </tr>
    {/foreach}
    </tbody>
</table>
