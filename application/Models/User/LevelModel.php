<?php

namespace Application\Models\User;

use CoffeeCode\DataLayer\DataLayer;

class LevelModel extends DataLayer
{
    public function __construct()
    {
        parent::__construct("levels", [
            "name",
            "status"
        ]);
    }

    public function bootstrap(string $name, string $status = "active"): LevelModel
    {
        $this->name = $name;
        $this->status = $status;
        return $this;
    }
}