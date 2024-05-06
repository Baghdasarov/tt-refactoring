<?php

namespace TestRefactor\Service\BinLookup;

use TestRefactor\Entity\Transaction;
use TestRefactor\Service\BinLookup\Providers\ProviderStrategyInterface;

interface BinLookupContextServiceInterface
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
    public function getCountyCode(Transaction $transaction): string;

}

