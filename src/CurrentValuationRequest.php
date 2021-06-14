<?php

namespace Totov\Cap;

class CurrentValuationRequest
{
    public function __construct(public array $valuationTypes = [], public array $valuationPoints = [])
    {
    }
}
