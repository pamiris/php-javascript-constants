php-javascript-constants 
========================

A simple tool for porting PHP constant classes to javascript constant objects

Installation
--------------------

### As a dependency

Run `composer require pamiris/javascript-constants`

-- or --

Add the following line to your composer.json:

```json
{
  "require": {
    "pamiris/javascript-constants": "*"
  }
}
```

Usage
------------------
To get the executable javascript to define the object, pass the classname and an optional target name into the tool; then include the resulting js inside a script tag on your template:

```php
<?php
//src/myprocject/controller.php

...
use Pamiris\JavascriptConstants\Mapper as ConstantMapper;

...
function someAction()
{
  $jsConstants = ConstantMapper::getJavascriptObject('MyNamespace\MyClass');
  $this->renderTemplate('mypage',[
    ...
    'scriptContent' => $jsConstants
  ]);
```

```twig
{# /myproject/page.html.twig #}
{% extends base.html.twig %}
{% block javascripts %}

<script>{{ scriptContent | raw }}</script>
{% endblock %}
```

TODO
-------------------
Add Twig extension and bundle to auto-configure.

Notes
-------------------
This requires ES2015, which is supported in [most broswers](http://caniuse.com/#search=const). Safari will let you overwrite the objects, Chrome and Firefox will not.

License
--------------------
PHP JavascriptConstants is licensed under the MIT License - see the LICENSE file for details.
