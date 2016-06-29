<?php
class SafebrowsingTest extends TestCase
{
    public function testAddCheckUrls()
    {

        $start_urls = [
            'http://yahoo.com',
            'http://google.com'
        ];

        Safebrowsing::addCheckUrls($start_urls);

        $add_urls = [
            'http://snipe.net',
            'http://ianfette.org',
        ];

        Safebrowsing::addCheckUrls($add_urls);
        $this->assertEquals(4, count(Safebrowsing::getUrls()));
        $this->assertEquals($add_urls[1], Safebrowsing::getUrls()[3]);
        $this->assertEquals($start_urls[0], Safebrowsing::getUrls()[0]);

    }
}
