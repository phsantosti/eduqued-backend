<?php

namespace Application\Routes;

use Application\Controllers\BannerController;
use Slim\App;

final class BannerRoute
{
    public static function initRoutes(App $app): App
    {
        $app->get("/website/banners/search", [BannerController::class, 'wSearch']);
        return $app;
    }
}