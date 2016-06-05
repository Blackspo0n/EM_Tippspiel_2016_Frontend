<h2 style="text-align: center">Ranking</h2>
<hr />
<table class="rankingTable">

    <thead>
        <tr>
            <th>
                Platz
            </th>
            <th>
                Nickname
            </th>
            <th>
                Punkte
            </th>
            <th>
                E-Mail
            </th>
        </tr>
    </thead>

    <tbody>
        {foreach from=$RankingArray item=position}
            <tr>
                <td>
                    {$position.platz}
                </td>
                <td>
                    {$position.nickname}
                </td>
                <td>
                    {$position.punkte}
                </td>
                <td>
                    {IF $position.show_Email eq true}{$position.email}{ELSE} - {/IF}
                </td>
            </tr>
        {/foreach}
    </tbody>

</table>