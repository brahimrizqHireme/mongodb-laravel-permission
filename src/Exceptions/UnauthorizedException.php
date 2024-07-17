<?php

namespace Houssam\Permission\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;
use function app;
use function config;

/**
 * Class UnauthorizedException
 * @package Houssam\Permission\Exceptions
 */
class UnauthorizedException extends HttpException
{
    private array $requiredRoles;
    private array $requiredPermissions;

    /**
     * UnauthorizedException constructor.
     *
     * @param $statusCode
     * @param string|null $message
     * @param array $requiredRoles
     * @param array $requiredPermissions
     */
    public function __construct(
        $statusCode,
        string $message = null,
        array $requiredRoles = [],
        array $requiredPermissions = []
    ) {
        parent::__construct($statusCode, $message);

        if (config('permission.log_registration_exception')) {
            $logger = app('log');
            $logger->alert($message);
        }

        $this->requiredRoles       = $requiredRoles;
        $this->requiredPermissions = $requiredPermissions;
    }

    /**
     * Return Required Roles
     *
     * @return array
     */
    public function getRequiredRoles(): array
    {
        return $this->requiredRoles;
    }

    /**
     * Return Required Permissions
     *
     * @return array
     */
    public function getRequiredPermissions(): array
    {
        return $this->requiredPermissions;
    }
}
