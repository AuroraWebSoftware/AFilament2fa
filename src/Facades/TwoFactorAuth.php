<?php

namespace AuroraWebSoftware\TwoFactorAuth\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AuroraWebSoftware\TwoFactorAuth\TwoFactorAuth
 */
class TwoFactorAuth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \AuroraWebSoftware\TwoFactorAuth\TwoFactorAuth::class;
    }
}
