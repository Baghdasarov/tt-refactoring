<?php

namespace TestRefactor\Service\CurrencyExchange\Providers;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use TestRefactor\AppException\CurrencyRateNotFoundException;
use TestRefactor\AppException\RequestFailedException;
use TestRefactor\Entity\Transaction;

final class ErApiProviderStrategy implements ProviderStrategyInterface
{

    const BASE_URL = 'https://open.er-api.com/v6/latest/EUR';

    protected array $rates;

    public function __construct()
    {
        $response = $this->sendRequest();
        $body = json_decode($response->getBody(), true);
        $this->rates = $body['rates'];
    }

    public function getExchangeRate(Transaction $transaction): string
    {
        $rate = $this->rates[$transaction->getCurrency()] ?? null;

        if(empty($rate)) {
            throw new CurrencyRateNotFoundException(
                sprintf(
                    "Configured exchange rate provider does not have data for %s", 
                    $transaction->getCurrency()
                )
            );
        }

        return $rate;
    }

    protected function sendRequest(): ResponseInterface
    {
        try {
            $client = new Client([
                'base_uri' => self::BASE_URL
            ]);
            $response = $client->request('GET');
        } 
        catch (GuzzleException $th) {
            throw new RequestFailedException(
                sprintf(
                    "Failed to retrieve exange rates.\nParent message: %s",
                    $th->getMessage(),
                ),
                $th->getCode(),
                $th
            );
        } 
        // Catch all net
        catch (Exception $th) {
            throw new RequestFailedException(
                sprintf(
                    "Failed to retrieve exange rates.\nParent message: %s",
                    $th->getMessage(),
                ),
                $th->getCode(),
                $th
            );
        }

        return $response;
    }

}


