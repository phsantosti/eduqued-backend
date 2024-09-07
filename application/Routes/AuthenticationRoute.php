<?php

namespace Application\Routes;

use Application\Controllers\AuthenticationController;
use Slim\App;

final class AuthenticationRoute
{
    public static function initRoutes(App $app): App
    {
        $app->get("/authentication/check", [AuthenticationController::class, 'check']);
        $app->post("/authentication/token", [AuthenticationController::class, 'token']);
        return $app;
    }
}