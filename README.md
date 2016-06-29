# Safebrowsing

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

This is a Laravel 5 package to easily enable you to interface with the Google Safebrowsing API and other RBL services that check for malicious links.

## Install

Via Composer

``` bash
$ composer require snipe/safebrowsing
```

## Usage

``` php
$safebrowsing = new Snipe\safebrowsing();
echo $safebrowsing->echoPhrase('Hello, League!');
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
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
