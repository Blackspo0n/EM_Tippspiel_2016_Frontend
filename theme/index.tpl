<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" type="image/x-icon" href="theme/img/favicon.ico">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>EM 2016 - Tippspiel WHS</title>
    <link href="theme/style/main.css" rel="stylesheet" type="text/css"/>
</head>

<body>

<div class="wrapper">
    <div class="header">
        <div class="menu">
            <ul>
                <li><a href="index.php?module=home">Home</a></li>
                <li><a href="index.php?module=login">Login</a></li>
                <li><a href="index.php?module=register">Registrieren</a></li>
                <li><a href="index.php?module=guidelines">Regelwerk</a></li>
            </ul>
        </div>
        <div class="logo">
        </div>
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
        <?php echo date("d.m.Y", time()); ?>
    </div>
    <div id="midd">
        &copy;opyright MKE, PMI, JMO | Westf&auml;lische Hochschule | Standort Bocholt
    </div>
</div>


</body>
</html>