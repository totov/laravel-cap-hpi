<?php

namespace Totov\Cap\Subsets\DerivativeHierarchy\Ranges;

use Totov\Cap\Exceptions\AuthorisationFailedException;
use Totov\Cap\Subsets\DerivativeHierarchy\Ranges\Requests\ByDerivativeTypeAndBrandIdRequest;
use Totov\Cap\Subsets\DerivativeHierarchy\Ranges\Requests\ByDerivativeTypeAndRangeIdRequest;
use Totov\Cap\Subsets\Subset;

class Ranges extends Subset
{
    /**
     * @throws AuthorisationFailedException
     */
    public function byDerivativeTypeAndBrandId(string $derivativeType, int $brandId): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByDerivativeTypeAndBrandIdRequest($token, $derivativeType, $brandId))->send();

        return $response->json();
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function byDerivativeTypeAndRangeId(string $derivativeType, int $rangeId): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByDerivativeTypeAndRangeIdRequest($token, $derivativeType, $rangeId))->send();

        return $response->json();
    }
}
