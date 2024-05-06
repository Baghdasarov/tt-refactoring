<?php

use PHPUnit\Framework\TestCase;
use TestRefactor\Request\Request;

class RequestTest extends TestCase
{
    public function testValidData()
    {
        $data = ['key1' => 'value1', 'key2' => 'value2'];
        $request = new Request($data);

        $this->assertSame($data, $request->getData());
    }

}

