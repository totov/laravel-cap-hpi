<?php

namespace Totov\Cap\Subsets\TechnicalSpecification\Categories;

use Totov\Cap\Exceptions\AuthorisationFailedException;
use Totov\Cap\Subsets\Subset;
use Totov\Cap\Subsets\TechnicalSpecification\Categories\Requests\ByDerivativeTypeAndCategoryIdRequest;
use Totov\Cap\Subsets\TechnicalSpecification\Categories\Requests\ByDerivativeTypeRequest;

class Categories extends Subset
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
    public function byDerivativeTypeAndCategoryId(string $derivativeType, int $categoryId): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByDerivativeTypeAndCategoryIdRequest($token, $derivativeType, $categoryId))->send();

        return $response->json();
    }
}
