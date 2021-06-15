<?php

namespace Totov\Cap\Subsets\FutureValuations\Requests;

use Totov\Cap\Cap;
use Totov\Cap\Requests\Request;
use Totov\Cap\Subsets\FutureValuations\FutureValuationOptions;

class ByDerivativeTypeAndCapIdRequest extends Request
{
    public function __construct(protected string $accessToken, protected string $derivativeType, protected string $capId, protected FutureValuationOptions $options)
    {
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

        return "https://api.cap-hpi.co.uk/v{$version}/{$this->derivativeType}/{$this->capId}/future-valuations";
    }
}
