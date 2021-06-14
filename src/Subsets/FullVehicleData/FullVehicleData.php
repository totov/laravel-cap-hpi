<?php

namespace Totov\Cap\Subsets\FullVehicleData;

use Totov\Cap\Exceptions\AuthorisationFailedException;
use Totov\Cap\Subsets\FullVehicleData\Requests\ByVinRequest;
use Totov\Cap\Subsets\FullVehicleData\Requests\ByVinAndVrmRequest;
use Totov\Cap\Subsets\FullVehicleData\Requests\ByVrmRequest;
use Totov\Cap\Subsets\Subset;

class FullVehicleData extends Subset
{
    /**
     * @throws AuthorisationFailedException
     */
    public function byVin(string $vin, ?Options $options = null): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByVinRequest($token, $vin, $options))->send();

        return $response->json();
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function byVrm(string $vrm, ?Options $options = null): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByVrmRequest($token, $vrm, $options))->send();

        return $response->json();
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function byVinAndVrm(string $vin, string $vrm, ?Options $options = null): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByVinAndVrmRequest($token, $vin, $vrm, $options))->send();

        return $response->json();
    }
}
