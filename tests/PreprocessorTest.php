<?php

class Twig_Tests_Loader_PreprocessorTest extends PHPUnit_Framework_TestCase
{
    public function testProcessing()
    {
        $realLoader = new Twig_Loader_Array(['test' => 'test']);
        $loader = new Twig_Loader_Preprocessor($realLoader, 'strtoupper');
        $this->assertEquals('TEST', $loader->getSource('test'));
    }

    public function testExists()
    {
        $realLoader = $this->getMockBuilder('Twig_Loader_Array')
            ->setMethods(array('exists', 'getSource'))
            ->disableOriginalConstructor()
            ->getMock();
        $realLoader->expects($this->once())->method('exists')->will($this->returnValue(false));
        $realLoader->expects($this->never())->method('getSource');

        /** @noinspection PhpParamsInspection */
        $loader = new Twig_Loader_Preprocessor($realLoader, 'trim');
        $this->assertFalse($loader->exists('foo'));

        $realLoader = $this->getMock('Twig_LoaderInterface');
        $realLoader->expects($this->once())->method('getSource')->will($this->returnValue('content'));

        /** @noinspection PhpParamsInspection */
        $loader = new Twig_Loader_Preprocessor($realLoader, 'trim');
        $this->assertTrue($loader->exists('foo'));
    }
}
