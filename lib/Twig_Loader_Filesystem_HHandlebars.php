<?php

namespace Roxburghm\TwigHHandlebars;

use Twig_Error_Loader;

/**
 * Twig Hhandlebars Filesystem loader that allows use of {{{ }}}
 **
 *
 * @author Matt Roxburgh
 */
class Twig_Loader_Filesystem_HHandlebars extends \Twig_Loader_Filesystem
{
    /**
     * {@inheritdoc}
     */
    public function getSourceContext($name) {
        $path = $this->findTemplate($name);

        return new \Twig_Source($this->_preprocessSource(file_get_contents($path)), $name, $path);
    }

    private function _preprocessSource($getCode) {

        return (str_replace(
                  [
                      '{{{',
                      '}}}'
                  ],
                  [
                      "{{ '{{' }}",
                      "{{ '}}' }}"
                  ], $getCode));

    }

}
