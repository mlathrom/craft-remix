<?php

namespace mlathrom\craftremix\fields;

use Craft;
use craft\base\ElementInterface;
use craft\base\Field;
use craft\base\PreviewableFieldInterface;
use craft\base\SortableFieldInterface;
use craft\fields\conditions\TextFieldConditionRule;
use craft\helpers\StringHelper;
use yii\db\ExpressionInterface;
use yii\db\Schema;
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
        return 'string|null';
    }

    public static function dbType(): string
    {
        return Schema::TYPE_STRING;
    }

    public static function isRequirable(): bool
    {
        return false;
    }

    public function attributeLabels(): array
    {
        return array_merge(parent::attributeLabels(), [
            'RemixTarget' => Craft::t('app', 'Target'),
            'RemixFindReplaceRules' => Craft::t('app', 'Find and Replace'),
            'RemixTextTransform' => Craft::t('remix', 'Text Transform'),
            'RemixPrepend' => Craft::t('remix', 'Prepend'),
            'RemixAppend' => Craft::t('remix', 'Append'),
        ]);
    }

    protected function defineRules(): array
    {
        return array_merge(parent::defineRules(), [
            ['RemixTarget', 'in', 'range' => ['title', 'slug']],
            ['RemixFindReplaceRules', 'validateFindReplaceRules'],
            ['RemixTextTransform', 'in', 'range' => ['none', 'lowercase', 'uppercase', 'titlecase']],
            ['RemixPrepend', 'string'],
            ['RemixAppend', 'string'],
        ]);
    }

    public function validateFindReplaceRules($attribute, $params)
    {
        foreach ($this->RemixFindReplaceRules as $rule) {
            if (isset($rule[2]) && $rule[2]) {
                $find = '/' . $rule[0] . '/';
                if (@preg_match($find, '') === false) {
                    $this->addError($attribute, Craft::t('remix', 'Invalid regex pattern.'));
                    break;
                }
            }
        }
    }

    public function checkTitleSlugPresence(ElementInterface $element): bool
    {
        $originalValue = $element->{$this->RemixTarget};

        $isTitleCheck = $this->RemixTarget === 'title' && $originalValue !== '()' && $originalValue !== null;
        $isSlugCheck = $this->RemixTarget === 'slug' && $element->getStatus() !== 'draft';

        $check = $isTitleCheck || $isSlugCheck;

        return $check;
    }

    public function normalizeValue(mixed $value = null, ?ElementInterface $element): mixed
    {
        $value = $this->checkTitleSlugPresence($element) ? $value : null;

        return $value;
    }

    public function serializeValue(mixed $value, ?ElementInterface $element): mixed
    {
        $value = $element->{$this->RemixTarget};
        
        if ($this->checkTitleSlugPresence($element)) {
            foreach ($this->RemixFindReplaceRules as $rule) {
                $find = $rule[0];
                $replace = $rule[1];
                $ignoreCase = $rule[2];
                $isRegex = $rule[3];
    
                if ($isRegex) {
                    $findRegex = '/' . $find  . '/' . ($ignoreCase ? 'i' : '');
                    $value = preg_replace($findRegex, $replace, $value);
                } else {
                    if ($ignoreCase) {
                        $value = str_ireplace($find, $replace, $value);
                    } else {
                        $value = str_replace($find, $replace, $value);
                    }
                }
            }

            switch ($this->RemixTextTransform) {
                case 'lowercase':
                    $value = strtolower($value);
                    break;
                case 'uppercase':
                    $value = strtoupper($value);
                    break;
                case 'capitalize':
                    $value = ucwords($value);
                    break;
                default:
                    break;
            }

            $value = $this->RemixPrepend . $value . $this->RemixAppend;
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
        $view = Craft::$app->getView();
        $view->registerAssetBundle(RemixAsset::class);
        $view->registerJsVar('remixSettings_' . $this->handle, $settingsJson);
        
        return Craft::$app->view->renderTemplate('remix/_input-html', [
            'value' => $value,
            'fieldId' => $this->handle,
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
        return TextFieldConditionRule::class;
    }

    public static function queryCondition(
        array $instances,
        mixed $value,
        array &$params,
    ): ExpressionInterface|array|string|false|null {
        return parent::queryCondition($instances, $value, $params);
    }
}
