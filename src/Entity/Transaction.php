<?php

namespace TestRefactor\Entity;

final class Transaction
{

    public function __construct(
        protected int $bin,
        protected float $amount,
        protected string $currency,
    )
    {
    }

    public function getBin(): int
    {
        return $this->bin;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

}

