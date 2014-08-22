<?php

namespace vova07\select2;

use yii\web\AssetBundle;

/**
 * Widget select2 asset bundle.
 */
class Select2Asset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@vova07/select2/assets';

    /**
     * @inheritdoc
     */
	public $css = [
		'select2-3.5.0/select2.css'
	];

    /**
     * @inheritdoc
     */
	public $depends = [
		'vova07\select2\Asset'
	];
}
