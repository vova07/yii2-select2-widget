<?php
namespace vova07\select2;

use Yii;
use yii\widgets\InputWidget;
use yii\helpers\Json;
use yii\helpers\Html;

/**
 * Select2 widget
 * Widget wrapper for {@link http://ivaynberg.github.io/select2/ Select2}.
 * @var \yii\base\Widget $this Widget
 * 
 * Usage:
 * ~~~
 * echo $form->field($model, 'field')->widget(Select2::className(), [
 *     'options' => [
 *         'multiple' => true,
 * 		   'placeholder' => 'Choose item'
 *     ],
 *     'settings' => [
 *         'width' => '100%',
 *     ],
 *     'items' => [
 *         'item1',
 *         'item2',
 *         ...
 *     ]
 * ]);
 * ~~~
 */
class Widget extends InputWidget
{
	/**
	 * @var array {@link http://ivaynberg.github.io/select2/#documentation Select2} settings
	 */
	public $settings = [];

	/**
	 * @var array Select items
	 */
	public $items = [];

	/**
	 * @var string Plugin language. If `null`, [[\yii\base\Application::language|app language]] will be used.
	 */
	public $language;

    /**
     * @var boolean Whatever to use bootstrap CSS or not.
     */
    public $bootstrap = false;

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();

		// Set language
		if ($this->language === null && ($language = Yii::$app->language) !== 'en-US') {
			$this->language = substr($language, 0, 2);
		}
	}

	/**
	 * @inheritdoc
	 */
	public function run()
	{
		$this->registerClientScript();
		if ($this->hasModel()) {
			return Html::activeDropDownList($this->model, $this->attribute, $this->items, $this->options);
		} else {
			return Html::dropDownList($this->name, $this->value, $this->items, $this->options);
		}
  	}

  	/**
	 * Register widget asset.
	 */
	public function registerClientScript()
	{
		$view = $this->getView();
		$selector = '#' . $this->options['id'];
		$settings = Json::encode($this->settings);

		// Register asset
		$asset = Asset::register($view);

        if ($this->language !== null) {
            $asset->language = $this->language;
        }

        if ($this->bootstrap === true) {
            BootstrapAsset::register($view);
        } else {
            Select2Asset::register($view);
        }

		// Init widget
		$view->registerJs("jQuery('$selector').select2($settings);");
	}
}