<?php

namespace vova07\select2;

use Yii;
use yii\web\JsExpression;
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
 *     ],
 *     'events' => [
 *         'select2-open' => 'function (e) { log("select2:open", e); }',
 *         'select2-close' => new JsExpression('function (e) { log("select2:close", e); }')
 *         ...
 *     ]
 * ]);
 * ~~~
 */
class Widget extends InputWidget
{
    /** Name of inline JavaScript package that is registered by the widget */
    const INLINE_JS_KEY = 'vova07/select2/';

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
     * @var boolean Whatever to use bootstrap CSS or not
     */
    public $bootstrap = false;

    /**
     * Events array. Array keys are the events name, and array values are the events callbacks.
     * Example:
     * ```php
     * [
     *     'select2-open' => 'function (e) { log("select2:open", e); }',
     *     'select2-close' => new JsExpression('function (e) { log("select2:close", e); }'),
     *     'select2-select' => [
     *         'function (e) { log("select2:select", e); }',
     *         'function (e) { console.log(e); }'
     *     ]
     * ]
     * ```
     * @var array Plugin events
     */
    public $events = [];

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
		$view->registerJs("jQuery('$selector').select2($settings);", $view::POS_READY, self::INLINE_JS_KEY . $this->options['id']);

        // Register events
        $this->registerEvents();
	}

    /**
     * Register plugin' events.
     */
    protected function registerEvents()
    {
        $view = $this->getView();
        $selector = '#' . $this->options['id'];

        if (!empty($this->events)) {
            $js = [];
            foreach ($this->events as $event => $callback) {
                if (is_array($callback)) {
                    foreach ($callback as $function) {
                        if (!$function instanceof JsExpression) {
                            $function = new JsExpression($function);
                        }
                        $js[] = "jQuery('$selector').on('$event', $function);";
                    }
                } else {
                    if (!$callback instanceof JsExpression) {
                        $callback = new JsExpression($callback);
                    }
                    $js[] = "jQuery('$selector').on('$event', $callback);";
                }
            }
            if (!empty($js)) {
                $js = implode("\n", $js);
                $view->registerJs($js, $view::POS_READY, self::INLINE_JS_KEY . 'events/' . $this->options['id']);
            }
        }
    }
}