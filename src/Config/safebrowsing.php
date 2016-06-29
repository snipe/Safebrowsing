<?php

use Aws\Laravel\AwsServiceProvider;

return [

    /*
    |--------------------------------------------------------------------------
    | Google Safebrowsing Configuration
    |--------------------------------------------------------------------------
    | Many of these entries can be left as default unless you want something different, however
    | the Google Safebrowsing key is required.
    |
    | IMPORTANT: Google Safebrowsing free tier is throttled. You can view your current API
    | limits here: https://console.cloud.google.com/apis/api/safebrowsing.googleapis.com/quotas?project=laravel-safebrowsing-test
    |
    | For more information on options:
    |
    | Platform Type: https://developers.google.com/safe-browsing/v4/reference/rest/v4/PlatformType
    | Threat Types: https://developers.google.com/safe-browsing/v4/reference/rest/v4/ThreatType
    */

    'google' => [
        'api_key' => env('GOOGLE_API_KEY'),
        'timeout' => 10,
        'threat_types' => [
            'THREAT_TYPE_UNSPECIFIED',
            'MALWARE',
            'SOCIAL_ENGINEERING',
            'UNWANTED_SOFTWARE',
            'POTENTIALLY_HARMFUL_APPLICATION',
        ],

        'threat_platforms' => [
            'PLATFORM_TYPE_UNSPECIFIED',
            'WINDOWS',
            'LINUX',
            'ANDROID',
            'OSX',
            'IOS',
            'ANY_PLATFORM',
        ],

        'clientId' => 'snipe-safebrowsing',
        'clientVersion' => '1.0',
    ],


    // These are not currently working
    'rbls' => [
        'zen.spamhaus.org',
        'multi.surbl.org',
        'black.uribl.com',
    ],

];
