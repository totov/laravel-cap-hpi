<?php

namespace Totov\Cap\Subsets\DerivativeImages;

use Illuminate\Http\Client\Response;
use Totov\Cap\Exceptions\AuthorisationFailedException;
use Totov\Cap\Subsets\DerivativeImages\Requests\ByDerivativeTypeAndCapIdRequest;
use Totov\Cap\Subsets\DerivativeImages\Requests\ByVinAndVrmRequest;
use Totov\Cap\Subsets\DerivativeImages\Requests\ByVinRequest;
use Totov\Cap\Subsets\DerivativeImages\Requests\ByVrmRequest;
use Totov\Cap\Subsets\DerivativeImages\Requests\SupportedDerivativeTypesRequest;
use Totov\Cap\Subsets\Subset;

class DerivativeImages extends Subset
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
    public function byDerivativeTypeAndCapId(string $derivativeType, string $capId): Response
    {
        $token = $this->cap->getValidToken();

        return (new ByDerivativeTypeAndCapIdRequest($token, $derivativeType, $capId))->send();
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function byVin(string $vin): Response
    {
        $token = $this->cap->getValidToken();

        return (new ByVinRequest($token, $vin))->send();
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function byVrm(string $vrm): Response
    {
        $token = $this->cap->getValidToken();

        return (new ByVrmRequest($token, $vrm))->send();
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function byVinAndVrm(string $vin, string $vrm): Response
    {
        $token = $this->cap->getValidToken();

        return (new ByVinAndVrmRequest($token, $vin, $vrm))->send();
    }
}
