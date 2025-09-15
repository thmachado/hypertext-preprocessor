<?php

declare(strict_types=1);

use App\System\Profilling;
use PHPUnit\Framework\TestCase;

final class ProffilingTest extends TestCase
{
    private Profilling $profilling;

    protected function setUp(): void
    {
        $this->profilling = new Profilling();
    }

    public function testMemoryUsage(): void
    {
        $memory = $this->profilling->getMemoryUsage();
        $this->assertEquals(memory_get_usage(), $memory);
        $this->assertIsInt($memory);
    }

    public function testMemoryUsageReal(): void
    {
        $memory = $this->profilling->getMemoryUsage(true);
        $this->assertEquals(memory_get_usage(true), $memory);
        $this->assertIsInt($memory);
    }

    public function testMemoryPeakUsage(): void
    {
        $memory = $this->profilling->getMemoryPeakUsage();
        $this->assertEquals(memory_get_peak_usage(), $memory);
        $this->assertIsInt($memory);
    }

    public function testMemoryPeakUsageReal(): void
    {
        $memory = $this->profilling->getMemoryPeakUsage(true);
        $this->assertEquals(memory_get_peak_usage(true), $memory);
        $this->assertIsInt($memory);
    }

}