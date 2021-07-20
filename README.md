# Laravel GHTK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vanthao03596/laravel-ghtk.svg?style=flat-square)](https://packagist.org/packages/vanthao03596/laravel-ghtk)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/vanthao03596/laravel-ghtk/run-tests?label=tests)](https://github.com/vanthao03596/laravel-ghtk/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/vanthao03596/laravel-ghtk/Check%20&%20fix%20styling?label=code%20style)](https://github.com/vanthao03596/laravel-ghtk/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/vanthao03596/laravel-ghtk.svg?style=flat-square)](https://packagist.org/packages/vanthao03596/laravel-ghtk)

To get the latest version, simply require the project using [Composer](https://getcomposer.org). You will need to install any packages that "provide" `psr/http-client-implementation` and `psr/http-factory-implementation`. Most users will want:

For example, to use Guzzle 7:

```bash
$ composer require "vanthao03596/laravel-ghtk" "guzzlehttp/guzzle:^7.2" "http-interop/http-factory-guzzle:^1.1.0"
```

Once installed, if you are not using automatic package discovery, then you need to register the `Vanthao03596\LaravelGhtk\GhtkServiceProvider` service provider in your `config/app.php`.

You can also optionally alias our facade:

```php
        'Ghtk' => Vanthao03596\LaravelGhtk\Facades\Ghtk::class,
```



## Configuration

Laravel GHTK requires connection configuration.

To get started, you'll need to publish all vendor assets:

```bash
$ php artisan vendor:publish
```

This will create a `config/ghtk.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

There are two config options:

##### Default Connection Name

This option (`'default'`) is where you may specify which of the connections below you wish to use as your default connection for all work. Of course, you may use many connections at once using the manager class. The default value for this setting is `'main'`.

##### Ghtk Connections

This option (`'connections'`) is where each of the connections are setup for your application. Example configuration has been included, but you may add as many connections as you would like.


## Usage

##### GhtkManager

This is the class of most interest. It is bound to the ioc container as `'ghtk'` and can be accessed using the `Facades\Ghtk` facade. This class implements the `ManagerInterface` by extending `AbstractManager`. The interface and abstract class are both part of my [Laravel Manager](https://github.com/GrahamCampbell/Laravel-Manager) package, so you may want to go and checkout the docs for how to use the manager class over at [that repo](https://github.com/GrahamCampbell/Laravel-Manager#usage). Note that the connection class returned will always be an instance of `Vanthao03596\GhtkSdk\Client`.

##### Facades\Ghtk

This facade will dynamically pass static method calls to the `'ghtk'` object in the ioc container which by default is the `GhtkManager` class.

##### GhtkServiceProvider

This class contains no public methods of interest. This class should be added to the providers array in `config/app.php`. This class will setup ioc bindings.

##### Real Examples

Here you can see an example of just how simple this package is to use. Out of the box, the default adapter is `main`. After you enter your authentication details in the config file, it will just work:

```php
use Vanthao03596\LaravelGhtk\Facades\Ghtk;
// you can alias this in config/app.php if you like

Ghtk::shipment()
    ->calculateFee([
        'pick_province' => 'Hà Nội',
        'pick_district' => 'Quận Hai Bà Trưng',
        'province' => 'Hà nội',
        'district' => 'Quận Cầu Giấy',
        'address' => 'P.503 tòa nhà Auu Việt, số 1 Lê Đức Thọ',
        'weight' => 1000,
        'value' => 3000000,
        'transport' => 'fly',
        'deliver_option' => 'xteam',
        'tags'  => [1]
    ]);
// we're done here - how easy was that, it just works!

Ghtk::order()->createOrder([
    'products' => [
        [
            'name' => 'bút',
            'weight' => 0.1,
            'quantity' => 1,
            'product_code' => '23304A3MHLMVMXX625'
        ],
        [
            'name' => 'tẩy',
            'weight' => 0.2,
            'quantity' => 1,
            'product_code' => ''
        ]
    ],
    'order' => [
        'id' => 'a9',
        'pick_name' => 'HCM-nội thành',
        'pick_address' => '590 CMT8 P.11',
        'pick_province' => 'TP. Hồ Chí Minh',
        'pick_district' => 'Quận 3',
        'pick_ward' => 'Phường 1',
        'pick_tel' => '0911222333',
        'tel' => '0911222333',
        'name' => 'GHTK - HCM - Noi Thanh',
        'address' => '123 nguyễn chí thanh',
        'province' => 'TP. Hồ Chí Minh',
        'district' => 'Quận 1',
        'ward' => 'Phường Bến Nghé',
        'hamlet' => 'Khác',
        'is_freeship' => 1,
        'pick_date' => '2016-09-30',
        'pick_money' => 47000,
        'note' => 'Khối lượng tính cước tối đa: 1.00 kg',
        'value' => 3000000,
        'transport' => 'fly',
        'pick_option' =>'cod',
        'deliver_option' => 'xteam',
        'pick_session' => '2',
        'tags' => [ 1],
        'email' => 'thao@123.com',
        'use_return_address' => 1
    ]
]);
// this example is simple, and there are far more methods available
```

The ghtk manager will behave like it is a `Vanthao03596\GhtkSdk\Client` class. If you want to call specific connections, you can do with the `connection` method:

```php
use Vanthao03596\LaravelGhtk\Facades\Ghtk;

// select the your_connection_name connection, then get going
Ghtk::connection('your_connection_name')shipment()
    ->calculateFee([
        'pick_province' => 'Hà Nội',
        'pick_district' => 'Quận Hai Bà Trưng',
        'province' => 'Hà nội',
        'district' => 'Quận Cầu Giấy',
        'address' => 'P.503 tòa nhà Auu Việt, số 1 Lê Đức Thọ',
        'weight' => 1000,
        'value' => 3000000,
        'transport' => 'fly',
        'deliver_option' => 'xteam',
        'tags'  => [1]
    ]);
```

With that in mind, note that:

```php
use Vanthao03596\LaravelGhtk\Facades\Ghtk;

// writing this:
Ghtk::connection('main')->order()->checkStatus('S1.A1.17373471');

// is identical to writing this:
Ghtk::order()->checkStatus('S1.A1.17373471');

// and is also identical to writing this:
Ghtk::connection()->order()->checkStatus('S1.A1.17373471');

// this is because the main connection is configured to be the default
Ghtk::getDefaultConnection(); // this will return main

// we can change the default connection
Ghtk::setDefaultConnection('alternative'); // the default is now alternative
```

If you prefer to use dependency injection over facades like me, then you can easily inject the manager like so:

```php
use Vanthao03596\LaravelGhtk\GhtkManager;
use Illuminate\Support\Facades\App; // you probably have this aliased already

class Foo
{
    protected $ghtk;

    public function __construct(GhtkManager $ghtk)
    {
        $this->ghtk = $ghtk;
    }

    public function bar()
    {
        $this->ghtk->order()->checkStatus('S1.A1.17373471');
    }
}

App::make('Foo')->bar();
```

For more information on how to use the `Vanthao03596\GhtkSdk\Client` class we are calling behind the scenes here, check out the docs at https://github.com/vanthao03596/ghtk-sdk, and the manager class at https://github.com/GrahamCampbell/Laravel-Manager#usage.

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
