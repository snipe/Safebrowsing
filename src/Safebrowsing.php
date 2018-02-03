<?php
namespace Snipe\Safebrowsing;


class Safebrowsing {


    function __construct() {
        $this->urls = array();
    }



    /**
    * Invokes the Safebrowing API
    *
    * @author [A. Gianotto] [<snipe@snipe.net>]
    * @param $url string|array
    * @since [v0.1.0]
    * @return String JSON
    */
    public static function checkSafeBrowsing($urls)
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
                "threatEntries" => Safebrowsing::formatUrls($urls),
            ]
        ];

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


    public function addCheckUrls(array $urls) {
        $this->urls = array_merge($this->urls, $urls);
        return $this;
    }


    public function removeUrls(array $urls) {
        $this->urls = array_pop($this->urls, $urls);
        return $this;
    }


    public function execute() {
        $this->results = self::checkSafeBrowsing($this->urls);
    }


    public function isFlagged($url) {
        $results_arr = json_decode($this->results);
        if (isset($results_arr->matches)) {
            foreach ($results_arr->matches as $result) {
                if ($result->threat->url == $url) {
                    return true;
                }
            }
        }
        return false;
    }

    public function getUrls() {
        return $this->urls;
    }


    // Format for google
    public static function formatUrls($urls) {
        $arr = array();
        foreach ($urls as $url) {
            $arr[] = ['url' => $url];
        }
        return $arr;
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
