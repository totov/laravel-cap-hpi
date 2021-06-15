<?php

namespace Totov\Cap;

use Carbon\Carbon;
use Totov\Cap\Exceptions\AuthorisationFailedException;
use Totov\Cap\Requests\AuthoriseRequest;
use Totov\Cap\Requests\ErrorsRequest;
use Totov\Cap\Requests\ProductsRequest;
use Totov\Cap\Requests\StatusRequest;
use Totov\Cap\Requests\VersionRequest;
use Totov\Cap\Subsets\CurrentValuations\CurrentValuations;
use Totov\Cap\Subsets\DerivativeDetails\DerivativeDetails;
use Totov\Cap\Subsets\DvlaData\DvlaData;
use Totov\Cap\Subsets\Equipment\Equipment;
use Totov\Cap\Subsets\FullVehicleData\FullVehicleData;
use Totov\Cap\Subsets\SmmtData\SmmtData;
use Totov\Cap\Subsets\VehicleDetails\VehicleDetails;
use Totov\Cap\Subsets\VehicleKeepers\VehicleKeepers;

class Cap
{
    protected string $accessToken = '';
    protected Carbon $tokenExpiresAt;

    public const VERSION = '1';

    public Equipment $equipment;
    public FullVehicleData $fullVehicleData;
    public CurrentValuations $currentValuations;
    public DerivativeDetails $derivativeDetails;
    public VehicleDetails $vehicleDetails;
    public SmmtData $smmtData;
    public VehicleKeepers $vehicleKeepers;
    public DvlaData $dvlaData;

    public function __construct(protected ?string $clientId, protected ?string $secret)
    {
        $this->tokenExpiresAt = now();

        $this->equipment = new Equipment($this);
        $this->fullVehicleData = new FullVehicleData($this);
        $this->currentValuations = new CurrentValuations($this);
        $this->derivativeDetails = new DerivativeDetails($this);
        $this->vehicleDetails = new VehicleDetails($this);
        $this->smmtData = new SmmtData($this);
        $this->vehicleKeepers = new VehicleKeepers($this);
        $this->dvlaData = new DvlaData($this);
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function authorise(): void
    {
        $response = (new AuthoriseRequest($this->clientId, $this->secret))->send();

        if ($response->status() !== 200 || ! $accessToken = $response->json('access_token')) {
            throw new AuthorisationFailedException('Invalid authorisation details');
        }

        $this->accessToken = $accessToken;
        $this->tokenExpiresAt = now()->addSeconds($response->json('expires_in'));
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function getValidToken(): string
    {
        if ($this->tokenExpiresAt->isPast()) {
            $this->authorise();
        }

        return $this->accessToken;
    }

    public static function status(bool $heathZ = false): string
    {
        $response = (new StatusRequest($heathZ))->send();

        return $response->json('status');
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function products(): array
    {
        $token = $this->getValidToken();
        $response = (new ProductsRequest($token))->send();

        return $response->json();
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function errors(): array
    {
        $token = $this->getValidToken();
        $response = (new ErrorsRequest($token))->send();

        return $response->json();
    }

    /**
     * @throws AuthorisationFailedException
     */
    public function version(): array
    {
        $token = $this->getValidToken();
        $response = (new VersionRequest($token))->send();

        return $response->json();
    }
}
