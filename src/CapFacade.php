<?php

namespace Totov\Cap;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Totov\Cap\Cap
 */
class CapFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-cap-hpi';
    }
}
