<?php
require __DIR__ . "/vendor/autoload.php";

use Slim\Factory\AppFactory;
use Slim\Psr7\Factory\ServerRequestFactory;

$app = AppFactory::create();

$baseResquest = ServerRequestFactory::createFromGlobals();

\Application\Libraries\SystemConfigurationLibrary::initConfig($app, $baseResquest);
\Application\Libraries\SystemConfigurationLibrary::registerAllPermissions();

/** Basic Routes */
\Application\Routes\StatusRoute::initRoutes($app);
\Application\Routes\DocumentationRoute::initRoutes($app);
\Application\Routes\AuthenticationRoute::initRoutes($app);
\Application\Routes\LevelRoute::initRoutes($app);
\Application\Routes\BannerRoute::initRoutes($app);

$app->run();