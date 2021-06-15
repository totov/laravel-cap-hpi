<?php

namespace Totov\Cap\Subsets\MotHistory\Requests;

use Totov\Cap\Cap;
use Totov\Cap\Requests\Request;

class ByVinAndVrmRequest extends Request
{
    public function __construct(protected string $accessToken, protected string $vin, protected string $vrm, protected bool $latest)
    {
        $this->method = Request::METHOD_GET;
    }

    protected function endpoint(): string
    {
        $version = Cap::VERSION;

        return "https://api.cap-hpi.co.uk/v{$version}/vins/{$this->vin}/vrms/{$this->vrm}/mots" . (($this->latest) ? '/latest' : '');
    }
}
