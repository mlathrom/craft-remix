# Remix

![Remix Poster](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-00-poster.jpg?v1)

## Übersicht

Das Remix-Feld gibt den transformierten Wert Ihres Titels oder Slugs basierend auf den von Ihnen definierten Regeln aus, einschließlich:

 - Suchen und Ersetzen
 - Umwandlungen in Groß-, Klein- und Titelschreibweise
 - Text anhängen
 - Text voranstellen

### Funktionen
 - **Live-Aktualisierung** - während Sie Ihren Titel oder Slug eingeben
 - **Reguläre Ausdrücke** - zum Suchen und Ersetzen
 - **Groß-/Kleinschreibung ignorieren** - beim Suchen und Ersetzen
 - **Elemente filtern** - im Control Panel
 - **Elemente sortieren** - im Control Panel

### Anwendungsfälle
Sortierung, Filterung, Übersetzung, Schwärzung, Formatierung, SEO

### Übersetzungen
Englisch, Spanisch, Französisch, Deutsch, Koreanisch. Weitere folgen!

## Remix in Aktion
![Remix-Regeln erstellen](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-01-create-rules.jpg?v1)
![Titel und Slugs transformieren](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-02-transform.jpg?v1)
![Remixen Sie Ihren Inhalt zum Sortieren, Filtern, für SEO und mehr.](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-03-remix-content.jpg?v2)

## Entstehungsgeschichte
Dieses Feld wurde entwickelt, um ein bestimmtes Bedürfnis zu erfüllen: "The" und "A" aus Titeln zu entfernen, um ein Sortierfeld zu erstellen. Tatsächlich war der ursprüngliche Name dieses Plugins **Sort Title**. Aber nach einigen Anpassungen wurde klar, dass dieses Feld mehr Potenzial hatte. 

So entstand das Remix-Feld.

---

## Installation

Sie können dieses Plugin aus dem [Plug-in-Store](https://plugins.craftcms.com/remix) oder mit Composer installieren.

Erfordert Craft CMS 5.0.0 oder höher und PHP 8.2 oder höher.

### Mit Composer

```bash
# In das Projektverzeichnis wechseln
cd /pfad/zu/meinem-projekt.test

# Composer anweisen, das Plugin zu laden
composer require mlathrom/craft-remix

# Craft anweisen, das Plugin zu installieren
./craft plugin/install remix
```

---

## Verwendung
1. Erstellen Sie ein Remix-Feld
2. Wählen Sie ein Ziel aus (Titel oder Slug)
3. Definieren Sie Ihre Regeln
4. Fügen Sie das Feld zu Ihrem Element hinzu
5. Remix wird automatisch ausgefüllt, wenn Sie den Titel oder Slug eines Elements hinzufügen oder ändern