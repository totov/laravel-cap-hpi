<?php

namespace Totov\Cap\Requests;

class ProductsRequest extends Request
{
    public function __construct(protected string $accessToken)
    {
        $this->accessToken = $accessToken;
        $this->method = Request::METHOD_GET;
    }

    protected function endpoint(): string
    {
        return 'https://api.cap-hpi.co.uk/products';
    }
}
