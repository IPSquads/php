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

To get all the details of an IP Address.
``` php
use Ipsquads\Php\IPSquads;
$ip_squads = new IPSquads('FREE');
$ip_data = $ip_squads->getDetails('54.70.143.245');
```

## JSON Representation
```json
{
  "ip_address": "54.70.143.245",
  "ip_type": "IPv4",
  "country_name": "United States",
  "country_code": "US",
  "country_languages": "en-US,es-US,haw,fr",
  "continent_code": "NA",
  "continent_name": "North America",
  "city": "Boardman",
  "zip": "97818",
  "region_name": "Oregon",
  "region_code": "USOR",
  "latitude": 45.83986,
  "longitude": -119.70058,
  "asn": {
    "asn": 16509,
    "asn_org": "AMAZON-02"
  },
  "location": {
    "is_eu": false,
    "postal_regex": "^d{5}(-d{4})?$",
    "capital": "Washington",
    "calling_code": "1"
  },
  "timezone": {
    "code": "America/Los_Angeles",
    "dst_offset": -7,
    "gmt_offset": -8,
    "current_time": "2020-10-12T22:52:09.911223+05:30",
    "current_time_unix": "1602523329.911223"
  },
  "currency": {
    "name": "Dollar",
    "code": "USD"
  }
}
```

To get only the currency details
``` php
use Ipsquads\Php\IPSquads;
$ip_squads = new IPSquads('FREE');
$ip_data = $ip_squads->getCurrencyDetails('54.70.143.245');
```

To get only the timezone details
``` php
use Ipsquads\Php\IPSquads;
$ip_squads = new IPSquads('FREE');
$ip_data = $ip_squads->getTimezoneDetails('54.70.143.245');
```

To get only the network details
``` php
use Ipsquads\Php\IPSquads;
$ip_squads = new IPSquads('FREE');
$ip_data = $ip_squads->getNetworkDetails('54.70.143.245');
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
