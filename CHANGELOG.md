# Release Notes for Remix

## 2.0.0 - 2026-03-26

### 🚀 Added
 - Rule-by-rule breakdown in field settings shows matches, intermediate results, and regex errors in real-time
 - Inline regex validation highlights invalid patterns as you type
 - "Collapse Whitespace" template button for cleaning up extra spaces after stripping characters
 - Regex parity note in field settings UI explaining JS vs PHP regex differences
 - Support for all element types (categories, etc.), not just entries
 - CSS for the regex tester breakdown UI

### 🔧 Fixed
 - Fixed regex validation bug where the validator checked the wrong column (ignoreCase instead of regex flag)
 - Removed dead `settings()` method override that returned mismatched keys

### 💡 Changed
 - **Breaking:** Renamed field properties from PascalCase to camelCase (`RemixTarget` → `target`, `RemixFindReplaceRules` → `findReplaceRules`, etc.). Includes migration for existing installations.
 - **Breaking:** Find/replace rules now stored as associative arrays (`['find' => ..., 'replace' => ...]`) instead of indexed arrays. Includes migration for existing installations.
 - Moved transformation logic out of `serializeValue()` into a dedicated `transform()` method
 - Used `mb_` string functions for proper Unicode support in text transforms
 - Updated ECS config from Craft CMS 4 to Craft CMS 5 ruleset
 - Added `: void` return type to `RemixSettingsAsset::init()`
 - Craft 4 (0.x line) is no longer maintained

## 1.2.2 - 2025-03-29

### 🚀 Changed
 - Update placeholder text on Remix fields

## 1.2.1 - 2025-03-28

### 🚀 Changed
 - Fixed find and replace rules template buttons on existing remix fields
 - Remove testing code

## 1.2.0 - 2025-03-28

### 🚀 Changed
 - Added live preview to field settings to test your remixes. This makes up for the removal live-update on the entry pages
 - Fixed field handling to work properly with both draft and regular saves
 - Removed live refresh on entry pages. It's a nice idea, but doesn't work well with Craft's ability to hide titles and slugs
 - Updated docs to reflect updates

## 1.1.3 - 2024-05-01

### 🚀 Added
 - Russian translation

### 🔧 Fixed
 - Grammar in package description in composer.json

## 1.1.2 - 2024-04-20

### 💡 Changed
 - Updated CHANGELOG for Craft Plugin Store compatibility

### 🔧 Fixed
 - Spelling errors in CHANGELOG

## 1.1.1 - 2024-04-17
Bug fixes, code cleanup, updated docs.

## 🚀  Added
 - Translations no, nb, nl translations.
 - READMEs for each translation

## 💡 Changed
 - Moved "How to Use" above the installation and requirements in README
 - Removed unused PHP methods

## 🔧 Fixed
 - Bug where quick add buttons didn't account for ignore case and regex

## 1.1.0 - 2024-04-13
This release is Remix's true birth. 👶 

### 🚀 Added
- **Ignore Case** for find and replace rules
- Translations
- Error lists to field settings

### 💡 Changed
 - Field can no longer be requirable
 - New plugin icon
 - Capitalize to Title Case
 - Append and Prepend now come after case transformations
 - The readme details features, shows images, and tells the story of this plugin

### 🔧 Fixed
 - Inconsistent find and replace login between frontend and backend
 - Issue where displayed value was not the stored value

## 1.0.0 - 2024-04-08
- Initial release
