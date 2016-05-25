# Tippspiel Frontend (freiwilliges Projekt GWI1)

Dies ist das Repository für die freiwillige Projektarbeit im Fach GWI1.

## Autoren
Mario Kellner - mario.kellner@studmail.w-hs.de
Jan Markus Momper - jan-markus.momper@studmail.w-hs.de
Philipp Miller - philipp.miller@studmail.w-hs.de
Mark Friedrich - mark.friedrich@studmail.w-hs.de

## Konfiguration

Die Datei "_Config.tpl.php_" stellt die standard Konfiguration dar. Um das Frontend zu
nutzen, muss diese in "_Config.php_" umbenannt werden.

### Notwendige Konfiguration
In der _Config.php_ müssen mindestens korrekte Logindaten für einen **MySQL-Server**
hinterlegt werden.

#### Beispielhafte konfigurierte Datenbankverbindung:
```php
public static $databaseSettings = [
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'database' => 'em2016'
];
```

## Anlegen eines neuen Kontrollers (Modules) 
Im Ordner "_classes/controller_" muss eine neu PHP-Datei mit dem Namen der Klasse
angelegt werden. Die Klasse muss vom Interface "_IController_" und die Funktionen implementieren.

### Beispiel:
Anlegen eines neuen Modules namens "_login_".

#### Dateiname
"_login.class.php_"

#### Dateiinhalt
```php
<?php

class login implements IController
{
    public function __construct() {
        
    }

    public function Run() {

    }
}
```

## Verwendete MySQL-Bibliothek
Die verwendete MySQL Bibliothek ist: MySQLI (MySQL improved)