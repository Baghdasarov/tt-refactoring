<?php

namespace TestRefactor\Request;

use TestRefactor\AppException\FileDoesNotExistException;

final class TransactionRequestProcessor implements TransactionRequestProcessorInterface
{


    /**
     * @inheritdoc
     */
    public function processRequest(mixed $filePath): RequestInterface
    {
        // Check if the provided file exists
        $isFile = file_exists($filePath);
        if(!$isFile) {
            throw new FileDoesNotExistException("File does not exist, please provide a valid file path");
        }

        return new Request([
            'path' => $filePath
        ]);
    }

}

