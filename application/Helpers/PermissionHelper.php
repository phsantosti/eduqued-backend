<?php

namespace Application\Helpers;

use Application\Libraries\AuthenticationLibrary;
use Application\Models\User\LevelModel;
use Application\Models\User\LevelPermissionModel;
use Application\Models\User\PermissionModel;
use ReflectionClass;
use Slim\Psr7\Request;

final class PermissionHelper
{
    public static function checkUserHasPermission(object $class, string $method, string $token): bool
    {
        $decodedToken = AuthenticationLibrary::decode($token);
        if(empty($decodedToken)){
            return false;
        } else {
            $reflectionClass = new ReflectionClass($class);

            $level = (new LevelModel())->findById($decodedToken->data->level);
            if(empty($level)){
                return false;
            } else {
                $permission = (new PermissionModel())->find(
                    "controller = :controller AND method = :method",
                    "controller={$reflectionClass->getName()}&method={$method}"
                )->fetch();

                if(empty($permission)){
                    return false;
                } else {
                    $levelPermission = (new LevelPermissionModel())->find(
                        "level = :level AND permission = :permission",
                        "level={$level->id}&permission={$permission->id}"
                    )->fetch();

                    if(empty($levelPermission)){
                        return false;
                    } else {
                        return true;
                    }
                }
            }
        }
    }

    public static function denyAccessResponseMessage(): string
    {
        return json_encode([
            "success" => false,
            "title" => "Ops!",
            "message" => "Acesso negado, você não tem permissão para acessar esse recurso",
            "redirect" => null,
            "content" => null
        ]);
    }

    public static function check(Request $request, object $class, string $method): bool
    {
        $token = AuthenticationLibrary::getTokenFromRequest($request);
        if(empty($token)){
            return false;
        }

        if(!self::checkUserHasPermission($class, $method, $token->getToken())){
            return false;
        }

        return true;
    }
}