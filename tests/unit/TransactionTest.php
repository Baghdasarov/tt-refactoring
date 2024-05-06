<?php

use PHPUnit\Framework\TestCase;
use TestRefactor\Entity\Transaction;

class TransactionTest extends TestCase
{
    public function testTransactionProperties()
    {
        $bin = 123456;
        $amount = 100.50;
        $currency = 'USD';

        $transaction = new Transaction($bin, $amount, $currency);

        $this->assertSame($bin, $transaction->getBin());
        $this->assertSame($amount, $transaction->getAmount());
        $this->assertSame($currency, $transaction->getCurrency());
    }

    public function testInvalidBin()
    {
        $this->expectException(TypeError::class);
        new Transaction('invalid_bin', 100.50, 'USD');
    }

    public function testInvalidAmount()
    {
        $this->expectException(TypeError::class);
        new Transaction(123456, 'invalid_amount', 'USD');
    }

    public function testInvalidCurrency()
    {
        $this->expectException(TypeError::class);
        new Transaction(123456, 100.50, [123]);
    }

    // Additional negative test cases can be added here to cover more scenarios.
}

