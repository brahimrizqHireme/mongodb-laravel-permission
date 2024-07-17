<?php

namespace Houssam\Permission\Commands;

use Illuminate\Console\Command;
use function app;
use function config;

/**
 * Class CreatePermission
 * @package Houssam\Permission\Commands
 */
class CreatePermission extends Command
{
    protected $signature = 'permission:create-permission
                {name : The name of the permission}
                {guard? : The name of the guard}';

    protected $description = 'Create a permission';

    public function handle()
    {
        $permissionClass = app(config('permission.models.permission'));

        $permission = $permissionClass::create([
            'name'       => $this->argument('name'),
            'guard_name' => $this->argument('guard')
        ]);

        $this->info("Permission `$permission->name` created");
    }
}
