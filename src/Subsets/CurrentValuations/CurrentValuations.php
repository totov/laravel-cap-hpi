<?php

namespace Totov\Cap\Subsets\CurrentValuations;

use Totov\Cap\Exceptions\AuthorisationFailedException;
use Totov\Cap\Subsets\CurrentValuations\Requests\ByDerivativeTypeAndCapIdRequest;
use Totov\Cap\Subsets\CurrentValuations\Requests\ByVinRequest;
use Totov\Cap\Subsets\CurrentValuations\Requests\ByVinAndVrmRequest;
use Totov\Cap\Subsets\CurrentValuations\Requests\ByVrmRequest;
use Totov\Cap\Subsets\CurrentValuations\Requests\SupportedDerivativeTypesRequest;
use Totov\Cap\Subsets\CurrentValuations\Requests\SupportedValuationTypesRequest;
use Totov\Cap\Subsets\Subset;

class CurrentValuations extends Subset
{
    /**
     * @throws AuthorisationFailedException
     */
    public function byDerivativeTypeAndCapId(string $derivativeType, string $capId, CurrentValuationOptions $options): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByDerivativeTypeAndCapIdRequest($token, $derivativeType, $capId, $options))->send();

        return $response->json();
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function byVin(string $vin, CurrentValuationOptions $options): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByVinRequest($token, $vin, $options))->send();

        return $response->json();
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function byVrm(string $vrm, CurrentValuationOptions $options): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByVrmRequest($token, $vrm, $options))->send();

        return $response->json();
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function byVinAndVrm(string $vin, string $vrm, CurrentValuationOptions $options): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByVinAndVrmRequest($token, $vin, $vrm, $options))->send();

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

    /**
     * @throws AuthorisationFailedException
     */
    public function supportedValuationTypes(): array
    {
        $token = $this->cap->getValidToken();
        $response = (new SupportedValuationTypesRequest($token))->send();

        return $response->json();
    }
}
