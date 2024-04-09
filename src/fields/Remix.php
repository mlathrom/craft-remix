<?php

namespace mlathrom\craftremix\fields;

use Craft;
use craft\base\ElementInterface;
use craft\base\Field;
use craft\base\PreviewableFieldInterface;
use craft\base\SortableFieldInterface;
use craft\elements\db\ElementQueryInterface;
use craft\helpers\Html;
use craft\helpers\StringHelper;
use yii\db\ExpressionInterface;
use yii\db\Schema;
use craft\web\View;
use mlathrom\craftremix\RemixAsset;

/**
 * Remix field type
 */
class Remix extends Field implements PreviewableFieldInterface, SortableFieldInterface
{
    public string $RemixTarget = 'title';
    public array $RemixFindReplaceRules = [];
    public string $RemixPrepend = '';
    public string $RemixAppend = '';
    public string $RemixTextTransform = 'none';
    
    public static function displayName(): string
    {
        return Craft::t('remix', 'Remix');
    }

    public static function icon(): string
    {
        return 'album';
    }

    public static function phpType(): string
    {
        return 'mixed';
    }

    public static function dbType(): array|string|null
    {
        return Schema::TYPE_STRING;
    }

    public function attributeLabels(): array
    {
        return array_merge(parent::attributeLabels(), [
            'RemixTarget' => Craft::t('app', 'Target'),
            'RemixFindReplaceRules' => Craft::t('app', 'Find and Replace'),
            'RemixPrepend' => Craft::t('app', 'Prepend'),
            'RemixAppend' => Craft::t('app', 'Append'),
            'RemixTextTransform' => Craft::t('app', 'Text Transform'),
        ]);
    }

    protected function defineRules(): array
    {
        return array_merge(parent::defineRules(), [
            ['RemixTarget', 'in', 'range' => ['title', 'slug']],
            ['RemixFindReplaceRules', 'validateFindReplaceRules'],
            ['RemixPrepend', 'string'],
            ['RemixAppend', 'string'],
            ['RemixTextTransform', 'in', 'range' => ['none', 'lowercase', 'uppercase', 'capitalize']],
        ]);
    }

    public function validateFindReplaceRules($attribute, $params)
    {
        foreach ($this->RemixFindReplaceRules as $rule) {
            if (isset($rule[2]) && $rule[2]) {
                if (@preg_match($rule[0], '') === false) {
                    $this->addError($attribute, Craft::t('remix', 'Invalid regex pattern.'));
                    break;
                }
            }
        }
    }

    public function checkTitleSlugPresence(ElementInterface $element): bool
    {
        $originalValue = $element->{$this->RemixTarget};
        $check = $this->RemixTarget === 'title' && $originalValue !== '()' && $originalValue !== null || $this->RemixTarget === 'slug' && $element->getStatus() !== 'draft';

        return $check;
    }

    public function normalizeValue(mixed $value = null, ?ElementInterface $element): mixed
    {
        if ($element) {
            $originalValue = $element->{$this->RemixTarget};
            
            if ($this->checkTitleSlugPresence($element)) {
                // Apply find and replace rules sequentially
                foreach ($this->RemixFindReplaceRules as $rule) {
                    $find = $rule[0];
                    $replace = $rule[1];
                    $isRegex = $rule[2];
        
                    if ($isRegex) {
                        $originalValue = preg_replace($find, $replace, $originalValue);
                    } else {
                        $originalValue = str_replace($find, $replace, $originalValue);
                    }
                }
        
                // Prepend value
                $originalValue = $this->RemixPrepend . $originalValue;
        
                // Append value
                $originalValue .= $this->RemixAppend;
        
                // Apply text transforming
                switch ($this->RemixTextTransform) {
                    case 'lowercase':
                        $value = strtolower($originalValue);
                        break;
                    case 'uppercase':
                        $value = strtoupper($originalValue);
                        break;
                    case 'capitalize':
                        $value = ucwords($originalValue);
                        break;
                    default:
                        $value = $originalValue;
                        break;
                }
            }
        }
        return $value;
    }

    public function settings(): array
    {
        return [
            'target' => $this->RemixTarget,
            'findReplaceRules' => $this->RemixFindReplaceRules,
            'prepend' => $this->RemixPrepend,
            'append' => $this->RemixAppend,
            'textTransform' => $this->RemixTextTransform,
            'fieldId' => '#' . $this->handle,
        ];
    }

    public function getSettingsHtml(): ?string
    {
        return Craft::$app->getView()->renderTemplate(
            'remix/_field-settings',
            [
                'field' => $this,
                'fieldId' => $this->handle,
            ]
        );
    }

    protected function inputHtml(mixed $value, ?ElementInterface $element, bool $inline): string
    {
        $view = Craft::$app->getView();
        $settingsJson = json_encode($this->settings(), JSON_PRETTY_PRINT);
        $fieldId = str_replace('-', '_', $this->handle);
        
        $settingsJson = json_encode($this->settings(), JSON_PRETTY_PRINT);
        $view = Craft::$app->getView();
        $view->registerAssetBundle(RemixAsset::class);
        $view->registerJsVar('remixSettings_' . $this->handle, $settingsJson); // Use the field handle to create a 
    
        if (!$this->checkTitleSlugPresence($element)) {
            $value = 'There\'s no ' . $fieldId . ' to remix yet.';
        }
        
        return Craft::$app->view->renderTemplate('remix/_input-html', [
            'value' => $value,
            'fieldId' => $this->handle, // Pass the field handle to the template
        ]);
    }

    public function getElementValidationRules(): array
    {
        return [];
    }

    protected function searchKeywords(mixed $value, ElementInterface $element): string
    {
        return StringHelper::toString($value, ' ');
    }

    public function getElementConditionRuleType(): array|string|null
    {
        return null;
    }

    public static function queryCondition(
        array $instances,
        mixed $value,
        array &$params,
    ): ExpressionInterface|array|string|false|null {
        return parent::queryCondition($instances, $value, $params);
    }
}
