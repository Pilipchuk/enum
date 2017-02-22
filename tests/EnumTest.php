<?php
/**
 * @author Vladimir Pilipchuk <vovapilipchuk@gmail.com>
 */
namespace Enum\Tests;

/**
 * Class EnumTest
 * @package Enum\Tests
 */
class EnumTest extends \PHPUnit_Framework_TestCase
{
    public function testGetValue()
    {
        $enum = new ExampleEnum(ExampleEnum::ONE);
        $this->assertEquals(ExampleEnum::ONE, $enum->getValue());

        $enum = new ExampleEnum(ExampleEnum::TWO);
        $this->assertEquals(ExampleEnum::TWO, $enum->getValue());

        $enum = new ExampleEnum(ExampleEnum::OTHER);
        $this->assertEquals(ExampleEnum::OTHER, $enum->getValue());
    }
}

