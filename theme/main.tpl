<h2 style="text-align: center">Dashboard</h2>
<hr>

<div class>
        <p class="dashbordP">
            {if $smarty.session.logged eq true}Hallo {$smarty.session.username}, willkommen{else}Willkommen{/if}
            auf GuessAndWin. Tippe und erreiche den begehrenswerten Platz 1.
            <!--<br />{$yolo}-->
            <br />
            <br />
            Tipps können vom 10. Juni 2016 bis zum 10. Juli 2016.
        </p>
</div>