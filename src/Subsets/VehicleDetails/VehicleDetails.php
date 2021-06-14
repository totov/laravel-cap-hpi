<?php

namespace Totov\Cap\Subsets\VehicleDetails;

use Totov\Cap\Exceptions\AuthorisationFailedException;
use Totov\Cap\Subsets\Subset;
use Totov\Cap\Subsets\VehicleDetails\Requests\ByVinAndVrmRequest;
use Totov\Cap\Subsets\VehicleDetails\Requests\ByVinRequest;
use Totov\Cap\Subsets\VehicleDetails\Requests\ByVrmRequest;

class VehicleDetails extends Subset
{
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
