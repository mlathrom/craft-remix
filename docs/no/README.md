# Remix

![Remix Plakat](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-00-poster.jpg?v1)

[English](docs/en/README.md), [Deutsch](docs/de/README.md), [Schwiizerdüütsch](docs/de-CH/README.md)
[Français](docs/fr/README.md), [Français canadien](docs/fr-CA/README.md), [Norsk](docs/no/README.md), [Norsk bokmål](docs/nb/README.md), [Nederlands](docs/nl/README.md), [한국어](docs/ko/README.md), [Español](docs/es/README.md), [Русский](docs/ru/README.md)

## Oversikt

Remix-feltet gir ut den transformerte verdien av tittelen eller slug-en din basert på reglene du definerer, inkludert:

 - Søk og erstatt
 - Store bokstaver, små bokstaver og titteltransformasjoner
 - Legg til tekst
 - Legg til tekst foran

### Funksjoner
 - **Sanntidsoppdatering** - mens du skriver inn tittelen eller slug-en din
 - **Regulære uttrykk** - for søk og erstatt
 - **Ignorer små og store bokstaver** - for søk og erstatt
 - **Filtrer elementer** - i kontrollpanelet
 - **Sorter elementer** - i kontrollpanelet

### Bruksområder
Sortering, filtrering, oversettelse, redigering, formatering, SEO

## Hvordan bruke
1. Opprett et Remix-felt
2. Velg et mål (tittel eller slug)
3. Definer reglene dine
4. Legg til feltet i elementet ditt
5. Remix autofyller når du legger til eller endrer tittelen eller slug-en til et element

## Remix i aksjon
![Opprett remix-regler](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-01-create-rules.jpg?v1)
![Transformer titler og slug-er](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-02-transform.jpg?v1)
![Remix innholdet ditt for sortering, filtrering, SEO og mer.](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-03-remix-content.jpg?v2)

## Opprinnelseshistorie
Dette feltet ble laget for å løse et spesifikt behov: fjerne "The" og "A" fra titler for å lage et sorteringsfelt. Faktisk var det opprinnelige navnet på denne plugin-en **Sort Title**. Men etter litt fikling ble det klart at dette feltet hadde mer potensial.

Slik ble Remix-feltet født.

---

## Installasjon

Du kan installere denne plugin-en fra [Plugin-butikk](https://plugins.craftcms.com/remix) eller med Composer.

Krever Craft CMS 5.0.0 eller senere, og PHP 8.2 eller senere.

### Med Composer

```bash
# gå til prosjektmappen
cd /path/to/my-project.test

# be Composer om å laste inn plugin-en
composer require mlathrom/craft-remix

# be Craft om å installere plugin-en
./craft plugin/install remix
```
