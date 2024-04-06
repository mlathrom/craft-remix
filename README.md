# Remix

Remix is a custom field type for Craft CMS that transforms entry titles or slugs using find & replace rules, appending/prepending text, and case transformations. The transformed value becomes the field's content, usable for sorting and searching entries.

## Requirements

This plugin requires Craft CMS 5.0.0 or later, and PHP 8.2 or later.

## Installation

You can install this plugin from the Plugin Store or with Composer.

#### From the Plugin Store

Go to the Plugin Store in your project’s Control Panel and search for “Remix”. Then press “Install”.

#### With Composer

Open your terminal and run the following commands:

```bash
# go to the project directory
cd /path/to/my-project.test

# tell Composer to load the plugin
composer require mlathrom/craft-remix

# tell Craft to install the plugin
./craft plugin/install remix
```

## Features
 - Target either the entry title or slug
 - Define find & replace rules
 - Append or prepend additional text
 - Transform text to uppercase, lowercase, or title case
 - Sort entries by Remix field content
 - Search entries using Remix field content