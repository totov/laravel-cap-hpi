<?php

namespace Totov\Cap\Subsets\CurrentValuations;

use Totov\Cap\Exceptions\AuthorisationFailedException;
use Totov\Cap\Subsets\CurrentValuations\Requests\ByDerivativeTypeAndCapIdRequest;
use Totov\Cap\Subsets\CurrentValuations\Requests\ByVin;
use Totov\Cap\Subsets\CurrentValuations\Requests\ByVinAndVrm;
use Totov\Cap\Subsets\CurrentValuations\Requests\ByVrm;
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
        $response = (new ByVin($token, $vin, $options))->send();

        return $response->json();
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function byVrm(string $vrm, CurrentValuationOptions $options): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByVrm($token, $vrm, $options))->send();

        return $response->json();
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function byVinAndVrm(string $vin, string $vrm, CurrentValuationOptions $options): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByVinAndVrm($token, $vin, $vrm, $options))->send();

        return $response->json();
    }
}
