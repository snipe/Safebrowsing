<?php
namespace Snipe\Safebrowsing;


class Safebrowsing {


    function __construct() {
        $this->urls = array();
    }


    /*
    $urls = [
        'http://www.yahoo.com/',
        'http://www.google.com/',
        'http://malware.testing.google.test/testing/malware/',
        'http://twitter.com/',
        'http://ianfette.org',

    ];
    //return trans('safebrowsing::messages.greeting');
    //
    //     ok      http://www.yahoo.com/
    //     ok      http://www.google.com/
    //     malware http://malware.testing.google.test/testing/malware/
    //     ok      http://twitter.com/
    //     malware http://ianfette.org
    //     ok      https://github.com/
    //
    //
    return self::checkSafeBrowsing($urls);

     */

    /**
    * Invokes the Safebrowing API
    *
    * @author [A. Gianotto] [<snipe@snipe.net>]
    * @param $url string|array
    * @since [v1.0]
    * @return String JSON
    */

    public function checkSafeBrowsing($urls)
    {

        $postUrl = 'https://safebrowsing.googleapis.com/v4/threatMatches:find?key='.config('safebrowsing.google.api_key');


        $payload = [
            'client' => [
                'clientId' => config('safebrowsing.google.clientId'),
                'clientVersion' => config('safebrowsing.google.clientVersion'),
            ],
            'threatInfo' => [
                "threatTypes"       =>   config('safebrowsing.google.threat_types'),
                "platformTypes"     =>   config('safebrowsing.google.threat_platforms'),
                "threatEntryTypes" => ["URL"],
                "threatEntries" => $this->formatUrls($urls),
            ]
        ];
        dd($payload);
        $ch = curl_init();
        $timeout = config('safebrowsing.google.timeout');
        curl_setopt($ch,CURLOPT_URL,$postUrl);
        curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Connection: Keep-Alive'
            ));

        $data = curl_exec($ch);
        $responseDecoded = json_decode($data, true);
        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);


        if ($responseCode != 200) {
            return $responseDecoded;
        }

        return $data;
    }


    // public function addCheckUrl($url) {
    //     $this->urls[] = $url;
    //     return $this->urls;
    // }

    public function addCheckUrls(array $urls) {
        //print_r($urls);
        //  foreach( $urls as $url ) {
        //      $this->urls[] = array_push($this->urls, $url);
        //  }
        $this->urls = array_merge($this->urls, $urls);
        return $this->urls;
    }


    public function removeUrl() {

    }


    public function execute() {
        $this->results = self::checkSafeBrowsing($this->urls);
        return $this->results;
    }

    // parse through the results
    public function isFlagged() {

    }

    public function getUrls() {
        return $this->urls;
    }

    public function formatUrls($urls) {
        $this->urls[] = $this->addCheckUrls($urls);
        return $this->urls;
    }


    /**
     * Cleans the URL for prep for RBL check
     *
     * Not currently used.
     * @param string $url The URL to check
     * @return mixed true if blacklisted, false if not blacklisted
     */
    // public static function parseAndCleanUrl($url)
    // {
    //     if ($parsed = parse_url($url)) {
    //         $parsed['host'] = trim($parsed['host']);
    //         $parsed['host'] = preg_replace( '/^www\.(.+\.)/i', '$1', $parsed['host']);
    //         return $parsed;
    //     }
    //     return false;
    // }

    /**
     * Check a URL against the 3 major blacklists
     * AG note: the 'zen.spamhaus.org' and 'black.uribl.com' URL blacklists
     * are currently not responding with valid DNS, so I am leaving them out for now
     *
     * @param string $url The URL to check
     * @return mixed true if blacklisted, false if not blacklisted
     */
    // public static function RblCheck($url)
    // {
    //     if ($parsed = self::parseAndCleanUrl($url)) {
    //         $blacklists = config('safebrowsing.rbls');
    //
    //         // Check against each blacklist, exit if blacklisted
    //         foreach ($blacklists as $blacklist) {
    //             $domain = $parsed['host'] . '.' . $blacklist . '.';
    //
    //             $record = dns_get_record(trim($domain));
    //             if (count($record) > 0 ) {
    //                 echo '<li>'.$domain.' - BLACKLISTED';
    //                 return true;
    //             } else {
    //                 echo '<li>'.$domain.' - NOT BLACKLISTED';
    //             }
    //             echo '<li>Records: '.count($record);
    //
    //          }
    //
    //          return false;
    //
    //      // the evaluation from the parse() function returned false
    //      }
    //      return false;
    // }


}
