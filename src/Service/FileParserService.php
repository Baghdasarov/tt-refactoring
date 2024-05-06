<?php

namespace TestRefactor\Service;

use TestRefactor\Entity\Transaction;

final class FileParserService
{

    /**
     * Scrape the provided file and return a formatted data
     *
     * @param string $filePath
     * @return array
     */
    public function __invoke(string $filePath): array
    {
        $result = [];

        // Get file contents
        $fileStream = fopen($filePath, "r");
        while (!feof($fileStream)) {
            $jsonContent = json_decode(fgets($fileStream), true);

            if(!empty($jsonContent)) {
                $result[] = new Transaction(
                    bin: $jsonContent['bin'],
                    amount: $jsonContent['amount'],
                    currency: $jsonContent['currency'],
                );
            }
        }

        return $result;
    }

}

