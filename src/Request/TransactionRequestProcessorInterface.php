<?php

namespace TestRefactor\Request;

interface TransactionRequestProcessorInterface
{

    /**
     * Process received request
     *
     * @param string $filePath
     * @return RequestInterface
     *
     * @throws FileDoesNotExistException
     */
    public function processRequest(string $filePath): RequestInterface;

}

