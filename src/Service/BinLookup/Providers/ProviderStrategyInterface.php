<?php

namespace TestRefactor\Service\BinLookup\Providers;

use TestRefactor\AppException\AppExceptionInterface;
use TestRefactor\Entity\Transaction;

interface ProviderStrategyInterface
{

    /**
     * Get the country code from the bin lookup service
     *
     * @param Transaction $transaction
     * @return string
     *
     * @throws AppExceptionInterface
     */
    public function getCountyCode(Transaction $transaction): string;

}


