<?php

/**
 * Twig Hhandlebars loader that allows use of {{{ }}} and {{{{ }}}}.
 **
 * $loader = new Twig_Loader_HHandlebars($realLoader);
 *
 * @author Matt Roxburgh
 */
class Twig_Loader_HHandlebars implements Twig_LoaderInterface
{
    private $realLoader;

    /**
     * Constructor
     *
     * @param Twig_LoaderInterface $loader A loader that does real loading of templates
     */
    public function __construct(Twig_LoaderInterface $loader)
    {
        $this->realLoader = $loader;
    }

    /**
     * {@inheritdoc}
     */
    public function getSourceContext($name)
    {
        $realSource = $this->realLoader->getSourceContext($name);

        return new Twig_Source(
            $this->_preprocessSource($realSource->getCode()), $realSource->getName(), $realSource->getPath()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function exists($name)
    {
        return $this->realLoader->exists((string)$name);
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheKey($name)
    {
        return $this->realLoader->getCacheKey($name);
    }

    /**
     * {@inheritdoc}
     */
    public function isFresh($name, $time)
    {
        return $this->realLoader->isFresh($name, $time);
    }

    private function _preprocessSource($getCode) {

        return str_replace(['{{{', '{{{{'], ['{{{', '{{'], $getCode);

    }
}
