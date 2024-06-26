<?php

namespace mlathrom\craftremix;

use Craft;
use craft\base\Plugin as BasePlugin;
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
        Event::on(Fields::class, Fields::EVENT_REGISTER_FIELD_TYPES, function (RegisterComponentTypesEvent $event) {
            $event->types[] = Remix::class;
        });
    }
}
