<?php

namespace Totov\Cap\Subsets\DerivativeHierarchy\Brands;

use Totov\Cap\Exceptions\AuthorisationFailedException;
use Totov\Cap\Subsets\DerivativeHierarchy\Brands\Requests\ByDerivativeTypeAndBrandIdRequest;
use Totov\Cap\Subsets\DerivativeHierarchy\Brands\Requests\ByDerivativeTypeRequest;
use Totov\Cap\Subsets\Subset;

class Brands extends Subset
{
    /**
     * @throws AuthorisationFailedException
     */
    public function byDerivativeType(string $derivativeType): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByDerivativeTypeRequest($token, $derivativeType))->send();

        return $response->json();
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function byDerivativeTypeAndBrandId(string $derivativeType, int $brandId): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByDerivativeTypeAndBrandIdRequest($token, $derivativeType, $brandId))->send();

        return $response->json();
    }
}
