<?php

namespace vova07\select2;

use yii\web\AssetBundle;

/**
 * Widget asset bundle.
 */
class Asset extends AssetBundle
{
    /**
     * @var string Plugin language
     */
    public $language;

    /**
     * @inheritdoc
     */
    public $sourcePath = '@bower/select2';

    /**
     * @inheritdoc
     */
    public $js = [
        'select2.min.js'
    ];

    /**
     * @inheritdoc
     */
    public $css = [
        'select2.css',
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset'
    ];

    /**
     * @inheritdoc
     */
    public function registerAssetFiles($view)
    {
        if ($this->language !== null) {
            $this->js[] = 'select2_locale_' . $this->language . '.js';
        }

        parent::registerAssetFiles($view);
    }
}
