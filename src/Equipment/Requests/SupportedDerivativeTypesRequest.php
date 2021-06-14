<?php

namespace Totov\Cap\Equipment\Requests;

use Totov\Cap\Cap;
use Totov\Cap\Requests\Request;

class SupportedDerivativeTypesRequest extends Request
{
    public function __construct(protected string $accessToken)
    {
        $this->method = Request::METHOD_GET;
    }

    protected function endpoint(): string
    {
        $version = Cap::VERSION;
        return "https://api.cap-hpi.co.uk/v{$version}/v{version}/derivative-types/equipment";
    }
}
