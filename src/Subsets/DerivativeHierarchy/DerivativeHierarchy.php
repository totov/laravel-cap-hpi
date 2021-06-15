<?php

namespace Totov\Cap\Subsets\DerivativeHierarchy;

use Totov\Cap\Cap;
use Totov\Cap\Subsets\DerivativeHierarchy\Brands\Brands;
use Totov\Cap\Subsets\DerivativeHierarchy\Derivatives\Derivatives;
use Totov\Cap\Subsets\DerivativeHierarchy\Models\Models;
use Totov\Cap\Subsets\DerivativeHierarchy\Ranges\Ranges;
use Totov\Cap\Subsets\DerivativeHierarchy\Trims\Trims;
use Totov\Cap\Subsets\Subset;

class DerivativeHierarchy extends Subset
{
    public Brands $brands;
    public Models $models;
    public Ranges $ranges;
    public Derivatives $derivatives;
    public Trims $trims;

    public function __construct(Cap $cap)
    {
        parent::__construct($cap);

        $this->brands = new Brands($cap);
        $this->models = new Models($cap);
        $this->ranges = new Ranges($cap);
        $this->derivatives = new Derivatives($cap);
        $this->trims = new Trims($cap);
    }
}
