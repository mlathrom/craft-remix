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

/**
 * Remix field type
 */
class Remix extends Field implements PreviewableFieldInterface, SortableFieldInterface
{
    public string $RemixTarget = 'title';
    public string $RemixTextTransform = 'none';
    public string $RemixPrepend = '';
    public string $RemixAppend = '';
    public array $RemixFindReplaceRules = [];
    
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
            'RemixTextTransform' => Craft::t('app', 'Text Transform'),
            'RemixPrepend' => Craft::t('app', 'Prepend'),
            'RemixAppend' => Craft::t('app', 'Append'),
            'RemixFindReplaceRules' => Craft::t('app', 'Find and Replace'),
        ]);
    }

    protected function defineRules(): array
    {
        return array_merge(parent::defineRules(), [
            ['RemixTarget', 'in', 'range' => ['title', 'slug']],
            ['RemixPrepend', 'string'],
            ['RemixAppend', 'string'],
            ['RemixTextTransform', 'in', 'range' => ['none', 'lowercase', 'uppercase', 'capitalize']],
            ['RemixFindReplaceRules', 'validateFindReplaceRules'],
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

    public function normalizeValue(mixed $value, ?ElementInterface $element): mixed
    {
        if ($element) {
            $originalValue = $element->{$this->RemixTarget};

            // If the target is slug and the entry is a draft, set the slug to blank
            if ($this->RemixTarget === 'title' && $originalValue !== '()' || $this->RemixTarget === 'slug' && $element->getStatus() !== 'draft') {
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
            } else {
                $value = "There's no ". $this->RemixTarget . ' to remix yet.';
            }
        }
    
        return $value;
    }

    public function settings(): array
    {
        return [
            'RemixTarget' => $this->RemixTarget,
            'RemixTextTransform' => $this->RemixTextTransform,
            'RemixPrepend' => $this->RemixPrepend,
            'RemixAppend' => $this->RemixAppend,
            'RemixFindReplaceRules' => $this->RemixFindReplaceRules,
        ];
    }

    public function getSettingsHtml(): ?string
    {
        return Craft::$app->getView()->renderTemplate(
            'remix/_field-settings',
            [
                'field' => $this,
            ]
        );
    }

    protected function inputHtml(mixed $value, ?ElementInterface $element, bool $inline): string
    {
        // Display the sort title (which will be automatically generated)
        return Html::tag('p', $value, ['class' => 'light']);
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
