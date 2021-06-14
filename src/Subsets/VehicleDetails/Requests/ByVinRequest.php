<?php

namespace Totov\Cap\Subsets\VehicleDetails\Requests;

use Totov\Cap\Cap;
use Totov\Cap\Requests\Request;

class ByVinRequest extends Request
{
    public function __construct(protected string $accessToken, protected string $vin)
    {
        $this->method = Request::METHOD_GET;
    }

    protected function endpoint(): string
    {
        $version = Cap::VERSION;

        return "https://api.cap-hpi.co.uk/v{$version}/vins/{$this->vin}";
    }
}
