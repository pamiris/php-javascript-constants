<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Tests\Pamiris\JavascriptConstants;

use Pamiris\JavascriptConstants\Mapper;

/**
 * Description of MapperTest
 *
 * @author Bryan J. Agee
 */
class MapperTest extends \PHPUnit_Framework_TestCase
{
    public function testExceptionOnNonExistentClass()
    {
        $this->setExpectedException('Exception');
        Mapper::getJavascriptObject('NotARealClass');
    }
    
    public function testMapClassWithName()
    {
        $json = Mapper::getJavascriptObject('Tests\Pamiris\JavascriptConstants\SomeConstantObject', 'SomeConstants');
        $expected = 'const SomeConstants = {"ONE":1,"VALUE":2};';
        
        $this->assertEquals($expected, $json);
    }
    
    public function testMapClassWithoutName()
    {
        $json = Mapper::getJavascriptObject('Tests\Pamiris\JavascriptConstants\SomeConstantObject');
        $expected = 'const SomeConstantObject = {"ONE":1,"VALUE":2};';
        
        $this->assertEquals($expected, $json);
    }
}
