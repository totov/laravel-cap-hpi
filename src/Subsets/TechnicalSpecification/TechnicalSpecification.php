<?php

namespace Totov\Cap\Subsets\TechnicalSpecification;

use Totov\Cap\Cap;
use Totov\Cap\Exceptions\AuthorisationFailedException;
use Totov\Cap\Subsets\Subset;
use Totov\Cap\Subsets\TechnicalSpecification\Categories\Categories;
use Totov\Cap\Subsets\TechnicalSpecification\Requests\ByDerivativeTypeAndCapIdRequest;
use Totov\Cap\Subsets\TechnicalSpecification\Requests\ByVinAndVrmRequest;
use Totov\Cap\Subsets\TechnicalSpecification\Requests\ByVinRequest;
use Totov\Cap\Subsets\TechnicalSpecification\Requests\ByVrmRequest;
use Totov\Cap\Subsets\TechnicalSpecification\Requests\SupportedDerivativeTypesRequest;

class TechnicalSpecification extends Subset
{
    public Categories $categories;

    public function __construct(Cap $cap)
    {
        parent::__construct($cap);

        $this->categories = new Categories($cap);
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function byDerivativeTypeAndCapId(string $derivativeType, string $capId, ?array $filteredCategoryIds = null, ?array $filteredItemIds = null): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByDerivativeTypeAndCapIdRequest($token, $derivativeType, $capId, $filteredCategoryIds, $filteredItemIds))->send();

        return $response->json();
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function byVin(string $vin, ?array $filteredCategoryIds = null, ?array $filteredItemIds = null): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByVinRequest($token, $vin, $filteredCategoryIds, $filteredItemIds))->send();

        return $response->json();
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function byVrm(string $vrm, ?array $filteredCategoryIds = null, ?array $filteredItemIds = null): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByVrmRequest($token, $vrm, $filteredCategoryIds, $filteredItemIds))->send();

        return $response->json();
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function byVinAndVrm(string $vin, string $vrm, ?array $filteredCategoryIds = null, ?array $filteredItemIds = null): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByVinAndVrmRequest($token, $vin, $vrm, $filteredCategoryIds, $filteredItemIds))->send();

        return $response->json();
    }

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
