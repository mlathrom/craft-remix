# Remix

![Remix Poster](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-00-poster.jpg?v1)

[English](docs/en/README.md), [Deutsch](docs/de/README.md), [Schwiizerdüütsch](docs/de-CH/README.md)
[Français](docs/fr/README.md), [Français canadien](docs/fr-CA/README.md), [Norsk](docs/no/README.md), [Norsk bokmål](docs/nb/README.md), [Nederlands](docs/nl/README.md), [한국어](docs/ko/README.md), [Español](docs/es/README.md), [Русский](docs/ru/README.md)

## Overview

The Remix field outputs the transformed value of your title or slug based on rules you define, including:

 - Find and replace (with regex support)
 - Uppercase, lowercase, and title case transformations
 - Append text
 - Prepend text

### Features
 - **Live Preview** - test your rules in real-time with a rule-by-rule breakdown
 - **Inline Regex Validation** - see errors as you type your patterns
 - **Regular Expressions** - for find and replace
 - **Ignore Case** - for find and replace
 - **Template Rules** - quick-add common patterns like stripping articles, punctuation, or collapsing whitespace
 - **All Element Types** - works with entries, categories, and any element with a title or slug
 - **Filter & Sort Elements** - in the Control Panel

### Use Cases
Sorting, Filtering, Translation, Redaction, Formatting, SEO

## How to Use
1. Create a Remix field
2. Select a target (Title or Slug)
3. Define your rules (or use template buttons for common patterns)
4. Add the field to your element's field layout
5. Remix autofills when you save the element

## Remix in Action
![Create remix rules](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-01-create-rules.jpg?v1)
![Transform titles and slugs](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-02-transform.jpg?v1)
![Remix your content for sorting, filtering, SEO and more.](https://mlathrom-storage-00.sfo3.cdn.digitaloceanspaces.com/github/mlathrom/craft-remix/remix-03-remix-content.jpg?v2)

## Origin Story
This field was built to address a specific need: strip "The" and "A" from titles to create a sorting field. In fact, the original name of this plugin was **Sort Title**. But after some tinkering, it became clear that this field had more potential.

Thus, the Remix field was born.

---

## Upgrading to v2.0.0

Version 2.0.0 includes breaking changes with automatic migration:

- **Property names** changed from PascalCase to camelCase (e.g., `RemixTarget` → `target`)
- **Rule storage** changed from indexed arrays to associative arrays
- **Craft 4 is no longer supported** — use the 0.x line for Craft 4

The migration runs automatically when you update. Back up your database first.

---

## Installation

You can install this plugin from the [Plugin Store](https://plugins.craftcms.com/remix) or with Composer.

Requires Craft CMS 5.0.0 or later, and PHP 8.2 or later.

### With Composer

```bash
# go to the project directory
cd /path/to/my-project.test

# tell Composer to load the plugin
composer require mlathrom/craft-remix

# tell Craft to install the plugin
./craft plugin/install remix
```
