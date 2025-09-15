<?php

declare(strict_types=1);

use App\Files\Json;
use PHPUnit\Framework\TestCase;

final class JsonTest extends TestCase
{
    private Json $json;

    /**
     * Summary of data
     * @var array<string>
     */
    private array $data = ["Palmeiras", "Corinthians"];

    protected function setUp(): void
    {
        $this->json = new Json($this->data);
    }

    public function testReadJson(): void
    {
        $json = $this->json->readJson(true);
        $this->assertCount(2, $json);
        $this->assertEquals("Palmeiras", $json[0]);
        $this->assertEquals("Corinthians", $json[1]);
    }

    public function testTransformToJson(): void
    {
        $json = $this->json->toJson();
        $this->assertEquals(json_encode($this->data), $json);
    }
}