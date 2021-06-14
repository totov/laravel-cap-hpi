<?php

namespace Totov\Cap;

class FutureValuationOptions
{
    public function __construct(public array $valuationTypes = [], public array $valuationPoints = [])
    {
    }
}
