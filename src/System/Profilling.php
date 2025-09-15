<?php

declare(strict_types=1);

namespace App\System;

class Profilling
{
    public function __construct(
        private int $start = 0,
        private int $end = 0,
        private int $duration = 0
    ) {
    }

    public function getMemoryUsage(bool $real = false): int
    {
        return memory_get_usage($real);
    }

    public function getMemoryPeakUsage(bool $real = false): int
    {
        return memory_get_peak_usage($real);
    }

    public function start(): void
    {
        $this->start = hrtime(true);
    }

    public function end(): void
    {
        $this->end = hrtime(true);
        $this->duration = $this->end - $this->start;
    }

    public function getDurationSeconds(): float
    {
        return $this->duration / 1e9;
    }

    public function getDurationFormatted(): string
    {
        $seconds = $this->getDurationSeconds();
        if ($seconds < 1) {
            return number_format($seconds * 1000, 5) . "ms";
        }

        return number_format($seconds, 5) . "s";
    }

    public function profilling(): string
    {
        return $this->getDurationFormatted() . " de carregamento";
    }
}