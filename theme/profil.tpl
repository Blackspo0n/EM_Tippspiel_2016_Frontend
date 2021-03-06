<h2 style="text-align: center">Dein Profil</h2>
<hr/>

{IF $UserRanking ne null}
    <h3 class="h3Games">Dein Ranking</h3>
    <p class="dashbordP">Du bist mit {$UserRanking.punkte} Punkt{IF $UserRanking.punkte ne 1}en{/IF} auf
        Platz {$UserRanking.platz} im Gesamt-Ranking.</p>
    <hr/>
{/IF}

{if isset($message)}
    <div style="font-size: 18px; text-align: center; color: black; background: lightgreen;">
        {$message}
    </div>
    <hr>
{/if}

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
        <th>

        </th>
    </tr>
    </thead>
    <tbody>
    {foreach from=$TippArray item=tipps}
        <tr>
            <td>
                {IF strstr($tipps.heimmannschaft, " ", true) ne null}
                    <img class="flags" src="theme/img/flags/euFlag.png"/>
                {ELSE}<img class="flags"
                           src="theme/img/flags/{$tipps.heimmannschaft}.png" />{/IF} {$tipps.heimmannschaft}
                :
                {IF strstr($tipps.gastmannschaft, " ", true) ne null}
                    <img class="flags" src="theme/img/flags/euFlag.png"/>
                {ELSE}<img class="flags"
                           src="theme/img/flags/{$tipps.gastmannschaft}.png" />{/IF} {$tipps.gastmannschaft}
            </td>
            <td>
                {$tipps.datumuhrzeit|date_format:"d. M Y H:i"}
            </td>
            <td>
                {$tipps.tippheimhz}
                :
                {$tipps.tippgasthz}
            </td>
            <td>
                {$tipps.tippheimende}
                :
                {$tipps.tippgastende}
            </td>
            <td>
                {$tipps.tippheimverl|default: "-"}
                :
                {$tipps.tippgastverl|default: "-"}
            </td>
            <td>
                {$tipps.tippheimelf|default: "-"}
                :
                {$tipps.tippgastelf|default: "-"}
            </td>
            <td>
                {$tipps.tippgelbeheim}
                :
                {$tipps.tippgelbegast}
            </td>
            <td>
                {$tipps.tipproteheim}
                :
                {$tipps.tipprotegast}
            </td>
            {IF $tipps.editable}
                <td style="width: 130px !important; text-align: center;">
                    <a href="index.php?module=profil&tipp={$tipps.tippid}">Tipp &Auml;ndern</a>
                </td>
            {else}
            {/IF}

        </tr>
    {foreachelse}
        <tr>
            <td style="width: 100% !important; text-align: center;" colspan="9">
                Du hast noch keine Tipps abgegeben.
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>
