<?php namespace Snipe\Safebrowsing\Facade;

use Illuminate\Support\Facades\Facade;

class Safebrowsing extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'safebrowsing';
    }

}
