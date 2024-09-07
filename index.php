<?php
require __DIR__ . "/vendor/autoload.php";

use Application\Libraries\SystemConfigurationLibrary;
use Application\Routes\AuthenticationRoute;
use Application\Routes\DocumentationRoute;
use Application\Routes\StatusRoute;
use Slim\Factory\AppFactory;
use Slim\Psr7\Factory\ServerRequestFactory;

$app = AppFactory::create();
$baseResquest = ServerRequestFactory::createFromGlobals();
SystemConfigurationLibrary::initConfig($app, $baseResquest);
SystemConfigurationLibrary::registerAllPermissions();
/** Basic Routes */
StatusRoute::initRoutes($app);
DocumentationRoute::initRoutes($app);
AuthenticationRoute::initRoutes($app);

$app->run();