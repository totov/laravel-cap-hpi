<?php

namespace Totov\Cap\Subsets\FutureValuations;

class FutureValuationOptions
{
    public function __construct(public array $valuationTypes = [], public array $valuationPoints = [])
    {
    }
}
