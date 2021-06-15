<?php

namespace Totov\Cap\Subsets\DerivativeHierarchy\Derivatives\Requests;

use Totov\Cap\Cap;
use Totov\Cap\Requests\Request;

class ByDerivativeTypeAndTrimId extends Request
{
    public function __construct(protected string $accessToken, protected string $derivativeType, protected int $trimId)
    {
        $this->method = Request::METHOD_GET;
    }

    protected function endpoint(): string
    {
        $version = Cap::VERSION;

        return "https://api.cap-hpi.co.uk/v{$version}/{$this->derivativeType}/trims/{$this->trimId}/derivatives";
    }
}
