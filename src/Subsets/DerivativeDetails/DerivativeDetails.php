<?php

namespace Totov\Cap\Subsets\DerivativeDetails;

use Totov\Cap\Exceptions\AuthorisationFailedException;
use Totov\Cap\Subsets\DerivativeDetails\Requests\SupportedDerivativeTypesRequest;
use Totov\Cap\Subsets\Subset;

class DerivativeDetails extends Subset
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
