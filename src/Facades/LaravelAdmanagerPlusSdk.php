<?php

namespace SpringfieldClinic\LaravelAdmanagerPlusSdk\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SpringfieldClinic\LaravelAdmanagerPlusSdk\LaravelAdmanagerPlusSdk
 */
class LaravelAdmanagerPlusSdk extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \SpringfieldClinic\LaravelAdmanagerPlusSdk\LaravelAdmanagerPlusSdk::class;
    }
}
