# Twig H-Handlebars

This Twig Preprocessor, heavilit based on [https://github.com/TiGR/twig-preprocessor] allows you to use {{{ }}} handlebars in a twig template which are rendered out in the final twig as {{ '{{' }} and {{ '}}' }}.

This allows you to mix twig and other handlebar delimited code, eg VueJS or handlebars.js, in the same template.

This branch (master) contains code for Twig 2.x.

## Installation

Installation via composer (version for twig 2):

    composer install roxburgh/twig-hhandlebars

## Usage

Intantiate a real template loader and then wrap that in a HHandlebars loader before passing to Twig.

Intantiate Twig

```php
$realLoader = Twig_Loader_Filesystem('/path/to/templates');
$twig = new Twig_Environment(new Twig_Loader_HHandlebars($loader));
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

Just in case you like to live dangerously and nest preprocessors in other languages this preprocessor will convert triple handlebars to double as you would expect but *ALSO* convert quadruple to triple.