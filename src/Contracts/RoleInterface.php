<?php

namespace Houssam\Permission\Contracts;

use Houssam\Permission\Exceptions\RoleDoesNotExist;

/**
 * Interface RoleInterface
 * @package Houssam\Permission\Contracts
 */
interface RoleInterface
{
    /**
     * A role may be given various permissions.
     */
    public function permissionsQuery();

    /**
     * Find a role by its name and guard name.
     *
     * @param string $name
     * @param string|null $guardName
     *
     * @return RoleInterface
     *
     * @throws RoleDoesNotExist
     */
    public static function findByName(string $name, ?string $guardName): RoleInterface;

    /**
     * Determine if the user may perform the given permission.
     *
     * @param string|PermissionInterface $permission
     *
     * @return bool
     */
    public function hasPermissionTo(string|PermissionInterface $permission): bool;
}
