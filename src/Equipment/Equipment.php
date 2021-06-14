<?php

namespace Totov\Cap\Equipment;

use Totov\Cap\Equipment\Requests\SupportedDerivativeTypesRequest;
use Totov\Cap\Exceptions\AuthorisationFailedException;
use Totov\Cap\Subset;

class Equipment extends Subset
{
    /**
     * @throws AuthorisationFailedException
     */
    public function supportedDerivativeTypes(): array
    {
        $token = $this->cap->getValidToken();
        $response = (new SupportedDerivativeTypesRequest($token))->send();

        return $response->json();
    }
}
