<?php

namespace TestRefactor\Service\BinLookup;

use TestRefactor\Entity\Transaction;
use TestRefactor\Service\BinLookup\Providers\ProviderStrategyInterface;

final class BinLookupContextService implements BinLookupContextServiceInterface
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
    public function getCountyCode(Transaction $transaction): string
    {
        return $this->strategy->getCountyCode($transaction);
    }

}

