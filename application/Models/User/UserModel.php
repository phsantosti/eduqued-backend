<?php

namespace Application\Models\User;

use CoffeeCode\DataLayer\DataLayer;

class UserModel extends DataLayer
{
    public function __construct()
    {
        parent::__construct("users", [
            "first_name",
            "last_name",
            "email",
            "password",
            "level",
            "document",
            "birth_date",
            "address",
            "status"
        ]);
    }

    public function bootstrap(string $first_name, string $last_name, string $email, string $password, int $level, string $document, string $birth_date, int $address, string $status = "active"): UserModel
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
        $this->level = $level;
        $this->document = $document;
        $this->birth_date = $birth_date;
        $this->address = $address;
        $this->status = $status;
        return $this;
    }
}