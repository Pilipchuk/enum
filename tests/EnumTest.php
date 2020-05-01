<?php

declare(strict_types=1);

namespace DarkDevLab\Enum\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Class EnumTest
 * @package DarkDevLab\Enum\Tests
 */
class EnumTest extends TestCase
{
    public function testGetValue(): void
    {
        $enum = ExampleEnum::get(ExampleEnum::ONE);
        $this->assertEquals(ExampleEnum::ONE, $enum->getValue());

        $enum = new ExampleEnum(ExampleEnum::TWO);
        $this->assertEquals(ExampleEnum::TWO, $enum->getValue());

        $enum = new ExampleEnum(ExampleEnum::OTHER);
        $this->assertEquals(ExampleEnum::OTHER, $enum->getValue());
    }

    public function testGetInvalidValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        ExampleEnum::get('unknown');
    }

    public function testGetList(): void
    {
        $this->assertEquals([ExampleEnum::ONE, ExampleEnum::TWO, ExampleEnum::OTHER], ExampleEnum::getList());
    }

    public function testInSet(): void
    {
        $this->assertTrue(ExampleEnum::inSet(ExampleEnum::ONE));
        $this->assertFalse(ExampleEnum::inSet('unknown'));
    }

    public function testStringify(): void
    {
        $this->assertEquals(ExampleEnum::ONE, (string) ExampleEnum::get(ExampleEnum::ONE));
        $this->assertEquals(ExampleEnum::OTHER, (string) (new ExampleEnum(ExampleEnum::OTHER)));
    }
}

