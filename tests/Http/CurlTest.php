<?php

declare(strict_types=1);

use App\Http\Curl;
use PHPUnit\Framework\TestCase;

final class CurlTest extends TestCase
{
    private Curl $curl;

    protected function setUp(): void
    {
        $this->curl = new Curl();
    }

    public function testCurlGetError(): void
    {
        $this->expectException(RuntimeException::class);
        $this->curl->get("palmeiras");
    }

    public function testCurlGet(): void
    {
        $data = $this->curl->get("https://jsonplaceholder.typicode.com/todos/");
        $this->assertArrayHasKey("userId", $data[0]);
        $this->assertArrayHasKey("title", $data[0]);
        $this->assertArrayHasKey("userId", $data[1]);
        $this->assertArrayHasKey("title", $data[1]);
    }

    public function testCurlPostError(): void
    {
        $this->expectException(RuntimeException::class);
        $this->curl->post("palmeiras");
    }

    public function testCurlPost(): void
    {
        $data = $this->curl->post(
            "https://jsonplaceholder.typicode.com/posts",
            [
                "title" => "Tests title",
                "body" => "Tests body",
                "userId" => 1
            ]
        );

        $this->assertArrayHasKey("userId", $data);
        $this->assertArrayHasKey("title", $data);
        $this->assertArrayHasKey("body", $data);
        $this->assertEquals("Tests title", $data["title"]);
        $this->assertEquals("Tests body", $data["body"]);
        $this->assertEquals(1, $data["userId"]);
    }
}