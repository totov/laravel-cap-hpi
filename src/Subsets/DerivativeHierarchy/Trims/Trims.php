<?php

namespace Totov\Cap\Subsets\DerivativeHierarchy\Trims;

use Totov\Cap\Exceptions\AuthorisationFailedException;
use Totov\Cap\Subsets\DerivativeHierarchy\Trims\Requests\ByDerivativeTypeAndModelIdRequest;
use Totov\Cap\Subsets\Subset;

class Trims extends Subset
{
    /**
     * @throws AuthorisationFailedException
     */
    public function byDerivativeTypeAndModelId(string $derivativeType, int $modelId): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByDerivativeTypeAndModelIdRequest($token, $derivativeType, $modelId))->send();

        return $response->json();
    }
}
