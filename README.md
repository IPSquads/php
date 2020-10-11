# PHP Library for IP Address Geolocation, Timezone, Currency & other information.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ipsquads/php.svg?style=flat-square)](https://packagist.org/packages/ipsquads/php)
![Tests](https://github.com/IPSquads/php/workflows/Tests/badge.svg?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/ipsquads/php.svg?style=flat-square)](https://packagist.org/packages/ipsquads/php)

IPSquads PHP library for IP Address Geolocation, Timezone, Currency & other information.

## Installation

You can install the package via composer:

```bash
composer require ipsquads/php
```

## Usage

``` php
use Ipsquads\Php\IPSquads;
$ip_squads = new IPSquads('FREE');
$ip_data = $ip_squads->getDetails('54.70.143.245');
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Sdklab007](https://github.com/Sdklab007)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
