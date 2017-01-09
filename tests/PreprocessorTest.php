<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class Twig_Tests_Loader_PreprocessorTest extends PHPUnit_Framework_TestCase
{
    public function testProcessing()
    {
        $loader = $this->getLoader();

        $this->assertEquals('TEST', $loader->getSourceContext('test')->getCode());
        $this->assertEquals('test', $loader->getSourceContext('test')->getName());
        $this->assertEquals('', $loader->getSourceContext('test')->getPath());
    }

    private function getLoader(Twig_LoaderInterface $realLoader = null)
    {
        if ($realLoader === null) {
            $realLoader = new Twig_Loader_Array(['test' => 'test']);
        }

        return new Twig_Loader_Preprocessor($realLoader, 'strtoupper');
    }

    public function testExists()
    {
        $mockedLoader = $this->createMock('Twig_Loader_Filesystem');
        $mockedLoader->method('exists')->will($this->returnValueMap([['foo', false], ['bar', true]]));

        $loader = $this->getLoader($mockedLoader);

        $this->assertFalse($loader->exists('foo'));
        $this->assertTrue($loader->exists('bar'));
    }

    public function testIsFresh()
    {
        $this->assertEquals(true, $this->getLoader()->isFresh('test', time()));
    }

    public function testGetCacheKey()
    {
        $this->assertEquals('test', $this->getLoader()->getCacheKey('test'));
    }
}
