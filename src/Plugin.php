<?php

namespace mlathrom\craftremix;

use Craft;
use craft\base\Plugin as BasePlugin;
use craft\events\ModelEvent;
use craft\events\RegisterComponentTypesEvent;
use craft\services\Fields;
use craft\elements\Entry;
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
    public string $schemaVersion = '1.0.0';

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
        Event::on(Fields::class, Fields::EVENT_REGISTER_FIELD_TYPES, function (RegisterComponentTypesEvent $event) {
            $event->types[] = Remix::class;
        });

        // Listen for entry save events (both published and draft)
        Event::on(
            Entry::class,
            Entry::EVENT_BEFORE_SAVE,
            function (ModelEvent $event) {
                $this->handleEntrySave($event);
            }
        );
    }
    
    /**
     * Process Remix fields when an entry is saved
     * 
     * @param ModelEvent $event
     */
    private function handleEntrySave(ModelEvent $event): void
    {
        /** @var Entry $entry */
        $entry = $event->sender;
        
        // Skip if the entry is a revision
        if ($entry->getIsRevision()) {
            return;
        }
        
        // Get all fields for this entry
        $fieldLayout = $entry->getFieldLayout();
        if (!$fieldLayout) {
            return;
        }
        
        // Find all Remix fields in the field layout
        $remixFields = [];
        foreach ($fieldLayout->getCustomFields() as $field) {
            if ($field instanceof Remix) {
                $remixFields[] = $field;
            }
        }
        
        // No Remix fields found, we can return
        if (empty($remixFields)) {
            return;
        }
        
        // Update each Remix field value
        foreach ($remixFields as $field) {
            // Get the field's handle
            $handle = $field->handle;
            
            // Get the target value (title or slug)
            $targetValue = $entry->{$field->RemixTarget};
            
            // If we have a target value, generate the remixed value
            if ($targetValue) {
                // The serializeValue method in the field class will handle all the transformations
                $remixedValue = $field->serializeValue(null, $entry);
                
                // Set the remixed value on the entry
                $entry->setFieldValue($handle, $remixedValue);
            }
        }
    }
}
