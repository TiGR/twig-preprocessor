# Twig Preprocessor Loader

[![Build Status](https://travis-ci.org/TiGR/twig-preprocessor.svg?branch=master)](https://travis-ci.org/TiGR/twig-preprocessor)
[![For Twig version](https://img.shields.io/badge/twig-%3E%3D%202.0-8892BF.svg)](http://twig.sensiolabs.org/)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.0-8892BF.svg)](https://secure.php.net/)
[![Total Downloads](https://poser.pugx.org/tigr/twig-preprocessor/downloads)](https://packagist.org/packages/tigr/twig-preprocessor)
[![Latest Stable Version](https://poser.pugx.org/tigr/twig-preprocessor/v/stable)](https://packagist.org/packages/tigr/twig-preprocessor)
[![License](https://poser.pugx.org/tigr/twig-preprocessor/license)](https://packagist.org/packages/tigr/twig-preprocessor)

This Twig Preprocessor loader allows you to do custom manipulations with twig templates before passing them to 
twig parser. This allows you, for instance, to do some substitutions, or format templates to make them look better.

This branch (master) contains code for Twig 2.x.

## Installation

Installation via composer (version for twig 2):

    composer install tigr/twig-preprocessor

If you want to use it with twig 1, use version 1:

    composer install tigr/twig-preprocessor "~1.0"

## Usage

In general usage, you pass real template loader to Twig Preprocessor Loader and also a callback that would be called
to mingle with twig template code. So, general usage is this:

```php
$realLoader = Twig_Loader_Filesystem('/path/to/templates');
$loader = Twig_Loader_Preprocessor(
    $realLoader, 
    function($twigSource) {
        // do something with $twigSource
        
        return $twigSource;
    }
);

$twig = new Twig_Environment($loader);
```

The main reason why this code was written was to make Twig output a bit more pretty-formatted code. You can read more 
about this [in this Twig issue](https://github.com/twigphp/Twig/issues/1005).

In short, the idea is to remove all spaces/tabs before any (well, most) twig control structures. Here is how you can 
achieve this:

```php
$loader = new Twig_Loader_Preprocessor(
    $realLoader,
    function ($template) {
        static $regExp;
        // the RE isn't perfect, it won't match structures having curly braces within, 
        // but it's okay for me.
        if (!isset($regExp)) {
            $regExp = str_replace(
                ['_',      '{',  '}'],
                ['[\t ]*', '\{', '\}'],
                '/^_({([#%])[^}]*[^-](?2)}|{%_block_\w*_%}{%_endblock_%})$/m'
            );
        }
        
        return preg_replace($regExp, '$1', $template);
    }
);
```

## History

- [Original code in gist](https://gist.github.com/TiGR/5002699).
- [Twig issue about suggested formatting fix](https://github.com/twigphp/Twig/issues/1005).
- [Rejected Twig pull request](https://github.com/twigphp/Twig/pull/1508).
