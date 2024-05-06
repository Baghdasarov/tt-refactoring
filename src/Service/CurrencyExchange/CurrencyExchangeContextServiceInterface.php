<?php

namespace TestRefactor\Service\CurrencyExchange;

use TestRefactor\Entity\Transaction;
use TestRefactor\Service\CurrencyExchange\Providers\ProviderStrategyInterface;

interface CurrencyExchangeContextServiceInterface
{
    /**
     * Set strategy provider
     *
     * @param ProviderStrategyInterface $strategy
     * @return void
     */
    public function setStrategy(ProviderStrategyInterface $strategy): void;

    /**
     * Get the country code from the bin lookup service
     *
     * @param Transaction $transaction
     * @return string
     */
    public function getExchangeRate(Transaction $transaction): string;

}

