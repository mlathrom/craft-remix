<?php
// RemixSettingsAsset.php
namespace mlathrom\craftremix;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

class RemixSettingsAsset extends AssetBundle
{
    public function init(): void
    {
        $this->sourcePath = '@remix/resources';
        $this->depends = [
            CpAsset::class,
        ];
        $this->js = [
            'js/remix-settings.js',
        ];
        $this->css = [
            'css/remix-settings.css',
        ];
        parent::init();
    }
}
