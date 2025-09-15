<?php

declare(strict_types=1);

use App\Basics\Type;
use PHPUnit\Framework\TestCase;

final class TypeTest extends TestCase
{
    private Type $type;

    protected function setUp(): void
    {
        $this->type = new Type();
    }

    public function testIntegerFunction(): void
    {
        $integer = 2025;
        $result = $this->type->integer($integer);
        $this->assertEquals($integer, $result);
    }

    public function testFloatFunction(): void
    {
        $float = 10.14;
        $result = $this->type->float($float);
        $this->assertEquals($float, $result);
    }

    public function testStringFunction(): void
    {
        $string = "Palmeiras";
        $result = $this->type->string($string);
        $this->assertEquals($string, $result);
    }

    public function testBooleanFunction(): void
    {
        $boolean = false;
        $result = $this->type->boolean($boolean);
        $this->assertEquals($boolean, $result);
    }

    public function testArrayFunction(): void
    {
        $array = ["Palmeiras", "Corinthians"];
        $result = $this->type->array($array);
        $this->assertCount(2, $result);
        $this->assertEquals($array, $result);
        $this->assertEquals("Palmeiras", $result[0]);
        $this->assertEquals("Corinthians", $result[1]);
    }

    public function testObjectFunction(): void
    {
        $object = (object) ["Palmeiras", "Corinthians"];
        $result = $this->type->object($object);
        $this->assertEquals($object, $result);
    }

    public function testNullFunction(): void
    {
        $null = null;
        $result = $this->type->null($null);
        $this->assertEquals($null, $result);
    }

    public function testCallableFunction(): void
    {
        $function = function (): string {
            return "Hello world";
        };

        $result = $this->type->callable($function);
        $this->assertIsString($result);
        $this->assertEquals("Hello world", $result);
    }

    public function testUnionFunction(): void
    {
        $variable = 10;
        $result = $this->type->union($variable);
        $this->assertIsInt($result);
        $this->assertEquals($variable, $result);
    }
}
