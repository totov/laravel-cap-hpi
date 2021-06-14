<?php

namespace Totov\Cap\FullVehicleData\Requests;

use Totov\Cap\Cap;
use Totov\Cap\CurrentValuationRequest;
use Totov\Cap\FullVehicleData\Options;
use Totov\Cap\FutureValuationRequest;
use Totov\Cap\Requests\Request;

class ByVin extends Request
{
    public function __construct(protected string $accessToken, protected string $vin, protected ?Options $options)
    {
        if (! $this->options) {
            $this->options = new Options(
                new CurrentValuationRequest(),
                new FutureValuationRequest()
            );
        }
    }

    protected function contentType(): string
    {
        return 'application/json';
    }

    protected function body(): string
    {
        return json_encode($this->options, JSON_THROW_ON_ERROR);
    }

    protected function endpoint(): string
    {
        $version = Cap::VERSION;

        return "https://api.cap-hpi.co.uk/v{$version}/vins/{$this->vin}/data";
    }
}
