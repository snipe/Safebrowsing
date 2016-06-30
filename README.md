# Safebrowsing

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

This is a Laravel 5 package to enable you to easily interface with the Google Safebrowsing API. (Other RBL services are coming.)

## Prerequisites

This package requires that you have an active Google Safebrowing API key.

## Install

Via Composer

``` bash
$ composer require snipe/safebrowsing
```

Then add

``` php
Snipe\Safebrowsing\SafebrowsingServiceProvider::class,
```

to your `providers` array in `config/app.php`, and

``` php
'Safebrowsing' => Snipe\Safebrowsing\Facade\Safebrowsing::class,
```

to your `aliases` array in `config/app.php`.


## Usage

### Using Blade Syntax

``` php
{{ Safebrowsing::checkSafeBrowsing($urls) }}
```

of

``` php
@if (Safebrowsing::isFlagged('http://twitter.com/'))
    // do something if the url is flagged as suspicious
@else
    // hooray - it's not flagged!
@endif
```



where `$url` is an array of URLs that you would like to check against the Google Safebrowsing API.

### Using Facades
``` php
Safebrowsing::addCheckUrls(['http://ianfette.org']);
Safebrowsing::addCheckUrls(['http://malware.testing.google.test/testing/malware/']);
Safebrowsing::execute();
print('Status of the third URL is: '.Safebrowsing::isFlagged('http://twitter.com/'));
```

## Test URLs

Here are some handy test urls you can use while you're experimenting with the system.

- http://www.yahoo.com/ (OK)
- http://www.google.com/ (OK)
- http://malware.testing.google.test/testing/malware/ (Malware)
- http://twitter.com/ (OK)
- http://ianfette.org (malware)
- https://github.com/ (OK)

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

From the package

``` bash
`../../../vendor/bin/phpunit`
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email snipe@snipe.net instead of using the issue tracker.

## Credits

- [A. Gianotto][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/snipe/safebrowsing.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/snipe/safebrowsing/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/snipe/safebrowsing.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/snipe/safebrowsing.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/snipe/safebrowsing.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/snipe/safebrowsing
[link-travis]: https://travis-ci.org/snipe/safebrowsing
[link-scrutinizer]: https://scrutinizer-ci.com/g/snipe/safebrowsing/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/snipe/safebrowsing
[link-downloads]: https://packagist.org/packages/snipe/safebrowsing
[link-author]: https://github.com/snipe
[link-contributors]: ../../contributors
