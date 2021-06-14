<?php

namespace Totov\Cap\Subsets\CurrentValuations;

class CurrentValuationOptions
{
    public function __construct(public array $valuationTypes = [], public array $valuationPoints = [])
    {
    }
}
