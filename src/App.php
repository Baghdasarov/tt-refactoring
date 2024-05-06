<?php

namespace TestRefactor;

use TestRefactor\AppException\AppExceptionInterface;
use TestRefactor\Entity\Country;
use TestRefactor\Request\TransactionRequestProcessor;
use TestRefactor\Response\Response;
use TestRefactor\Service\BinLookup\BinLookupContextService;
use TestRefactor\Service\BinLookup\Providers\HandyApiProviderStrategy;
use TestRefactor\Service\CurrencyExchange\CurrencyExchangeContextService;
use TestRefactor\Service\CurrencyExchange\Providers\ErApiProviderStrategy;
use TestRefactor\Service\FileParserService;
use Throwable;

final class App
{

    const COMMISSION_RATE_EU = 0.01;
    const COMMISSION_RATE_NON_EU = 0.02;

    /**
     * Application entrypoint
     *
     * @param null|string $input
     * @return string
     *
     * @throws AppExceptionInterface
     */
    public function init(?string $input): string
    {
        $response = new Response();
        $responseData = [];

        try {
            // Get the request and process it
            $requestProcessor = new TransactionRequestProcessor();
            $request = $requestProcessor->processRequest($input)->getData();

            // Parse the file
            $transactionCollection = (new FileParserService)($request['path']);

            // Spin up strategies
            $binLookupService = new BinLookupContextService(
                strategy: new HandyApiProviderStrategy()
            );

            $currencyExchangeService = new CurrencyExchangeContextService(
                strategy: new ErApiProviderStrategy()
            );

            /**
             * Loop through transactions and get country code
             */
            foreach ($transactionCollection as $transaction) {
                // Set defaults
                $commission = 0;
                $amount = $transaction->getAmount();
                $commissionRate = self::COMMISSION_RATE_NON_EU;

                $countryCode = $binLookupService->getCountyCode($transaction);
                $exchangeRate = $currencyExchangeService->getExchangeRate($transaction);

                // Calculate commissions
                $isInEu = Country::isInEu($countryCode);
                if($isInEu) {
                    $commissionRate = self::COMMISSION_RATE_EU;
                }

                // Convert the amount to EUR if neccessary
                if($transaction->getCurrency() !== "EUR") {
                    $amount = $transaction->getAmount() / $exchangeRate;
                }

                // Apply commission rates
                $commission = $amount * $commissionRate;
                $commission = round($commission, 2, PHP_ROUND_HALF_UP);

                $responseData[] = $commission;
            }

        } catch (Throwable $th) {
            return $response->error($th);
        }

        return $response->success($responseData);
    } 

}

