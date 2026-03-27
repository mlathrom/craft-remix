<?php

namespace mlathrom\craftremix\migrations;

use Craft;
use craft\db\Migration;
use craft\db\Query;
use craft\helpers\Json;

/**
 * Migrates Remix field settings from v1 to v2:
 * - Renames properties: RemixTarget → target, RemixFindReplaceRules → findReplaceRules, etc.
 * - Converts find/replace rules from indexed arrays to associative arrays.
 */
class m260326_000000_v2_settings_refactor extends Migration
{
    public function safeUp(): bool
    {
        // Find all Remix fields
        $fields = (new Query())
            ->select(['id', 'settings'])
            ->from('{{%fields}}')
            ->where(['type' => 'mlathrom\\craftremix\\fields\\Remix'])
            ->all();

        foreach ($fields as $field) {
            $settings = Json::decodeIfJson($field['settings']);
            if (!is_array($settings)) {
                continue;
            }

            $newSettings = $this->migrateSettings($settings);

            $this->update('{{%fields}}', [
                'settings' => Json::encode($newSettings),
            ], ['id' => $field['id']]);
        }

        // Rebuild project config
        Craft::$app->getProjectConfig()->rebuild();

        return true;
    }

    public function safeDown(): bool
    {
        return true;
    }

    private function migrateSettings(array $settings): array
    {
        $keyMap = [
            'RemixTarget' => 'target',
            'RemixFindReplaceRules' => 'findReplaceRules',
            'RemixTextTransform' => 'textTransform',
            'RemixPrepend' => 'prepend',
            'RemixAppend' => 'append',
        ];

        $newSettings = [];
        foreach ($settings as $key => $value) {
            $newKey = $keyMap[$key] ?? $key;
            $newSettings[$newKey] = $value;
        }

        // Convert indexed rule arrays to associative
        if (isset($newSettings['findReplaceRules']) && is_array($newSettings['findReplaceRules'])) {
            $newSettings['findReplaceRules'] = array_map(function($rule) {
                // Already associative (has string keys)
                if (isset($rule['find'])) {
                    return $rule;
                }

                // Convert indexed to associative
                return [
                    'find' => $rule[0] ?? '',
                    'replace' => $rule[1] ?? '',
                    'ignoreCase' => $rule[2] ?? false,
                    'regex' => $rule[3] ?? false,
                ];
            }, $newSettings['findReplaceRules']);
        }

        return $newSettings;
    }
}
