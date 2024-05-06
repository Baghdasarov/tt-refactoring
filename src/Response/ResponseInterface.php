<?php

namespace TestRefactor\Response;

use TestRefactor\AppException\AppExceptionInterface;

interface ResponseInterface
{

    /**
     * Return formatted error response
     *
     * @param AppExceptionInterface $appException
     * @return string
     */
    public function error(AppExceptionInterface $appException): string;

    /**
     * Return formatted success response
     *
     * @param array $commissionSet
     * @return string
     */
    public function success(array $commissionSet): string;

}

