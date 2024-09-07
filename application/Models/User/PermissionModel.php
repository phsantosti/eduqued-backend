<?php

namespace Application\Models\User;

use CoffeeCode\DataLayer\Connect;
use CoffeeCode\DataLayer\DataLayer;

class PermissionModel extends DataLayer
{
    public function __construct()
    {
        parent::__construct("permissions", [
            "controller",
            "method",
            "description",
            "status"
        ]);
    }

    public function bootstrap(string $controller, string $method, string $description, string $status = "active"): PermissionModel
    {
        $this->controller = $controller;
        $this->method = $method;
        $this->description = $description;
        $this->status = $status;
        return $this;
    }

    public function registerSuperAdminPermissions(): void
    {
        $sql = "SELECT * FROM permissions WHERE permissions.id NOT IN (SELECT levels_permissions.permission FROM levels_permissions WHERE levels_permissions.level = 1);";

        $db = Connect::getInstance();
    }
}