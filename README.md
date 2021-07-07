# This is my package LaravelGhtk

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vanthao03596/laravel-ghtk.svg?style=flat-square)](https://packagist.org/packages/vanthao03596/laravel-ghtk)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/vanthao03596/laravel-ghtk/run-tests?label=tests)](https://github.com/vanthao03596/laravel-ghtk/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/vanthao03596/laravel-ghtk/Check%20&%20fix%20styling?label=code%20style)](https://github.com/vanthao03596/laravel-ghtk/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/vanthao03596/laravel-ghtk.svg?style=flat-square)](https://packagist.org/packages/vanthao03596/laravel-ghtk)

You can install the package via composer:

```bash
composer require vanthao03596/laravel-ghtk
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Vanthao03596\LaravelGhtk\LaravelGhtkServiceProvider" --tag="laravel-ghtk-migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Vanthao03596\LaravelGhtk\LaravelGhtkServiceProvider" --tag="laravel-ghtk-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$laravel-ghtk = new Vanthao03596\LaravelGhtk();
echo $laravel-ghtk->echoPhrase('Hello, Spatie!');
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

- [phamthao](https://github.com/vanthao03596)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
