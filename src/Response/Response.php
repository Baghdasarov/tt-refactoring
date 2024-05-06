<?php

namespace TestRefactor\Response;

use TestRefactor\AppException\AppExceptionInterface;

final class Response implements ResponseInterface
{

    /**
     * @inheritdoc
     */
    public function error(AppExceptionInterface $appException): string
    {
        echo $appException->__toString();
        exit(1);
    }


    /**
     * @inheritdoc
     */
    public function success(array $commissionSet): string
    {
        echo implode("\n", $commissionSet);
        exit(0);
    }

}

