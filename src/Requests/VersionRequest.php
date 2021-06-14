<?php

namespace Totov\Cap\Requests;

class VersionRequest extends Request
{
    public function __construct(protected string $accessToken)
    {
        $this->method = Request::METHOD_GET;
    }

    protected function endpoint(): string
    {
        return 'https://api.cap-hpi.co.uk/version';
    }
}
