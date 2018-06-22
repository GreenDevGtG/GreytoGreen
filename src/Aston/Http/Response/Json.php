<?php

namespace Aston\Http\Response;

use Aston\Http\Response;

class Json extends Response
{
    public function generate()
    {
        $this->setHeader('Content-Type', 'application/json');
        return json_encode(parent::generate());
    }
}