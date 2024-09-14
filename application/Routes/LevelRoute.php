<?php

namespace Application\Routes;

use Application\Controllers\LevelController;
use Slim\App;

final class LevelRoute
{
    public static function initRoutes(App $app): App
    {
        $app->post("/levels/search", [LevelController::class, 'search']);
        return $app;
    }
}