<?php

namespace mlathrom\craftremix;

use Craft;
use craft\base\Element;
use craft\base\Plugin as BasePlugin;
use craft\events\ModelEvent;
use craft\events\RegisterComponentTypesEvent;
use craft\services\Fields;
use mlathrom\craftremix\fields\Remix;
use yii\base\Event;

/**
 * Remix plugin
 *
 * @method static Plugin getInstance()
 * @author Matt Lathrom <mlathrom@gmail.com>
 * @copyright Matt Lathrom
 * @license https://craftcms.github.io/license/ Craft License
 */
class Plugin extends BasePlugin
{
    public string $schemaVersion = '2.0.0';

    public function init(): void
    {
        parent::init();

        Craft::setAlias('@remix', $this->getBasePath());

        Craft::$app->onInit(function() {
            $this->attachEventHandlers();
        });
    }

    private function attachEventHandlers(): void
    {
        // Register the field type
        Event::on(Fields::class, Fields::EVENT_REGISTER_FIELD_TYPES, function(RegisterComponentTypesEvent $event) {
            $event->types[] = Remix::class;
        });

        // Listen for all element save events (entries, categories, etc.)
        Event::on(
            Element::class,
            Element::EVENT_BEFORE_SAVE,
            function(ModelEvent $event) {
                $this->handleElementSave($event);
            }
        );
    }

    private function handleElementSave(ModelEvent $event): void
    {
        /** @var Element $element */
        $element = $event->sender;

        // Skip revisions
        if ($element->getIsRevision()) {
            return;
        }

        $fieldLayout = $element->getFieldLayout();
        if (!$fieldLayout) {
            return;
        }

        foreach ($fieldLayout->getCustomFields() as $field) {
            if (!$field instanceof Remix) {
                continue;
            }

            $targetValue = $field->getTargetValue($element);
            if ($targetValue === null) {
                continue;
            }

            $remixedValue = $field->transform($targetValue);
            $element->setFieldValue($field->handle, $remixedValue);
        }
    }
}
