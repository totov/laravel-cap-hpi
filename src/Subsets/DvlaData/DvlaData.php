<?php

namespace Totov\Cap\Subsets\DvlaData;

use Totov\Cap\Exceptions\AuthorisationFailedException;
use Totov\Cap\Subsets\Subset;
use Totov\Cap\Subsets\DvlaData\Requests\ByVinAndVrmRequest;
use Totov\Cap\Subsets\DvlaData\Requests\ByVinRequest;
use Totov\Cap\Subsets\DvlaData\Requests\ByVrmRequest;

class DvlaData extends Subset
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
