<?php

namespace TestRefactor\Service\CurrencyExchange;

use TestRefactor\Entity\Transaction;
use TestRefactor\Service\CurrencyExchange\Providers\ProviderStrategyInterface;

final class CurrencyExchangeContextService implements CurrencyExchangeContextServiceInterface
{

    public function __construct(
        protected ProviderStrategyInterface $strategy
    )
    {
    }

    /**
     * @inheritdoc
     */
    public function setStrategy(ProviderStrategyInterface $strategy): void
    {
        $this->strategy = $strategy;
    }

    /**
     * @inheritdoc
     */
    public function getExchangeRate(Transaction $transaction): string
    {
        return $this->strategy->getExchangeRate($transaction);
    }

}

