# A Laravel implementation of the Cap HPI UK API - https://api.cap-hpi.co.uk/docs/index.html

[![Latest Version on Packagist](https://img.shields.io/packagist/v/totov/laravel-cap-hpi.svg?style=flat-square)](https://packagist.org/packages/totov/laravel-cap-hpi)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/totov/laravel-cap-hpi/run-tests?label=tests)](https://github.com/totov/laravel-cap-hpi/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/totov/laravel-cap-hpi/Check%20&%20fix%20styling?label=code%20style)](https://github.com/totov/laravel-cap-hpi/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/totov/laravel-cap-hpi.svg?style=flat-square)](https://packagist.org/packages/totov/laravel-cap-hpi)

---

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

```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Stephen Hamilton](https://github.com/totov)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
