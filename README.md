# Tippspiel Frontend (freiwilliges Projekt GWI1)

Dies ist das Repository für die freiwillige Projektarbeit im Fach GWI1.

## Code ist nicht represetativ
Dieser Code wurde in Zusammenarbeit mit Authoren unten erstellt. Um die Zusammenarbeit zu erleichtern wurde bewusst der Code sehr einfach gehalten. Dementsprechend wird sich nicht an dem Standard in der PHP-Community gehalten.

## Autoren
Mario Kellner - mario.kellner@studmail.w-hs.de
Jan Markus Momper - jan-markus.momper@studmail.w-hs.de
Philipp Miller - philipp.miller@studmail.w-hs.de
Mark Friedrich - mark.friedrich@studmail.w-hs.de

## Verwendete Frameworks & Bibliotheken
Die verwendete MySQL Bibliothek ist: MySQLI (MySQL improved)
Template Engine: smarty3.1.29


## Konfiguration

Die Datei "_Config.tpl.php_" stellt die Standard-Konfiguration dar. Um das Frontend zu
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

### Smarty Hack
Eigentlich braucht das Framework Smarty einen Ordner mit 0755 Rechten (UNIX Rechtesystem)
damit dieses gescheit arbeiten kann.

Da wir aber davon ausgehen, dass wir auf keinen Ordner irgendwelche Schreibrechte bekommen,
aber Smarty auf das Schreiben kompilierter Templates angewiesen ist, bedienen wir uns einer simplen Methode.

Wir benutzen den temporären Ordner eines Systems der mittels _sys_get_temp_dir();_ ermittelt wird.
Auf diesen haben wir standardmäßig 0755 Rechte (0755 bedeutet alles außer ausführen)

#### Korrekte Konfiguration
In der Datei _SmartyInstance.php_ die Zeile:
```php
        $this->smarty->setCompileDir(sys_get_temp_dir());
```

in 
```php
        $this->smarty->setCompileDir(ROOT_DIR . DS . 'theme_compile');
```
ändern. Anschließend den Ordner _theme_compile_ erstellen und mit write/read rechten
(auf Linux und anderen Unix Systemen ist das das Octet 0755 oder 0777) ausstatten.


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
