# Remix

![Remix Poster](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-00-poster.jpg?v1)

[English](docs/en/README.md), [Deutsch](docs/de/README.md), [Schwiizerdüütsch](docs/de-CH/README.md)
[Français](docs/fr/README.md), [Français canadien](docs/fr-CA/README.md), [Norsk](docs/no/README.md), [Norsk bokmål](docs/nb/README.md), [Nederlands](docs/nl/README.md), [한국어](docs/ko/README.md), [Español](docs/es/README.md)

## Overview

The Remix field outputs the transformed value of your title or slug based on rules you define, including:

 - Find and replace
 - Uppercase, lowercase, and title case transformations
 - Append text
 - Prepend text

### Features
 - **Live Refresh** - as you type your title or slug
 - **Regular Expressions** - for find and replace
 - **Ignore Case** - for find and replace
 - **Filter Elements** - in the Control Panel
 - **Sort Elements** - in the Control Panel

### Use Cases
Sorting, Filtering, Translation, Redaction, Formatting, SEO

## How to Use
1. Create a Remix field
2. Select a target (Title or Slug)
3. Define your rules
4. Add the field to your element
5. Remix autofills when you add or modify the title or slug of an element

## Remix in Action
![Create remix rules](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-01-create-rules.jpg?v1)
![Transform titles and slugs](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-02-transform.jpg?v1)
![Remix your content for sorting, filtering, SEO and more.](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-03-remix-content.jpg?v2)

## Origin Story
This field was built to address a specific need: strip "The" and "A" from titles to create a sorting field. In fact, the original name of this plugin was **Sort Title**. But after some tinkering, it became clear that this field had more potential. 

Thus, the Remix field was born.

---

## Installation

You can install this plugin from the [Plugin Store](https://plugins.craftcms.com/remix) or with Composer.

Requires Craft CMS 4.0.0 or later, and PHP 8.0.2 or later.

### With Composer

```bash
# go to the project directory
cd /path/to/my-project.test

# tell Composer to load the plugin
composer require mlathrom/craft-remix

# tell Craft to install the plugin
./craft plugin/install remix
```