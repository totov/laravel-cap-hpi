<?php

namespace Totov\Cap\Subsets\DerivativeHierarchy\Models;

use Totov\Cap\Exceptions\AuthorisationFailedException;
use Totov\Cap\Subsets\DerivativeHierarchy\Models\Requests\ByDerivativeTypeAndBrandIdRequest;
use Totov\Cap\Subsets\DerivativeHierarchy\Models\Requests\ByDerivativeTypeAndModelIdRequest;
use Totov\Cap\Subsets\DerivativeHierarchy\Models\Requests\ByDerivativeTypeAndRangeIdRequest;
use Totov\Cap\Subsets\Subset;

class Models extends Subset
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
