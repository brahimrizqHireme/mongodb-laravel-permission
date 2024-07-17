<?php

namespace Houssam\Permission\Middlewares;

use Closure;
use Houssam\Permission\Exceptions\UnauthorizedException;
use Houssam\Permission\Exceptions\UnauthorizedRole;
use Houssam\Permission\Exceptions\UserNotLoggedIn;
use Houssam\Permission\Helpers;
use function explode;
use function is_array;

/**
 * Class RoleMiddleware
 * @package Houssam\Permission\Middlewares
 */
class RoleMiddleware
{
    /**
     * @param $request
     * @param Closure $next
     * @param $role
     *
     * @return mixed
     * @throws UnauthorizedException
     */
    public function handle($request, Closure $next, $role): mixed
    {
        if (app('auth')->guest()) {
            $helpers = new Helpers();
            throw new UserNotLoggedIn(403, $helpers->getUserNotLoggedINMessage());
        }

        $roles = is_array($role) ? $role : explode('|', $role);

        if (! app('auth')->user()->hasAnyRole($roles)) {
            $helpers = new Helpers();
            throw new UnauthorizedRole(403, $helpers->getUnauthorizedRoleMessage(implode(', ', $roles)), $roles);
        }

        return $next($request);
    }
}
