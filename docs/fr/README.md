# Remix

![Remix Poster](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-00-poster.jpg?v1)

[English](docs/en/README.md), [Deutsch](docs/de/README.md), [Schwiizerdüütsch](docs/de-CH/README.md)
[Français](docs/fr/README.md), [Français canadien](docs/fr-CA/README.md), [Norsk](docs/no/README.md), [Norsk bokmål](docs/nb/README.md), [Nederlands](docs/nl/README.md), [한국어](docs/ko/README.md), [Español](docs/es/README.md), [Русский](docs/ru/README.md)

## Aperçu

Le champ Remix génère la valeur transformée de votre titre ou slug en fonction des règles que vous définissez, notamment :

 - Rechercher et remplacer
 - Transformations en majuscules, minuscules et casse du titre
 - Ajouter du texte
 - Préfixer du texte

### Fonctionnalités
 - **Actualisation en direct** - au fur et à mesure que vous tapez votre titre ou slug
 - **Expressions régulières** - pour rechercher et remplacer
 - **Ignorer la casse** - pour rechercher et remplacer
 - **Filtrer les éléments** - dans le panneau de contrôle
 - **Trier les éléments** - dans le panneau de contrôle

### Cas d'utilisation
Tri, filtrage, traduction, rédaction, formatage, SEO

## Comment l'utiliser
1. Créez un champ Remix
2. Sélectionnez une cible (titre ou slug)
3. Définissez vos règles
4. Ajoutez le champ à votre élément
5. Remix se remplit automatiquement lorsque vous ajoutez ou modifiez le titre ou le slug d'un élément

## Remix en action
![Créer des règles de remix](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-01-create-rules.jpg?v1)
![Transformer les titres et les slugs](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-02-transform.jpg?v1)
![Remixer votre contenu pour le tri, le filtrage, le SEO et plus encore.](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-03-remix-content.jpg?v2)

## Histoire d'origine
Ce champ a été créé pour répondre à un besoin spécifique : supprimer "The" et "A" des titres pour créer un champ de tri. En fait, le nom original de ce plugin était **Sort Title**. Mais après quelques ajustements, il est devenu clair que ce champ avait plus de potentiel. 

Ainsi, le champ Remix est né.

---

## Installation

Vous pouvez installer ce plugin depuis le [boutique des plugins](https://plugins.craftcms.com/remix) ou avec Composer.

Nécessite Craft CMS 5.0.0 ou version ultérieure, et PHP 8.2 ou version ultérieure.

### Avec Composer

```bash
# aller dans le répertoire du projet
cd /chemin/vers/mon-projet.test

# demander à Composer de charger le plugin
composer require mlathrom/craft-remix

# demander à Craft d'installer le plugin
./craft plugin/install remix
```
