<?php

namespace Totov\Cap\FullVehicleData;

use Totov\Cap\CurrentValuationRequest;
use Totov\Cap\FutureValuationRequest;

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

    public function __construct(public ?CurrentValuationRequest $currentValuationRequest, public ?FutureValuationRequest $futureValuationRequest)
    {
    }
}
