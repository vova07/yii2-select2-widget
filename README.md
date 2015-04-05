# Yii2 select2 widget.

[![Latest Version](https://img.shields.io/github/tag/vova07/yii2-select2-widget.svg?style=flat-square&label=release)](https://github.com/vova07/yii2-select2-widget/releases)
[![Software License](https://img.shields.io/badge/license-BSD-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/vova07/yii2-select2-widget/master.svg?style=flat-square)](https://travis-ci.org/vova07/yii2-select2-widget)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/vova07/yii2-select2-widget.svg?style=flat-square)](https://scrutinizer-ci.com/g/vova07/yii2-select2-widget/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/vova07/yii2-select2-widget.svg?style=flat-square)](https://scrutinizer-ci.com/g/vova07/yii2-select2-widget)
[![Total Downloads](https://img.shields.io/packagist/dt/vova07/yii2-select2-widget.svg?style=flat-square)](https://packagist.org/packages/vova07/yii2-select2-widget)

Select2 widget is a wrapper of [Select2](http://ivaynberg.github.io/select2/) for Yii 2 framework.

## Install

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist vova07/yii2-select2-widget "*"
```

or add

```
"vova07/yii2-select2-widget": "*"
```

to the require section of your `composer.json` file.

## Usage

Once the extension is installed, simply use it in your code by:

```php
use vova07\select2\Widget;

echo $form->field($model, 'field')->widget(Widget::className(), [
    'options' => [
        'multiple' => true,
        'placeholder' => 'Choose item'
    ],
    'settings' => [
        'width' => '100%',
    ],
    'items' => [
        'item1',
        'item2',
        ...
    ],
    'events' => [
        'select2-open' => 'function (e) { log("select2:open", e); }',
        'select2-close' => new JsExpression('function (e) { log("select2:close", e); }')
        ...
    ]
]);
```

## Testing

``` bash
$ phpunit
```

## Further Information

Please, check the [Select2](https://select2.github.io) documentation for further information about its configuration options.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Vasile Crudu](https://github.com/vova07)
- [All Contributors](../../contributors)

## License

The BSD License (BSD). Please see [License File](LICENSE.md) for more information.
