<?php

namespace Application\Controllers;

use Slim\Psr7\Request;
use Slim\Psr7\Response;

class StatusController
{
    public function status(Request $request, Response $response, $args): Response
    {
        $response->getBody()->write(json_encode([
            "success" => true,
            "title" => "Ok",
            "message" => "All services is green",
            "redirect" => null,
            "content" => null
        ]));

        return $response->withHeader('Content-Type', 'application/json');
    }
}