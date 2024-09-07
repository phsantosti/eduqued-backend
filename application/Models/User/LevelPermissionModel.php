<?php

namespace Application\Models\User;

use CoffeeCode\DataLayer\DataLayer;

class LevelPermissionModel extends DataLayer
{
    public function __construct()
    {
        parent::__construct("levels_permissions", [
            "level",
            "permission",
            "status"
        ]);
    }

    public function bootstrap(int $level, int $permission, string $status = "active"): LevelPermissionModel
    {
        $this->level = $level;
        $this->permission = $permission;
        $this->status = $status;
        return $this;
    }

    public function getLevel(): DataLayer
    {
        return (new LevelModel())->findById($this->level);
    }

    public function getPermission(): DataLayer
    {
        return (new PermissionModel())->findById($this->permission);
    }
}