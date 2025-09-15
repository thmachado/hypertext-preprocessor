<?php

declare(strict_types=1);

use App\Basics\Arrays;
use PHPUnit\Framework\TestCase;

final class ArrayTest extends TestCase
{
    private Arrays $array;

    protected function setUp(): void
    {
        $this->array = new Arrays(["Aston Villa", "Arsenal", "Chelsea", "Fulham", "Liverpool", "Newcastle United"]);
    }

    public function testArrayPushFunction(): void
    {
        $team = $this->array->push("Manchester United");
        $this->assertEquals(7, $team);
        $this->assertCount(7, $this->array->data);
    }

    public function testArrayMergeFunction(): void
    {
        $array = $this->array->merge(["Barcelona", "Real Madrid"]);
        $this->assertCount(8, $array);
        $this->assertEquals("Aston Villa", $array[0]);
        $this->assertEquals("Real Madrid", $array[7]);
        $this->assertCount(6, $this->array->data);
        $this->assertEquals("Aston Villa", $this->array->data[0]);
        $this->assertEquals("Newcastle United", $this->array->data[5]);
    }

    public function testArrayPopFunction(): void
    {
        $array = $this->array->pop();
        $this->assertIsString($array);
        $this->assertEquals("Newcastle United", $array);
        $this->assertCount(5, $this->array->data);
        $this->assertEquals("Aston Villa", $this->array->data[0]);
        $this->assertEquals("Liverpool", $this->array->data[4]);
    }

    public function testArrayShiftFunction(): void
    {
        $array = $this->array->shift();
        $this->assertIsString($array);
        $this->assertEquals("Aston Villa", $array);
        $this->assertCount(5, $this->array->data);
        $this->assertEquals("Arsenal", $this->array->data[0]);
        $this->assertEquals("Newcastle United", $this->array->data[4]);
    }

    public function testArrayMapFunction(): void
    {
        $array = $this->array->map();
        $this->assertCount(6, $array);
        $this->assertEquals("ASTON VILLA", $array[0]);
        $this->assertEquals("NEWCASTLE UNITED", $array[5]);
    }

    public function testArrayFilterFunction(): void
    {
        $array = $this->array->filter();
        $this->assertCount(5, $array);
        $this->assertEquals("Aston Villa", $array[0]);
        $this->assertEquals("Newcastle United", $array[5]);
    }
}
