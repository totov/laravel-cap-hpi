# A Laravel implementation of the Cap HPI UK API - https://api.cap-hpi.co.uk/docs/index.html

[![Latest Version on Packagist](https://img.shields.io/packagist/v/totov/laravel-cap-hpi.svg?style=flat-square)](https://packagist.org/packages/totov/laravel-cap-hpi)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/totov/laravel-cap-hpi/run-tests?label=tests)](https://github.com/totov/laravel-cap-hpi/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/totov/laravel-cap-hpi/Check%20&%20fix%20styling?label=code%20style)](https://github.com/totov/laravel-cap-hpi/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/totov/laravel-cap-hpi.svg?style=flat-square)](https://packagist.org/packages/totov/laravel-cap-hpi)

---

## Requirements

- PHP ^8.0
- PHP ext-json
- Composer ^2.0

## Installation

You can install the package via composer:

```bash
composer require totov/laravel-cap-hpi
```

You can publish the config file with:

```bash
php artisan vendor:publish --provider="Totov\Cap\CapServiceProvider" --tag="laravel-cap-hpi-config"
```

This is the contents of the published config file:

```php
return [
    'client_id' => env('CAP_CLIENT_ID', 'null'),
    'secret' => env('CAP_SECRET', 'null'),
];
```

## Usage

```php
use Totov\Cap\Cap;
use Totov\Cap\Subsets\CurrentValuations\CurrentValuationOptions;
use Totov\Cap\Subsets\FutureValuations\FutureValuationOptions;
use Totov\Cap\Subsets\FullVehicleData\Options;

// Initialise cap with client ID and secret
$clientId = config('cap.client_id');
$secret = config('cap.secret');
$cap = new Cap($clientId, $secret);

// Or grab from the container which automatically grabs the config and creates a singleton
$cap = app(Cap::class);

// Get current API version and status
$version = $cap->version();
$status = Cap::status();

// Get full vehicle data by VRM
$currentPoints = new CurrentValuationOptions(['TradeClean'], [['mileage' => 20000]]);
$futurePoints = new FutureValuationOptions(['TradeClean'], [['mileage' => 25000, 'valuationDate' => '2021-09-19']]);
$options = new Options($currentPoints, $futurePoints);

$cap->fullVehicleData->byVrm('AB12CDE', $options);

// Look up current valuation by VRM
$options = new CurrentValuationOptions(['TradeClean'], [['mileage' => 20000]]);
$cap->currentValuations->byVrm('AB12CDE', $options);

// Look up equipment by VRM
$cap->equipment->byVrm('AB12CDE');

// Look up derivative details by VRM
$cap->derivativeDetails->byVrm('AB12CDE');

// Get vehicle details by VRM
$cap->vehicleDetails->byVrm('AB12CDE');

// Get vehicle SMMT data by VRM
$cap->smmtData->byVrm('AB12CDE');

// Get previous keepers of vehicle by VRM
$cap->vehicleKeepers->byVrm('AB12CDE');

// Look up DVLA data for vehicle by VRM
$cap->dvlaData->byVrm('AB12CDE');

// Perform flag check lookup by VRM
$cap->checkFlags->byVrm('AB12CDE');

// Get future valuation for vehicle by VRM
$options = new FutureValuationOptions(['TradeClean'], [['mileage' => 25000, 'valuationDate' => '2021-09-19']]);
$cap->futureValuations->byVrm('AB12CDE', $options);

// Get derivative image for vehicle by VRM
$response = $cap->derivativeImages->byVrm('AB12CDE');
if ($response->ok()) {
    $imageContent = $response->body();
    // ...
}

// Get latest MOT details for vehicle by VRM
$cap->motHistory->byVrm('AB12CDE', true);

// Or all MOT history for vehicle by VRM
$cap->motHistory->byVrm('AB12CDE');

// Get brands info
$cap->derivativeHierarchy->brands->byDerivativeType('cars');
$cap->derivativeHierarchy->brands->byDerivativeTypeAndBrandId('cars', 25545);

// Get ranges info
$cap->derivativeHierarchy->ranges->byDerivativeTypeAndBrandId('cars', 25545);
$cap->derivativeHierarchy->ranges->byDerivativeTypeAndRangeId('cars', 89);

// Get model info
$cap->derivativeHierarchy->models->byDerivativeTypeAndBrandId('cars', 25545);
$cap->derivativeHierarchy->models->byDerivativeTypeAndRangeId('cars', 89);
$cap->derivativeHierarchy->models->byDerivativeTypeAndModelId('cars', 25547);

// Get trim info
$cap->derivativeHierarchy->trims->byDerivativeTypeAndModelId('cars', 25547);

// Get derivatives
$cap->derivativeHierarchy->derivatives->byDerivativeTypeAndModelId('cars', 25547);
$cap->derivativeHierarchy->derivatives->byDerivativeTypeAndTrimId('cars', 10619);

// Get technical spec categories
$cap->technicalSpecification->categories->byDerivativeType('cars');
$cap->technicalSpecification->categories->byDerivativeTypeAndCategoryId('cars', 8);

// Get technical specs for vehicle by VRM
$cap->technicalSpecification->byVrm('AB12CDE');

// Get technical specs for vehicle by VRM with filter on returned items (category IDs and item IDs)
$cap->technicalSpecification->byVrm('AB12CDE', [6, 7], [33, 34, 24]);
```

Examples above use VRM, but lookups can be performed using the VIN (or a combination of VIN & VRM) as per the documentation, just use `->byVin()` or `->byVinAndVRM()` instead.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Roadmap

- More in-depth testing per endpoint
- Use DataTransferObjects instead of returning JSON
- Automatically inject token into relevant requests

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Stephen Hamilton](https://github.com/totov)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
