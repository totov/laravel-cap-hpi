<?php

namespace Totov\Cap\Subsets\DerivativeDetails;

use Totov\Cap\Exceptions\AuthorisationFailedException;
use Totov\Cap\Subsets\DerivativeDetails\Requests\ByDerivativeTypeAndCapIdRequest;
use Totov\Cap\Subsets\DerivativeDetails\Requests\ByVinAndVrmRequest;
use Totov\Cap\Subsets\DerivativeDetails\Requests\ByVinRequest;
use Totov\Cap\Subsets\DerivativeDetails\Requests\ByVrmRequest;
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

    /**
     * @throws AuthorisationFailedException
     */
    public function byDerivativeTypeAndCapId(string $derivativeType, string $capId): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByDerivativeTypeAndCapIdRequest($token, $derivativeType, $capId))->send();

        return $response->json();
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function byVin(string $vin): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByVinRequest($token, $vin))->send();

        return $response->json();
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function byVrm(string $vrm): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByVrmRequest($token, $vrm))->send();

        return $response->json();
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function byVinAndVrm(string $vin, string $vrm): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByVinAndVrmRequest($token, $vin, $vrm))->send();

        return $response->json();
    }
}
