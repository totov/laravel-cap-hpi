<?php

namespace Totov\Cap\Subsets\MotHistory;

use Totov\Cap\Exceptions\AuthorisationFailedException;
use Totov\Cap\Subsets\MotHistory\Requests\ByVinAndVrmRequest;
use Totov\Cap\Subsets\MotHistory\Requests\ByVinRequest;
use Totov\Cap\Subsets\MotHistory\Requests\ByVrmRequest;
use Totov\Cap\Subsets\Subset;

class MotHistory extends Subset
{
    /**
     * @throws AuthorisationFailedException
     */
    public function byVin(string $vin, bool $latest = false): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByVinRequest($token, $vin, $latest))->send();

        return $response->json();
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function byVrm(string $vrm, bool $latest = false): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByVrmRequest($token, $vrm, $latest))->send();

        return $response->json();
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function byVinAndVrm(string $vin, string $vrm, bool $latest = false): array
    {
        $token = $this->cap->getValidToken();
        $response = (new ByVinAndVrmRequest($token, $vin, $vrm, $latest))->send();

        return $response->json();
    }
}
