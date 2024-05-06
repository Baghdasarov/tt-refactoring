<?php

namespace TestRefactor\AppException;

use Exception;

abstract class AbstractException extends Exception
{

    public function __toString(): string
    {
        return sprintf("%d %s",$this->code, $this->message);
    }

}

