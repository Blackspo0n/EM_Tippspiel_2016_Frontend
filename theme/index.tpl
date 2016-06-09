<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" type="image/x-icon" href="theme/img/favicon.ico">
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>
    <meta charset="ISO-8859-1"/>
    <title>EM 2016 - Tippspiel WHS</title>
    <link href="theme/style/main.css" rel="stylesheet" type="text/css"/>
</head>

<body>

<div class="wrapper">
    <div class="header">
        <div class="menu">
            <ul>
                {if $smarty.session.logged eq true}
                    {include file="header.logged.tpl"}
                {else}
                    {include file="header.tpl"}
                {/if}
            </ul>
        </div>
        <div class="logo">
        </div>
    </div>
    <div class="loginLine">
        {if $smarty.session.logged eq true}
            {include file="login.logged.tpl"}
        {else}
            {include file="login.line.tpl"}
        {/if}
    </div>
    <div class="content">
        {* Hier werden die Sub-templates geladen *}
        {include file=$contentfile|default:"main.tpl"}
        <hr/>
    </div>
</div>
<div class="footer">
    <div id="links"></div>
    <div id="rechts" align="right">
        {$smarty.now|date_format:"%d.%m.%Y"}
    </div>
    <div id="midd">
        Copyright JMO, MFR, MKE, PMI &copy; 2016 | Westf&auml;lische Hochschule | Standort Bocholt
    </div>
</div>


</body>
</html>