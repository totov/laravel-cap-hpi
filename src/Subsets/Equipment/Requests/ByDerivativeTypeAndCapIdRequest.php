<?php

namespace Totov\Cap\Subsets\Equipment\Requests;

use Totov\Cap\Cap;
use Totov\Cap\Requests\Request;

class ByDerivativeTypeAndCapIdRequest extends Request
{
    public function __construct(protected string $accessToken, protected string $derivativeType, protected string $capId)
    {
        $this->method = Request::METHOD_GET;
    }

    protected function endpoint(): string
    {
        $version = Cap::VERSION;

        return "https://api.cap-hpi.co.uk/v{$version}/{$this->derivativeType}/{$this->capId}/equipment";
    }
}
