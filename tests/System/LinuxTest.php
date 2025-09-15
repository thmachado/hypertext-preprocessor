<?php

declare(strict_types=1);

use App\System\Linux;
use PHPUnit\Framework\TestCase;

final class LinuxTest extends TestCase
{
    private Linux $linux;

    protected function setUp(): void
    {
        $this->linux = new Linux();
    }

    public function testLsDefault(): void
    {
        exec("ls", $files);
        $result = $this->linux->ls();

        $this->assertIsArray($result);
        $this->assertEquals($files, $result);
    }

    public function testLsWithArgs(): void
    {
        exec("ls -la", $files);
        $result = $this->linux->ls("-la");

        $this->assertIsArray($result);
        $this->assertEquals($files, $result);
    }

    public function testPwd(): void
    {
        $pwd = $this->linux->pwd();
        $this->assertIsString($pwd);
        $this->assertEquals(shell_exec("pwd"), $pwd);
    }

    public function testPs(): void
    {
        $this->assertIsArray($this->linux->ps());
    }

    public function testUptime(): void
    {
        $uptime = $this->linux->uptime();
        $this->assertIsString($uptime);
        $this->assertEquals(shell_exec("uptime"), $uptime);
    }
}