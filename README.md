# PHP Library for IP Address Geolocation, Timezone, Currency & other information.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ipsquads/php.svg?style=flat-square)](https://packagist.org/packages/ipsquads/php)
![Tests](https://github.com/IPSquads/php/workflows/Tests/badge.svg?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/ipsquads/php.svg?style=flat-square)](https://packagist.org/packages/ipsquads/php)

IPSquads PHP library for IP Address Geolocation, Timezone, Currency & other information.

## How companies are using IP Squads API?

IPSquads is helping many companies & organizations for various use-cases:

- Content Localization
- Analytics
- Fraud Prevention
- Targeted online advertising
- Geographic rights management

## Getting Started

By default, requests are throttled at 20 requests per minute if access key is not passed. You can remove this throttle limit by getting a FREE access key through which you can make 1000  unthrottled requests per day.

If you are a non-profit organization, you may request to increase this limit. You can drop us a mail at support@ipsquads.com.

If you would like to upgrade for more than 1000 requests per day, you may select the plan here: https://ipsquads.com/product/


## Installation
In-order to get started, 

You can install the package via composer:

```bash
composer require ipsquads/php
```

## Usage

To get all the details of an IP Address.
``` php
use Ipsquads\Php\IPSquads;
$access_key = 'FREE';
$ip_squads = new IPSquads($access_key);
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

### To get only the currency details
If you are interested in only currency details, you can use the below method.

``` php
use Ipsquads\Php\IPSquads;
$access_key = 'FREE';
$ip_squads = new IPSquads($access_key);
$ip_data = $ip_squads->getCurrencyDetails('54.70.143.245');
```

### To get only the timezone details
If you are interested in only getting the timezone details of a visitor based on the IP Address, you can do that using the below method.
``` php
use Ipsquads\Php\IPSquads;
$access_key = 'FREE';
$ip_squads = new IPSquads($access_key);
$ip_data = $ip_squads->getTimezoneDetails('54.70.143.245');
```

### To get only the network details
If you are only looking for the network details of an IP Address, you can do using the below method.
``` php
use Ipsquads\Php\IPSquads;
$access_key = 'FREE';
$ip_squads = new IPSquads($access_key);
$ip_data = $ip_squads->getNetworkDetails('54.70.143.245');
```

## Caching
By default, any result returned from IPSquads server are cached for quick access & prevent you from using more credits unnecessarily. 

Under the hood, this SDK uses [symfony/cache](https://github.com/symfony/cache) library for caching.

The default TTL of cache is 3600 seconds. If you would like to increase or decrease this limit, you can do so by modifying the way IPSquads is getting initialized.

``` php
use Ipsquads\Php\IPSquads;
$access_key = 'FREE';
$settings = [
  'expires_after' => '1000'
];
$ip_squads = new IPSquads($access_key, $settings);
```

### Cache adapter
As a default, FilesystemAdapter cache is used. If you would like to use any other adapter of symfony/cache library, you can do so by passing the instance of a Cache Adapter. To check the available cache adapters, [click here](https://symfony.com/doc/current/components/cache.html#available-cache-adapters).

``` php
use Ipsquads\Php\IPSquads;
use Symfony\Component\Cache\Adapter\ApcuAdapter;
$access_key = 'FREE';
$settings = [
  'cache_adapter' => (new ApcuAdapter)
];
$ip_squads = new IPSquads($access_key, $settings);
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

The Apache License. Please see [License File](LICENSE.md) for more information.
