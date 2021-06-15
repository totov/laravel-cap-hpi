<?php

namespace Totov\Cap\Subsets\TechnicalSpecification\Categories\Requests;

use Totov\Cap\Cap;
use Totov\Cap\Requests\Request;

class ByDerivativeTypeRequest extends Request
{
    public function __construct(protected string $accessToken, protected string $derivativeType)
    {
        $this->method = Request::METHOD_GET;
    }

    protected function endpoint(): string
    {
        $version = Cap::VERSION;

        return "https://api.cap-hpi.co.uk/v{$version}/{$this->derivativeType}/technical-specification/categories";
    }
}
