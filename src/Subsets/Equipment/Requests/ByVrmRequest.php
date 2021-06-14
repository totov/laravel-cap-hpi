<?php

namespace Totov\Cap\Subsets\Equipment\Requests;

use Totov\Cap\Cap;
use Totov\Cap\Requests\Request;

class ByVrmRequest extends Request
{
    public function __construct(protected string $accessToken, protected string $vrm)
    {
        $this->method = Request::METHOD_GET;
    }

    protected function endpoint(): string
    {
        $version = Cap::VERSION;

        return "https://api.cap-hpi.co.uk/v{$version}/vrms/{$this->vrm}/derivative/equipment";
    }
}
