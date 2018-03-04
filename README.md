# Twig H-Handlebars

_Pun: H-Handlebars, extra H because of extra curly brace._

This Twig Preprocessor, originally based on [https://github.com/TiGR/twig-preprocessor] allows you to use {{{ }}} handlebars in a twig template which are rendered out in the final twig as {{ '{{' }} and {{ '}}' }}.

This allows you to mix twig and other handlebar delimited code, eg VueJS or handlebars.js, in the same template.

This branch (master) contains code for Twig 2.x.

## Installation

Installation via composer (version for twig 2):

    composer install roxburghm/twig-hhandlebars

## Usage

Intantiate a the HHandlebars template loader and pass it to Twig.

Intantiate Twig

```php
$realLoader = Twig_Loader_HHandlebars_Filesystem('/path/to/templates');
$twig = new Twig_Environment($loader);
```

Template Usage

```twig
<h1>Hello {{ twigvar_user.name }}</h1>

<div id="app">
  {{{ message }}}
</div>

var app = new Vue({
  el: '#app',
  data: {
    message: 'Hello Vue!'
  }
})
```

The code is rendered out correctly without having to resort to changing delimiters anywhere in eithe Twig or, say, VueJS.
