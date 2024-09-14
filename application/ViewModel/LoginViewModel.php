<?php

namespace Application\ViewModel;

class LoginViewModel
{
    public string $email;
    public string $password;
    public string $grantType;

    public function __construct(?array $data)
    {
        $this->email = $data["email"];
        $this->password = $data["password"];
        $this->grantType = $data["grantType"];
    }
}