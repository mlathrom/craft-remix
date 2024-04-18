# Remix

![Remix Poster](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-00-poster.jpg?v1)

[English](docs/en/README.md), [Deutsch](docs/de/README.md), [Schwiizerdüütsch](docs/de-CH/README.md)
[Français](docs/fr/README.md), [Français canadien](docs/fr-CA/README.md), [Norsk](docs/no/README.md), [Norsk bokmål](docs/nb/README.md), [Nederlands](docs/nl/README.md), [한국어](docs/ko/README.md), [Español](docs/es/README.md)

## Overzicht

Het Remix-veld geeft de getransformeerde waarde van je titel of slug weer op basis van de regels die je definieert, waaronder:

 - Zoeken en vervangen
 - Hoofdletters, kleine letters en titel case-transformaties
 - Tekst toevoegen
 - Tekst voorvoegen

### Functies
 - **Live verversen** - terwijl je je titel of slug typt
 - **Reguliere expressies** - voor zoeken en vervangen
 - **Hoofdlettergevoeligheid negeren** - voor zoeken en vervangen
 - **Elementen filteren** - in het Control Panel
 - **Elementen sorteren** - in het Control Panel

### Gebruikscases
Sorteren, filteren, vertalen, redigeren, opmaken, SEO

## Hoe te gebruiken
1. Maak een Remix-veld
2. Selecteer een doel (titel of slug)
3. Definieer je regels
4. Voeg het veld toe aan je element
5. Remix vult automatisch aan wanneer je de titel of slug van een element toevoegt of wijzigt

## Remix in actie
![Remix-regels maken](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-01-create-rules.jpg?v1)
![Titels en slugs transformeren](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-02-transform.jpg?v1)
![Remix je inhoud voor sorteren, filteren, SEO en meer.](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-03-remix-content.jpg?v2)

## Ontstaansgeschiedenis
Dit veld is gebouwd om een specifieke behoefte aan te pakken: het verwijderen van "The" en "A" uit titels om een sorteerveld te creëren. Sterker nog, de oorspronkelijke naam van deze plugin was **Sort Title**. Maar na wat geknutsel werd duidelijk dat dit veld meer potentie had.

Zo is het Remix-veld ontstaan.

---

## Installatie

Je kunt deze plugin installeren vanuit de [Plugin-winkel](https://plugins.craftcms.com/remix) of met Composer.

Vereist Craft CMS 4.0.0 of later en PHP 8.0.2 of later.

### Met Composer

```bash
# ga naar de projectmap
cd /pad/naar/mijn-project.test

# vertel Composer om de plugin te laden
composer require mlathrom/craft-remix

# vertel Craft om de plugin te installeren
./craft plugin/install remix
```