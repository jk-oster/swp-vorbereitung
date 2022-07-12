# swp-vorbereitung
Übungsaufgaben zur Vorbereitung auf die Übungsklausur in SWP4

## 1. Aufgabe - Sessions, Formularverarbeitung und Datenbanken
[index.php](https://github.com/jk-oster/swp-vorbereitung/blob/master/index.php)
## 2. Aufgbae - XML-Verarbeitung
[parse.php](https://github.com/jk-oster/swp-vorbereitung/blob/master/parse.php), [SaxParser.php](https://github.com/jk-oster/swp-vorbereitung/blob/master/SaxParser.php) und [DomParser.php](https://github.com/jk-oster/swp-vorbereitung/blob/master/DomParser.php)

## 3. Aufgabe
### Magische Funktionen: 
[magic-methods.php](https://github.com/jk-oster/swp-vorbereitung/blob/master/magic-methods.php) und [MagicModel.php](https://github.com/jk-oster/swp-vorbereitung/blob/master/MagicModel.php)


Versucht folgender Code magische Funktionen aufzurufen? Wenn ja, welche? Hinweis: in der Klasse Student sind sämtliche
Membervariablen und (nicht-magische) Funktionen privat. 
1. $oStudent = new Student("John", "Doe", 1985, "kwmXX001"); -> __contructor()
2. $sFirstname = "Mary";
3. echo("</br>Firstname: ".$sFirstname);
4. echo("Student: ".$oStudent->toString()); -> __call()


### Arrays: [arrays.php](https://github.com/jk-oster/swp-vorbereitung/blob/master/arrays.php)

### Allgemeines zu PHP
- Die Funktion __call wird immer automatisch bei jedem Funktionsaufruf (innerhalb eine Klasse) aufgerufen. -> falsch
- Bei der Übertragung mittels POST werden die übertragenen Informationen verschlüsselt. -> falsch (nur nicht in URL sichtbar aber nicht verschlüsselt -> nur mit HTTPS)
- Eine PHP Session ist an den Browser gebunden (d.h. für einen anderen Browser wird eine andere Session gestartet). -> richtig
- Ein DOM-Parser ist ein Einschritt-Parser der ein XML-Dokument sequenziell abarbeitet. -> falsch nicht sequenziell
- Ein SAX-Parser arbeitet Event-basiert. -> richtig
- Der Speicherverbrauch ist beim SAX-Parser höher als beim DOMParser -> falsch
- PHP ist eine clientseitige Skriptsprache. -> falsch (serverseitig)
- PHP ist eine interpretierte Skriptsprache. -> richtig
- Der Browser kann keinen PHP Code ausführen. -> falsch
- Der Code $oMyObject = new MyObject(); führt zu einem impliziten Aufruf einer magischen Funktion. -> richtig (__constructor())
- Mittels Type Hinting kann bei der Erstellung eines Objekts dessen Typ festgelegt werden. 
- Bei der Übertragung mittels GET können keine Dateien mitgeschickt werden. -> falsch
- Ein durch PHP-Skript erzeugtes Cookie kann nur durch den Betreiber des Servers gelöscht werden, da es im temp_Verzeichnis des Webservers gespeichert wird. -> falsch (Cookies können vom Client glöscht werden)
- Ein mittels password_hash gehashtes Passwort kann mittels einer weiteren nativen PHP-Funktion wieder „entschlüsselt“ werden. -> falsch (hash ist eine Einwegfunktion)
- Im Kontext von SQL-Injection sind numerische Datentypen weniger gefährlich als Zeichenketten. -> richtig
- session_start ruft eine magische Funktion auf. -> falsch (einfach normale native PHP-Funktion)
- PHP7 erlaubt die Festlegung eines Rückgabetyps bei Funktionen auch für private Datentypen. -> richtig
- Unter SQL-Injection versteht man das Einschleusen gefährlicher Kommandos an die Datenbank durch eine Benutzereingabe. -> richtig
