<?php

namespace Application\Models;

use CoffeeCode\DataLayer\DataLayer;

class AddressModel extends DataLayer
{
    public function __construct()
    {
        parent::__construct("addresses", [
            "zip_code",
            "street",
            "number",
            "complement",
            "neighborhood",
            "city",
            "state",
        ]);
    }
}