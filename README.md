Yii2 select2 widget.
===================
Select2 widget is a wrapper of [Select2](http://ivaynberg.github.io/select2/) for Yii 2 framework.

Installation
------------

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

Usage
-----

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
    ]
]);
```
