<?php

namespace Houssam\Permission\Traits;

use function app;
use function config;

/**
 * Trait RefreshesPermissionCache
 * @package Houssam\Permission\Traits
 */
trait RefreshesPermissionCache
{
    /**
     * Refresh Permission Cache
     *
     * @return void
     */
    public static function bootRefreshesPermissionCache(): void
    {
        static::saved(function () {
            app(config('permission.models.permission'))->forgetCachedPermissions();
        });

        static::deleted(function () {
            app(config('permission.models.permission'))->forgetCachedPermissions();
        });
    }
}
