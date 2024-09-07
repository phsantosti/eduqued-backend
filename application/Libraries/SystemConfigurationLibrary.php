<?php

namespace Application\Libraries;

use Application\Middlewares\AuthenticationMiddleware;
use Application\Models\User\PermissionModel;
use CoffeeCode\DataLayer\Connect;
use Slim\App;
use Slim\Psr7\Request;

final class SystemConfigurationLibrary
{
    public static function initConfig(App $app, Request $request): App
    {
        $scriptName = $request->getServerParams()['SCRIPT_NAME'];
        $basePath = str_replace("\\", "/", dirname($scriptName));

        if($basePath === "/" || $basePath === "\\"){
            $basePath = "";
        }

        $app->setBasePath($basePath);
        $app->addRoutingMiddleware();
        $app->addErrorMiddleware(CONF_APP_IS_DEBUG, CONF_APP_IS_DEBUG, CONF_APP_IS_DEBUG);
        $app->add(AuthenticationMiddleware::class);

        return $app;
    }

    public static function registerAllPermissions(): void
    {
        $controllerDirectory = __DIR__ . "/../Controllers";
        $controllerFiles = scandir($controllerDirectory);

        if(!empty($controllerFiles)){
            foreach ($controllerFiles as $file){
                if($file != "." && $file != ".."){
                    $path = $controllerDirectory . "/" . $file;
                    if(is_file($path) && pathinfo($path, PATHINFO_EXTENSION) === "php"){
                        $className = "Application\\Controllers\\" . pathinfo($path, PATHINFO_FILENAME);
                        try{
                            $reflectionClass = new \ReflectionClass($className);
                            $methods = $reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC);
                            if(!empty($methods)){
                                foreach ($methods as $method){
                                    if($method->getName() != "__construct"){
                                        $exist = (new PermissionModel())
                                            ->find(
                                                "controller = :controller and method = :method",
                                                "controller={$className}&method={$method->getName()}"
                                        )->count() > 0;
                                        if(!$exist){
                                            $permission = new PermissionModel();
                                            $permission->bootstrap(
                                                "{$className}",
                                                "{$method->getName()}",
                                                "{$className}@{$method->getName()}",
                                                "active"
                                            );
                                            $permission->save();
                                        }
                                    }
                                }
                            }
                        } catch (\ReflectionException $e) {
                            // nothing to do
                        }
                    }
                }
            }
        }
    }

    public static function registerSuperAdminPermissions(): void
    {

        $statement = $db->query()

        $permissions = $db->query()

        $permissions = Connect::getInstance()
            ->query("")
            ->fetchAll(PDO::FETCH_OBJ);

        if(!empty($permissions)){
            foreach ($permissions as $permission){
                $newLevelPermission = new LevelPermissionModel();
                $newLevelPermission->bootstrap(1, $permission->id);
                $newLevelPermission->save();
            }
        }
    }
}