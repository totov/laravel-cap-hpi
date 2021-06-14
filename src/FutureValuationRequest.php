<?php

namespace Totov\Cap;

class FutureValuationRequest
{
    public function __construct(public array $valuationTypes = [], public array $valuationPoints = [])
    {
    }
}
