<h2 class="headerguidelines">Tippabgabe</h2>

<hr>

<table class="rankingTable">
    <tr>
        <th>Spielbezeichnung</th>
        <th>Heim</th>
        <th>Gast</th>
        <th>Datum / Uhrzeit</th>
        <th>Austragungsort</th>
    </tr>
    <tr>
        <td>{$singleGameData.spielbezeichnung}</td>
        <td>{$singleGameData.heimmannschaft}</td>
        <td>{$singleGameData.gastmannschaft}</td>
        <td>{$singleGameData.datumuhrzeit|date_format:'%d.%m.%Y %H:%M'}</td>
        <td>{$singleGameData.spielort}</td>
    </tr>
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

<form action="index.php?module=tipinput&showform={$singleGameData.spieleid}" method="post" class="tipinputForm">
    <div class="formElements">
        <div class="formLine">
            <label for="homefirsthalf">Tore Heim nach 1. HZ:</label><input type="number" id="homefirsthalf"
                                                                           name="tipinput[homefirsthalf]">
        </div>
        <div class="formLine">
            <label for="guestfirsthalf">Tore Gast nach 1. HZ:</label><input type="number" id="guestfirsthalf"
                                                                            name="tipinput[guestfirsthalf]">
        </div>
        <div class="formLine">
            <label for="homesecondhalf">Tore Heim nach 2. HZ:</label><input type="number" id="homesecondhalf"
                                                                            name="tipinput[homesecondhalf]">
        </div>
        <div class="formLine">
            <label for="guestsecondhalf">Tore Gast nach 2. HZ:</label><input type="number" id="guestsecondhalf"
                                                                             name="tipinput[guestsecondhalf]">
        </div>

        <div class="formLine">
            <label for="yellowcardshome">Gelbe Karten Heim:</label><input type="number" id="yellowcardshome"
                                                                          name="tipinput[yellowcardshome]">
        </div>
        <div class="formLine">
            <label for="yellowcardsguest">Gelbe Karten Gast:</label><input type="number" id="yellowcardsguest"
                                                                           name="tipinput[yellowcardsguest]">
        </div>
        <div class="formLine">
            <label for="redcardshome">Rote Karten Heim:</label><input type="number" id="redcardshome"
                                                                      name="tipinput[redcardshome]">
        </div>
        <div class="formLine">
            <label for="redcardsguest">Rote Karten Gast:</label><input type="number" id="redcardsguest"
                                                                       name="tipinput[redcardsguest]">
        </div>


        // KO- Phase
        {if strstr($singleGameData.spielbezeichnung, "Gruppe") ne null}
        <div class="formLine">
            <label for="homeovertime">Tore nach Verlängerung Heim:</label><input type="number" id="homeovertime"
                                                                                 name="tipinput[homeovertime]">
        </div>
        <div class="formLine">
            <label for="guestovertime">Tore nach Verlängerung Gast:</label><input type="number" id="guestovertime"
                                                                                  name="tipinput[guestovertime]">
        </div>
        <div class="formLine">
            <label for="homepenalty">Tore nach 11m-Schießen Heim:</label><input type="number" id="homeovertime"
                                                                                name="tipinput[homeovertime]">
        </div>
        <div class="formLine">
            <label for="guestpenalty">Tore nach 11m-Schießen Gast:</label><input type="number" id="guestpenalty"
                                                                                 name="tipinput[guestpenalty]">
        </div>
        {/if}

    </div>
    <div class="btnLine">
        <input type="submit" value="Tipps Speichern">
    </div>
</form>