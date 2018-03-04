# Twig H-Handlebars

_Pun: H-Handlebars, extra H because of extra curly brace._

This Twig Preprocessor, originally based on [https://github.com/TiGR/twig-preprocessor] allows you to use {{{ }}} handlebars in a twig template which are rendered out in the final twig as {{ '{{' }} and {{ '}}' }}.

This allows you to mix twig and other handlebar delimited code, eg VueJS or handlebars.js, in the same template.

This branch (master) contains code for Twig 1.x.

## Installation

Installation via composer (version for twig 1):

    composer install roxburghm/twig-hhandlebars

## Usage

Intantiate the Filesystem HHandlebars Loader and pass that to Twig.

Intantiate Twig

```php
$Loader = Twig_Loader_Filesystem_HHandlebars('/path/to/templates');
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
