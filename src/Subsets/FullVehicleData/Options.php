<?php

namespace Totov\Cap\Subsets\FullVehicleData;

use Totov\Cap\Subsets\CurrentValuations\CurrentValuationOptions;
use Totov\Cap\Subsets\FutureValuations\FutureValuationOptions;

class Options
{
    public bool $currentValuations = true;
    public bool $futureValuations = true;
    public bool $derivativeDetails = true;
    public bool $checkFlags = true;
    public bool $vehicleDetails = true;
    public $dvla = true;
    public $smmt = true;
    public $keepers = true;
    public $plateTransfer = true;
    public $securityWatch = true;
    public $stolen = true;
    public $financeAgreements = true;
    public $insuranceWriteOffStolen = true;
    public $insuranceWriteOffDamaged = true;
    public $insuranceRoadworthyInspected = true;

    public function __construct(public ?CurrentValuationOptions $currentValuationRequest, public ?FutureValuationOptions $futureValuationRequest)
    {
    }
}
