# Remix

![Remix Poster](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-00-poster.jpg?v1)

[English](docs/en/README.md), [Deutsch](docs/de/README.md), [Schwiizerdüütsch](docs/de-CH/README.md)
[Français](docs/fr/README.md), [Français canadien](docs/fr-CA/README.md), [Norsk](docs/no/README.md), [Norsk bokmål](docs/nb/README.md), [Nederlands](docs/nl/README.md), [한국어](docs/ko/README.md), [Español](docs/es/README.md), [Русский](docs/ru/README.md)

## Aperçu

Le champ Remix génère la valeur transformée de votre titre ou slug en fonction des règles que vous définissez, notamment :

 - Rechercher et remplacer (avec prise en charge des regex)
 - Transformations en majuscules, minuscules et casse du titre
 - Ajouter du texte
 - Préfixer du texte

### Fonctionnalités
 - **Aperçu en direct** - testez vos règles en temps réel avec un détail règle par règle
 - **Validation regex en ligne** - voyez les erreurs pendant la saisie de vos motifs
 - **Expressions régulières** - pour rechercher et remplacer
 - **Ignorer la casse** - pour rechercher et remplacer
 - **Règles de modèle** - ajout rapide de motifs courants comme la suppression des articles, de la ponctuation ou la réduction des espaces
 - **Tous les types d'éléments** - fonctionne avec les entrées, les catégories et tout élément avec un titre ou un slug
 - **Filtrer et trier les éléments** - dans le panneau de contrôle

### Cas d'utilisation
Tri, filtrage, traduction, rédaction, formatage, SEO

## Comment l'utiliser
1. Créez un champ Remix
2. Sélectionnez une cible (titre ou slug)
3. Définissez vos règles (ou utilisez les boutons de modèle pour les motifs courants)
4. Ajoutez le champ au layout de champs de votre élément
5. Remix se remplit automatiquement lorsque vous enregistrez l'élément

## Remix en action
![Créer des règles de remix](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-01-create-rules.jpg?v1)
![Transformer les titres et les slugs](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-02-transform.jpg?v1)
![Remixer votre contenu pour le tri, le filtrage, le SEO et plus encore.](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-03-remix-content.jpg?v2)

## Histoire d'origine
Ce champ a été créé pour répondre à un besoin spécifique : supprimer "The" et "A" des titres pour créer un champ de tri. En fait, le nom original de ce plugin était **Sort Title**. Mais après quelques ajustements, il est devenu clair que ce champ avait plus de potentiel.

Ainsi, le champ Remix est né.

---

## Mise à jour vers v2.0.0

La version 2.0.0 inclut des changements incompatibles avec migration automatique :

- **Les noms de propriétés** sont passés de PascalCase à camelCase (ex. `RemixTarget` → `target`)
- **Le stockage des règles** est passé de tableaux indexés à tableaux associatifs
- **Craft 4 n'est plus pris en charge** — utilisez la branche 0.x pour Craft 4

La migration s'exécute automatiquement lors de la mise à jour. Sauvegardez votre base de données au préalable.

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
