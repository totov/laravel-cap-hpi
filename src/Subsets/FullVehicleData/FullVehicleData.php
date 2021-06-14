<?php

namespace Totov\Cap\Subsets\FullVehicleData;

use Totov\Cap\Exceptions\AuthorisationFailedException;
use Totov\Cap\Subsets\FullVehicleData\Requests\ByVin;
use Totov\Cap\Subsets\FullVehicleData\Requests\ByVinAndVrm;
use Totov\Cap\Subsets\FullVehicleData\Requests\ByVrm;
use Totov\Cap\Subsets\Subset;

class FullVehicleData extends Subset
{
    /**
     * @throws AuthorisationFailedException
     */
    public function byVin(string $vin, ?Options $options = null): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByVin($token, $vin, $options))->send();

        return $response->json();
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function byVrm(string $vrm, ?Options $options = null): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByVrm($token, $vrm, $options))->send();

        return $response->json();
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function byVinAndVrm(string $vin, string $vrm, ?Options $options = null): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByVinAndVrm($token, $vin, $vrm, $options))->send();

        return $response->json();
    }
}