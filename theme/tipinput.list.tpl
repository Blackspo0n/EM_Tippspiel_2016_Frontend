<h2 class="headerguidelines">Tippabgabe</h2>

<hr>

<table class="rankingTable">
    <tr>
        <th>Heim</th>
        <th>Gast</th>
    </tr>
    {foreach from=$gameData item=output}
        <tr>
            <td><a href="index.php?module=tipinput&showform={$output.spieleid}">{$output.heimmannschaft}</a></td>
            <td>{$output.gastmannschaft}</td>
        </tr>
    {/foreach}
</table>