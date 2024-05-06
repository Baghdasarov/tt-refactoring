<?php

namespace TestRefactor\Service\BinLookup\Providers;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use TestRefactor\AppException\RequestFailedException;
use TestRefactor\Entity\Transaction;

final class HandyApiProviderStrategy implements ProviderStrategyInterface
{

    const BASE_URL = 'https://data.handyapi.com/bin/';

    /**
     * @inheritdoc
     */
    public function getCountyCode(Transaction $transaction): string
    {
        $response = $this->sendRequest($transaction->getBin());
        $body = json_decode($response->getBody(), true);

        return $body['Country']['A2'];
    }

    protected function sendRequest(string $binNumber): ResponseInterface
    {
        try {
            $client = new Client([
                'base_uri' => self::BASE_URL
            ]);
            $response = $client->request('GET', $binNumber);
        } 
        catch (GuzzleException $th) {
            throw new RequestFailedException(
                sprintf(
                    "Failed to retrieve country code for BIN %s.\nParent message: %s",
                    $binNumber,
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
                    "Failed to retrieve country code for BIN %s.\nParent message: %s",
                    $binNumber,
                    $th->getMessage(),
                ),
                $th->getCode(),
                $th
            );
        }

        return $response;
    }

}

