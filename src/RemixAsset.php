<?php

namespace mlathrom\craftremix;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

class RemixAsset extends AssetBundle
{
    public function init()
    {
        $this->sourcePath = '@remix/resources';
        $this->depends = [
            CpAsset::class,
        ];
        $this->js = [
            'js/remix.js',
        ];

        parent::init();
    }
}