<?php

namespace Application\Helpers;

final class PasswordHelper
{
    public static function isValid(string $password): bool
    {
        if(password_get_info($password)['algo'] || (mb_strlen($password) >= CONF_PASSWD_MIN_LEN && mb_strlen($password) <= CONF_PASSWD_MAX_LEN)){
            return true;
        } else {
            return false;
        }
    }

    public static function check(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    public static function generate(string $password): string
    {
        if (!empty(password_get_info($password)['algo'])) {
            return $password;
        } else {
            return password_hash($password, CONF_PASSWD_ALGO, CONF_PASSWD_OPTION);
        }
    }
}