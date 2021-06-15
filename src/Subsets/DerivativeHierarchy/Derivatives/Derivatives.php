<?php

namespace Totov\Cap\Subsets\DerivativeHierarchy\Derivatives;

use Totov\Cap\Exceptions\AuthorisationFailedException;
use Totov\Cap\Subsets\DerivativeHierarchy\Derivatives\Requests\ByDerivativeTypeAndModelId;
use Totov\Cap\Subsets\DerivativeHierarchy\Derivatives\Requests\ByDerivativeTypeAndTrimId;
use Totov\Cap\Subsets\Subset;

class Derivatives extends Subset
{
    /**
     * @throws AuthorisationFailedException
     */
    public function byDerivativeTypeAndModelId(string $derivativeType, int $modelId): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByDerivativeTypeAndModelId($token, $derivativeType, $modelId))->send();

        return $response->json();
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function byDerivativeTypeAndTrimId(string $derivativeType, int $trimId): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByDerivativeTypeAndTrimId($token, $derivativeType, $trimId))->send();

        return $response->json();
    }
}
