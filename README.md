# A Laravel package that integrates the ADManager Plus REST API as an SDK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/springfieldclinic/laravel-admanager-plus-sdk.svg?style=flat-square)](https://packagist.org/packages/springfieldclinic/laravel-admanager-plus-sdk)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/springfieldclinic/laravel-admanager-plus-sdk/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/springfieldclinic/laravel-admanager-plus-sdk/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/springfieldclinic/laravel-admanager-plus-sdk/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/springfieldclinic/laravel-admanager-plus-sdk/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/springfieldclinic/laravel-admanager-plus-sdk.svg?style=flat-square)](https://packagist.org/packages/springfieldclinic/laravel-admanager-plus-sdk)

Use this package to integrate ADManager Plus REST API into your Laravel application.

## Installation

You can install the package via composer:

```bash
composer require springfieldclinic/laravel-admanager-plus-sdk
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-admanager-plus-sdk-config"
```

This is the contents of the published config file:

```php
return [
    /*
    |--------------------------------------------------------------------------
    | Base API URL
    |--------------------------------------------------------------------------
    | The full base URL to your ADManager Plus REST API (e.g.
    | http://hostname:8080/RestAPI). Leave null to set via ENV.
    */
    'BASE_API_URL' => env('ADMANAGER_BASE_API_URL', null),

    /*
    |--------------------------------------------------------------------------
    | Active Directory Domain Name
    |--------------------------------------------------------------------------
    | The domain that ADManager Plus will target by default.
    */
    'domainName' => env('ADMANAGER_DOMAIN_NAME', null),

    /*
    |--------------------------------------------------------------------------
    | Authorization Token
    |--------------------------------------------------------------------------
    | A valid AuthToken generated in ADManager Plus (Delegation → Technician Authtokens).
    */
    'AuthToken' => env('ADMANAGER_AUTH_TOKEN', null),

    /*|--------------------------------------------------------------------------
    | Product Name
    |--------------------------------------------------------------------------
    | The product name to use in the API requests. Defaults to 'RESTAPI'.
    | This can be useful for identifying the source of API requests in audit/logs.
    */
    'PRODUCT_NAME' => env('ADMANAGER_PRODUCT_NAME', 'RESTAPI'),
];
```

Set the following in `.env`:

```
ADMANAGER_PLUS_BASE_API_URL=http://your-admanager-plus-host
ADMANAGER_PLUS_DOMAIN_NAME=your.domain.com
ADMANAGER_PLUS_AUTH_TOKEN=your_auth_token
ADMANAGER_PLUS_PRODUCT_NAME=name_of_your_application_for_audit_purposes
```

## Usage

```php
use LaravelADManagerPlusSDK\Http\Clients\ADManagerPlusConnector;

$connector = new ADManagerPlusConnector();
$users = $connector->users()->search(searchText: 'john');

dump($users);
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Christopher Graham](https://github.com/97906213+sc-chgraham)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
