<?php

declare(strict_types=1);

namespace App\Payment;

use App\Models\User;
use RuntimeException;

abstract class Bank
{
    public function __construct(
        private User $user,
        private float $money
    ) {
    }

    public function deposit(float $money): float
    {
        if ($money <= 0) {
            throw new RuntimeException("Must be greater than zero");
        }

        $this->money += $money;
        return $this->money;
    }

    public function withdraw(float $money): float
    {
        if ($money <= 0) {
            throw new RuntimeException("Must be greater than zero");
        }

        if ($this->money < $money) {
            throw new RuntimeException("Insufficient balance");
        }

        $this->money -= $money;
        return $this->money;
    }

    public function transfer(Bank $bank, float $money): float
    {
        if ($money <= 0) {
            throw new RuntimeException("Must be greater than zero");
        }

        if ($this->money < $money) {
            throw new RuntimeException("Insufficient balance");
        }

        $this->money -= $money;
        $bank->deposit($money);
        return $this->money;
    }

    public function balance(): float
    {
        return $this->money;
    }
}