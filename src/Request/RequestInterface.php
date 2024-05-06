<?php

namespace TestRefactor\Request;

interface RequestInterface
{

    /**
     * Get request data
     *
     * @return array
     */
    public function getData(): array;

}

