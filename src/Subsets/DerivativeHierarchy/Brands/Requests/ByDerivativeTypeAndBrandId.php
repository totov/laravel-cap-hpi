<?php

namespace Totov\Cap\Subsets\DerivativeHierarchy\Brands\Requests;

use Totov\Cap\Cap;
use Totov\Cap\Requests\Request;

class ByDerivativeTypeAndBrandId extends Request
{
    public function __construct(protected string $accessToken, protected string $derivativeType, protected int $brandId)
    {
        $this->method = Request::METHOD_GET;
    }

    protected function endpoint(): string
    {
        $version = Cap::VERSION;

        return "https://api.cap-hpi.co.uk/v{$version}/{$this->derivativeType}/brands/{$this->brandId}";
    }
}
