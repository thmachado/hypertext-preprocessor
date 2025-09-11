<?php

declare(strict_types=1);

use App\Files\Text;
use PHPUnit\Framework\TestCase;

final class TextTest extends TestCase
{
    private Text $text;

    protected function setUp(): void
    {
        $this->text = new Text("test.txt");
        $this->text->writeFile("Palmeiras");
    }

    protected function tearDown(): void
    {
        $this->text->deleteFile();
    }

    public function testReadFileFunction(): void
    {
        $file = $this->text->readFile();
        $this->assertIsString($file);
        $this->assertEquals("Palmeiras", $file);
    }

    public function testWriteFileFunction(): void
    {
        $this->text->cleanFile();
        $this->text->writeFile("Sociedade Esportiva Palmeiras");
        $file = $this->text->readFile();
        $this->assertIsString($file);
        $this->assertEquals("Sociedade Esportiva Palmeiras", $file);
    }

    public function testCleanFileFunction(): void
    {
        $this->text->cleanFile();
        $file = $this->text->readFile();
        $this->assertIsString($file);
        $this->assertEmpty($file);
        $this->assertEquals("", $file);
    }
}