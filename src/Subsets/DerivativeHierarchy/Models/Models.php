<?php

namespace Totov\Cap\Subsets\DerivativeHierarchy\Models;

use Totov\Cap\Exceptions\AuthorisationFailedException;
use Totov\Cap\Subsets\DerivativeHierarchy\Models\Requests\ByDerivativeTypeAndBrandId;
use Totov\Cap\Subsets\DerivativeHierarchy\Models\Requests\ByDerivativeTypeAndModelId;
use Totov\Cap\Subsets\DerivativeHierarchy\Models\Requests\ByDerivativeTypeAndRangeId;
use Totov\Cap\Subsets\Subset;

class Models extends Subset
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

    /**
     * @throws AuthorisationFailedException
     */
    public function byDerivativeTypeAndModelId(string $derivativeType, int $modelId): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByDerivativeTypeAndModelId($token, $derivativeType, $modelId))->send();

        return $response->json();
    }
}
