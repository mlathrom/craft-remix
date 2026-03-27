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
use mlathrom\craftremix\RemixSettingsAsset;

/**
 * Remix field type
 */
class Remix extends Field implements PreviewableFieldInterface, SortableFieldInterface
{
    public string $target = 'title';
    public array $findReplaceRules = [];
    public string $prepend = '';
    public string $append = '';
    public string $textTransform = 'none';

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
            'target' => Craft::t('app', 'Target'),
            'findReplaceRules' => Craft::t('app', 'Find and Replace'),
            'textTransform' => Craft::t('remix', 'Text Transform'),
            'prepend' => Craft::t('remix', 'Prepend'),
            'append' => Craft::t('remix', 'Append'),
        ]);
    }

    protected function defineRules(): array
    {
        return array_merge(parent::defineRules(), [
            ['target', 'in', 'range' => ['title', 'slug']],
            ['findReplaceRules', 'validateFindReplaceRules'],
            ['textTransform', 'in', 'range' => ['none', 'lowercase', 'uppercase', 'titlecase']],
            ['prepend', 'string'],
            ['append', 'string'],
        ]);
    }

    public function validateFindReplaceRules($attribute, $params): void
    {
        foreach ($this->findReplaceRules as $rule) {
            if (!empty($rule['regex'])) {
                $find = '/' . ($rule['find'] ?? '') . '/';
                if (@preg_match($find, '') === false) {
                    $this->addError($attribute, Craft::t('remix', 'Invalid regex pattern.'));
                    break;
                }
            }
        }
    }

    /**
     * Apply all transformation rules to the given text.
     */
    public function transform(string $text): string
    {
        $value = $text;

        // Apply find/replace rules
        foreach ($this->findReplaceRules as $rule) {
            $find = $rule['find'] ?? '';
            $replace = $rule['replace'] ?? '';
            $ignoreCase = !empty($rule['ignoreCase']);
            $isRegex = !empty($rule['regex']);

            if ($find === '') {
                continue;
            }

            if ($isRegex) {
                $findRegex = '/' . $find . '/' . ($ignoreCase ? 'i' : '');
                $result = @preg_replace($findRegex, $replace, $value);
                if ($result !== null) {
                    $value = $result;
                }
            } else {
                if ($ignoreCase) {
                    $value = str_ireplace($find, $replace, $value);
                } else {
                    $value = str_replace($find, $replace, $value);
                }
            }
        }

        // Apply text transformations
        switch ($this->textTransform) {
            case 'lowercase':
                $value = mb_strtolower($value);
                break;
            case 'uppercase':
                $value = mb_strtoupper($value);
                break;
            case 'titlecase':
                $value = mb_convert_case($value, MB_CASE_TITLE);
                break;
        }

        // Add prefix and suffix
        $value = $this->prepend . $value . $this->append;

        return $value;
    }

    /**
     * Get the target value (title or slug) from an element, if available.
     */
    public function getTargetValue(ElementInterface $element): ?string
    {
        $value = $element->{$this->target} ?? null;

        if ($value === null || $value === '') {
            return null;
        }

        if ($this->target === 'title' && $value === '()') {
            return null;
        }

        return $value;
    }

    public function normalizeValue(mixed $value = null, ?ElementInterface $element): mixed
    {
        if (!$element || $this->getTargetValue($element) === null) {
            return null;
        }

        return $value;
    }

    public function serializeValue(mixed $value, ?ElementInterface $element): mixed
    {
        return $value;
    }

    public function getSettingsHtml(): ?string
    {
        $view = Craft::$app->getView();
        $view->registerAssetBundle(RemixSettingsAsset::class);

        return $view->renderTemplate(
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

        return $view->renderTemplate('remix/_input-html', [
            'value' => $value,
            'field' => $this,
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
