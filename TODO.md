# [EPIC] Patientenportal
## [STORY] Im Portal anmelden
* TODO Basis-View
* TODO Frontend- und Backend-View
* TODO Login-View
* TODO User:
   * Tabelle
   * Model
   * Seeder
* TODO Backend darf nur nach Login zugreifbar sein
## [STORY] Patienten (als Mitarbeiter) auflisten und verwalten
* TODO Patient
   * Tabelle
   * Model
   * Seeder
   * View
   * Controller
* TODO Patient: Pagination
* TODO Patienten suchen/filtern (non-Ajax)
* TODO Patienten sortieren (aufsteigend, absteigend, versch. Spalten)
## [STORY] Rollenbasiertes Zugriffssystem
* TODO Role
   * Tabelle
   * Model
   * Seeder
* TODO Permission
   * Tabelle
   * Model
   * Seeder
* TODO Rolle zu Permission
   * Pivot Table
* TODO User zu Rolle
   * Pivot-Table   
* TODO Views nach Permissions absichern
## [STORY] Als Patient registrieren
* TODO Admin/Behandler/Assistent können Benutzer-Account anlegen und mit Patient verknüpfen
## [STORY] Patient benachrichtigen
## [STORY] Eigene Dokumente einsehen
# [EPIC] Dokumentation
## [STORY] Behandlung dokumentieren
* TODO Dokumentation für Patient als Behandler eingeben
## [STORY] Dokumentation einsehen
* TODO Dokumentation pro Patient als Behandler auflisten
# [EPIC] Terminplanung (Slot-Modell)
## [STORY] Verfügbarkeit eintragen
* TODO Eigene Verfügbare Slots anzeigen (als Behandler)
* TODO Eigene Verfügbare Slots löschen (als Behandler)
* TODO Eigene Verfügbare Slots erzeugen (als Behandler)
## [STORY] Termin buchen
* TODO Verfuegbare Slots pro Behandler sehen (als Patient)
* TODO Slot reservieren (als Patient)
* TODO Reservierten Slot bestätigen (als Behandler)
* TODO Patient zu Slot zuweisen (als Behandler)
## [STORY] Kommende Termine einsehen
* TODO Reservierte und Bestätigte Slots anzeigen (als Behandler)
## [STORY] Termin absagen
* TODO Reservierung stornieren (als Patient)
* TODO Reservierung stornieren (als Behandler)
## [STORY] E-Mail-Bestätigungen
* TODO E-Mail-Bestätigung für jede Änderung des Termin-Status schicken
# [EPIC] Website + CMS
## [STORY] Einfache Website
(derzeit nicht geplant)
## [STORY] Responsive Design
(derzeit nicht geplant)
## [STORY] Kontaktfunktion
(derzeit nicht geplant)
## [STORY] Praxis auf Karte finden
(derzeit nicht geplant)
## [STORY] Praxis weiterempfehlen
(derzeit nicht geplant)
# [EPIC] Rechnungswesen
## [STORY] Eigene Rechnungen einsehen
(derzeit nicht geplant)
## [STORY] Rechnung eingeben
(derzeit nicht geplant)
## [STORY] Rechnungen verwalten
(derzeit nicht geplant)
## [STORY] Rechnungs-PDF erstellen
(derzeit nicht geplant)
## [STORY] CSV-Export für Buchhaltung
(derzeit nicht geplant)
# [EPIC] Datenschutz
## [STORY] Datenschutzerklärung
(derzeit nicht geplant)
## [STORY] Vollständige Löschung
* TODO eigene Daten loeschen (außer Rechnungen)
