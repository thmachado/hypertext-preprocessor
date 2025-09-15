<?php

declare(strict_types=1);

use App\Basics\Hint;
use PHPUnit\Framework\TestCase;

final class HintTest extends TestCase
{
    private Hint $hint;

    protected function setUp(): void
    {
        $this->hint = new Hint();
    }

    public function testMatchFunction(): void
    {
        $message = $this->hint->match(400);
        $this->assertNotEmpty($message);
        $this->assertEquals("User not found", $message);
    }

    public function testNamedArgumentsFunction(): void
    {
        $name = $this->hint->named(email: "thiago@email.com", lastname: "Machado", firstname: "Thiago");
        $this->assertNotEmpty($name);
        $this->assertEquals("Thiago Machado thiago@email.com", $name);
    }
}
