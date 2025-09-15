<?php

declare(strict_types=1);

use App\Basics\Functions;
use PHPUnit\Framework\TestCase;

final class FunctionTest extends TestCase
{
    private Functions $function;

    protected function setUp(): void
    {
        $this->function = new Functions();
    }

    public function testAnonymousFunction(): void
    {
        $string = "Thiago";
        $result = $this->function->anonymous($string);
        $this->assertNotEmpty($result);
        $this->assertEquals($string, $result);
    }

    public function testArrowFunction(): void
    {
        $number = 5;
        $result = $this->function->arrow($number);
        $this->assertEquals($number * 5, $result);
    }

    public function testVariadicFunction(): void
    {
        /**
         * @var array<int, array<string>> $data
         */
        $data = $this->function->variadic(["Palmeiras", "Corinthians"], ["Grêmio", "Internacional"], ["Atlético-MG", "Cruzeiro"], ["Flamengo", "Vasco"]);
        $this->assertCount(4, $data);
        $this->assertCount(2, $data[0]);
        $this->assertCount(2, $data[3]);
        $this->assertEquals("Palmeiras", $data[0][0]);
        $this->assertEquals("Internacional", $data[1][1]);
    }
}
