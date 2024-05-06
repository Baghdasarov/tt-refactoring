<?php

namespace TestRefactor\Request;

final class Request implements RequestInterface
{

    public function __construct(
        public array $data,
    )
    {
    }

    /**
     * @inheritdoc
     */
    public function getData(): array
    {
        return $this->data;
    }

}
