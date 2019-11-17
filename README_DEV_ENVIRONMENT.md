# Aufsetzen der Entwicklungsumgebung

Dieses Dokument enthält exakte Anweisungen, um die Entwicklungsumgebung einheitlich aufzusetzen. Diese Anweisungen sollte jeder Entwickler pro Rechner einmalig ausführen. Die Kommandos sind im Projekt-Root in einer Git-Bash auszuführen
 * weil `CMD.exe` nicht alle benötigten Befehle unterstützt
 * weil `CMD.exe` keine History bietet

## Voraussetzungen

* Composer muss installiert und im Pfad sein, sodass er von der Kommandozeile als `composer` aufgerufen werden kann.
* Node.js muss installiert und im Pfad sein, sodass `npm` von der Kommandozeile aufgerufen werden kann. Falls nicht, von https://nodejs.org/dist/v12.13.0/node-v12.13.0-x64.msi  herunterladen und installieren.

## Hosts-File

Folgende Zeile zu `c:\windows\system32\drivers\etc\hosts` hinzufügen:

```
127.0.0.1 dev.aiot
```

## IDE

Als IDE wird PHPStorm verwendet.

* PHPStorm starten
* Falls ein Projekt geöffnet ist: `File/Close Project`
* `Check out from Version Control/Git` wählen
* `https://github.com/jaromic/2019-11-all-in-one-therapy.git` in ein passendes Zielverzeichnis auschecken
* Im Project-Baum auf der linken Seite den Projektnamen `2019-11-all-in-one-therapy.git` mit Rechts anklicken und `Copy path` wählen
* Frage `Open Directory?` mit `Yes` beantworten, falls sie angezeigt wird.

## VHost-Konfiguration
Die VHost-Konfiguration unter `C:\xampp\apache\conf\extra\httpd-vhosts.conf` bearbeiten:
* den folgenden VHost hinzufügen
    * dabei `MY_AIOT_GIT_WORKING_COPY` durch den Pfad aus der Zwichenablage, siehe Punkt `IDE`ersetzen
    * kontrollieren, ob der Port `8009` nicht schon anderswo in `http-vhosts.conf` konfiguriert ist (in dem Fall einen anderen wählen)
    * Anschließend den Web-Server neu starten.

```apacheconfig
Listen 8009
<VirtualHost dev.aiot:8009>
  ServerName dev.aiot
  DocumentRoot "MY_AIOT_GIT_WORKING_COPY/public"

  SSLEngine on
  SSLCertificateFile "conf/ssl.crt/server.crt"
  SSLCertificateKeyFile "conf/ssl.key/server.key"

  <Directory "MY_AIOT_GIT_WORKING_COPY/public">
      AllowOverride All
      Require all granted
      Options Indexes FollowSymLinks
  </Directory>

  ErrorLog "logs/dev.aiot.log"
  CustomLog "logs/dev.aiot.log" common
</VirtualHost>
```

## Datenbank

`http://localhost/phpmyadmin/` aufrufen
In oberer Leiste `SQL` wählen
Folgende Befehle ausführen

```mysql
CREATE DATABASE `dev.aiot` CHARACTER SET `utf8mb4` COLLATE `utf8mb4_general_ci`;
CREATE USER 'aiot'@'localhost' IDENTIFIED BY 'H%21ka/bl3-';
GRANT USAGE ON *.* TO 'aiot'@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
GRANT ALL PRIVILEGES ON `dev.aiot`.* TO 'aiot'@'localhost'; 
```

## Composer-Install

Die lokalen Abhängigkeiten auf den im Repository eingecheckten Stand bringen:

```
composer install
```

## Copy development environment file

Die Datei `.env.development` auf den Namen `.env` kopieren.
`.env` der .gitignore hinzufügen

## node_modules in Git ignorieren
`node_modules` der .gitignore hinzufügen, da sonst Git-Operationen sehr lange dauern können

## App-Key generieren

```
php artisan key:generate
```

## NPM-Abhängigkeiten installieren

```
npm install
```

# Laufend benötigte Kommandos

## DB zurücksetzen / Migrationen und Seeding ausführen

```
php artisan migrate:fresh --seed
```

## JS/CSS-Assets bauen

```
npm run development
```

# Initiale Kommandos

Applikation erzeugen

```
composer create-project --prefer-dist laravel/laravel temp
mv -vi temp/* ./
rmdir temp
```