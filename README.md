# Safebrowsing
[![Gitter](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/snipe/safebrowsing?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge) [![Build Status](https://travis-ci.org/snipe/Safebrowsing.svg?branch=master)](https://travis-ci.org/snipe/Safebrowsing) [![Latest Stable Version](https://poser.pugx.org/snipe/safebrowsing/v/stable.svg)](https://packagist.org/packages/snipe/safebrowsing) [![Total Downloads](https://poser.pugx.org/snipe/safebrowsing/downloads.svg)](https://packagist.org/packages/snipe/safebrowsing) [![Latest Unstable Version](https://poser.pugx.org/snipe/safebrowsing/v/unstable.svg)](https://packagist.org/packages/snipe/safebrowsing) [![License](https://poser.pugx.org/snipe/safebrowsing/license.svg)](https://packagist.org/packages/snipe/safebrowsing) [![Codacy Badge](https://api.codacy.com/project/badge/Grade/eb21765a140141e6828035a376733a80)](https://www.codacy.com/app/snipe/Safebrowsing?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=snipe/Safebrowsing&amp;utm_campaign=Badge_Grade)

This is a Laravel 5 package to enable you to easily interface with the Google Safebrowsing API. (Other RBL services are coming.)

Right now it's only using the [Google Safebrowsing Lookup API](https://developers.google.com/safe-browsing/v4/lookup-api) (v4), but I'll be updating it to include the Update API as well. The [old Safebrowser v3 (non-package) version](http://snipe.net/2014/04/check-user-submitted-urls-for-malware-and-phishing-in-your-application/) of this script has also included Phishtank and several RBLs, but I think the RBLs have changed how they work so that old code doesn't work anymore.

__This package requires that you have [an active Google Safebrowsing API key](https://developers.google.com/safe-browsing/v4/get-started). It absolutely will not work without one.__ It's free to create an API key (although the process is every bit as confusing and convoluted as you would expect from Google).

Bear in mind that Google does throttle API usage, so if you have a high-traffic site, you may want to build in a caching layer or something so you don't burn through your requests too quickly. You can keep an eye on your usage through the [Google API console](https://console.developers.google.com/apis/api/safebrowsing.googleapis.com/usage).



## Install

### Via Composer

``` bash
$ composer require snipe/safebrowsing
```

### Update config/app.php

Add

``` php
Snipe\Safebrowsing\SafebrowsingServiceProvider::class,
```

to your `providers` array in `config/app.php`, and

``` php
'Safebrowsing' => Snipe\Safebrowsing\Facade\Safebrowsing::class,
```

to your `aliases` array in `config/app.php`.

### Publish the config

``` bash
php artisan vendor:publish
```

### Set Your Google Safebrowsing API Key

In your `.env`, add:

``` bash
GOOGLE_API_KEY=YOUR-ACTUAL-API-KEY
```

There are additional options in the config file that relate to what specific types of threats you want to check for, and what platforms you want to check on, but you only really need to worry about that if you want to check *fewer* things, as it's pretty inclusive already.

## Usage

### Using Blade Syntax

``` php
{{ Safebrowsing::checkSafeBrowsing($urls) }}
```

or

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

GNU GENERAL PUBLIC LICENSE. Please see [License File](LICENSE.md) for more information.

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
