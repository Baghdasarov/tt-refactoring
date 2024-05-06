<?php

use PHPUnit\Framework\TestCase;
use TestRefactor\Service\FileParserService;
use TestRefactor\Entity\Transaction;

class FileParserServiceTest extends TestCase
{
    public function testInvokeMethodWithValidFile()
    {
        $fileParser = new FileParserService();
        $filePath = 'valid_file.json';

        // Prepare mock file contents
        $jsonContent = '{"bin": 123456, "amount": 123.45, "currency": "USD"}';
        $fileContent = $jsonContent . PHP_EOL; // Add end of line

        // Create a temporary file with mock contents
        $tempFile = tmpfile();
        fwrite($tempFile, $fileContent);
        $tempFilePath = stream_get_meta_data($tempFile)['uri'];

        // Execute the file parser service
        $transactions = $fileParser->__invoke($tempFilePath);

        // Assert that the result contains a Transaction object with correct data
        $this->assertCount(1, $transactions);
        $this->assertInstanceOf(Transaction::class, $transactions[0]);
        $this->assertSame(123456, $transactions[0]->getBin());
        $this->assertSame(123.45, $transactions[0]->getAmount());
        $this->assertSame('USD', $transactions[0]->getCurrency());

        // Clean up temporary file
        fclose($tempFile);
    }

    public function testInvokeMethodWithEmptyFile()
    {
        $fileParser = new FileParserService();
        $filePath = 'empty_file.json';

        // Create an empty temporary file
        $tempFile = tmpfile();
        $tempFilePath = stream_get_meta_data($tempFile)['uri'];

        // Execute the file parser service
        $transactions = $fileParser->__invoke($tempFilePath);

        // Assert that the result is an empty array
        $this->assertIsArray($transactions);
        $this->assertEmpty($transactions);

        // Clean up temporary file
        fclose($tempFile);
    }
}

