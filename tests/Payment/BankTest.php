<?php

declare(strict_types=1);

use App\Payment\Nubank;
use App\Payment\Picpay;
use PHPUnit\Framework\TestCase;

final class BankTest extends TestCase
{
    private Nubank $nubank;
    private Picpay $picpay;

    protected function setUp(): void
    {
        $this->nubank = new Nubank(10000);
        $this->picpay = new Picpay(15000);
    }

    public function testDepositLessThanZero(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage("Must be greater than zero");
        $this->picpay->deposit(0);
    }

    public function testDeposit(): void
    {
        $nubank = $this->nubank->deposit(500);
        $picpay = $this->picpay->deposit(100);
        $this->assertEquals(10500, $nubank);
        $this->assertEquals(15100, $picpay);
    }

    public function testWithdrawLessThanZero(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage("Must be greater than zero");
        $this->nubank->withdraw(0);
    }

    public function testWithdrawInsufficientBalance(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage("Insufficient balance");
        $this->picpay->withdraw(10000000);
    }

    public function testWithdraw(): void
    {
        $nubank = $this->nubank->withdraw(500);
        $picpay = $this->picpay->withdraw(100);
        $this->assertEquals(9500, $nubank);
        $this->assertEquals(14900, $picpay);
    }

    public function testTransferLessThanZero(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage("Must be greater than zero");
        $this->nubank->transfer($this->picpay, 0);
    }

    public function testTransferInsufficientBalance(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage("Insufficient balance");
        $this->picpay->transfer($this->nubank, 10000000);
    }

    public function testTransfer(): void
    {
        $picpay = $this->picpay->transfer($this->nubank, 500);
        $nubank = $this->nubank->transfer($this->picpay, 500);
        $this->assertEquals(14500, $picpay);
        $this->assertEquals(10000, $nubank);
    }

    public function testBalance(): void
    {
        $nubank = $this->nubank->balance();
        $picpay = $this->picpay->balance();
        $this->assertEquals(15000, $picpay);
        $this->assertEquals(10000, $nubank);
    }
}