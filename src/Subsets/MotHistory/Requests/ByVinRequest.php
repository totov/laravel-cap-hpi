<?php

namespace Totov\Cap\Subsets\MotHistory\Requests;

use Totov\Cap\Cap;
use Totov\Cap\Requests\Request;

class ByVinRequest extends Request
{
    public function __construct(protected string $accessToken, protected string $vin, protected bool $latest)
    {
        $this->method = Request::METHOD_GET;
    }

    protected function endpoint(): string
    {
        $version = Cap::VERSION;

        return "https://api.cap-hpi.co.uk/v{$version}/vins/{$this->vin}/mots" . (($this->latest) ? '/latest' : '');
    }
}
