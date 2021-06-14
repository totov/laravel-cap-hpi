<?php

namespace Totov\Cap\Requests;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

abstract class Request
{
    protected const METHOD_POST = 'post';
    protected const METHOD_GET = 'get';

    protected string $method = Request::METHOD_POST;
    protected string $accessToken = '';

    abstract protected function endpoint(): string;

    protected function body(): string
    {
        return '';
    }

    public function send(): Response
    {
        $request = Http::withBody($this->body(), 'application/x-www-form-urlencoded');

        if ($this->accessToken) {
            $request->withToken($this->accessToken);
        }

        return $request->{$this->method}($this->endpoint());
    }
}
