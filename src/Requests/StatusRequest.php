<?php

namespace Totov\Cap\Requests;

class StatusRequest extends Request
{
    public function __construct(protected bool $healthZ = false)
    {
        $this->method = Request::METHOD_GET;
    }

    protected function endpoint(): string
    {
        return 'https://api.cap-hpi.co.uk/health' . ($this->healthZ ? 'z' : '');
    }
}
