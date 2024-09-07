<?php

namespace Application\Routes;

use Application\Controllers\StatusController;
use Slim\App;

final class StatusRoute
{
    public static function initRoutes(App $app): App
    {
        $app->get("/status", [StatusController::class, 'status']);

        return $app;
    }
}