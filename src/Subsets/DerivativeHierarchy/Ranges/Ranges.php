<?php

namespace Totov\Cap\Subsets\DerivativeHierarchy\Ranges;

use Totov\Cap\Exceptions\AuthorisationFailedException;
use Totov\Cap\Subsets\DerivativeHierarchy\Ranges\Requests\ByDerivativeTypeAndBrandId;
use Totov\Cap\Subsets\DerivativeHierarchy\Ranges\Requests\ByDerivativeTypeAndRangeId;
use Totov\Cap\Subsets\Subset;

class Ranges extends Subset
{
    /**
     * @throws AuthorisationFailedException
     */
    public function byDerivativeTypeAndBrandId(string $derivativeType, int $brandId): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByDerivativeTypeAndBrandId($token, $derivativeType, $brandId))->send();

        return $response->json();
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function byDerivativeTypeAndRangeId(string $derivativeType, int $rangeId): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByDerivativeTypeAndRangeId($token, $derivativeType, $rangeId))->send();

        return $response->json();
    }
}
