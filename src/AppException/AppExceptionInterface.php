<?php

namespace TestRefactor\AppException;

interface AppExceptionInterface {

    /**
     * @return string
     */
    public function __toString(): string;

}
