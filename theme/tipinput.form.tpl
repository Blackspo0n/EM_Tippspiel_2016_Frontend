<h2 class="headerguidelines">Tippabgabe</h2>

{$gameData}

<hr>
<form action="index.php?module=tipinput" method="post" class="tipinputForm">
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
            <label for="recardshome">Rote Karten Heim:</label><input type="number" id="redcardshome"
                                                                     name="tipinput[redcardshome]">
        </div>
        <div class="formLine">
            <label for="redcardsguest">Rote Karten Gast:</label><input type="number" id="redcardsguest"
                                                                       name="tipinput[redcardsguest]">
        </div>
    </div>
    <div class="btnLine">
        <input type="submit" value="Tipps Speichern">
    </div>
</form>