<?php

namespace BunoWave\ReCloud\Facades;

use BunoWave\ReCloud\Client;
use Illuminate\Support\Facades\Facade;

class ReCloud extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Client::class;
    }
}
