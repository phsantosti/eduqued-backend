<?php

namespace Application\Routes;

use Application\Controllers\StatusController;
use Slim\App;

final class DocumentationRoute
{
    public static function initRoutes(App $app): App
    {
        $app->get("/documentation", [StatusController::class, 'status']);

        return $app;
    }
}