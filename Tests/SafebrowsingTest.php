<?php

use Snipe\Safebrowsing\Safebrowsing;

class SafebrowsingTest extends \PHPUnit_Framework_TestCase
{
    public function testAddCheckUrls()
    {
        $safebrowsing = new Safebrowsing();

        $start_urls = [
            'http://yahoo.com',
            'http://google.com'
        ];

        $safebrowsing->addCheckUrls($start_urls);

        $add_urls = [
            'http://snipe.net',
            'http://ianfette.org',
        ];

        $safebrowsing->addCheckUrls($add_urls);
        $this->assertEquals(4, count($safebrowsing->getUrls()));
        $this->assertEquals($add_urls[1], $safebrowsing->getUrls()[3]);
        $this->assertEquals($start_urls[0], $safebrowsing->getUrls()[0]);

    }

}
