<?php

namespace Totov\Cap\Requests;

class AuthoriseRequest extends Request
{
    public function __construct(protected ?string $clientId, protected ?string $secret)
    {
    }

    protected function endpoint(): string
    {
        return 'https://identity.cap-hpi.com/connect/token';
    }

    protected function body(): string
    {
        $params = [
            'client_id' => $this->clientId,
            'client_secret' => $this->secret,
            'grant_type' => 'client_credentials',
            'scope' => 'CapHpi.UK.PublicApi',
        ];

        return http_build_query($params);
    }
}
