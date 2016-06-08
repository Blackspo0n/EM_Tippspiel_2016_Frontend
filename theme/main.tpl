<h2 style="text-align: center">Dashboard</h2>
<hr>

<div class>
    {IF $SpieleArray ne NULL}
        <h2 class="h2Dashboard">Laufende spiele</h2>
        <div class="dashboardCurrentGamesDiv">
            <table>
                {foreach from=$SpieleArray item=spiel}
                    <tr>
                        <td>
                            {$spiel.datumuhrzeit|date_format:"d M.Y"}
                        </td>
                        <td>
                            {$spiel.datumuhrzeit|date_format:"H:i"}
                        </td>
                        <td>
                            {$spiel.spielort}
                        </td>
                        <td>
                            {IF strstr($spiel.heimmannschaft, " ", true) ne null}<img class="flags" src="theme/img/flags/euFlag.png" />{ELSE}<img class="flags" src="theme/img/flags/{$spiel.heimmannschaft}.png" />{/IF} {$spiel.heimmannschaft}
                        </td>
                        <td>
                            {IF strstr($spiel.gastmannschaft, " ", true) ne null}<img class="flags" src="theme/img/flags/euFlag.png" />{ELSE}<img class="flags" src="theme/img/flags/{$spiel.gastmannschaft}.png" />{/IF} {$spiel.gastmannschaft}
                        </td>
                    </tr>
                {/foreach}
            </table>
        </div>
        <hr />
    {/IF}
    <p class="dashbordP">
        {if $smarty.session.logged eq true}Hallo {$smarty.session.username}, herzlich Willkommen{else}Herzlich Willkommen{/if}
        zu unserem EM-Tippspiel!<br />

        <br />
        Sie sind fu&szlig;ballbegeistert und fiebern der EM genauso entgegen wie wir?
        <br />
        Sie m&ouml;chten nicht nur die Spiele mitverfolgen, sondern gleichzeitig noch Ihr Fu&szlig;ballfachwissen mit dem Wissen anderer Tipper messen?
        <br />
        Dann sind Sie bei UNS genau richtig!
        <br />
        Tippen Sie Spielereignisse und Ergebnisse der EM in Frankreich und zeigen Sie den anderen Tippern, wie viel Wissen in Ihnen steckt.

        <!--{$yolo}-->
        <br />
        <br />
        Wir w&uuml;nschen Ihnen eine spannende und erfolgreiche EM und m&ouml;ge der Beste Tipper gewinnen!
    </p>
</div>