<?php

namespace vova07\select2;

use yii\web\AssetBundle;

/**
 * Widget bootstrap asset bundle.
 */
class BootstrapAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@vova07/select2/assets/select2-3.5.0';
    /**
     * @inheritdoc
     */
    public $css = [
        'select2-bootstrap.css'
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        'vova07\select2\Asset',
        'yii\bootstrap\BootstrapAsset'
    ];
}
